<?php

namespace App\Http\Livewire\Auth;

use App\Actions\User\UserCreator;
use App\Models\User;
use Livewire\Component;

class Register extends Component
{
    public $name      = null;
    public $email     = null;
    public $password  = null;
    public $role      = null;
    public $device_id = null;

    private $dummies = [
        [
            'name' => 'Albert Einstein',
            'email' => 'email@relative.is',
        ],
        [
            'name' => 'Master Yoda',
            'email' => 'gmail@youremail.com',
        ],
        [
            'name' => 'Elon Musk',
            'email' => 'falconheavy@spacex.com',
        ],
    ];

    public $dummy = [];

    public function mount()
    {
        $this->device_id = unique_device_id();

        $this->role = User::CONTRIBUTOR;

        $this->dummy = $this->dummies[mt_rand(0,2)];
    }

    public function rules()
    {
        return (new \App\Http\Requests\Auth\Register)->rules();
    }

    public function updatedEmail()
    {
        $this->validate(['email' => 'unique:users']);
    }

    public function register(UserCreator $creator)
    {
        $user = $creator->create($this->validate());

        auth()->login($user);

        return redirect('/');
    }

    public function render()
    {
        return view('livewire.auth.register')
            ->layout('layouts.auth');
    }
}

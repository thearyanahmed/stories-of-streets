<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public User $user;

    public $upload;

    protected $rules = [
        'user.about' => 'max:140',
        'user.username' => 'max:24|unique:users,username',
        'upload' => 'nullable|image|max:1000',
    ];

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function save()
    {
        $this->rules['user.username'] = 'max:24|unique:users,username,' . $this->user->id;
        $this->validate();

        $this->user->save();

        $this->upload && $this->user->update([
            'avatar' => $this->upload->store('/', 'avatars'),
        ]);

        $this->emitSelf('notify-saved');
    }
}

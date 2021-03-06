<?php

namespace App\Http\Livewire\User;

use Artesaos\SEOTools\Traits\SEOTools;
use Livewire\Component;
use App\Models\User;

class View extends Component
{
    use SEOTools;

    public $user;

    public function mount($id)
    {
        $this->user = User::with([
            'posts' => function($post) {
                $post->select('id','user_id','slug','title','summary','published_at')->latest();
            }
        ])->find($id);

        abort_if(empty($this->user),404);

        $this->seo()->setTitle($this->user->name . ' | ' . config('app.name'));
        $this->seo()->setDescription($this->user->summary . ' | ' . config('app.name'));
        $this->seo()->setCanonical(route('users.read',$this->user->id));
    }

    public function render()
    {
        return view('livewire.user.view')->layout('layouts.user')->with( [
            'user' => $this->user,
        ]);
    }
}

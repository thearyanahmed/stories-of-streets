<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Canvas\Models\Post;

class Welcome extends Component
{
    public function render()
    {
        $stories = Post::with(['user' => function($user) {
            $user->select('id','name');
        }])
        ->select('title','slug','featured_image','published_at','user_id','summary')
        ->published()
        ->orderBy('published_at')
        ->get();

        return view('livewire.welcome')->layout('layouts.user')->with([
            'stories' => $stories
        ]);
    }
}

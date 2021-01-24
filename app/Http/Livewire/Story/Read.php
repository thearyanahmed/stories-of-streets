<?php

namespace App\Http\Livewire\Story;

use Livewire\Component;
use Canvas\Models\Post;

class Read extends Component
{
    private $story;

    public function mount($slug)
    {
        $this->story = Post::with([
            'user' => function($user) {
                $user->select('id','name');
            }])
            ->whereSlug($slug)
            ->published()
            ->first();

        if(! $this->story) {
            abort(404);
        }
    }

    public function render()
    {
        return view('livewire.story.read')->layout('layouts.user')->with(['story' => $this->story]);
    }
}

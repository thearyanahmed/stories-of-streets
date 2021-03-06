<?php

namespace App\Http\Livewire;

use Artesaos\SEOTools\Traits\SEOTools;
use Livewire\Component;
use Canvas\Models\Post;

class Welcome extends Component
{
    use SEOTools;

    /**
     * @return mixed
     */
    public function render()
    {
        $stories = Post::with(['user' => function($user) {
            $user->select('id','name');
        }])
        ->select('title','slug','featured_image','published_at','user_id','summary')
        ->published()
        ->orderBy('published_at')
        ->get();

        $this->setupSeo();

        return view('livewire.welcome')->layout('layouts.user')->with([
            'stories' => $stories
        ]);
    }

    private function setupSeo()
    {
        $this->seo()->setTitle('Binary Threads');
        $this->seo()->setDescription('Your daily tech magazine');
        $this->seo()->setCanonical(url('/'));
    }
}

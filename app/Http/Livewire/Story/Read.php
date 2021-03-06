<?php

namespace App\Http\Livewire\Story;

use Artesaos\SEOTools\Traits\SEOTools;
use Livewire\Component;
use Canvas\Models\Post;

class Read extends Component
{
    use SEOTools;

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

        $this->seo()->setTitle($this->story->title);
        $this->seo()->setDescription($this->story->summary);
        $this->seo()->opengraph()->setUrl(route('story.read',$this->story->slug));
        $this->seo()->opengraph()->addProperty('type', 'articles');
        $this->seo()->twitter()->setSite('@LuizVinicius73');
        $this->seo()->jsonLd()->setType('Article');
    }

    public function render()
    {
        return view('livewire.story.read')->layout('layouts.user')->with(['story' => $this->story]);
    }
}

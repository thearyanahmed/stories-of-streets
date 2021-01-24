<?php

namespace App\Http\Livewire\Story\Cards;

use Livewire\Component;

class Base extends Component
{
    public $story;

    public function render()
    {
        return view('livewire.story.cards.base');
    }
}

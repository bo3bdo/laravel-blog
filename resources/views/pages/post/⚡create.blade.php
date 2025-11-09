<?php

use Livewire\Component;

new class extends Component
{
    public $title;

    public function mount()
    {
        $this->title = 'Create Post';
    }
};
?>

<div>
    It is quality rather than quantity that matters. - Lucius Annaeus Seneca {{ $title }}
</div>
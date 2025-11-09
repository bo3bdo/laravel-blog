<?php

namespace App\Livewire\Pages\Post;

use App\Models\Post;
use Illuminate\Support\Str;
use Livewire\Component;

class CreatePost extends Component
{
    public string $title = '';

    public ?string $excerpt = null;

    public string $content = '';

    public ?string $featured_image = null;

    public bool $is_published = false;

    public function mount(): void
    {
        if (! auth()->check()) {
            $this->redirect(route('login'));
        }
    }

    public function save()
    {
        $this->authorize('create', Post::class);

        $validated = $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'featured_image' => ['nullable', 'string', 'max:255'],
            'is_published' => ['boolean'],
        ]);

        $post = Post::create([
            ...$validated,
            'user_id' => auth()->id(),
            'slug' => Str::slug($this->title),
            'published_at' => $this->is_published ? now() : null,
        ]);

        session()->flash('success', 'Post created successfully.');

        return $this->redirect(route('posts.show', $post));
    }

    public function render()
    {
        return view('livewire.pages.post.create-post')
            ->layout('components.layouts.app', ['title' => 'Create Post']);
    }
}

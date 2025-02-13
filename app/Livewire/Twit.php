<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class Twit extends Component
{   
    use WithFileUploads;
    public $now_page=10;
    public $isOpen = false;
    public $title, $body, $image, $post_id, $type;

    public function render()
    {
        return view('livewire.twit', [
            'posts' => Post::latest()->paginate($this->now_page),
        ]);
    }
    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }
    public function openModal()
    {
        $this->isOpen = true;
    }
    public function closeModal()
    {
        $this->isOpen = false;
    }
    public function resetInputFields()
    {
        $this->reset(['title', 'body', 'image', 'post_id', 'type']);
    }
    public function store()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'type' => 'required|string|max:50',
        ]);
        $image = $this->image->store('images', 'public');
        Post::updateOrCreate(['id' => $this->post_id], [
            'title' => $this->title,
            'body' => $this->body,
            'image' => $image,
            'type' => $this->type
        ]);
        session()->flash('message', $this->post_id ? 'Post Updated Successfully.' : 'Post Created Successfully.');
        $this->closeModal();
        $this->resetInputFields();
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class Posts extends Component
{
    use WithFileUploads;

    public $title, $body, $image, $post_id, $type;
    public $isOpen = false;

    public function render()
    {
        return view('livewire.posts', [
            'posts' => Post::latest()->get()
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

    private function resetInputFields()
    {
        $this->reset(['title', 'body', 'image', 'post_id', 'type']);
    }

    public function store()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'type' => 'required|string|max:50'
        ]);
    
        $imagePath = null;
    
        if ($this->post_id) {
            $oldPost = Post::find($this->post_id);
            if ($oldPost) {
                $imagePath = $oldPost->image; // Gunakan gambar lama jika tidak diubah
            }
        }
    
        if ($this->image) {
            // Jika ada gambar baru, hapus gambar lama (jika ada)
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $this->image->store('posts', 'public');
        }
    
        Post::updateOrCreate(['id' => $this->post_id], [
            'title' => $this->title,
            'body' => $this->body,
            'image' => $imagePath,
            'type' => $this->type
        ]);
    
        session()->flash('message', $this->post_id ? 'Post updated successfully.' : 'Post created successfully.');
    
        $this->closeModal();
        $this->resetInputFields();
    }
    

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        
        $this->post_id = $post->id;
        $this->title = $post->title;
        $this->body = $post->body;
        $this->type = $post->type;

        $this->openModal();
    }

    public function delete($id)
    {
        $post = Post::find($id);
        if ($post) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $post->delete();
            session()->flash('message', 'Post deleted successfully.');
        }
    }
}
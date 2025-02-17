<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;

class Posts extends Component
{
    use WithFileUploads;

    public $title, $body, $image, $post_id, $type, $link;
    public $isOpen = false;

    public function render()
    {
        return view('livewire.posts', [
            'posts' => Post::latest()->paginate(5)
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
        $this->reset(['title', 'body', 'image', 'post_id', 'type', 'link']);
    }

    public function store()
    {
        Log::info('Data diterima:', [
            'title' => $this->title,
            'body' => $this->body,
            'image' => $this->image,
            'type' => $this->type,
            'link' => $this->link
        ]);

        $this->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|image|max:10240', // 10MB Max
            'type' => 'required|string|max:50',
            'link' => 'required|url|max:255'
        ]);

        $imagePath = $this->post_id ? Post::find($this->post_id)->image : null;

        if ($this->image) {
            // Delete old image if exists
            if ($imagePath && file_exists(public_path('storage/posts/' . basename($imagePath)))) {
                unlink(public_path('storage/posts/' . basename($imagePath)));
            }
            
            // Create posts directory if it doesn't exist
            $uploadPath = public_path('storage/posts');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // Generate unique filename
            $filename = time() . '_' . $this->image->getClientOriginalName();
            
            // Move uploaded file directly to public/storage/posts
            $this->image->move(public_path('storage/posts'), $filename);
            
            // Update image path
            $imagePath = 'storage/posts/' . $filename;
        }

        Post::updateOrCreate(['id' => $this->post_id], [
            'title' => $this->title,
            'body' => $this->body,
            'image' => $imagePath,
            'type' => $this->type,
            'link' => $this->link
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
        $this->link = $post->link;

        $this->openModal();
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);
        if ($post->image && file_exists(public_path('storage/posts/' . basename($post->image)))) {
            unlink(public_path('storage/posts/' . basename($post->image)));
        }
        $post->delete();
        session()->flash('message', 'Post deleted successfully.');
    }
}
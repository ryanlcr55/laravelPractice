<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PostRepository;
	
class PostController extends Controller
{
   protected $postRepo;

    public function __construct(PostRepository $postRepo)
    {
        $this->postRepo = $postRepo;
    }

    public function index()
    {
        $posts = $this->postRepo->index();
        return view('post.index', ['posts' => $posts]);
    }

    // ...略

    public function show($id)
    {
        $post = $this->postRepo->find($id);
        
        if (!$post) {
            return redirect()->route('post.index');
        }
        
        return view('post.show', ['post' => $post]);
    }
	
    public function create()
    {
        return view('post.create');
    }

    public function store()
    {
        $post = $this->postRepo->create(request()->only('title', 'content'));
    
        if ($post) {
            return redirect()->route('post.show', $post->id);
        }
    
        return back();
    }
    
    public function edit($id)
    {
        $post = $this->postRepo->find($id);

        if (!$post) {
            return redirect()->route('post.index');
        }

        return view('post.edit', ['post' => $post]);
     }

    public function update($id)
    {
        $result = $this->postRepo->update($id, request()->only('title', 'content'));
 
       if (!$result) {
           return redirect()->route('post.index');
        }

       return redirect()->route('post.show', $id);
    }


    public function destroy($id)
    {
        $result = $this->postRepo->delete($id);
     
        if ($result) {
            return redirect()->route('post.index');
        }
    
        return back();
    }
}

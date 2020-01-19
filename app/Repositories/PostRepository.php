<?php


namespace App\Repositories;

use App\Entities\Post;

class PostRepository
{
    public function index()
    {
        return Post::with('user')->get();
    }

    public function find($id)
    {
        return Post::with('user')->find($id);
    }

	 public function delete($id)
    {
        return Post::destroy($id);
    }

	 public function create(array $data)
    {
        return auth()->user()->posts()->create($data);
    }

    public function update($id, array $data)
    {
        $post = Post::find($id);
        return $post ? $post->update($data) : false;
    }

    /**
     * 取得最新10筆文章
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function latest10()
    {
        return Post::query()->orderBy('id', 'desc')->limit(10)->get();
    }
}

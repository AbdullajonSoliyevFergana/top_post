<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function addPost(Request $request){
        $file = $request->file('image');
        $image = $this->uploadFile($file, "post/image/");

        Post::create([
            'author_id' => $request->author->id,
            'image' => $image,
            'title' => $request->title,
            'body' => $request->body,
            'created_at' => Carbon::now()
        ]);

        return $this->sendResponse(null, true, "Muvaffaqiyatli qo'shildi!");
    }

    public function detailPost($post_id){

        $post = Post::where('id', $post_id)->first();
        if ($post == null){
            return $this->sendResponse(null, false, "Post topilmadi!");
        }

        return $this->sendResponse($post, true, "");
    }

    public function updatePost(Request $request, $post_id){


        $post = Post::where('id', $post_id)->first();
        if ($post == null){
            return $this->sendResponse(null, false, "Post topilmadi!");
        }

        $file = $request->file('image');
        $image = $this->uploadFile($file, "post/image/", "update", $post->image);

        $post->update([
            'image' => $image,
            'title' => $request->title,
            'body' => $request->body,
        ]);
        return $this->sendResponse(null, true, "Muvaffaqiyatli o'zgartirildi!");
    }

    public function deletePost($post_id){

        $post = Post::where('id', $post_id)->first();
        if ($post == null){
            return $this->sendResponse(null, false, "Post topilmadi!");
        }
        $this->uploadFile(null, null, "unlink", $post->image);
        $post->delete();
        return $this->sendResponse(null, true, "Muvaffaqiyatli o'chirildi!");
    }

    public function myListPost(Request $request){
        $author = $request->author;
        $my_posts = Post::where('author_id', $author->id)->get();
        return $this->sendResponse($my_posts, true, "");
    }

    public function allPost(){
        $all_posts = Post::get();
        return $this->sendResponse($all_posts, true, "");
    }
}

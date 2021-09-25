<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){

        $posts = Post::get();

        return view('admin.posts.index', compact('posts'));
    }

    public function create(Request $request){

        // Post::create([
        //     'title' => $request->title
        //...O ideal era listar todos os elementos aqui, porem como eu ja fiz o forms com os names igual ao da tabela, eu posso dar um all()
        // ]);

        Post::create($request->all());

        return redirect()->route('posts.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){

        $posts = Post::get();

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(StoreUpdatePost $request){

        // Post::create([
        //     'title' => $request->title
        //...O ideal era listar todos os elementos aqui, porem como eu ja fiz o forms com os names igual ao da tabela, eu posso dar um all()
        // ]);

        Post::create($request->all());

        return redirect()->route('posts.index');
    }

    public function show($id){

        //esses 3 dao certo ja que busca somentro um dado
        //Post::where('id', $id)->get();
        //Post::where('id', $id)->first();
        //$post = Post::find($id);
        //por default o laravel busca o find pelo id

        if (!$post = Post::find($id)) {
            return redirect()->route('posts.index');
        }

        return view('admin.posts.show', compact('post'));
    }

    public function destroy($id){
        
        if (!$post = Post::find($id)) {
            return redirect()->route('posts.index');
        }

        $post->delete();

        return redirect()->route('posts.index')
            ->with('message', 'Post deletado');
    }
}

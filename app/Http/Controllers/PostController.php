<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(){

        //paginate por default traz 15 elementos por pagina, mas basta passar com parametro pra definir
        $posts = Post::latest()->paginate(3);
        //$posts = Post::latest()->paginate(10); Orderna dos mais antigos

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

        //Formas de pegar a imagem : ******
        //$request->file('image');
        //$request->image; Aqui ele detecta q é uma imagem

        $data = $request->all();

        //Validando a imagem
        if ($request->image->isValid()){
            //aqui ja ta configurado no config que o padrao é o arquivo storage com o link ao public
            //assim botando o posts ele entende que é uma pasta posts dentro desse diretorio
            //isso retorna o path do arquivo

            //essa linha pega o nome inique padrao
            //$image = $request->image->store('posts');

            //porem eu quero usar o nome do proprio post q tb é unico, slug deixa os caracteres usaveis, nao esquecer de importar com o use
            $nameFile = Str::of($request->title)->slug('-') . '.' .$request->image->getClientOriginalExtension();
            $image = $request->image->storeAs('posts', $nameFile);
            
            $data['image'] = $image;
        }

        Post::create($data);

        return redirect()
        ->route('posts.index')
        ->with('message', 'Post criado com sucesso');
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

    public function edit($id){

        if (!$post = Post::find($id)) {
            //volta daonde veio
            return redirect()->back();
        }

        return view('admin.posts.edit', compact('post'));
    }

    public function update(StoreUpdatePost $request, $id){

        if (!$post = Post::find($id)) {
            //volta daonde veio
            return redirect()->back();
        }

        $post->update($request->all());

        return redirect()->route('posts.index')
        ->with('message', 'Post modificado com sucesso');
    }
    
    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $posts = Post::where('title', 'LIKE', "%{$request->search}%")
                        ->orWhere('content', 'LIKE', "%{$request->search}%")
                        ->paginate();    
        return view('admin.posts.index', compact('posts', 'filters'));
    }
}

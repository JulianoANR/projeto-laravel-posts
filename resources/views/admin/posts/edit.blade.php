
<h1>Editar o post {{$post->title}}</h1>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)                
                <li>$error</li>                
            @endforeach
        </ul>
    </div>
@endif

<form action="{{route('posts.update', $post->id)}}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="title" id="title" placeholder="Titulo" value="{{$post->title}}">
    <textarea name="content" id="content" cols="30" rows="4" placeholder="Conteudo">{{$post->content}}</textarea>
    <button type="submit">Enviar</button>
</form>
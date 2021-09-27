<h1>Detalhes do Post {{$post->title}}</h1>

<ul>
    <li>{{$post->title}}</li>
    <li>{{$post->content}}</li>
</ul>

<form action="{{route('posts.destroy', $post->id)}}" method="POST">
    @method('delete')
    @csrf
    <button type="submit">Deletar Post</button>
</form>
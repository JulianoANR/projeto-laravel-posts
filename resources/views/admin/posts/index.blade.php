<a href="{{route('posts.create')}}">Criar novo post</a>
<hr>
@if (session('message'))
    <div>
    {{session('message')}}
    </div>
@endif
<h1> Posts Index</h1>

@foreach ($posts as $post)
    <p>{{$post->title}}</p>
    [ 
    <a href="{{route('posts.show', $post->id)}}">Detalhes</a>
    <a href="{{route('posts.edit', $post->id)}}">Edit</a>
    ]
@endforeach
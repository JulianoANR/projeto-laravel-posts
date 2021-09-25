<a href="{{route('posts.create')}}">Criar novo post</a>
<hr>
<h1> Posts Index</h1>

@foreach ($posts as $post)
    <p>{{$post->title}}</p>
@endforeach
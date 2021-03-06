@extends('admin.layouts.app')

@section('title', 'Listagem dos Posts')

@section('content')

<a href="{{route('posts.create')}}">Criar novo post</a>
<hr>
@if (session('message'))
    <div>
    {{session('message')}}
    </div>
@endif

<form action="{{route('posts.search')}}" method="post">
    @csrf
    <input type="text" name="search" placeholder="search" placeholder="Filtrar:">
    <button type="submit">Filtrar</button>
</form>

<h1> Posts Index</h1>

@foreach ($posts as $post)
    <p>
        <img src="{{ url("storage/{$post->image}") }}" alt="{{ $post->image }}" style="max-width: 100px;">
        {{$post->title}}
        [ 
        <a href="{{route('posts.show', $post->id)}}">Detalhes</a>
        <a href="{{route('posts.edit', $post->id)}}">Edit</a>
        ]
    </p>
@endforeach
<hr>

@if (isset($filters))
    {{ $posts->appends($filters)->links() }}
@else
    {{ $posts->links() }}
@endif

@endsection
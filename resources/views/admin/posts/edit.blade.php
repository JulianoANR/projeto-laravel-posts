
<h1>Editar o post {{$post->title}}</h1>

<form action="{{route('posts.update', $post->id)}}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @include('admin.posts._partials.form')
</form>
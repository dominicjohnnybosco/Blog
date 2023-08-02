@extends('layout.app')

@section('content')
    <div class="container">
        <h1>Dashboard</h1>
        <h3 class="text-center mb-3"> My Posts </h3>
        @if (count($posts) > 0)
            <table class="table table-hover">
                <tr>
                    <th>Title</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>

            @foreach ($posts as $post)
                <tr>
                    <td>{{$post->title}}</td>

                    <td>
                        <a href="{{route('posts.edit',$post->id)}}" type="button" class="btn btn-outline-warning me-2" style="text-decoration:none">
                            Edit Post
                        </a>
                    </td>

                    <td>
                        <form action="{{route('posts.destroy',$post->id)}}" method="POST">
                            @method('delete')
                            @csrf
                            <button class="btn btn-outline-danger me-2">Delete Post</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            </table>

        @else
            <p>No Post Yet</p>
        @endif
    </div>
@endsection

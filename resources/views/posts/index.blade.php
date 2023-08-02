@extends('layout.app')

@section('content')
    {{-- jumbotron section here --}}
    <div class="p-5 text-center bg-body-tertiary rounded-3 container"
        style="border:solid 1px white;
        background-image:url('assests/img/5.jpg');
        height:500px;
        width:auto;
        background-repeat:no-repeat;
        background-position:top center;
        background-size:cover;
        margin-bottom:20px;">
        <h1 class="text-body-emphasis" style="margin-top:180px;">Welcome To My Blog Site</h1>
        <p class="col-lg-8 mx-auto fs-5 text-light">
          This is a custom jumbotron featuring an SVG image at the top, some longer text that wraps early thanks to a responsive <code>.col-*</code> class, and a customized call to action.
        </p>
      </div>

    {{-- add the create post button --}}
    <div class="container">
        <h1 class="text-center">All Posts</h1>

        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
                    {{-- yeild the contents here --}}

        @if(count($posts) > 0)
        @foreach($posts as $post)
            <div class="well">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img src="public/storage/cover_images/{{$post->cover_image}}" style="width:100%" />
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <h2 class="fs-2 text-body-emphasis">
                            {{$post->title}}
                        </h2>
                        <p>Paragraph of text beneath the heading to explain the heading............</p>
                            <a href="{{route('posts.show',$post->id)}}" class="icon-link">
                        Read More
                            </a>
                    </div>
                        <small>
                        {{$post->created_at}}
                         @auth
                            by : {{$post->users->name}}
                        @endauth
                        </small>
                </div>
            </div>

        @endforeach
    @else
        <p>No Post Found</p>
    @endif

@endsection


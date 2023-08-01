@extends('layout.app')

@section('content')
    <div class="container">
        <x-back--button />

        {{-- display image here --}}
        @if($showSinglePost->cover_image)
            <img src="{{ asset('public/storage/cover_images/'.$showSinglePost->cover_image)}}" alt="Blog Image" 
            style="width:100%; 
            height:500px; 
            background-repeat:no-repeat;
            background-size:cover;
            border-radius:20px;
            background-position:top center;" />
        @endif
        
        {{-- display the single post contents --}}
        <div class="mb-5">
            <h1>{{$showSinglePost->title}}</h1>
            <p>{{$showSinglePost->body}}</p>
            @if($showSinglePost->created_at == "")
                <small>Created @ : 0000-00-00 00:00:00</small>
            @else
                <small>Created @ : {{$showSinglePost->created_at}}</small>
            @endif
            <small>
                @auth
                    {{-- yield user name  --}}
                    By : {{$showSinglePost->users->name}}
                @endauth
            </small><br/>
        </div>

    </div>

@endsection


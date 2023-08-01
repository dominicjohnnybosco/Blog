@extends('layout.app')

@section('content')
    <main class="form-signin w-100 m-auto container">
        <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data" >
            @csrf
            <h1 class="h3 mb-3 fw-normal text-center">Create Post</h1>

            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label h5">Blog Title :</label>
                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Enter blog title here" name="title">
            </div>

            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label h5">Blog Body : </label>
                <textarea class="form-control mb-3" id="exampleFormControlTextarea1" rows="10" name="body"></textarea>
            </div>

            <div class="mb-3">
                <input type="file" class="form-control" id="formGroupExampleInput"  name="cover_image">
            </div>

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif

            <button class="btn btn-primary w-100" type="submit">Submit</button>
        </form>
    </main>
@endsection


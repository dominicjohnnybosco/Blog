@extends('layout.app')
@section('content')
    <main class="w-50 mx-auto p-5 rounded-4 mb-4"
        style="background-color: #eff0f1;
        border:solid 5px #f8f9fa;">
        <form action="{{route('register.store')}}" method="POST">
            @csrf
            <h2 class="mb-3 text-center">Create an account</h2>
            <div class="mb-3 ">
                <label for="name" class="form-label">NAME</label>
                <input
                    type="text"
                    name="name"
                    class="form-control border-secondary"
                    id="name"
                    value="{{old('name')}}"
                >
                @error('name')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="mb-3 ">
                <label for="email" class="form-label">EMAIL</label>
                <input
                    type="email"
                    name="email"
                    class="form-control border-secondary"
                    id="email"
                    value="{{old('email')}}"
                >
                @error('email')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="mb-3 ">
                <label for="password" class="form-label">PASSWORD</label>
                <input
                    type="password"
                    name="password"
                    class="form-control border-secondary"
                    id="password"
                >
                @error('password')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="mb-3 ">
                <label for="password" class="form-label">CONFIRM PASSWORD</label>
                <input
                    type="password"
                    name="confirm_password"
                    class="form-control border-secondary"
                    id="confirm_password"
                >
                @error('confirm_password')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary m-3 mx-auto w-100">Submit</button>
        </form>
    </main>
@endsection

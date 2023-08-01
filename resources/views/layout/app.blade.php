<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>My Blog Post</title>
</head>
<body>
    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
          <div class="col-md-3 mb-2 mb-md-0">
            <ul class="nav col-12 col-md-auto mb-2 mb-md-0 ">
                @auth
                    <li><a href="{{route('dashboard')}}" class="nav-link px-2 link-secondary">Dashboard</a></li>
                @endauth
              </ul>
          </div>

          <ul class="nav col-12 col-md-auto mb-2 mb-md-0 ">
            <li><a href="{{route('posts.index')}}" class="nav-link px-2 link-secondary">Home</a></li>
          </ul>
          @auth
            {{-- yield user name here --}}
            <small class="text-dark">Welcome back, <strong>{{auth()->user()->name}}</strong></small>
          @endauth

          <div class="col-12 col-md-auto text-end d-inline-flex">
            @auth
                 {{-- yield logout button --}}
                <x-logout />

                {{-- yeild create button --}}
                <x-create-post-button />
            @else
                {{-- yield signup button --}}
                <x-signup-button />

                {{-- yeild Login button --}}
                <x-login-button />
            @endauth

          </div>
        </header>

        {{-- display the flash success message here --}}
        <x-alert />

      </div>
        {{-- yeild the contents here --}}
        @yield('content')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

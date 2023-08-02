<form action="{{route('logout')}}" method="POST">
    @method('post')
    @csrf
    <button type="submit" class="btn btn-primary mx-4">Logout</button>
</form>

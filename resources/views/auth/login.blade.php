@extends('layout.app')

@section('content')
<div class="container text-center mt-5">
    <h2>Login</h2>

    <form method="POST" action="{{ route('authenticate') }}">
        @csrf

        <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>

        <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

        <button class="btn btn-success">Login</button>
    </form>

    @if(session('error'))
        <p class="text-danger mt-2">{{ session('error') }}</p>
    @endif
</div>
@endsection
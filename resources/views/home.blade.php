@extends('layout.app')

@section('content')

<div class="text-center">

    <h1 class="mb-5" style="font-weight:600;">Support System</h1>

    <a href="{{ route('tickets.create') }}" class="btn btn-primary px-4 py-2 mb-5">
        Open New Ticket
    </a>

    <h5 class="mb-3">check the status of your ticket:</h5>

    <form action="{{ route('tickets.search') }}" method="GET" class="d-flex justify-content-center">
        
        <input 
            name="ref" 
            class="form-control me-3" 
            placeholder="Enter ticket reference"
            style="max-width: 350px;"
        >

        <button class="btn btn-success px-4">
            View Ticket
        </button>

    </form>

</div>

@endsection
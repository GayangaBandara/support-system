@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <h2 class="text-center mb-4">Open New Ticket</h2>

    <form action="{{ route('tickets.store') }}" method="post">
        @csrf

        <div class="mb-3">
            <label class="form-label">Your Name</label>
            <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name') }}">
            @if($errors->has('customer_name'))
                <small class="text-danger">{{ $errors->first('customer_name') }}</small>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
            @if($errors->has('email'))
                <small class="text-danger">{{ $errors->first('email') }}</small>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Phone (Optional)</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
            @if($errors->has('description'))
                <small class="text-danger">{{ $errors->first('description') }}</small>
            @endif
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-success">Submit Ticket</button>
        </div>

    </form>
</div>

@endsection
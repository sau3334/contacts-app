@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Edit Contact</h2>

        <form action="{{ route('contacts.update', $contact->id) }}" method="POST" class="border p-4 shadow-sm bg-light rounded">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ $contact->name }}" required>
            </div>

            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" name="phone_number" class="form-control" value="{{ $contact->phone_number }}" required>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection

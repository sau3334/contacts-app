@extends('layouts.app')

@section('content')
    <h2>Add Contact</h2>
    <form action="{{ route('contacts.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Name" required>
        <input type="text" name="phone_number" placeholder="Phone Number" required>
        <button type="submit">Save</button>
    </form>
@endsection

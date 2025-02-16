@extends('layouts.app')

@section('content')
    <h2>Contacts List</h2>
    <a href="{{ route('contacts.create') }}">Add New Contact</a>
    <form action="{{ route('contacts.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="xml_file" required>
        <button type="submit">Import XML</button>
    </form>
    <ul>
        @foreach ($contacts as $contact)
            <li>{{ $contact->name }} - {{ $contact->phone_number }}
                <a href="{{ route('contacts.edit', $contact) }}">Edit</a>
                <form action="{{ route('contacts.destroy', $contact) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection

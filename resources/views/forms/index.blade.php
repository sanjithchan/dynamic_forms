@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Forms</h1>
    <a href="{{ route('forms.create') }}" class="btn btn-primary mb-3">Create New Form</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($forms as $form)
            <tr>
                <td>{{ $form->id }}</td>
                <td>{{ $form->name }}</td>
                <td>{{ $form->created_at->format('Y-m-d H:i') }}</td>
                <td>
                    <a href="{{ route('forms.edit', $form) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('forms.destroy', $form) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this form?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
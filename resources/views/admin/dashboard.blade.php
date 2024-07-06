@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>
    <a href="{{ route('forms.create') }}" class="btn btn-primary">Create New Form</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($forms)
            @foreach ($forms as $form)
            <tr>
                <td>{{ $form->id }}</td>
                <td>{{ $form->name }}</td>
                <td>
                    <a href="{{ route('forms.edit', $form) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('forms.destroy', $form) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection
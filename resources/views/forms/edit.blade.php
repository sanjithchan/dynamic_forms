@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Form</h1>
    <form action="{{ route('forms.update', $form->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Form Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $form->name }}" required>
        </div>

        <div id="form-fields">
            @foreach($form->fields as $index => $field)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Field {{ $index + 1 }}</h5>
                        <div class="mb-3">
                            <label class="form-label">Label</label>
                            <input type="text" class="form-control" name="fields[{{ $index }}][label]" value="{{ $field->label }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Type</label>
                            <select class="form-select" name="fields[{{ $index }}][type]" onchange="toggleOptionsField(this)" required>
                                <option value="text" {{ $field->type == 'text' ? 'selected' : '' }}>Text</option>
                                <option value="number" {{ $field->type == 'number' ? 'selected' : '' }}>Number</option>
                                <option value="select" {{ $field->type == 'select' ? 'selected' : '' }}>Select</option>
                            </select>
                        </div>
                        <div class="mb-3 options-field" style="display: {{ $field->type == 'select' ? 'block' : 'none' }};">
                            <label class="form-label">Options (comma-separated)</label>
                            <input type="text" class="form-control" name="fields[{{ $index }}][options]" value="{{ $field->options }}">
                        </div>
                        <button type="button" class="btn btn-danger" onclick="removeField(this)">Remove Field</button>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="button" class="btn btn-secondary mb-3" onclick="addField()">Add Field</button>
        <button type="submit" class="btn btn-primary">Update Form</button>
    </form>
</div>

<template id="field-template">
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">New Field</h5>
            <div class="mb-3">
                <label class="form-label">Label</label>
                <input type="text" class="form-control" name="fields[__INDEX__][label]" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Type</label>
                <select class="form-select" name="fields[__INDEX__][type]" onchange="toggleOptionsField(this)" required>
                    <option value="text">Text</option>
                    <option value="number">Number</option>
                    <option value="select">Select</option>
                </select>
            </div>
            <div class="mb-3 options-field" style="display: none;">
                <label class="form-label">Options (comma-separated)</label>
                <input type="text" class="form-control" name="fields[__INDEX__][options]">
            </div>
            <button type="button" class="btn btn-danger" onclick="removeField(this)">Remove Field</button>
        </div>
    </div>
</template>

<script>
let fieldIndex = {{ count($form->fields) }};

function addField() {
    const template = document.getElementById('field-template').innerHTML;
    const newField = template.replace(/__INDEX__/g, fieldIndex);
    document.getElementById('form-fields').insertAdjacentHTML('beforeend', newField);
    fieldIndex++;
}

function removeField(button) {
    button.closest('.card').remove();
}

function toggleOptionsField(select) {
    const optionsField = select.closest('.card-body').querySelector('.options-field');
    optionsField.style.display = (select.value === 'select') ? 'block' : 'none';
}
</script>
@endsection
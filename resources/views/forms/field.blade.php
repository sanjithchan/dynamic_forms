<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">Field {{ $index }}</h5>
        <div class="mb-3">
            <label class="form-label">Label</label>
            <input type="text" class="form-control" name="fields[{{ $index }}][label]" value="{{ $field->label ?? '' }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Type</label>
            <select class="form-select" name="fields[{{ $index }}][type]" onchange="toggleOptionsField(this)" required>
                <option value="text" {{ (isset($field) && $field->type == 'text') ? 'selected' : '' }}>Text</option>
                <option value="number" {{ (isset($field) && $field->type == 'number') ? 'selected' : '' }}>Number</option>
                <option value="select" {{ (isset($field) && $field->type == 'select') ? 'selected' : '' }}>Select</option>
            </select>
        </div>
        <div class="mb-3 options-field" style="display: {{ (isset($field) && $field->type == 'select') ? 'block' : 'none' }};">
            <label class="form-label">Options (comma-separated)</label>
            <input type="text" class="form-control" name="fields[{{ $index }}][options]" value="{{ $field->options ?? '' }}">
        </div>
        <button type="button" class="btn btn-danger" onclick="removeField(this)">Remove Field</button>
    </div>
</div>
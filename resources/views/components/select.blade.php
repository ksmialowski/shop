@props([
    'errors' => null,
    'field' => null,
    'options' => [],
    'selected' => null,
])

<div class="form-group {{ $errors->has($field) ? 'has-danger' : '' }}">
    <label>{{ __('admin.label.' . $field) }}</label>
    <select name="form[{{ $field }}]" class="form-control {{ $errors->has($field) ? 'is-invalid' : '' }}">
        <option value="">{{ __('admin.label.select') }}</option>
        @foreach($options as $key => $value)
            <option value="{{ $key }}" {{ $selected == $key ? 'selected' : '' }}>{{ $value }}</option>
        @endforeach
    </select>

    @if ($errors->has($field))
        <span class="invalid-feedback" role="alert">{{ $errors->first($field) }}</span>
    @endif
</div>

@props([
    'type' => 'text',
    'errors' => null,
    'field' => null,
    'value' => null,
])

<div class="form-group {{ $errors->has($field) ? 'has-danger' : '' }}">
    <label>{{ __('admin.label.' . $field) }}</label>
    <input type="{{ $type }}" name="form[{{ $field }}]" class="form-control {{ $errors->has($field) ? 'is-invalid' : '' }}"
           placeholder="{{ __('admin.label.' . $field) }}" value="{{ old("form.$field", $value) }}">

    @if ($errors->has($field))
        <span class="invalid-feedback" role="alert">{{ $errors->first($field) }}</span>
    @endif
</div>

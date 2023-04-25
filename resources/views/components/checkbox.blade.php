@props([
    'errors' => null,
    'field' => null,
    'value' => null,
])

<div class="form-check">
    <label class="form-check-label"> {{ __('admin.label.' . $field) }}
        <input type="hidden" name="form[{{ $field }}]" value="0">
        <input class="form-check-input" type="checkbox" name="form[{{ $field }}]" value="1"
               onchange="this.previousElementSibling.value = this.checked ? '1' : '0'" {{ $value ? 'checked' : '' }}>
        <span class="form-check-sign">
            <span class="check"></span>
        </span>
    </label>

    @if ($errors->has($field))
        <span class="invalid-feedback" role="alert">{{ $errors->first($field) }}</span>
    @endif
</div>

@props([
    'errors' => null,
    'field' => null,
    'value' => null,
    'attr' => null,
])

@php
    $name = $attr === 'multiple' ? 'form[' . $field . '][]' : 'form[' . $field . ']';
@endphp

<label class="form-control-label d-block mb-3">{{ __('admin.label.' . $field) }}</label>

@if ($value)
    <div class="row px-3 d-inline-flex">
        @foreach ($value as $filepath)
            <img src="{{ asset('storage/' . $filepath) }}" class="img-thumbnail w-25" alt="photo">
        @endforeach
    </div>
@endif

<div class="">
    <span class="btn btn-raised btn-round btn-primary btn-file mb-3">
       <input type="file" name="{{ $name }}" {{ $attr }} />
    </span>

    @if ($errors && $errors->has($field))
        <span class="invalid-feedback" role="alert">{{ $errors->first($field) }}</span>
    @endif
</div>

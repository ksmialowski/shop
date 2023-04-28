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
    <div class="container mb-3">
        <div class="row">
            @foreach ($value as $key => $filepath)
                @if ($key % 4 === 0 && $key !== 0)
                    </div><div class="row">
                @endif
                <div class="col-sm">
                    <div class="text-center"><img src="{{ asset('storage/' . $filepath) }}" class="img-thumbnail" style="width: 200px; height: 200px;" alt="photo"></div>
                    <div class="text-center"><button class="btn btn-round btn-sm btn-danger">{{ __('admin.label.delete') }}</button></div>
                </div>
            @endforeach
        </div>
    </div>
@endif

<div class="container">
    <span class="btn btn-raised btn-round btn-primary btn-file mb-3">
       <input type="file" name="{{ $name }}" {{ $attr }} />
    </span>

    @if ($errors && $errors->has($field))
        <span class="invalid-feedback" role="alert">{{ $errors->first($field) }}</span>
    @endif
</div>

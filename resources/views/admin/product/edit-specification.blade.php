@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <h4 class="mb-0">{{ __('admin.label.specification') }}</h4>
                    <a href="{{ route('admin.product.edit', ['id' => $product->id_product]) }}" class="btn btn-sm btn-primary">{{ __('admin.label.back') }}</a>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <form method="post" action="{{ route('admin.product.edit-specification', ['id' => $product->id_product]) }}">
                    <div class="card-body">
                        @csrf

                        @foreach($product->product_specification as $key => $value)
                            <x-input type="text" :field="$key" :value="$value" />
                        @endforeach

                        <div id="input-container">
                            {{-- This is the container for the dynamic input--}}
                        </div>
                        <button type="button" class="btn btn-sm btn-primary" onclick="addInput()">{{ __('admin.label.add') }}</button>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('admin.label.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        let counter = 1;

        function createInputFormGroup(labelText, inputType, inputPlaceholder, inputName) {
            const newFormGroup = document.createElement('div');
            newFormGroup.className = 'form-group col-md-6';
            const newLabel = document.createElement('label');
            newLabel.textContent = labelText;
            const newInput = document.createElement('input');
            newInput.type = inputType;
            newInput.className = 'form-control';
            newInput.setAttribute('name', inputName);
            newInput.setAttribute('placeholder', inputPlaceholder);
            newFormGroup.appendChild(newLabel);
            newFormGroup.appendChild(newInput);
            return newFormGroup;
        }

        function addInput() {
            const inputContainer = document.getElementById('input-container');
            const newInputDiv = document.createElement('div');
            newInputDiv.className = 'form-row';

            const specificationFormGroup = createInputFormGroup('{{ __('admin.label.specification') }}', 'text',
                '{{ __('admin.label.specification') }}', `new_specifications[new_specification${counter}][key]`);
            const valueFormGroup = createInputFormGroup('{{ __('admin.label.value') }}', 'text',
                '{{ __('admin.label.value') }}', `new_specifications[new_specification${counter}][value]`);

            newInputDiv.appendChild(specificationFormGroup);
            newInputDiv.appendChild(valueFormGroup);
            inputContainer.appendChild(newInputDiv);

            counter++;
        }

    </script>
@endpush

@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <h4 class="mb-0">{{ __('admin.label.product') }}</h4>
                    <a href="{{ route('admin.product.index') }}" class="btn btn-sm btn-primary">{{ __('admin.label.back') }}</a>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <form method="post" action="{{ route('admin.product.edit', ['id' => $product->id_product]) }}"
                      autocomplete="off" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf

                        <x-input type="text" field="product_name" :value="$product->product_name" />
                        <x-select field="id_category" :options="$categories" :selected="$product->id_category" />
                        <x-input type="text" field="product_slug" :value="$product->product_slug" attr="disabled" />
                        <x-input type="text" field="product_type" :value="$product->product_type" />
                        <x-input type="text" field="product_description" :value="$product->product_description" />
                        <x-input type="number" field="product_price" :value="$product->product_price" />
                        <x-input type="number" field="product_quantity" :value="$product->product_quantity" />
                        <x-file field="product_photo" :value="$images" attr="multiple" />
                        <x-file field="product_thumbnail" :value="$thumbnail" />
                        <x-checkbox field="product_status" :value="$product->product_status" />
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
        $(document).ready(function () {
            $(document).on('click', '.photo-delete', function (){
                $.ajax({
                    url: '{{ route('admin.product.delete-photo') }}',
                    type: 'post',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id_photo: $(this).data('photo')
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            location.reload();
                        }
                    }
                });
            });
        });
    </script>
@endpush

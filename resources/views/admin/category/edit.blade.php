@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <h4 class="mb-0">{{ __('admin.label.category') }}</h4>
                    <a href="{{ route('admin.category.index') }}" class="btn btn-sm btn-primary">{{ __('admin.label.back') }}</a>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <form method="post" action="{{ route('admin.category.edit', ['id' => $category->id_category]) }}"
                      autocomplete="off" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf

                        <x-input type="text" field="category_name" :value="$category->category_name" />
                        <x-input type="text" field="category_slug" :value="$category->category_slug" />
                        <x-input type="text" field="category_description" :value="$category->category_description" />
                        <x-input type="text" field="category_order" :value="$category->category_order" />
                        <x-input type="color" field="category_color" :value="$category->category_color" />
                        <x-file field="category_thumbnail" :value="$thumbnail" />
                        <x-checkbox field="category_status" :value="$category->category_status" />
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
                    url: '{{ route('admin.category.delete-photo') }}',
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

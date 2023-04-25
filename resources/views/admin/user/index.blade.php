@extends('layouts.app')
@section('content')
    <div class="card p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">{{ __('admin.label.user') }}</h4>
            <a href="{{ route('admin.user.edit') }}" class="btn btn-sm btn-primary">{{ __('admin.label.add') }}</a>
        </div>
        {{ $dataTable->table() }}
    </div>
@endsection

@include('admin._layout.datatable')

@push('js')
    {{ $dataTable->scripts() }}
@endpush

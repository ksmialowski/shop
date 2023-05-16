@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <h4 class="mb-0">{{ __('admin.label.config') }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <form method="post" action="{{ route('admin.config.edit') }}" autocomplete="off">
                    <div class="card-body">
                        @csrf
                        @foreach($configs as $config_name => $config_value)
                            <x-input type="text" field="{{ $config_name }}" value="{{ $config_value }}" />
                        @endforeach
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
@endpush

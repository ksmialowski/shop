@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'user'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">{{ __('admin.label.user') }}</h4>
                    <h4><a href="{{ route('admin.user.index') }}">{{ __('admin.label.back') }}</a></h4>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <form method="post" action="{{ route('admin.user.edit', ['id' => $user->id]) }}" autocomplete="off">
                    <div class="card-body">
                        @csrf
                        @include('alerts.alerts')

                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label>{{ __('admin.label.name') }}</label>
                            <input type="text" name="form[name]" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('admin.label.name') }}" value="{{ $user->name }}">
                            @include('alerts.feedback', ['field' => 'name'])
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                            <label>{{ __('admin.label.email') }}</label>
                            <input type="email" name="form[email]" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('admin.label.email') }}" value="{{ $user->email }}">
                            @include('alerts.feedback', ['field' => 'email'])
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

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

                        <x-input :type="'text'" :field="'name'" :value="$user->name" :errors="$errors" />
                        <x-input :type="'email'" :field="'email'" :value="$user->email" :errors="$errors" />
                        <x-input :type="'password'" :field="'password'" :errors="$errors" />
                        <x-input :type="'password'" :field="'re-password'" :errors="$errors" />

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

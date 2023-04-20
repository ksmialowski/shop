@foreach(['success', 'error', 'info', 'warning'] as $alert_code)
    @if(session()->has($alert_code))
        @foreach(session()->get($alert_code, []) as $message)
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @endforeach
    @endif
@endforeach

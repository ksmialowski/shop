@foreach(['success', 'danger', 'info', 'warning'] as $alert_code)
    @if(session()->has($alert_code))
        @foreach(session()->get($alert_code, []) as $message)
            <div class="alert alert-{{ $alert_code }}" role="alert">

                @if(is_array($message))
                    @foreach($message as $message_item)
                        {{ $message_item }}
                    @endforeach
                @else
                    {{ $message }}
                @endif

            </div>
        @endforeach
    @endif
@endforeach

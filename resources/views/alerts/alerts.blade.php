@push('js')
    <script>
        @foreach(['success', 'danger', 'info', 'warning'] as $alert_code)
            @if(session()->has($alert_code))
                @foreach(session()->get($alert_code, []) as $message)
                    @if(is_array($message))
                        @foreach($message as $message_item)
                            demo.showNotification('top', 'right', '{{ $message_item }}');
                        @endforeach
                    @else
                        demo.showNotification('top', 'right', '{{ $message }}');
                    @endif
                @endforeach
            @endif
        @endforeach
    </script>
@endpush

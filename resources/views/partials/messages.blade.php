@if (Session::has('messages'))
    <div class="messages">
        @foreach(['success', 'warning', 'danger', 'info'] as $type)
            @if(Session::get('messages')[$type])
                <ul class="alert alert-{{ $type }}">
                    @foreach(Session::get('messages')[$type] as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
        @endforeach
    </div>
@endif

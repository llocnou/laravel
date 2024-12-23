@isset($breadcrumb)
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('myDrive') }}</a></li>
            @forelse ($breadcrumb as $value)
                @if (!$loop->last)
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.show', $value['id']) }}">{{ $value['name'] }}</a>
                    </li>
                @endif
                @if ($loop->last)
                    <li class="breadcrumb-item active">{{ $value['name'] }}</li>
                @endif

            @empty
                {{ $slot }}
            @endforelse
        </ol>
    </nav>
@endisset

{{-- <!-- resources/views/components/toggle-button.blade.php -->

<form method="POST" action="{{ route('status.toggle', $listingId) }}">
    @csrf
    @method('POST')

    <button type="submit" id="toggleButton">
        @if ($initialStatus === 'on')
            On
        @else
            Off
        @endif
    </button>
</form> --}}

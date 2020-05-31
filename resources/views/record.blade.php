
<div
    id="{{ $record['id'] }}"
    class="{{ $styles['record'] }}">
    <p>
        {{ $record['client'] }}
    </p>
    <p class="text-xs text-gray-500 mt-1">
        $ {{ number_format($record['total']) }}
    </p>
    @if (collect(['registered', 'awaiting_confirmation'])->contains($record['status']))
        <div class="text-right">
            <button
                wire:click.stop="withdrawOffer({{ $record['id'] }})"
                class="text-xs text-red-500">
                Withdraw Offer
            </button>
        </div>
    @endif
</div>


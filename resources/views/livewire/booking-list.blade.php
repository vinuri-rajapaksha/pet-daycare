<div>
    @if ($bookings->isEmpty())
    <p class="text-gray-500">No bookings yet.</p>
    @else
    <ul class="divide-y divide-gray-100">
        @foreach ($bookings as $booking)
        <li class="py-4">
            <div class="flex justify-between items-start gap-3">
                <div>
                    <p class="font-medium text-gray-800">{{ $booking->pet->name }}</p>
                    <p class="text-sm text-gray-500">
                        {{ ucfirst($booking->service_type) }} · {{ $booking->booking_date }} · {{ $booking->duration }} day{{ $booking->duration > 1 ? 's' : '' }}
                    </p>
                </div>

                <span class="text-xs font-semibold px-3 py-1 rounded-full flex-shrink-0
                            @if($booking->status === 'confirmed') bg-green-100 text-green-700
                            @elseif($booking->status === 'cancelled') bg-red-100 text-red-700
                            @else bg-amber-100 text-amber-700
                            @endif">
                    {{ ucfirst($booking->status) }}
                </span>
            </div>

            @if ($booking->status !== 'cancelled')
            <div class="flex gap-2 mt-3">
                @if ($booking->status === 'pending')
                <button wire:click="confirm({{ $booking->id }})"
                    class="bg-green-100 hover:bg-green-200 text-green-700 text-sm font-medium px-3 py-1.5 rounded-md transition-colors">
                    Confirm
                </button>
                @endif
                <button wire:click="cancel({{ $booking->id }})"
                    class="bg-red-100 hover:bg-red-200 text-red-700 text-sm font-medium px-3 py-1.5 rounded-md transition-colors">
                    Cancel
                </button>
            </div>
            @endif
        </li>
        @endforeach
    </ul>
    @endif
</div>
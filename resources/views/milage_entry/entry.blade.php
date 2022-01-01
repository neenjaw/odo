<div
    class="transition-colors w-full p-2 pl-4 rounded-md border border-gray-400 flex items-end hover:bg-sky-100 gap-10">
    <ul>
        <li class="flex gap-1 items-center">
            <img src="{{ asset('/img/icons/date.svg') }}" alt="date" class="w-5 h-5" />
            {{ $milageEntry->entered_at }}
        </li>

        <li class="flex gap-1 items-center">
            <img src="{{ asset('/img/icons/odometer.svg') }}" alt="odometer" class="w-5 h-5" />
            {{ $milageEntry->odometer_reading }} km
        </li>

        @if ($milageEntry->odometer_diff)
            <li class="text-green-700 flex gap-1 items-center">
                <img src="{{ asset('/img/icons/add.svg') }}" alt="change from previous" class="w-5 h-5" />
                {{ $milageEntry->odometer_diff }} km
            </li>
        @endif
    </ul>
    <ul>
        @if ($milageEntry->milage)
            <li>{{ number_format($milageEntry->milage, 2, '.', ' ') }} km/L</li>
        @endif

        @if ($milageEntry->fuel_economy)
            <li>{{ number_format($milageEntry->fuel_economy, 2, '.', ' ') }} L/100km</li>
        @endif
    </ul>
</div>

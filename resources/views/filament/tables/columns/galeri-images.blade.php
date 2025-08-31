@php
    $record = $getRecord();
    $path = optional($record->images->first())->path ?? null;
    $src = $path ? url('/storage/' . ltrim($path, '/')) : null;
@endphp
@if ($src)
    <img src="{{ $src }}" alt="img" class="h-8 w-8 rounded object-cover ring-1 ring-gray-200" loading="lazy" />
@endif

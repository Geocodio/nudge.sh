@if (isset($responsive))
    @if ($responsive === 'small')
<div class="max-w-4xl mx-auto my-4 block sm:hidden">
    @else
<div class="max-w-4xl mx-auto my-4 hidden sm:block">
    @endif
@else
<div class="max-w-4xl mx-auto my-4">
@endif
    <div class="w-full p-2 bg-gray-900 rounded-tl rounded-tr flex items-center">
        <div class="w-3 h-3 rounded-full mx-1 bg-red-status"></div>
        <div class="w-3 h-3 rounded-full mx-1 bg-yellow-status"></div>
        <div class="w-3 h-3 rounded-full mx-1 bg-green-status"></div>
    </div>
    <div class="rounded-bl rounded-br bg-gray-800 text-white font-mono whitespace-pre p-2 sm:p-4 text-left overflow-y-scroll leading-normal text-xs sm:text-base">{{ $slot }}</div>
</div>

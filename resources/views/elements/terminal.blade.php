@if (isset($responsive))
    @if ($responsive === 'small')
    <div class="max-w-4xl mx-auto my-4 block sm:hidden">
    @else
    <div class="max-w-4xl mx-auto my-4 hidden sm:block">
    @endif
@else
    <div class="max-w-4xl mx-auto my-4">
@endif
    <div class="w-full h-5 bg-gray-200 rounded-tl rounded-tr flex items-center">
        <div class="w-3 h-3 rounded-full mx-1 bg-red-400"></div>
        <div class="w-3 h-3 rounded-full mx-1 bg-yellow-600"></div>
        <div class="w-3 h-3 rounded-full mx-1 bg-green-400"></div>
    </div>
    <div class="bg-gray-900 text-white font-mono whitespace-pre p-2 sm:p-4 text-left overflow-y-scroll leading-normal text-xs sm:text-base">{{ $slot }}</div>
</div>

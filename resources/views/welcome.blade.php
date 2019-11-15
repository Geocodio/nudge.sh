@extends('layouts.app')

@section('content')
    <h1 class="text-center font-bold text-4xl mb-4">Super simple notifications</h1>
    <h2 class="text-center font-bold text-2xl">For long-running command line tasks</h2>

    <div class="max-w-3xl mx-auto my-8">
        <div class="w-full h-5 bg-gray-200 rounded-tl rounded-tr flex items-center">
            <div class="w-3 h-3 rounded-full mx-1 bg-red-400"></div>
            <div class="w-3 h-3 rounded-full mx-1 bg-yellow-600"></div>
            <div class="w-3 h-3 rounded-full mx-1 bg-green-400"></div>
        </div>
        <div class="bg-gray-900 text-white font-mono whitespace-pre p-4 text-left overflow-y-scroll">
$ mysql < large_database_dump.sh | <span class="bg-purple-800 rounded p-1">curl -X POST -d @- https://nudge.sh/TokN</span>
        </div>
    </div>

    <svg class="mx-auto relative" style="right: 75px;" height="100" width="100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><path d="M67.007 86.304a.99.99 0 0 1-.363-.069C49.315 79.48 37.538 69.084 31.638 55.337c-9.513-22.169-.137-45.609-.041-45.844a1 1 0 0 1 1.851.758c-.093.227-9.153 22.927.036 44.315 5.682 13.228 17.083 23.256 33.887 29.807a1 1 0 0 1-.364 1.931z"/><path d="M52.667 91.128a1.001 1.001 0 0 1-.3-1.955l13.946-4.382-10.23-12.562a1 1 0 0 1 1.551-1.263l11.162 13.706a1 1 0 0 1-.475 1.585l-15.353 4.824a.984.984 0 0 1-.301.047z"/></svg>

    <div class="max-w-md mx-auto">
        <div class="text-center text-gray-700 text-sm">
            <strong>Text Message</strong><br />
            <strong>Today</strong> 4:42pm
        </div>
        <div class="bg-gray-300 rounded-lg p-4 max-w-sm mt-4">
            Your command-line task completed. See output at: <span class="underline text-blue-500">https://nudge.sh/output/1dbf6334-8912-4c30-b8ec-b3ddd8dc792b</span>
        </div>
    </div>

    <div class="bg-purple-500 text-white my-10 py-8">
        <h2 class="text-center font-bold text-2xl">Five notifications free per day</h2>
        <h2 class="text-center font-bold text-lg mt-2">Just enter your phone number to get your own code</h2>

        <form class="max-w-lg mx-auto" method="POST" action="{{ route('register') }}">
            @csrf
                <div class="flex items-center border-b border-b-2 border-white py-2 my-4">
                <input type="tel" name="phone" class="appearance-none bg-transparent border-none w-full text-gray-100 placeholder-gray-400 mr-3 py-1 px-2 leading-tight focus:outline-none" placeholder="e.g. 999-999-9999" aria-label="Phone number">
                <button class="flex-shrink-0 bg-white hover:bg-gray-300 border-white hover:border-gray-300 text-sm border-4 text-black py-1 px-2 rounded" type="submit">
                  Sign Up
                </button>
            </div>

            @error('phone')
                <p class="text-red-500 text-xs italic mb-4">
                {{ $message }}
                </p>
            @enderror

            <p class="text-gray-200 text-xs italic">US Phone numbers only (for now). We never share your phone number or use it for any other purposes. This service is provided as-is and solely to make your life a little bit easier.</p>
        </form>
    </div>

@endsection

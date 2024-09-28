@php
    $title = "User profile";
    $cssLinks = [];  // Your array of CSS links
    $body_classes = "bg-cyan-800";
@endphp

<x-header :cssLinks="$cssLinks" :title="$title" :body_classes="$body_classes">
    <x-slot name="body_classes">{{ $body_classes }}</x-slot>  {{-- Pass body_classes through a slot --}}
</x-header>
<div class="max-w-md mx-auto my-32 bg-white p-6 rounded-lg shadow-md" >
    <h1 class="text-2xl font-bold mb-4">Update Phone Number</h1>
    
    <form action="{{route("phone_number_edit_function",$user_id)}}" method="POST" >
        @csrf
        <div class="mb-4">
            <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
            <input type="text" id="phone" name="phone" value="{{old("phone")}}" 
                   class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                   placeholder="Enter your phone number" >
        </div>
        @if($errors->any())  
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            @error("phone")
            {{$message}}
            @enderror
        </div>
        @endif  
        <div>
            <button type="submit" 
                    class="w-full bg-stone-950 text-white py-2 px-4 rounded-md hover:bg-cyan-800 focus:ring-4 focus:ring-indigo-300">
                Update Phone Number
            </button>
        </div>
    </form>
</div>


@component("components.footer")
    @endcomponent

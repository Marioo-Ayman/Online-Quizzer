@php
    $title = "Reports";
    $cssLinks = [];  // Your array of CSS links
    $body_classes = "bg-gray-500";
@endphp

<x-header :cssLinks="$cssLinks" :title="$title" :body_classes="$body_classes">
    <x-slot name="body_classes">{{ $body_classes }}</x-slot>  
</x-header>
<form class="max-w-full sm:max-w-md mx-auto p-4 sm:p-6 relative" method="post" >
@csrf
    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
    <div class="relative">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
        </div>
        <input name="search_quiz" type="text" id="default-search" class="block w-full p-3 sm:p-4 pl-10 text-sm sm:text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search quiz" required />
        <button type="submit" class="text-white absolute right-2 bottom-1.5 sm:bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm sm:text-base px-3 sm:px-4 py-1.5 sm:py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
    </div>
</form>



    <div class="p-32 bg-gray-200 pt-20 parent">
    <h2 class="text-center	my-16 text-4xl"><span style="color:#0d6efd">A</span>ll quizes</h2>

    <div class="overflow-x-auto">
    <table class="table-auto relative bg-gray-200 w-full text-center">
        <thead class="text-lg sm:text-xl border-b-2 border-blue-600">
            <tr>
                <th class="p-4">Quiz</th>
                <th class="p-4">Duration</th>
                <th class="p-4">Description</th>
                <th class="p-4">Date Created</th>
                <th class="p-4">More Details</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quizes as $quize)
            <tr class="border-b border-gray-300">
                <td class="p-4">{{$quize->title}}</td>
                <td class="p-4">{{$quize->time_limit}}</td>
                <td class="p-4">{{$quize->description}}</td>
                <td class="p-4">{{$quize->created_at}}</td>
                <td class="p-4">
                    <a href="{{route('admin.show_quiz', $quize->id)}}" class="inline-block p-2 bg-blue-800 rounded text-white">Show more</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="relative " style="left:50%;transform:translateX(-50%);width:50%;margin-top:20px;">{{$quizes->links()}}</div>

    </div>

@component("components.footer")
    @endcomponent



    <style>
@media(max-width:900px){
    .parent{
            padding-inline:0 !important;
            }
    th,td{
        padding:1px !important;
    }    

    }    
    
    </style>
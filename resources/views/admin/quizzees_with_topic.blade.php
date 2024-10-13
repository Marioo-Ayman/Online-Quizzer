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
    <h2 class="text-center	my-16 text-4xl">{{$topic_name->name}} quizzes</h2>

    <div class="topic-items select-none py-6
                md:p-6" style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap">
    @foreach ($quizes as $quiz)
        <li class="p-5 bg-gray-700 rounded-xl min-w-60 text-center text-white select-none
            md:min-w-80 " style="width:30%;margin-bottom:10px;">
            <h2 class="text-lg p-2">{{$quiz['title']}}</h2>
            <hr class="w-[60%] ml-[20%]">
            <p class="leading-6 p-3">{{$quiz['description']}}</p>
            <div class="p-2 rounded-md flex justify-between">
                <span class="text-gray-400">{{$quiz['author']}}</span>
                @if(Auth::user())
                    @if(Auth::user()->role=="user")
                <a href="/user/quiz/{{Auth::user()->id}}/{{$quiz['id']}}" class="hover:bg-yellow-500 p-1 w-[30%] rounded-md transition duration-300 ease-in-out transform hover:translate-x-5">go
                    <i class="fa-solid fa-arrow-right-long "></i>
                </a>
                    @endif
                    @if(Auth::user()->role=="admin")
                <a style="display:none" href="#" class="hover:bg-yellow-500 p-1 w-[30%] rounded-md transition duration-300 ease-in-out transform hover:translate-x-5">go
                    <i class="fa-solid fa-arrow-right-long "></i>
                </a >
                    @endif
                @endif
            </div>
        </li>
    @endforeach
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
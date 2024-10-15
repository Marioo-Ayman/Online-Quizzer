@php
    $jsLinks = ['home']; // file name
    $cssLinks = ['home'];
    $pageTitle = 'Home';
@endphp
<x-header :cssLinks="$cssLinks" :title="$pageTitle" />

{{-- your code here --}}

<div class="landing relative w-[100%] h-[87vh] bg-cover flex justify-center ">
    <div class="absolute inset-0 bg-black bg-opacity-35"></div>
    <p class="text-white text-lg text-center leading-9 bg-gray-800 p-5 rounded-3xl w-[100%]
        md:w-[60%] h-fit mt-[23%]">
        Welcome to Quizzer! Test your knowledge, challenge yourself,
        and track your progress with quizzes across a wide range of topics.
        Ready to start learning and having fun?
    </p>
</div>

<main class="py-5  bg-gray-900 text-white
            md:p-5">
    <div class="text-center">
        <input id="search-box" type="text" placeholder="Search . . ." class="w-[60%] rounded-2xl bg-gray-800">
    </div>
     @foreach ($topics as $topic)
        <div class="topic-items select-none py-6
                md:p-6">
            <ul class="flex flex-col gap-3 bg-gray-800 rounded-2xl py-5
                    md:p-5">
                <li>
                    <div class="text-center">
                    <span class="text-3xl"> {{$topic['name']}} </span>
                    </div>
                    <div class="relative w-[100%] overflow-hidden">
                        <ul class="slider flex gap-5 w-fit p-5 transition-all duration-[0.05s] ease-linear cursor-grab relative select-none">
                            @foreach ($topic['quizzes'] as $quiz)
                                <li class="p-5 bg-gray-700 rounded-xl min-w-60 text-center text-white select-none
                                    md:min-w-80">
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
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    @endforeach

    <div class="video bg-white">
        <video src="{{asset('videos/91998-631504261_medium.mp4')}}" autoplay controls
         class="w-[100%] p-32"></video>
    </div>

</main>

<x-footer :jsLinks="$jsLinks" />

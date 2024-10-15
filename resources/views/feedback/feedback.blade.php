
@php
    $title = "FeedBack";
    $cssLinks = [];  // Your array of CSS links
    $body_classes = "bg-gray-500 flex-col align-center";
@endphp

<x-header :cssLinks="$cssLinks" :title="$title" :body_classes="$body_classes">
    <x-slot name="body_classes">{{ $body_classes }}</x-slot>  {{-- Pass body_classes through a slot --}}
</x-header>
    <div class="bg-white p-8 rounded-lg shadow-lg flex flex-col md:flex-row">
        <div class="md:w-1/2 md:pr-8">
            <p class="text-gray-500 mb-2">
                Type here, use @ for references
            </p>
            <h1 class="text-3xl font-bold mb-2">
                We value your opinion.
            </h1>
            <p class="text-gray-500 mb-4">
                Type here, use @ for references
            </p>
            <p class="mb-2">
                How would you rate your overall experience?
            </p>
            <div class="flex mb-4">
                <i class="far fa-star text-2xl text-gray-400 mr-1">
                </i>
                <i class="far fa-star text-2xl text-gray-400 mr-1">
                </i>
                <i class="far fa-star text-2xl text-gray-400 mr-1">
                </i>
                <i class="far fa-star text-2xl text-gray-400 mr-1">
                </i>
                <i class="far fa-star text-2xl text-gray-400">
                </i>
            </div>
            <p class="mb-2">
                Kindly take a moment to tell us what you think.
            </p>
            <form action="{{route("feedback")}}" method="post">
            @csrf
            <textarea class="w-full p-2 border border-gray-300 rounded mb-4" rows="4" name="feedback"></textarea>
            <input class="bg-gray-800 text-white px-4 py-2 rounded" type="submit" value="Share your feedback">
                </form>
        </div>
        <div class="md:w-1/2 md:pl-8 mt-8 md:mt-0">
            <img alt="A vase with yellow flowers on a rustic wooden stool against a white wall" class="rounded-lg"
                height="400"
                src="https://storage.googleapis.com/a1aa/image/dS6sGUGS1fQSZKIG65e8D7Ck8UNJvrfBoUfqXjwc4OjIQObOB.jpg"
                width="400" />
        </div>
    </div>
@component("components.footer")
@endcomponent
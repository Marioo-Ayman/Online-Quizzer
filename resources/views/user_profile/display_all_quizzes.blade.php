@php
    $title = "User profile";
    $cssLinks = [];  // Your array of CSS links
    $body_classes = "bg-gray-400";
@endphp

<x-header :cssLinks="$cssLinks" :title="$title" :body_classes="$body_classes">
    <x-slot name="body_classes">{{ $body_classes }}</x-slot>  {{-- Pass body_classes through a slot --}}
</x-header>




    <div class="p-32 bg-gray-200 pt-20 parent">
    <h2 class="text-center	my-16 text-4xl"><span style="color:#0d6efd">A</span>ll quizes</h2>

    <div class="overflow-x-auto">
    <table class="table-auto relative bg-gray-200 w-full text-center">
        <thead class="text-lg sm:text-xl border-b-2 border-blue-600">
            <tr>
                <th class="p-4">Quiz</th>
                <th class="p-4">Duration</th>
                <th class="p-4">Description</th>
                <th class="p-4">Score</th>
                <th class="p-4">Date Created</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
            <tr class="border-b border-gray-300">
                <td class="p-4">{{$d->title}}</td>
                <td class="p-4">{{$d->time_limit}}</td>
                <td class="p-4">{{$d->description}}</td>
                <td class="p-4">{{$d->user_score}}</td>
                <td class="p-4">{{$d->created_at}}</td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="relative " style="left:50%;transform:translateX(-50%);width:50%;margin-top:20px;">{{$data->links()}}</div>

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
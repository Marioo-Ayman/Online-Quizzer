@php
    $title = "Reports";
    $cssLinks = [];  // Your array of CSS links
    $body_classes = "bg-gray-500";
@endphp

<x-header :cssLinks="$cssLinks" :title="$title" :body_classes="$body_classes">
    <x-slot name="body_classes">{{ $body_classes }}</x-slot>  
</x-header>



    <div class="p-32 bg-gray-200 pt-20 parent">
        
    <h2 class="text-center	mb-4 text-4xl">{{$students->first()->title}} quiz</h2>
    <h3 class="text-center	mb-16 text-2xl"><span style="color:#0d6efd">{{$students->first()->description}} </span></h3>

    <div class="overflow-x-auto">
    <table class="table-auto w-full bg-gray-200 text-center">
        <thead class="text-lg sm:text-xl border-b-2 border-blue-600">
            <tr>
                <th class="p-4">Student Name</th>
                <th class="p-4">Student Phone</th>
                <th class="p-4">Student Email</th>
                <th class="p-4">Student Score</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
            <tr class="border-b">
                <td class="p-4">{{$student->name}}</td>
                <td class="p-4">{{$student->phone}}</td>
                <td class="p-4">{{$student->email}}</td>
                <td class="p-4">{{$student->user_score}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="relative " style="left:50%;transform:translateX(-50%);width:50%;margin-top:20px;">{{$students->links()}}</div>

    </div>

@component("components.footer")
    @endcomponent

    <style>
@media(max-width:900px){
    .parent{
            padding-inline:0 !important;
            }
    th,td{
        padding:2px !important;
    }    

    }    
    
    </style>
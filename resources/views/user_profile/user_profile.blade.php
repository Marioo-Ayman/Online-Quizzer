@php
    $title = "Feed Back";
    $cssLinks = [];  // Your array of CSS links
    $body_classes = "bg-gray-500 flex-col align-center";
@endphp

<x-header :cssLinks="$cssLinks" :title="$title" :body_classes="$body_classes">
    <x-slot name="body_classes">{{ $body_classes }}</x-slot>  {{-- Pass body_classes through a slot --}}
</x-header>
@if ($data->image=="/uploads/avatar.png")
@php
$src="/uploads/avatar.png";
@endphp
@else
@php
$src="/uploads/{$data->image}";
@endphp
@endif
    <div class="parent w-2/5 mt-20" style="position:relative;left:50%;transform:translateX(-50%);margin-bottom:40px;">
        <div class="text mt-5 text-white">
            <h2 class="text-2xl">Your settings</h2>
            <p>Put a face to your name, edit your login details, and set preferences</p>
        </div>
        <div class="content p-5 bg-gray-300 rounded mt-5">
            <div class="logo_name flex  " >
            <img class="w-16 h-16 rounded-full object-cover" src="{{ $src }}" alt="">
            <div class="text mx-5">
                    <div class="name">{{$data->name}}</div>
                    <div class="joining_date">joining date : {{$data->created_at}}</div>
                </div>
            </div>
            <div class="buttons  mt-5 ">
                <a href="{{route( "image_edit_show")}}" class="	rounded border border-cyan-950 " style="padding:5px 20px">Edit Profile Image</a>
                <a  href="{{route( "name_edit_show")}}" class="mr-8 bg-cyan-950	rounded text-white" style="padding:5px 20px">Edit Name</a>
            </div>
                <a href="{{route("home")}}" class="reset_password  w-full p-5 bg-blue-200 flex justify-center text-white align-center my-12 bg-cyan-950">Go Home</a>
            <div class="phone mt-7 flex justify-between align-center">
                <div class="number">
                @if (empty($data->phone))
                @php
                $data->phone="write one";
                @endphp
                @endif
                    Your phone number:{{$data->phone}}
                </div>
                <a href="{{route("phone_number_edit_show")}}" class=" bg-cyan-950 rounded text-white p-2">Edit</a>
            </div>
            <div class="email mt-7 flex justify-between align-center">
                <div class="email">
                    Your email :{{$data->email}}
                </div>
                <a href="{{route( "email_edit_show")}}" class=" bg-cyan-950 rounded text-white p-2">Edit</a>
            </div>
            @if(Auth::user()->role=="admin")
            <a href="{{route("admin.all_quizes")}}" class=" w-full p-5  flex justify-center align-center  my-12 border-2 border-cyan-950" >Display your quizes</a>
            @else
            <a href="{{route("display_all_quizzes")}}" class=" w-full p-5  flex justify-center align-center  my-12 border-2 border-cyan-950" >Display your quizes</a>
            @endif
          
            <div class="logout_delete flex ">
                <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="mt-7 mr-5 p-5 bg-cyan-950 flex justify-center align-center text-white rounded" >Logout</button>
                </form>
                <form action="{{ route('delete-account') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete your account?');">
                @csrf
                @method('DELETE')
                <button class="mt-7  p-5 bg-red-700 flex justify-center align-center text-white rounded" >Delete account</button>
                </form>
            </div>
        </div>
    </div>

    @component("components.footer")
    @endcomponent

<style>
    @media (max-width:970px){
        .parent > .text{
            position:relative;
            left:50%;
            transform:translateX(-50%);
        }
        .parent{
            width:80%;
        }
       
    }
    @media (max-width:500px){
        .buttons{
            display:flex;
            flex-direction:column;
            width:fit-content;
        }
        .buttons a{
            margin-top:10px;
        }
       
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User profile</title>
    @vite('resources/css/app.css')
</head>
@if ($data->image=="/uploads/avatar.png")
@php
$src="/uploads/avatar.png";
@endphp
@else
@php
$src="/uploads/{$data->image}";
@endphp
@endif

<body class="bg-cyan-800 flex flex-warp justify-center ">
    <div class="parent w-2/5 ">
        <div class="text mt-5 text-white">
            <h2 class="text-2xl">Your settings</h2>
            <p>Put a face to your name, edit your login details, and set preferences</p>
        </div>
        <div class="content p-5 bg-blue-200 rounded mt-5">
            <div class="logo_name flex  " >
                <img class=" rounded-full w-16 h-16" src="{{$src}}"  alt="">
                <div class="text mx-5">
                    <div class="name">{{$data->name}}</div>
                    <div class="joining_date">joining date : {{$data->created_at}}</div>
                </div>
            </div>
            <div class="buttons  mt-5 ">
                <a href="{{route( "image_edit_show","1")}}" class="	rounded border border-cyan-950 " style="padding:5px 20px">Edit Profile Image</a>
                <a  href="{{route( "name_edit_show","1")}}" class="mr-8 bg-cyan-950	rounded text-white" style="padding:5px 20px">Edit Name</a>
            </div>
                <button class="reset_password  w-full p-5 bg-blue-200 flex justify-center text-white align-center my-12 bg-cyan-950">Reset your password</button>
            <div class="phone mt-7 flex justify-between align-center">
                <div class="number">
                @if (empty($data->phone))
                @php
                $data->phone="write one";
                @endphp
                @endif
                    Your phone number:{{$data->phone}}
                </div>
                <a href="{{route("phone_number_edit_show","1")}}" class=" bg-cyan-950 rounded text-white p-2">Edit</a>
            </div>
            <div class="email mt-7 flex justify-between align-center">
                <div class="email">
                    Your email :{{$data->email}}
                </div>
                <a href="{{route( "email_edit_show","1")}}" class=" bg-cyan-950 rounded text-white p-2">Edit</a>
            </div>
            <button class=" w-full p-5  flex justify-center align-center  my-12 border-2 border-cyan-950" >Display your quizes</button>
          
            <div class="logout_delete flex ">
            <button class="mt-7 mr-5 p-5 bg-cyan-950 flex justify-center align-center text-white rounded" >Logout</button>
            <button class="mt-7  p-5 bg-red-700 flex justify-center align-center text-white rounded" >Delete account</button>
            </div>
        </div>
    </div>
</body>
</html>

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
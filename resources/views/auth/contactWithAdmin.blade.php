<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact with admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>
        .bg-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
          }
    </style>
</head>

<body class="bg-gray-100 ">
    <div class="bg-overlay"></div>
    <div class="wrapper-page  absolute top-0 left-0 w-full h-full flex justify-center items-center bg-cover bg-center"style="background-image: url('{{ asset('images/auth-bg.jpg') }}')">
        <div class="container mx-auto">
            <div class="max-w-md mx-auto mt-8 bg-white rounded p-8">


                <h4 class="text-gray-600 text-2xl font-bold text-center"><b>Send Email to Admin </b></h4>

                <div class="p-3">
                    <form method="POST" class="mt-3" action="{{ route('admin.sendEmail') }}">
                        @csrf

                        <div class="mb-6">
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" id="email" name="email"
                                class="@error('email') border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="enter your email" />

                            @error('email')
                                <div class="p-3 mt-1 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                    role="alert">
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                </div>
                            @enderror



                        </div>


                        <div class="mb-3 text-center">
                            <button
                                class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                type="submit">Send Email</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

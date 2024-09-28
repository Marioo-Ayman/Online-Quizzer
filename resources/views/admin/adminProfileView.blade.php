<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
    rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

<style>
    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
</style>

@include('admin.navbar')
{{-- @include('admin.sidenav') --}}

<div class="bg-white w-full flex flex-col gap-5 px-3 md:px-16 lg:px-28 md:flex-row text-[#161931]">
    <aside class="hidden py-4 md:w-1/3 lg:w-1/4 md:block">
        {{-- <div class="sticky flex flex-col gap-2 p-4 text-sm border-r border-indigo-100 top-12">

            <h2 class="pl-3 mb-4 text-2xl font-semibold">Settings</h2>

            <a href="#"
                class="flex items-center px-3 py-2.5 font-bold bg-white  text-indigo-900 border rounded-full">
                Pubic Profile
            </a>
            <a href="#"
                class="flex items-center px-3 py-2.5 font-semibold  hover:text-indigo-900 hover:border hover:rounded-full">
                Account Settings
            </a>
            <a href="#"
                class="flex items-center px-3 py-2.5 font-semibold hover:text-indigo-900 hover:border hover:rounded-full  ">
                Notifications
            </a>
            <a href="#"
                class="flex items-center px-3 py-2.5 font-semibold hover:text-indigo-900 hover:border hover:rounded-full  ">
                PRO Account
            </a>
        </div> --}}
        @include('admin.sidenav')
    </aside>
    <main class="w-full min-h-screen py-1 md:w-2/3 lg:w-3/4">
        <div class="p-2 md:p-4">
            <div class="w-full px-6 pb-8 mt-8 sm:max-w-xl sm:rounded-lg">
                <h2 class="pl-6 text-2xl font-bold sm:text-xl">Public Profile</h2>

                <div class="grid max-w-2xl mx-auto mt-8">
                    <div class="flex flex-col items-center space-y-5 sm:flex-row sm:space-y-0">

                        <img class="object-cover w-40 h-40 p-1 rounded-full ring-2 ring-indigo-300 dark:ring-indigo-500"
                            src="{{ $userData->image }}" alt="Bordered avatar">

                        <div class="flex flex-col space-y-5 sm:ml-8">
                            <button type="button"
                                class="py-3.5 px-7 text-base font-medium text-indigo-100 focus:outline-none bg-[#202142] rounded-lg border border-indigo-200 hover:bg-indigo-900 focus:z-10 focus:ring-4 focus:ring-indigo-200 ">
                                Change picture
                            </button>
                            <button type="button"
                                class="py-3.5 px-7 text-base font-medium text-indigo-900 focus:outline-none bg-white rounded-lg border border-indigo-200 hover:bg-indigo-100 hover:text-[#202142] focus:z-10 focus:ring-4 focus:ring-indigo-200 ">
                                Delete picture
                            </button>
                        </div>
                    </div>

                    <div class="items-center mt-8 sm:mt-14 text-[#202142]">

                        <div
                            class="flex flex-col items-center w-full mb-2 space-x-0 space-y-2 sm:flex-row sm:space-x-4 sm:space-y-0 sm:mb-6">
                            <div class="w-full">
                                <label for="username"
                                    class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">User name</label>
                                <input type="text" id="username"
                                    class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                    placeholder="Your first name" value="{{ $userData->name }}" required>
                            </div>

                            {{-- <div class="w-full">
                                <label for="last_name"
                                    class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">Your
                                    last name</label>
                                <input type="text" id="last_name"
                                    class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                    placeholder="Your last name" value="Ferguson" required>
                            </div> --}}

                        </div>

                        <div class="mb-2 sm:mb-6">
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">Your
                                email</label>
                            <input type="email" id="email"
                                class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                value="{{ $userData->email }}" placeholder="your.email@mail.com" required>
                        </div>

                        <div>
                            <h2 class="font-bold underline py-2">Change Password</h2>
                            <div class="mb-2 sm:mb-6">
                                <label for="profession"
                                    class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">Current
                                    password</label>
                                <input type="password" id="profession"
                                    class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                    placeholder="Current password" required>

                            </div>
                            <hr>
                            <div class="mb-2 mt-3 sm:mb-6">
                                <label for="newPassword"
                                    class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">New
                                    password</label>
                                <input type="password" id="newPassword"
                                    class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                    placeholder="your profession" required>
                            </div>
                            <label for="confirmNewPassword"
                                class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">Confirm New
                                password</label>
                            <input type="password" id="confirmNewPassword"
                                class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                placeholder="your profession" required>
                        </div>

                    </div>
                    {{-- <div class="mb-6">
                        <label for="message"
                            class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">Bio</label>
                        <textarea id="message" rows="4"
                            class="block p-2.5 w-full text-sm text-indigo-900 bg-indigo-50 rounded-lg border border-indigo-300 focus:ring-indigo-500 focus:border-indigo-500 "
                            placeholder="Write your bio here..."></textarea>
                    </div> --}}

                    <div class="flex justify-end mt-2">
                        <button type="submit"
                            class="text-white bg-indigo-700  hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Save</button>
                    </div>

                </div>
            </div>
        </div>
</div>
</main>
</div>

 {{-- @include('admin.style') --}}
@include('admin.script')


{{-- <html lang="en" class="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile - Admin One Tailwind CSS Admin Dashboard</title>


    <script src="https://cdn.tailwindcss.com"></script>



</head>

<body>

    <section class="is-title-bar">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <ul>
                <li>Admin</li>
                <li>Profile</li>
            </ul>

        </div>
    </section>

    <section class="is-hero-bar">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <h1 class="title">
                Profile
            </h1>
            <button class="button light">Button</button>
        </div>
    </section>

    <section class="section main-section">
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2 mb-6">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        <span class="icon"><i class="mdi mdi-account-circle"></i></span>
                        Edit Profile
                    </p>
                </header>
                <div class="card-content">
                    <form>
                        @csrf
                        <div class="field">
                            <label class="label">Avatar</label>
                            <div class="field-body">
                                <div class="field file">
                                    <label class="upload control">
                                        <a class="button blue">
                                            Upload
                                        </a>
                                        <input type="file">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="field">
                            <label class="label">Name</label>
                            <div class="field-body">
                                <div class="field">
                                    <div class="control">
                                        <input type="text" autocomplete="on" name="name"
                                            value="{{ $userData->name }}" class="input" required>
                                    </div>
                                    <p class="help">Required. Your name</p>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">E-mail</label>
                            <div class="field-body">
                                <div class="field">
                                    <div class="control">
                                        <input type="email" autocomplete="on" name="email"
                                            value="{{ $userData->email }}" class="input" required>
                                    </div>
                                    <p class="help">Required. Your e-mail</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="field">
                            <div class="control">
                                <button type="submit" class="button green">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        <span class="icon"><i class="mdi mdi-account"></i></span>
                        Profile
                    </p>
                </header>
                <div class="card-content">
                    <div class="image w-48 h-48 mx-auto">
                        <img src="{{ $userData->image }}" alt="John Doe" class="rounded-full">
                    </div>
                    <hr>
                    <div class="field">
                        <label class="label">Name</label>
                        <div class="control">
                            <input type="text" readonly value="{{ $userData->name }}" class="input is-static">
                        </div>
                    </div>
                    <hr>
                    <div class="field">
                        <label class="label">E-mail</label>
                        <div class="control">
                            <input type="text" readonly value="{{ $userData->email }}" class="input is-static">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">
                    <span class="icon"><i class="mdi mdi-lock"></i></span>
                    Change Password
                </p>
            </header>
            <div class="card-content">
                <form>
                    @csrf
                    <div class="field">
                        <label class="label">Current password</label>
                        <div class="control">
                            <input type="password" name="password_current" autocomplete="current-password"
                                class="input" required>
                        </div>
                        <p class="help">Required. Your current password</p>
                    </div>
                    <hr>
                    <div class="field">
                        <label class="label">New password</label>
                        <div class="control">
                            <input type="password" autocomplete="new-password" name="password" class="input"
                                required>
                        </div>
                        <p class="help">Required. New password</p>
                    </div>
                    <div class="field">
                        <label class="label">Confirm password</label>
                        <div class="control">
                            <input type="password" autocomplete="new-password" name="password_confirmation"
                                class="input" required>
                        </div>
                        <p class="help">Required. New password one more time</p>
                    </div>
                    <hr>
                    <div class="field">
                        <div class="control">
                            <button type="submit" class="button green">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

</body>

</html> --}}

<script src="https://cdn.tailwindcss.com"></script>
<script src="{{ asset('JS/jquery.js') }}"></script>
<!--
  Heads up! 👋

  This component comes with some `rtl` classes. Please remove them if they are not needed in your project.
-->
@include('admin.navbar')

{{-- <div class="flex w-full">
    <div class="w-1/5">
        @include('admin.sidenav')
    </div>

    <div class="w-4/5 left-0 right-0 items-center">

        <div class="overflow-x-auto mx-auto items-center text-center">
            <h1 class="text-center text-4xl  font-bold">show all users</h1>
            <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                <div class="w-6/12 mx-auto bg-orange-300">
                    <input class="w-full px-2 py-2 rounded border border-lime-500" id="keyword" type="text"
                        placeholder="search">
                </div>
                <thead class="ltr:text-left rtl:text-right">

                    <tr>
                         <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">name </th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">email </th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Title</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 w-14 h-14">Score</th>
                        <th class="px-4 py-2"></th>
                    </tr>

                </thead>

                <tbody class="divide-y text-center divide-gray-200">
                    @foreach ($users as $user)
                        <tr>
                             <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>



                            <td>
                                <button id="dropdownInformationButton" data-dropdown-toggle="dropdownInformation"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    type="button">Quiz Title <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg>
                                </button>
                                <!-- Dropdown menu -->
                                <div id="dropdownInformation"
                                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                        aria-labelledby="dropdownInformationButton">
                                        @foreach (explode(',', $user->quiz_titles) as $quizname)
                                            <li class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                role="menuitem">
                                                <a href="{{ route('admin.getUser', $user->user_id) }}"
                                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                    {{ trim($quizname) }} </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            <td>

                            <td>
                                <button id="dropdownInformationButton" data-dropdown-toggle="dropdownInformation"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    type="button">Scores <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg>
                                </button>
                                <!-- Dropdown menu -->
                                <div id="dropdownInformation"
                                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                        aria-labelledby="dropdownInformationButton">
                                        @foreach (explode(',', $user->scores) as $score)
                                            @php $trimmedScore = trim($score); @endphp

                                            <li class="block px-4 py-2 text-sm
                                @if ($trimmedScore > 90) text-green-600
                                @elseif ($trimmedScore > 75) text-orange-300
                                @elseif ($trimmedScore > 50) text-rose-300
                                @else text-rose-800 @endif hover:bg-gray-100"
                                                role="menuitem">
                                                <a href="{{ route('admin.getUser', $user->user_id) }}"
                                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                    {{ $trimmedScore }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                            <td>
                                <button class="rounded border-blue-600 px-5 py-3 text-white bg-blue-600 text-center">
                                    <a href="{{ route('admin.getUser', $user->user_id) }}" class="btn">View</a>
                                </button>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>

        </div>
        {{-- pagination --}}
        {{-- <div class="rounded-b-lg border-t w-4/5 mx-auto	 border-gray-200 px-4 py-2">
            <ol class="flex justify-end gap-1 text-xs font-medium">
                <li>
                    <a href="#"
                        class="inline-flex size-8 items-center justify-center rounded border border-gray-100 bg-white text-gray-900 rtl:rotate-180">
                        <span class="sr-only">Prev Page</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </li>

                <li>
                    <a href="#"
                        class="block size-8 rounded border border-gray-100 bg-white text-center leading-8 text-gray-900">
                        1
                    </a>
                </li>

                <li class="block size-8 rounded border-blue-600 bg-blue-600 text-center leading-8 text-white">
                    2
                </li>

                <li>
                    <a href="#"
                        class="block size-8 rounded border border-gray-100 bg-white text-center leading-8 text-gray-900">
                        3
                    </a>
                </li>

                <li>
                    <a href="#"
                        class="block size-8 rounded border border-gray-100 bg-white text-center leading-8 text-gray-900">
                        4
                    </a>
                </li>

                <li>
                    <a href="#"
                        class="inline-flex size-8 items-center justify-center rounded border border-gray-100 bg-white text-gray-900 rtl:rotate-180">
                        <span class="sr-only">Next Page</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </li>
            </ol>
        </div> --}}
    </div>

    <script>
        $('#keyword').keyup(function() {
            let keyword = $(this).val()
            // console.log(keyword);
            // console.log("{{ route('admin.getAllUsers.search') }}"+"?keyword" + keyword);

            // processing ajax request
            $.ajax({
                url: "{{ route('admin.getAllUsers') }}" + "?keyword" + keyword,
                type: 'get',
                contentType: false,
                processData: false,
                // dataType: "json",
                // data: {
                //     name: name,
                //     email: email,
                //     role: role
                // },
                success: function(data) {

                    for (user of data) {
                        // console.log(user.name);

                    }

                }
            });

        })
    </script>


    <script>
        // Function to toggle dropdown visibility
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownButtons = document.querySelectorAll('[id$="Button"]');

            dropdownButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const dropdownMenu = this
                        .nextElementSibling; // Selects the next element (the dropdown)
                    dropdownMenu.classList.toggle('hidden'); // Toggles visibility
                });
            });

            // Optional: Close dropdowns when clicking outside
            document.addEventListener('click', function(event) {
                dropdownButtons.forEach(button => {
                    const dropdownMenu = button.nextElementSibling;
                    if (!button.contains(event.target) && !dropdownMenu.contains(event.target)) {
                        dropdownMenu.classList.add('hidden');
                    }
                });
            });
        });
    </script>
</div>





 <div class="flex">
    <div class="w-1/4">
        @include('admin.sidenav')

    </div>
    <div class="w-full right-0    items-center text-center justify-around flex-nowrap">

        <div class="max-w-[85rem] right-0  px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
            <!-- Card -->
            <div class="flex flex-col ">
                <div class="-m-1.5 overflow-x-auto ">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div
                            class="bg-white border px-5 border-gray-200 rounded-xl shadow-sm  dark:bg-neutral-800 dark:border-neutral-700">
                            <!-- Header -->
                            <div
                                class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700">
                                <div class="flex justify-between w-full">
                                    <h2 class="text-xl  font-semibold text-gray-800 dark:text-neutral-200">
                                        All Users
                                    </h2>
                                </div>

                            </div>

                            <!-- End Header -->

                            <!-- Table -->
                            <table class="min-w-full items-center     flex-nowrap divide-y divide-gray-200 dark:divide-neutral-700">
                                <thead class="bg-gray-50 dark:bg-neutral-800">
                                    <tr>


                                        <th scope="col" class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span
                                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                    Name
                                                </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span
                                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                    Title
                                                </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span
                                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                    Grade
                                                </span>
                                            </div>
                                        </th>

                                        {{-- <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span
                                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                                    Created
                                                </span>
                                            </div>
                                        </th> --}}

                                        <th scope="col" class="px-6 py-3 text-end"></th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                    @foreach ($users as $user)
                                        <tr>

                                            <td class="size-px whitespace-nowrap">
                                                <div class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3">
                                                    <div class="flex items-center gap-x-3">
                                                        <img class="inline-block size-[38px] rounded-full"
                                                            src="{{ $user->image }}" alt="Avatar">
                                                        <div class="grow">
                                                            <span
                                                                class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">{{ $user->name }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="h-px w-72 whitespace-nowrap relative">
                                                <div class="px-6 py-3">
                                                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                                        <button id="dropdownInformationButton"
                                                        data-dropdown-toggle="dropdownInformation"
                                                        class="inline-flex items-center gap-x-1 text-sm  decoration-2 hover:underline focus:outline-none focus:underline font-medium bg-blue-500 text-white py-3 px-5 border rounded-xl"
                                                        type="button">Quiz Title <svg
                                                            class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 10 6">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="m1 1 4 4 4-4" />
                                                        </svg>
                                                    </button>
                                                    <!-- Dropdown menu -->
                                                    <div id="dropdownInformation"
                                                        class="absolute z-50   hidden bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
                                                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                                            aria-labelledby="dropdownInformationButton">
                                                            @foreach (explode(',', $user->quiz_titles) as $quizname)
                                                                <li class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                                    role="menuitem">
                                                                    <a href="{{ route('admin.getUser', $user->user_id) }}"
                                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                                        {{ trim($quizname) }} </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>

                                                    </span>
                                                </div>
                                            </td>
                                            <td class="h-px w-72 whitespace-nowrap relative">
                                                <div class="px-6 py-3">
                                                    <span
                                                        class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                                        <button id="dropdownInformationButton" data-dropdown-toggle="dropdownInformation"
                                                        class="inline-flex items-center gap-x-1 text-sm  decoration-2 focus:outline-none focus:underline font-medium no-underline bg-blue-500 text-white py-3 px-5 border rounded-xl"
                                                        type="button">Scores <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="m1 1 4 4 4-4" />
                                                        </svg>
                                                    </button>
                                                    <!-- Dropdown menu -->
                                                    <div id="dropdownInformation"
                                                        class=" absolute z-50 hidden bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
                                                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                                            aria-labelledby="dropdownInformationButton">
                                                            @foreach (explode(',', $user->scores) as $score)
                                                                @php $trimmedScore = trim($score); @endphp

                                                                <li class="block px-4 py-2 text-sm
                                                    @if ($trimmedScore > 90) text-green-600
                                                    @elseif ($trimmedScore > 75) text-orange-300
                                                    @elseif ($trimmedScore > 50) text-rose-300
                                                    @else text-rose-800 @endif hover:bg-gray-100"
                                                                    role="menuitem">
                                                                    <a href="{{ route('admin.getUser', $user->user_id) }}"
                                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                                        {{ $trimmedScore }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>

                                                    </span>
                                                </div>
                                            </td>
                                            {{-- <td class="size-px whitespace-nowrap">
                                                <div class="px-6 py-3">
                                                    <span
                                                        class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-full dark:bg-teal-500/10 dark:text-teal-500">
                                                        <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg"
                                                            width="16" height="16" fill="currentColor"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                                        </svg>
                                                        Active
                                                    </span>
                                                </div>
                                            </td> --}}

                                            {{-- <td class="size-px whitespace-nowrap">
                                                <div class="px-6 py-3">
                                                    <span
                                                        class="text-sm text-gray-500 dark:text-neutral-500">44-45-2021</span>
                                                 </div>
                                            </td> --}}
                                            <td class="size-px whitespace-nowrap">
                                                <div class="px-6 py-1.5">
                                                    <a class="inline-flex items-center gap-x-1 text-sm  decoration-2 hover:underline focus:outline-none focus:underline font-medium bg-blue-500 text-white py-3 px-5 border rounded-xl"
                                                        href="{{ route('admin.getUser', $user->user_id) }}">
                                                        View
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

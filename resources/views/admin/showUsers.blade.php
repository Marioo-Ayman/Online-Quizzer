<script src="https://cdn.tailwindcss.com"></script>
<script src="{{ asset('JS/jquery.js') }}"></script>
<!--
  Heads up! 👋

  This component comes with some `rtl` classes. Please remove them if they are not needed in your project.
-->
@include('admin.navbar')

    <script>
        $('#keyword').keyup(function() {
            let keyword = $(this).val()


            // processing ajax request
            $.ajax({
                url: "{{ route('admin.getAllUsers') }}" + "?keyword" + keyword,
                type: 'get',
                contentType: false,
                processData: false,
            
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
                                                            src="../uploads/{{ $user->image }}" alt="Avatar">
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

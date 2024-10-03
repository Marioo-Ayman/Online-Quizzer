
    <script src="https://cdn.tailwindcss.com"></script>

<style>
    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
</style>



        @include('admin.navbar')


<div class="flex">
    <div class="w-1/5">
            @include('admin.sidenav')
    </div>
    <div class=" right-0 w-full">

        <div class="max-w-[85rem] right-0 w-3/4 left-full  px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
            <!-- Card -->
            <div class="flex w-full flex-col">
                <div class="-m-1.5 overflow-x-auto ">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div
                            class="bg-white border px-5 border-gray-200 rounded-xl shadow-sm overflow-hidden dark:bg-neutral-800 dark:border-neutral-700">
                            <!-- Header -->
                            <div
                                class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700">
                                <div class="flex justify-between w-full">
                                    <h2 class="text-xl  font-semibold text-gray-800 dark:text-neutral-200">
                                        User info
                                    </h2>
                                </div>

                            </div>

                            <!-- End Header -->

                            <!-- Table -->
                            <table class="min-w-full  items-center flex-nowrap divide-y divide-gray-200 dark:divide-neutral-700">
                                <thead class="bg-gray-50 px-8 border w-full dark:bg-neutral-800">
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
                                     </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                     <tr>
                                        {{-- <span>this is the id for this user {{ $u->user_id }}</span> --}}
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
                                             <td class="h-px w-72 whitespace-nowrap">
                                                <div class="px-6 py-3">
                                                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">

                                                    <!-- Dropdown menu -->
                                                         <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                                            aria-labelledby="dropdownInformationButton">
                                                            @foreach (explode(',', $user->quiz_titles) as $quizname)
                                                            <li class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                                                <a class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                                    {{ $quizname }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                        </ul>
                                                 </div>

                                                    </span>
                                                </div>
                                            </td>
                                            <td class="h-px w-72 whitespace-nowrap">


                                                <div class="px-6 py-3">
                                                    <span
                                                        class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">

                                                    <!-- Dropdown menu -->
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
                                                                <a class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $trimmedScore }}</a>
                                                            </li>
                                                        @endforeach
                                                        </ul>

                                                    </span>
                                                </div>
                                            </td>


                                        </tr>
                                  </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>





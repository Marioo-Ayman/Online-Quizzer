<script src="https://cdn.tailwindcss.com"></script>
<script src="{{ asset('JS/jquery.js') }}"></script>
<!--
  Heads up! 👋

  This component comes with some `rtl` classes. Please remove them if they are not needed in your project.
-->
@include('admin.navbar')
@include('admin.sidenav')
 <div class="overflow-x-auto mx-auto items-center text-center">
    <h1 class="text-center text-4xl  font-bold">show all users</h1>
    <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
        <div class="w-6/12 mx-auto bg-orange-300">
            <input class="w-full px-2 py-2 rounded border border-lime-500" id="keyword" type="text" placeholder="search">
        </div>
        <thead class="ltr:text-left rtl:text-right">

            <tr>
                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">id</th>
                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">name </th>
                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">email </th>
                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 w-14 h-14">score</th>
                <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Role</th>
                <th class="px-4 py-2"></th>
            </tr>

        </thead>

        <tbody class="divide-y text-center divide-gray-200">
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <table class="w-96">
                        <thead class="w-full text-center bg-blue-200">
                            <tr>
                                <th>Exam Name</th>
                                <th>Score</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody class="w-full">
                            @if ($user->userScore->isNotEmpty())
                                @foreach ($user->userScore as $score)
                                    <tr class="w-20  flex-row text-center   ">
                                        <td>{{ $score->title }}</td>
                                        <td>{{ $score->user_score }}</td>
                                        <td>{{ $score->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="  text-center  ">
                                     <td colspan="3" class="text-center"><small>No scores</small></td>
                                 </tr>
                            @endif
                        </tbody>
                    </table>
                </td>
                <td>{{ $user->is_admin }}</td>
                <td>
                    <button class="rounded border-blue-600 px-5 py-3 text-white bg-blue-600 text-center">
                          <a href="{{ route('admin.getUser', $user->id) }}" class="btn">View</a>
                    </button>
                </td>
            </tr>
        @endforeach


        </tbody>
    </table>

</div>
{{-- pagination --}}
<div class="rounded-b-lg border-t w-4/5 mx-auto	 border-gray-200 px-4 py-2">
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
</div>
</div>




<script>

    $('#keyword').keyup(function(){
        let keyword = $(this).val()
        // console.log(keyword);
        // console.log("{{ route('admin.getAllUsers.search') }}"+"?keyword" + keyword);

                 // processing ajax request
                $.ajax({
                    url: "{{ route('admin.getAllUsers') }}" + "?keyword" + keyword,
                    type: 'get',
                    contentType:false,
                    processData:false,
                    // dataType: "json",
                    // data: {
                    //     name: name,
                    //     email: email,
                    //     is_admin: is_admin
                    // },
                    success: function(data) {

                        for(user of data){
                            // console.log(user.name);

                        }

                    }
                });

    })






</script>


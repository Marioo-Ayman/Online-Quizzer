
<footer>
    <div class="p-10 bg-gray-800 text-gray-200">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2">
                <div class="mb-5">
                    <h4 class="text-2xl pb-4">Quizzer</h4>
                    <p class="text-gray-500">
                        Street <br>
                        City <br>
                        Country <br> <br>
                        <strong>Phone: </strong>+20 111 111 1111 <br>
                        <strong>Email: </strong>Quizzer@test.com <br>
                    </p>
                </div>
                <div class="mb-5">
                    <h4 class="pb-4">Useful Links</h4>
                    <ul class="text-gray-500">
                        <li class="pb-4">
                            <i class="fa fa-chevron-right text-yellow-500 " ></i>
                            <a href="#" class="hover:text-yellow-500">Home</a>
                        </li>
                        <li class="pb-4">
                            <i class="fa fa-chevron-right text-yellow-500 "></i>
                            <a href="#" class="hover:text-yellow-500">About</a>
                        </li>
                        <li class="pb-4">
                            <i class="fa fa-chevron-right text-yellow-500 "></i>
                            <a href="#" class="hover:text-yellow-500">services</a>
                        </li>
                        <li class="pb-4">
                            <i class="fa fa-chevron-right text-yellow-500 "></i>
                            <a href="#" class="hover:text-yellow-500">Terms of Services</a>
                        </li>
                        <li class="pb-4">
                            <i class="fa fa-chevron-right text-yellow-500 "></i>
                            <a href="#" class="hover:text-yellow-500">Privacy policy</a>
                        </li>
                    </ul>
                </div>

                <div class="mb-5">
                    <h4 class="pb-4">Join Us</h4>
                    <p class="text-gray-500 pb-2">join 10000+ others</p>
                    <form action="" method="post" class="flex flex-row flex-wrap">
                        <input type="text" class="text-gray-500 w-2/3 p-2 focus:border-yellow-500" placeholder="email@example.com" name="">
                        <button class="p-2 lg:pr-11 w-1/3 bg-yellow-500 text-white hover:bg-yellow-600 min-w-20">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full bg-gray-900 text-gray-500 px-10">
        <div class="max-w-7xl flex flex-col sm:flex-row py-4 mx-auto justify-between items-center">
            <div class="text-center">
                <div>
                    Copyright <strong><span>Quizzer</span></strong>. All Rights Reserved
                </div>
                <div>
                    Designed by <a href="#"></a>
                </div>
            </div>
            <div class="text-center text-xl text-white">
                <a href="#" class="w-10 h-10 rounded-full bg-yellow-500 hover:bg-yellow-600 mx-1 inline-block pt-1"><i class="fa-brands fa-twitter"></i></a>
                <a href="#" class="w-10 h-10 rounded-full bg-yellow-500 hover:bg-yellow-600 mx-1 inline-block pt-1"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" class="w-10 h-10 rounded-full bg-yellow-500 hover:bg-yellow-600 mx-1 inline-block pt-1"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" class="w-10 h-10 rounded-full bg-yellow-500 hover:bg-yellow-600 mx-1 inline-block pt-1"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
        </div>

    </div>
</footer>
{{-- js files --}}
@if(!empty($jsLinks))
@foreach ($jsLinks as $link)
    @php
        $filePath = public_path("JS/{$link}.js");
    @endphp
        @if (file_exists($filePath))

         <script src="{{ asset("JS/{$link}.js") }}"></script>

        @endif
@endforeach
@endif
<script src="../JS/header.js"></script>
</body>
</html>

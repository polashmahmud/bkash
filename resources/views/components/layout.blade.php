<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
</head>
<body class="dark bg-gray-900">
<nav class="border-gray-200 bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ route('bkash.index') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 rounded-lg" viewBox="-6.674 -11.073 57.842 66.436">
                <g fill="none">
                    <path fill="#DF146E"
                          d="M42.31 44.291H2.182A2.189 2.189 0 0 1 0 42.107V2.186C0 .982.981 0 2.182 0H42.31a2.19 2.19 0 0 1 2.184 2.186v39.921a2.19 2.19 0 0 1-2.184 2.184"/>
                    <path fill="#FFF"
                          d="m31.894 24.251-14.107-2.246 1.909 8.329zm.572-.682L21.374 8.16l-3.623 13.106zm-15.402-2.482L5.441 6.239l15.221 1.819zm-5.639-6.154-6.449-6.08h1.695zm24.504 1.15L33.2 23.486l-4.426-6.118zM21.417 30.232l10.71-4.3.454-1.365zm-8.933 7.821 4.589-16.102 2.326 10.479zm24.099-21.914-1.128 3.056 4.059-.07z"/>
                </g>
            </svg>
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Bkash Admin Panel</span>
        </a>
        <button data-collapse-toggle="navbar-solid-bg" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-solid-bg" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto text-gray-600 space-x-3" id="navbar-solid-bg">
{{--            <a class="@if($period == '1') font-bold text-gray-200 @endif" href="{{ route('bkash.index') }}?period=1&page={{ $page }}">Today</a>--}}
{{--            <a class="@if($period == '7') font-bold text-gray-200 @endif"  href="{{ route('bkash.index') }}?period=7&page={{ $page }}">7 days</a>--}}
{{--            <a class="@if($period == '30') font-bold text-gray-200 @endif"  href="{{ route('bkash.index') }}?period=30&page={{ $page }}">30 days</a>--}}
        </div>
    </div>
</nav>

<div>
    {{ $slot }}
</div>
</body>
</html>

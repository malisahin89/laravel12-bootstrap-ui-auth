@extends('dashboard.layouts.app')

@section('title', 'Profile')
@section('pagename', 'profile')

@section('content')
    <main>
        <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
            <!-- Breadcrumb Start -->
            <div x-data="{ pageName: `Profile` }">
                <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90" x-text="pageName"></h2>

                    <nav>
                        <ol class="flex items-center gap-1.5">
                            <li>
                                <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400"
                                    href="{{ route('dashboard.index') }}">
                                    Home
                                    <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke=""
                                            stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </li>
                            <li class="text-sm text-gray-800 dark:text-white/90" x-text="pageName"></li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- Breadcrumb End -->

            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
                <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90 lg:mb-7">
                    Profile
                </h3>

                <div class="p-5 mb-6 border border-gray-200 rounded-2xl dark:border-gray-800 lg:p-6">
                    <div class="flex flex-col gap-5 xl:flex-row xl:items-center xl:justify-between">
                        <div class="flex flex-col items-center w-full gap-6 xl:flex-row">
                            <div class="w-20 h-20 overflow-hidden border border-gray-200 rounded-full dark:border-gray-800">
                                <img src="{{ !empty(Auth::user()->profile_image) ? asset('storage/profile_photos/' . Auth::user()->profile_image) : asset('dashboard/src/images/user/owner.webp') }}"
                                    alt="user" />
                            </div>
                            <div class="order-3 xl:order-2">
                                <h4
                                    class="mb-2 text-lg font-semibold text-center text-gray-800 dark:text-white/90 xl:text-left">
                                    {{ $user->name . ' ' . $user->surname }}
                                </h4>
                                <div class="flex flex-col items-center gap-1 text-center xl:flex-row xl:gap-3 xl:text-left">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        <a href="{{ route('showprofile',$user->username ) }}">{{ '@' . $user->username }}</a>
                                    </p>
                                    <div class="hidden h-3.5 w-px bg-gray-300 dark:bg-gray-700 xl:block"></div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $user->bio }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center order-2 gap-2 grow xl:order-3 xl:justify-end">

                                <a href="{{ 'https://github.com/' . $user->x }}" target="_blank"><button
                                        class="flex h-11 w-11 items-center justify-center gap-2 rounded-full border border-gray-300 bg-white text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                                        <svg class="fill-current" width="20" height="20" viewBox="0 0 24 24"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M12 .297C5.373.297 0 5.67 0 12.297c0 5.305 3.438 9.8 8.207 11.387.6.111.82-.26.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61-.546-1.387-1.332-1.757-1.332-1.757-1.09-.745.083-.73.083-.73 1.204.085 1.838 1.237 1.838 1.237 1.07 1.835 2.807 1.304 3.49.997.108-.775.418-1.305.76-1.605-2.665-.305-5.467-1.334-5.467-5.93 0-1.31.468-2.38 1.235-3.22-.124-.303-.535-1.527.116-3.182 0 0 1.008-.322 3.3 1.23a11.523 11.523 0 0 1 3.004-.404c1.02.005 2.047.137 3.004.404 2.29-1.552 3.297-1.23 3.297-1.23.653 1.655.242 2.88.118 3.182.77.84 1.233 1.91 1.233 3.22 0 4.61-2.807 5.624-5.479 5.921.43.372.815 1.1.815 2.22 0 1.606-.015 2.897-.015 3.286 0 .32.217.694.825.577C20.565 22.094 24 17.6 24 12.297 24 5.67 18.627.297 12 .297z"
                                                fill="currentColor" />
                                        </svg>
                                    </button></a>

                                <a href="{{ 'https://youtube.com/@' . $user->youtube }}" target="_blank">
                                    <button
                                        class="flex h-11 w-11 items-center justify-center gap-2 rounded-full border border-gray-300 bg-white text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                                        <svg class="fill-current" width="20" height="20" viewBox="0 0 576 512"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M549.655 124.083c-6.281-23.65-24.791-42.174-48.437-48.455C456.779 64 288 64 288 64s-168.779 0-213.218 11.628c-23.645 6.281-42.155 24.805-48.437 48.455C16 168.547 16 256.045 16 256.045s0 87.516 10.345 131.962c6.281 23.65 24.791 42.174 48.437 48.455C119.221 448.091 288 448.091 288 448.091s168.779 0 213.218-11.629c23.645-6.281 42.155-24.805 48.437-48.455C560 343.561 560 256.045 560 256.045s0-87.498-10.345-131.962zM232 334.053V178.037l142.857 78.008L232 334.053z"
                                                fill="currentColor" />
                                        </svg>
                                    </button>
                                </a>

                                <a href="{{ 'https://facebook.com/' . $user->x }}" target="_blank"><button
                                        class="flex h-11 w-11 items-center justify-center gap-2 rounded-full border border-gray-300 bg-white text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                                        <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.6666 11.2503H13.7499L14.5833 7.91699H11.6666V6.25033C11.6666 5.39251 11.6666 4.58366 13.3333 4.58366H14.5833V1.78374C14.3118 1.7477 13.2858 1.66699 12.2023 1.66699C9.94025 1.66699 8.33325 3.04771 8.33325 5.58342V7.91699H5.83325V11.2503H8.33325V18.3337H11.6666V11.2503Z"
                                                fill="" />
                                        </svg>
                                    </button></a>

                                <a href="{{ 'https://x.com/' . $user->x }}" target="_blank"><button
                                        class="flex h-11 w-11 items-center justify-center gap-2 rounded-full border border-gray-300 bg-white text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                                        <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M15.1708 1.875H17.9274L11.9049 8.75833L18.9899 18.125H13.4424L9.09742 12.4442L4.12578 18.125H1.36745L7.80912 10.7625L1.01245 1.875H6.70078L10.6283 7.0675L15.1708 1.875ZM14.2033 16.475H15.7308L5.87078 3.43833H4.23162L14.2033 16.475Z"
                                                fill="" />
                                        </svg>
                                    </button></a>

                                <a href="{{ 'https://www.linkedin.com/in/' . $user->linkedin }}" target="_blank"><button
                                        class="flex h-11 w-11 items-center justify-center gap-2 rounded-full border border-gray-300 bg-white text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                                        <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M5.78381 4.16645C5.78351 4.84504 5.37181 5.45569 4.74286 5.71045C4.11391 5.96521 3.39331 5.81321 2.92083 5.32613C2.44836 4.83904 2.31837 4.11413 2.59216 3.49323C2.86596 2.87233 3.48886 2.47942 4.16715 2.49978C5.06804 2.52682 5.78422 3.26515 5.78381 4.16645ZM5.83381 7.06645H2.50048V17.4998H5.83381V7.06645ZM11.1005 7.06645H7.78381V17.4998H11.0672V12.0248C11.0672 8.97475 15.0422 8.69142 15.0422 12.0248V17.4998H18.3338V10.8914C18.3338 5.74978 12.4505 5.94145 11.0672 8.46642L11.1005 7.06645Z"
                                                fill="" />
                                        </svg>
                                    </button></a>

                                <a href="{{ 'https://instagram.com/' . $user->x }}" target="_blank"><button
                                        class="flex h-11 w-11 items-center justify-center gap-2 rounded-full border border-gray-300 bg-white text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                                        <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.8567 1.66699C11.7946 1.66854 12.2698 1.67351 12.6805 1.68573L12.8422 1.69102C13.0291 1.69766 13.2134 1.70599 13.4357 1.71641C14.3224 1.75738 14.9273 1.89766 15.4586 2.10391C16.0078 2.31572 16.4717 2.60183 16.9349 3.06503C17.3974 3.52822 17.6836 3.99349 17.8961 4.54141C18.1016 5.07197 18.2419 5.67753 18.2836 6.56433C18.2935 6.78655 18.3015 6.97088 18.3081 7.15775L18.3133 7.31949C18.3255 7.73011 18.3311 8.20543 18.3328 9.1433L18.3335 9.76463C18.3336 9.84055 18.3336 9.91888 18.3336 9.99972L18.3335 10.2348L18.333 10.8562C18.3314 11.794 18.3265 12.2694 18.3142 12.68L18.3089 12.8417C18.3023 13.0286 18.294 13.213 18.2836 13.4351C18.2426 14.322 18.1016 14.9268 17.8961 15.458C17.6842 16.0074 17.3974 16.4713 16.9349 16.9345C16.4717 17.397 16.0057 17.6831 15.4586 17.8955C14.9273 18.1011 14.3224 18.2414 13.4357 18.2831C13.2134 18.293 13.0291 18.3011 12.8422 18.3076L12.6805 18.3128C12.2698 18.3251 11.7946 18.3306 10.8567 18.3324L10.2353 18.333C10.1594 18.333 10.0811 18.333 10.0002 18.333H9.76516L9.14375 18.3325C8.20591 18.331 7.7306 18.326 7.31997 18.3137L7.15824 18.3085C6.97136 18.3018 6.78703 18.2935 6.56481 18.2831C5.67801 18.2421 5.07384 18.1011 4.5419 17.8955C3.99328 17.6838 3.5287 17.397 3.06551 16.9345C2.60231 16.4713 2.3169 16.0053 2.1044 15.458C1.89815 14.9268 1.75856 14.322 1.7169 13.4351C1.707 13.213 1.69892 13.0286 1.69238 12.8417L1.68714 12.68C1.67495 12.2694 1.66939 11.794 1.66759 10.8562L1.66748 9.1433C1.66903 8.20543 1.67399 7.73011 1.68621 7.31949L1.69151 7.15775C1.69815 6.97088 1.70648 6.78655 1.7169 6.56433C1.75786 5.67683 1.89815 5.07266 2.1044 4.54141C2.3162 3.9928 2.60231 3.52822 3.06551 3.06503C3.5287 2.60183 3.99398 2.31641 4.5419 2.10391C5.07315 1.89766 5.67731 1.75808 6.56481 1.71641C6.78703 1.70652 6.97136 1.69844 7.15824 1.6919L7.31997 1.68666C7.7306 1.67446 8.20591 1.6689 9.14375 1.6671L10.8567 1.66699ZM10.0002 5.83308C7.69781 5.83308 5.83356 7.69935 5.83356 9.99972C5.83356 12.3021 7.69984 14.1664 10.0002 14.1664C12.3027 14.1664 14.1669 12.3001 14.1669 9.99972C14.1669 7.69732 12.3006 5.83308 10.0002 5.83308ZM10.0002 7.49974C11.381 7.49974 12.5002 8.61863 12.5002 9.99972C12.5002 11.3805 11.3813 12.4997 10.0002 12.4997C8.6195 12.4997 7.50023 11.3809 7.50023 9.99972C7.50023 8.61897 8.61908 7.49974 10.0002 7.49974ZM14.3752 4.58308C13.8008 4.58308 13.3336 5.04967 13.3336 5.62403C13.3336 6.19841 13.8002 6.66572 14.3752 6.66572C14.9496 6.66572 15.4169 6.19913 15.4169 5.62403C15.4169 5.04967 14.9488 4.58236 14.3752 4.58308Z"
                                                fill="" />
                                        </svg>
                                    </button></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-5 mb-6 border border-gray-200 rounded-2xl dark:border-gray-800 lg:p-6">
                    <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
                        <div>
                            <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90 lg:mb-6">
                                Personal Information
                            </h4>

                            <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-7 2xl:gap-x-32">
                                <div>
                                    <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                                        First Name
                                    </p>
                                    <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                        {{ $user->name }}
                                    </p>
                                </div>

                                <div>
                                    <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                                        Last Name
                                    </p>
                                    <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                        {{ $user->surname }}
                                    </p>
                                </div>

                                <div>
                                    <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                                        Email address
                                    </p>
                                    <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                        {{ $user->email }}
                                    </p>
                                </div>

                                <div>
                                    @php
                                        $rawPhone = $user->phone; // örnek: +905424613963
                                        $formattedPhone = preg_replace(
                                            '/^\+90(\d{3})(\d{3})(\d{2})(\d{2})$/',
                                            '+90 ($1) $2 $3 $4',
                                            $rawPhone,
                                        );
                                    @endphp
                                    <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                                        Phone
                                    </p>
                                    <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                        {{ $formattedPhone }}
                                    </p>
                                </div>

                                <div>
                                    <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                                        Username
                                    </p>
                                    <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                        {{ $user->username }}
                                    </p>
                                </div>

                                <div>
                                    <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                                        Bio
                                    </p>
                                    <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                        {{ $user->bio }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('dashboard.profile.edit') }}">
                            <button
                                class="flex w-full items-center justify-center gap-2 rounded-full border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200 lg:inline-flex lg:w-auto">
                                <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M15.0911 2.78206C14.2125 1.90338 12.7878 1.90338 11.9092 2.78206L4.57524 10.116C4.26682 10.4244 4.0547 10.8158 3.96468 11.2426L3.31231 14.3352C3.25997 14.5833 3.33653 14.841 3.51583 15.0203C3.69512 15.1996 3.95286 15.2761 4.20096 15.2238L7.29355 14.5714C7.72031 14.4814 8.11172 14.2693 8.42013 13.9609L15.7541 6.62695C16.6327 5.74827 16.6327 4.32365 15.7541 3.44497L15.0911 2.78206ZM12.9698 3.84272C13.2627 3.54982 13.7376 3.54982 14.0305 3.84272L14.6934 4.50563C14.9863 4.79852 14.9863 5.2734 14.6934 5.56629L14.044 6.21573L12.3204 4.49215L12.9698 3.84272ZM11.2597 5.55281L5.6359 11.1766C5.53309 11.2794 5.46238 11.4099 5.43238 11.5522L5.01758 13.5185L6.98394 13.1037C7.1262 13.0737 7.25666 13.003 7.35947 12.9002L12.9833 7.27639L11.2597 5.55281Z"
                                        fill="" />
                                </svg>
                                Edit
                            </button>
                        </a>




                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

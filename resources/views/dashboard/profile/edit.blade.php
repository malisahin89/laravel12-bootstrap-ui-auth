@extends('dashboard.layouts.app')

@section('title', 'Profile Edit')
@section('pagename', 'profile-edit')

@section('content')
    <main>
        <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
            {{-- <!-- Breadcrumb Start --> --}}
            <div x-data="{ pageName: `Profile Edit` }">
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
            {{-- <!-- Breadcrumb End --> --}}

            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
                <h3 class="mb-5 text-lg font-semibold text-gray-800 dark:text-white/90 lg:mb-7">
                    Profile Edit
                </h3>

                <div class="p-5 mb-6 border border-gray-200 rounded-2xl dark:border-gray-800 lg:p-6">
                    <div class="flex flex-col gap-5 xl:flex-row xl:items-center xl:justify-between">


                        {{-- Profil Fotoğrafı Güncelleme Formu --}}
                        <form action="{{ route('dashboard.profile.photo.update') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="flex flex-col items-center w-full gap-6 xl:flex-row">
                                {{-- Profil Fotoğrafı --}}
                                <div class="w-40 h-40 overflow-hidden border border-gray-200 dark:border-gray-800">
                                    <img id="profilePreview"
                                        src="{{ !empty(Auth::user()->profile_image) ? asset('storage/profile_photos/' . Auth::user()->profile_image) : asset('dashboard/src/images/user/owner.webp') }}"
                                        alt="user" />
                                </div>

                                {{-- Dosya input + buton --}}
                                <div>
                                    <input type="file" name="profile_photo" id="profilePhotoInput" class="hidden"
                                        accept="image/*" />

                                    <button type="button" id="photoTriggerButton"
                                        class="flex items-center gap-2 rounded-full border border-gray-400 bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                                        <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M15.0911 2.78206C14.2125 1.90338 12.7878 1.90338 11.9092 2.78206L4.57524 10.116C4.26682 10.4244 4.0547 10.8158 3.96468 11.2426L3.31231 14.3352C3.25997 14.5833 3.33653 14.841 3.51583 15.0203C3.69512 15.1996 3.95286 15.2761 4.20096 15.2238L7.29355 14.5714C7.72031 14.4814 8.11172 14.2693 8.42013 13.9609L15.7541 6.62695C16.6327 5.74827 16.6327 4.32365 15.7541 3.44497L15.0911 2.78206ZM12.9698 3.84272C13.2627 3.54982 13.7376 3.54982 14.0305 3.84272L14.6934 4.50563C14.9863 4.79852 14.9863 5.2734 14.6934 5.56629L14.044 6.21573L12.3204 4.49215L12.9698 3.84272ZM11.2597 5.55281L5.6359 11.1766C5.53309 11.2794 5.46238 11.4099 5.43238 11.5522L5.01758 13.5185L6.98394 13.1037C7.1262 13.0737 7.25666 13.003 7.35947 12.9002L12.9833 7.27639L11.2597 5.55281Z"
                                                fill="" />
                                        </svg>
                                        <span id="photoButtonText">Change Profile Photo</span>
                                    </button>

                                    {{-- Submit Button (başta gizli) --}}
                                    <button type="submit" id="submitPhotoBtn"
                                        class="hidden flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
                                        Change Profile
                                    </button>

                                    @error('profile_photo')
                                        <span class="text-warning-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </form>




                    </div>
                </div>

                <div class="p-5 mb-6 border border-gray-200 rounded-2xl dark:border-gray-800 lg:p-6">
                    <form class="flex flex-col" action="{{ route('dashboard.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mt-7">
                            <h5 class="mb-5 text-lg font-medium text-gray-800 dark:text-white/90 lg:mb-6">Social Links</h5>

                            <div class="grid grid-cols-1 gap-x-6 gap-y-5 lg:grid-cols-2">
                                {{-- <!-- Youtube --> --}}
                                <div class="col-span-2 lg:col-span-1">
                                    <label
                                        class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Youtube</label>
                                    <input name="youtube" type="text" value="{{ old('youtube', $user->youtube) }}"
                                        class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-400 bg-transparent px-4 py-2.5 text-sm 
                                        @error('youtube') border-error-500 @enderror">
                                    @error('youtube')
                                        <span class="text-warning-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- <!-- Github --> --}}
                                <div class="col-span-2 lg:col-span-1">
                                    <label
                                        class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Github</label>
                                    <input name="github" type="text" value="{{ old('github', $user->github) }}"
                                        class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-400 bg-transparent px-4 py-2.5 text-sm 
                                        @error('github') border-error-500 @enderror">
                                    @error('github')
                                        <span class="text-warning-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- <!-- Facebook --> --}}
                                <div class="col-span-2 lg:col-span-1">
                                    <label
                                        class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Facebook</label>
                                    <input name="facebook" type="text" value="{{ old('facebook', $user->facebook) }}"
                                        class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-400 bg-transparent px-4 py-2.5 text-sm 
                                        @error('facebook') border-error-500 @enderror">
                                    @error('facebook')
                                        <span class="text-warning-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- <!-- X.com --> --}}
                                <div class="col-span-2 lg:col-span-1">
                                    <label
                                        class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">X.com</label>
                                    <input name="x" type="text" value="{{ old('x', $user->x) }}"
                                        class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-400 bg-transparent px-4 py-2.5 text-sm 
                                        @error('x') border-error-500 @enderror">
                                    @error('x')
                                        <span class="text-warning-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- <!-- Linkedin --> --}}
                                <div class="col-span-2 lg:col-span-1">
                                    <label
                                        class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Linkedin</label>
                                    <input name="linkedin" type="text" value="{{ old('linkedin', $user->linkedin) }}"
                                        class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-400 bg-transparent px-4 py-2.5 text-sm 
                                        @error('linkedin') border-error-500 @enderror">
                                    @error('linkedin')
                                        <span class="text-warning-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- <!-- Instagram --> --}}
                                <div class="col-span-2 lg:col-span-1">
                                    <label
                                        class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Instagram</label>
                                    <input name="instagram" type="text" value="{{ old('instagram', $user->instagram) }}"
                                        class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-400 bg-transparent px-4 py-2.5 text-sm 
                                        @error('instagram') border-error-500 @enderror">
                                    @error('instagram')
                                        <span class="text-warning-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- <!-- Personal Information --> --}}
                        <div class="mt-7">
                            <h5 class="mb-5 text-lg font-medium text-gray-800 dark:text-white/90 lg:mb-6">Personal
                                Information</h5>

                            <div class="grid grid-cols-1 gap-x-6 gap-y-5 lg:grid-cols-2">
                                {{-- <!-- Username --> --}}
                                <div class="col-span-2">
                                    <label
                                        class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Username</label>
                                    <input name="username" type="text" value="{{ old('username', $user->username) }}"
                                        class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-400 bg-transparent px-4 py-2.5 text-sm 
                                        @error('username') border-error-500 @enderror">
                                    @error('username')
                                        <span class="text-warning-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- <!-- First Name --> --}}
                                <div class="col-span-2 lg:col-span-1">
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">First
                                        Name</label>
                                    <input name="name" type="text" value="{{ old('name', $user->name) }}"
                                        class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-400 bg-transparent px-4 py-2.5 text-sm 
                                        @error('name') border-error-500 @enderror">
                                    @error('name')
                                        <span class="text-warning-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- <!-- Last Name --> --}}
                                <div class="col-span-2 lg:col-span-1">
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Last
                                        Name</label>
                                    <input name="surname" type="text" value="{{ old('surname', $user->surname) }}"
                                        class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-400 bg-transparent px-4 py-2.5 text-sm 
                                        @error('surname') border-error-500 @enderror">
                                    @error('surname')
                                        <span class="text-warning-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- <!-- Email --> --}}
                                <div class="col-span-2 lg:col-span-1">
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Email
                                        Address</label>
                                    <input name="email" type="text" value="{{ old('email', $user->email) }}"
                                        class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-400 bg-transparent px-4 py-2.5 text-sm 
                                        @error('email') border-error-500 @enderror">
                                    @error('email')
                                        <span class="text-warning-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- <!-- Phone --> --}}
                                <div class="col-span-2 lg:col-span-1">
                                    <label for="phone"
                                        class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        Phone
                                    </label>
                                    <input id="phone" name="phone" type="text"
                                        value="{{ old('phone', $user->phone) }}"
                                        pattern="\+90\s?\(\d{3}\)\s?\d{3}\s?\d{2}\s?\d{2}"
                                        title="Telefon numarası +90 (555) 555 55 55 formatında olmalıdır."
                                        class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-400 bg-transparent px-4 py-2.5 text-sm 
                                    @error('phone') border-error-500 @enderror"
                                        placeholder="+90 (555) 555 55 55">

                                    @error('phone')
                                        <span class="text-warning-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>



                                {{-- <!-- Bio --> --}}
                                <div class="col-span-2 lg:col-span-1">
                                    <label
                                        class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Bio</label>
                                    <input name="bio" type="text" value="{{ old('bio', $user->bio) }}"
                                        class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-400 bg-transparent px-4 py-2.5 text-sm 
                                        @error('bio') border-error-500 @enderror">
                                    @error('bio')
                                        <span class="text-warning-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 px-2 mt-6 lg:justify-end">
                            <button type="submit"
                                class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
                                Save Changes
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        </div>
    </main>


    {{-- <!-- InputMask --> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7-beta.19/jquery.inputmask.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#phone").inputmask({
                mask: "+90 (999) 999 99 99",
                showMaskOnHover: false,
                showMaskOnFocus: false,
                placeholder: " ",
                // autoUnmask: true,
                // removeMaskOnSubmit: true,
                rightAlign: false
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('profilePhotoInput');
            const triggerButton = document.getElementById('photoTriggerButton');
            const buttonText = document.getElementById('photoButtonText');
            const submitButton = document.getElementById('submitPhotoBtn');
            const previewImage = document.getElementById('profilePreview');

            triggerButton.addEventListener('click', function() {
                fileInput.click();
            });

            fileInput.addEventListener('change', function() {
                if (fileInput.files.length > 0) {

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                    };
                    reader.readAsDataURL(fileInput.files[0]);

                    triggerButton.classList.add('hidden');
                    submitButton.classList.remove('hidden');
                }
            });
        });
    </script>




@endsection

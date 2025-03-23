<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name . ' ' . $user->surname }} Profile Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        .social-link {
            transition: all 0.2s ease-in-out;
        }

        .social-link:hover {
            transform: translateY(-2px);
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        .modal.show {
            display: flex;
            opacity: 1;
        }
    </style>
</head>

<body>
    {{-- <!-- Modal --> --}}
    <div id="imageModal" class="modal items-center justify-center" onclick="closeModal()">
        <img src="{{ !empty($user->profile_image) ? asset('storage/profile_photos/' . $user->profile_image) : asset('dashboard/src/images/user/owner.webp') }}"
            alt="Profile Large" class="max-w-[90%] max-h-[90vh] rounded-lg shadow-2xl cursor-pointer"
            onclick="event.stopPropagation()" />
    </div>

    <div class="min-h-screen bg-gradient-to-br from-blue-500 to-purple-600 p-4 sm:p-8 flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl p-6 sm:p-8">
            {{-- <!-- Profile Header --> --}}
            <div class="flex flex-col sm:flex-row items-center gap-6">
                <img src="{{ !empty($user->profile_image) ? asset('storage/profile_photos/' . $user->profile_image) : asset('dashboard/src/images/user/owner.webp') }}"
                    alt="Profile"
                    class="w-32 h-32 rounded-full object-cover border-4 border-purple-500 shadow-lg cursor-pointer hover:opacity-90 transition-opacity"
                    onclick="openModal()" />
                <div class="text-center sm:text-left">
                    <h1 class="text-3xl font-bold text-gray-800">{{ $user->name . ' ' . $user->surname }}</h1>
                    <p class="text-lg text-purple-600">{{ '@' . $user->username }}</p>
                    <div class="flex items-center justify-center sm:justify-start gap-3 mt-2 text-gray-600">
                        <div class="flex items-center gap-1">
                            <i data-lucide="mail" class="w-4 h-4"></i>
                            <span class="text-sm">{{ $user->email }}</span>
                        </div>
                        @if ($user->phone)
                            @php
                                $rawPhone = $user->phone;
                                $formattedPhone = preg_replace(
                                    '/^\+90(\d{3})(\d{3})(\d{2})(\d{2})$/',
                                    '+90 ($1) $2 $3 $4',
                                    $rawPhone,
                                );
                            @endphp
                            <div class="flex items-center gap-1">
                                <i data-lucide="phone" class="w-4 h-4"></i>
                                <span class="text-sm">{{ $formattedPhone }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- <!-- Bio --> --}}
            <div class="mt-6">
                <p class="text-gray-600 leading-relaxed">{{ $user->bio }}</p>
            </div>

            {{-- <!-- Social Links --> --}}
            <div class="mt-8 flex flex-wrap justify-center sm:justify-start gap-4">

                @if ($user->github)
                    <a href="https://github.com/{{ $user->github }}" target="_blank"
                        class="social-link flex items-center gap-2 px-4 py-2 rounded-full bg-gray-100 hover:bg-gray-200 transition-colors">
                        <i data-lucide="github" class="w-5 h-5 text-gray-700"></i>
                        <span class="text-gray-700">GitHub</span>
                    </a>
                @endif

                @if ($user->facebook)
                    <a href="http://facebook.com/{{ $user->facebook }}" target="_blank"
                        class="social-link flex items-center gap-2 px-4 py-2 rounded-full bg-blue-100 hover:bg-blue-200 transition-colors">
                        <i data-lucide="facebook" class="w-5 h-5 text-blue-600"></i>
                        <span class="text-blue-600">Facebook</span>
                    </a>
                @endif
                @if ($user->x)
                    <a href="https://x.com/{{ $user->x }}" target="_blank"
                        class="social-link flex items-center gap-2 px-4 py-2 rounded-full bg-sky-100 hover:bg-sky-200 transition-colors">
                        <i data-lucide="twitter" class="w-5 h-5 text-sky-500"></i>
                        <span class="text-sky-500">Twitter</span>
                    </a>
                @endif
                @if ($user->linkedin)
                    <a href="https://linkedin.com/in/{{ $user->linkedin }}" target="_blank"
                        class="social-link flex items-center gap-2 px-4 py-2 rounded-full bg-blue-100 hover:bg-blue-200 transition-colors">
                        <i data-lucide="linkedin" class="w-5 h-5 text-blue-700"></i>
                        <span class="text-blue-700">LinkedIn</span>
                    </a>
                @endif
                @if ($user->instagram)
                    <a href="https://instagram.com/{{ $user->instagram }}" target="_blank"
                        class="social-link flex items-center gap-2 px-4 py-2 rounded-full bg-pink-100 hover:bg-pink-200 transition-colors">
                        <i data-lucide="instagram" class="w-5 h-5 text-pink-600"></i>
                        <span class="text-pink-600">Instagram</span>
                    </a>
                @endif
                @if ($user->youtube)
                    <a href="https://youtube.com/{{ '@' . $user->youtube }}" target="_blank"
                        class="social-link flex items-center gap-2 px-4 py-2 rounded-full bg-red-100 hover:bg-red-200 transition-colors">
                        <i data-lucide="youtube" class="w-5 h-5 text-red-600"></i>
                        <span class="text-red-600">YouTube</span>
                    </a>
                @endif
            </div>


            {{-- <!-- Custom Link --> --}}
            <div class="mt-4 pt-2 border-t border-gray-200">

                @foreach ($user->links as $link)
                    <a href="{{ $link['url'] }}" target="_blank"
                        class="block mt-2 p-4 bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl hover:from-blue-100 hover:to-purple-100 transition-colors">
                        <div class="flex items-center gap-3">
                            <i data-lucide="link" class="w-5 h-5 text-purple-600"></i>
                            <div>
                                <p class="text-sm text-gray-500">{{ $link['title'] }}</p>
                                <p class="text-purple-600 font-medium">{{ $link['url'] }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach






            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

        const modal = document.getElementById('imageModal');

        function openModal() {
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            modal.classList.remove('show');
            document.body.style.overflow = 'auto';
        }
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeModal();
        });
    </script>
</body>

</html>

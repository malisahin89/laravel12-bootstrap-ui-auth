<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaliSahin89 - Teknoloji Çözümleri</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100 overflow-x-hidden">

    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <i data-lucide="rocket" class="h-8 w-8 text-indigo-600"></i>
                    <span class="ml-2 text-xl font-bold text-gray-900">MaliSahin89</span>
                </div>



                <div class="flex items-center space-x-4">


                    @auth
                        <a href="{{ url('/admin') }}">
                            <button
                                class="flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 transition-colors">
                                <i data-lucide="layout-dashboard" class="h-4 w-4 mr-2"></i>
                                Dashboard
                            </button>
                        </a>
                    @else
                        <a href="{{ route('login') }}">
                            <button
                                class="flex items-center px-4 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 transition-colors">
                                <i data-lucide="log-in" class="h-4 w-4 mr-2"></i>
                                Giriş Yap
                            </button>
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">
                                <button
                                    class="flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 transition-colors">
                                    <i data-lucide="user-plus" class="h-4 w-4 mr-2"></i>
                                    Üye Ol
                                </button>
                            </a>
                        @endif
                    @endauth




                </div>


            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <!-- Hero Section -->
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-10">
                <div class="lg:w-1/2">
                    <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl">
                        Geleceğin Teknolojisine
                        <span class="block text-indigo-600">Hoş Geldiniz</span>
                    </h1>
                    <p class="mt-6 text-xl text-gray-500">
                        En yeni teknolojileri keşfedin, uzmanlarla bağlantı kurun ve dijital dünyada yerinizi alın.
                    </p>
                    <div class="mt-8 space-y-4 sm:space-y-0 sm:flex sm:space-x-4">
                        <button
                            class="w-full sm:w-auto flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 transition-colors">
                            Hemen Başla
                        </button>
                        <button
                            class="w-full sm:w-auto flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-lg text-indigo-600 bg-indigo-50 hover:bg-indigo-100 transition-colors">
                            Daha Fazla Bilgi
                        </button>
                    </div>
                </div>
                <div class="lg:w-1/2">
                    <img class="w-full h-auto rounded-lg shadow-xl"
                        src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=80"
                        alt="Modern çalışma ortamı">
                </div>
            </div>

            <!-- Features -->
            <div class="mt-16 sm:mt-24 lg:mt-32 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="bg-indigo-50 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                        <i data-lucide="rocket" class="h-6 w-6 text-indigo-600"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Hızlı Başlangıç</h3>
                    <p class="mt-2 text-gray-600">Dakikalar içinde hesabınızı oluşturun ve platformun tüm özelliklerine
                        erişin.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="bg-indigo-50 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                        <i data-lucide="shield" class="h-6 w-6 text-indigo-600"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Güvenli Sistem</h3>
                    <p class="mt-2 text-gray-600">En son güvenlik teknolojileriyle korunan güvenli bir platform.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="bg-indigo-50 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                        <i data-lucide="headphones" class="h-6 w-6 text-indigo-600"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">7/24 Destek</h3>
                    <p class="mt-2 text-gray-600">Uzman ekibimiz her zaman yanınızda, sorularınıza anında yanıt alın.
                    </p>
                </div>
            </div>

            <!-- Content Section -->
            <div class="mt-16 sm:mt-24 lg:mt-32">
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8">Teknoloji Dünyasında Öncü</h2>
                    <div class="prose prose-lg max-w-none text-gray-600">
                        <p class="mb-6">
                            Teknolojiyi herkes için erişilebilir kılmak amacıyla çıktığımız bu yolda; web geliştirme,
                            mobil uygulama, UI/UX tasarımı, danışmanlık ve SEO gibi alanlarda kaliteli çözümler
                            sunuyoruz.
                        </p>
                        <p class="mb-6">
                            İhtiyacınıza özel teknolojik altyapılar ve yazılımlar geliştirerek işletmenizi dijital çağa
                            hazırlıyoruz. Güvenli altyapımız, kullanıcı dostu arayüzlerimiz ve uzman desteğimizle her
                            zaman yanınızdayız.
                        </p>
                        <p>
                            MaliSahin89, yalnızca bir teknoloji şirketi değil; aynı zamanda size değer katan dijital bir
                            yol arkadaşıdır.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-16 sm:mt-24 lg:mt-32">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center">
                        <i data-lucide="rocket" class="h-8 w-8 text-indigo-400"></i>
                        <span class="ml-2 text-xl font-bold">MaliSahin89</span>
                    </div>
                    <p class="mt-4 text-gray-400">
                        Geleceğin teknolojisini bugünden keşfedin.
                    </p>
                    <div class="flex space-x-4 mt-6">
                        <a href="#" class="text-gray-400 hover:text-indigo-400 transition-colors">
                            <i data-lucide="facebook" class="h-6 w-6"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-indigo-400 transition-colors">
                            <i data-lucide="twitter" class="h-6 w-6"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-indigo-400 transition-colors">
                            <i data-lucide="instagram" class="h-6 w-6"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-indigo-400 transition-colors">
                            <i data-lucide="linkedin" class="h-6 w-6"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Hızlı Bağlantılar</h3>
                    <ul class="space-y-2">
                        <li><a href="https://malisahin.com" class="text-gray-400 hover:text-indigo-400">Anasayfa</a>
                        </li>
                        <li><a href="https://malisahin.com" class="text-gray-400 hover:text-indigo-400">Hakkımızda</a>
                        </li>
                        <li><a href="https://malisahin.com" class="text-gray-400 hover:text-indigo-400">Hizmetler</a>
                        </li>
                        <li><a href="https://malisahin.com" class="text-gray-400 hover:text-indigo-400">Blog</a></li>
                        <li><a href="https://malisahin.com" class="text-gray-400 hover:text-indigo-400">İletişim</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Hizmetlerimiz</h3>
                    <ul class="space-y-2">
                        <li><a href="https://malisahin.com" class="text-gray-400 hover:text-indigo-400">Web
                                Geliştirme</a></li>
                        <li><a href="https://malisahin.com" class="text-gray-400 hover:text-indigo-400">Mobil
                                Uygulama</a></li>
                        <li><a href="https://malisahin.com" class="text-gray-400 hover:text-indigo-400">UI/UX
                                Tasarım</a></li>
                        <li><a href="https://malisahin.com"
                                class="text-gray-400 hover:text-indigo-400">Danışmanlık</a></li>
                        <li><a href="https://malisahin.com" class="text-gray-400 hover:text-indigo-400">SEO</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">İletişim</h3>
                    <ul class="space-y-4">
                        <li class="flex items-center">
                            <i data-lucide="map-pin" class="h-5 w-5 text-indigo-400 mr-2"></i>
                            <span class="text-gray-400">ORDU, Türkiye</span>
                        </li>
                        <li class="flex items-center">
                            <i data-lucide="phone" class="h-5 w-5 text-indigo-400 mr-2"></i>
                            <span class="text-gray-400">+90 (999) 999 99 99</span>
                        </li>
                        <li class="flex items-center">
                            <i data-lucide="mail" class="h-5 w-5 text-indigo-400 mr-2"></i>
                            <span class="text-gray-400">info@MaliSahin.com</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8">
                <p class="text-center text-gray-400">
                    © 2024 MaliSahin.com. Tüm hakları saklıdır.
                </p>
            </div>
        </div>
    </footer>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>

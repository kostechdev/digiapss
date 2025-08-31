<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DIGIAPS - Kelurahan Lebak Denok</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo.svg') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.svg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        /* Fade Up Animation */
        .fade-up {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        .fade-up.animate-in {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Fade Left Animation */
        .fade-left {
            opacity: 0;
            transform: translateX(-50px);
            transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        .fade-left.animate-in {
            opacity: 1;
            transform: translateX(0);
        }
        
        /* Fade Right Animation */
        .fade-right {
            opacity: 0;
            transform: translateX(50px);
            transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        .fade-right.animate-in {
            opacity: 1;
            transform: translateX(0);
        }
        
        /* Zoom In Animation */
        .zoom-in {
            opacity: 0;
            transform: scale(0.8);
            transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        .zoom-in.animate-in {
            opacity: 1;
            transform: scale(1);
        }
        
        /* Rotate In Animation */
        .rotate-in {
            opacity: 0;
            transform: rotate(-10deg) scale(0.9);
            transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        .rotate-in.animate-in {
            opacity: 1;
            transform: rotate(0deg) scale(1);
        }
        
        /* Flip Animation */
        .flip-in {
            opacity: 0;
            transform: perspective(1000px) rotateY(-90deg);
            transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        .flip-in.animate-in {
            opacity: 1;
            transform: perspective(1000px) rotateY(0deg);
        }
        
        /* Staggered delays for items */
        .animate-item:nth-child(1) { transition-delay: 0.1s; }
        .animate-item:nth-child(2) { transition-delay: 0.2s; }
        .animate-item:nth-child(3) { transition-delay: 0.3s; }
        .animate-item:nth-child(4) { transition-delay: 0.4s; }
        .animate-item:nth-child(5) { transition-delay: 0.5s; }
        .animate-item:nth-child(6) { transition-delay: 0.6s; }
        .animate-item:nth-child(7) { transition-delay: 0.7s; }
        .animate-item:nth-child(8) { transition-delay: 0.8s; }
        .animate-item:nth-child(9) { transition-delay: 0.9s; }
    </style>
</head>
<body class="font-sans bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="h-10 w-10">
                    <div>
                        <h1 class="text-xl font-bold text-gray-900">DIGIAPS</h1>
                        <p class="text-xs text-gray-600">Kelurahan Lebak Denok</p>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-1">
                    <a href="#beranda" class="relative px-4 py-2 text-gray-900 font-medium transition-all duration-300 hover:text-black group">
                        <span class="relative z-10">Beranda</span>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-black transform scale-x-100 transition-transform duration-300 group-hover:scale-x-100"></div>
                    </a>
                    <a href="#penduduk" class="relative px-4 py-2 text-gray-600 font-medium transition-all duration-300 hover:text-black group">
                        <span class="relative z-10">Data Penduduk</span>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-black transform scale-x-0 transition-transform duration-300 group-hover:scale-x-100"></div>
                    </a>
                    <a href="#galeri" class="relative px-4 py-2 text-gray-600 font-medium transition-all duration-300 hover:text-black group">
                        <span class="relative z-10">Galeri</span>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-black transform scale-x-0 transition-transform duration-300 group-hover:scale-x-100"></div>
                    </a>
                    <a href="#berita" class="relative px-4 py-2 text-gray-600 font-medium transition-all duration-300 hover:text-black group">
                        <span class="relative z-10">Berita</span>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-black transform scale-x-0 transition-transform duration-300 group-hover:scale-x-100"></div>
                    </a>
                    
                    <a href="#lokasi" class="relative px-4 py-2 text-gray-600 font-medium transition-all duration-300 hover:text-black group">
                        <span class="relative z-10">Lokasi</span>
                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-black transform scale-x-0 transition-transform duration-300 group-hover:scale-x-100"></div>
                    </a>
                    <div class="ml-6 pl-6 border-l border-gray-200">
                        <a href="/admin" class="px-6 py-2.5 bg-black text-white font-medium rounded-lg hover:bg-gray-800 transition-all duration-200">
                            Login
                        </a>
                    </div>
                </div>
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-gray-700 hover:text-primary-600">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t shadow-lg">
            <div class="px-4 pt-4 pb-6 space-y-2">
                <a href="#beranda" class="block px-4 py-3 text-black font-medium bg-gray-50 rounded-lg border-l-4 border-black">Beranda</a>
                <a href="#penduduk" class="block px-4 py-3 text-gray-600 hover:text-black hover:bg-gray-50 rounded-lg transition-all duration-200">Data Penduduk</a>
                <a href="#berita" class="block px-4 py-3 text-gray-600 hover:text-black hover:bg-gray-50 rounded-lg transition-all duration-200">Berita</a>
                <a href="#galeri" class="block px-4 py-3 text-gray-600 hover:text-black hover:bg-gray-50 rounded-lg transition-all duration-200">Galeri</a>
                <a href="#lokasi" class="block px-4 py-3 text-gray-600 hover:text-black hover:bg-gray-50 rounded-lg transition-all duration-200">Lokasi</a>
                <div class="pt-4 mt-4 border-t border-gray-100">
                    <a href="/admin" class="block bg-black text-white px-6 py-3 rounded-full text-center font-medium hover:bg-gray-800 transition-all duration-200">
                        Admin
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="relative overflow-hidden scroll-mt-16">
        <div class="hero-slider relative h-[250px] sm:h-[350px] md:h-[500px] lg:h-[600px]">
            @foreach($banners as $index => $banner)
            <div class="slide {{ $index === 0 ? 'active' : '' }} absolute inset-0 transition-opacity duration-1000">
                <img src="{{ $banner->gambar_url }}" alt="Banner" class="w-full h-full object-contain sm:object-cover object-center">
            </div>
            @endforeach
        </div>
        
        @if(count($banners) > 1)
        <div class="absolute bottom-2 sm:bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-1 sm:space-x-2 z-30">
            @foreach($banners as $index => $banner)
            <button class="slider-dot w-2 h-2 sm:w-3 sm:h-3 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-white' : 'bg-white/50' }}" data-slide="{{ $index }}"></button>
            @endforeach
        </div>
        @endif
    </section>

    <!-- Overview Penduduk -->
    <section id="penduduk" class="py-16 bg-white fade-up">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 fade-up animate-item">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Data Penduduk</h2>
                <p class="text-lg text-gray-600">Informasi demografis Kelurahan Lebak Denok</p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="bg-white rounded-xl shadow-lg p-8 fade-left animate-item">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 text-center">Distribusi Penduduk</h3>
                    <div class="relative mb-6">
                        <canvas id="populationChart" width="400" height="400"></canvas>
                    </div>
                    <div class="grid grid-cols-1 gap-3">
                        <div class="flex items-center justify-center">
                            <div class="w-4 h-4 bg-green-500 rounded-full mr-2"></div>
                            <span class="text-sm text-gray-700">Anak (0-17 tahun)</span>
                        </div>
                        <div class="flex items-center justify-center">
                            <div class="w-4 h-4 bg-blue-500 rounded-full mr-2"></div>
                            <span class="text-sm text-gray-700">Dewasa Muda (18-30 tahun)</span>
                        </div>
                        <div class="flex items-center justify-center">
                            <div class="w-4 h-4 bg-purple-500 rounded-full mr-2"></div>
                            <span class="text-sm text-gray-700">Dewasa (31-50 tahun)</span>
                        </div>
                        <div class="flex items-center justify-center">
                            <div class="w-4 h-4 bg-orange-500 rounded-full mr-2"></div>
                            <span class="text-sm text-gray-700">Pra Lansia (51-65 tahun)</span>
                        </div>
                        <div class="flex items-center justify-center">
                            <div class="w-4 h-4 bg-red-500 rounded-full mr-2"></div>
                            <span class="text-sm text-gray-700">Lansia (65+ tahun)</span>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-4 fade-right animate-item">
                    <div class="bg-white rounded-xl shadow-lg p-4 zoom-in animate-item">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-4 h-4 bg-green-500 rounded-full mr-3"></div>
                                <span class="text-gray-700 font-medium">Anak (0-17 tahun)</span>
                            </div>
                            <div class="text-right">
                                <div class="text-xl font-bold text-gray-900 counter" data-target="{{ $distribusiUsia['anak'] }}">0</div>
                                <div class="text-sm text-gray-500 counter-percent" data-target="{{ $totalPenduduk > 0 ? number_format(($distribusiUsia['anak'] / $totalPenduduk) * 100, 1) : 0 }}">0%</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-lg p-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-4 h-4 bg-blue-500 rounded-full mr-3"></div>
                                <span class="text-gray-700 font-medium">Dewasa Muda (18-30)</span>
                            </div>
                            <div class="text-right">
                                <div class="text-xl font-bold text-gray-900 counter" data-target="{{ $distribusiUsia['dewasa_muda'] }}">0</div>
                                <div class="text-sm text-gray-500 counter-percent" data-target="{{ $totalPenduduk > 0 ? number_format(($distribusiUsia['dewasa_muda'] / $totalPenduduk) * 100, 1) : 0 }}">0%</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-lg p-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-4 h-4 bg-purple-500 rounded-full mr-3"></div>
                                <span class="text-gray-700 font-medium">Dewasa (31-50)</span>
                            </div>
                            <div class="text-right">
                                <div class="text-xl font-bold text-gray-900 counter" data-target="{{ $distribusiUsia['dewasa'] }}">0</div>
                                <div class="text-sm text-gray-500 counter-percent" data-target="{{ $totalPenduduk > 0 ? number_format(($distribusiUsia['dewasa'] / $totalPenduduk) * 100, 1) : 0 }}">0%</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-lg p-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-4 h-4 bg-orange-500 rounded-full mr-3"></div>
                                <span class="text-gray-700 font-medium">Pra Lansia (51-65)</span>
                            </div>
                            <div class="text-right">
                                <div class="text-xl font-bold text-gray-900 counter" data-target="{{ $distribusiUsia['lansia_awal'] }}">0</div>
                                <div class="text-sm text-gray-500 counter-percent" data-target="{{ $totalPenduduk > 0 ? number_format(($distribusiUsia['lansia_awal'] / $totalPenduduk) * 100, 1) : 0 }}">0%</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-lg p-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-4 h-4 bg-red-500 rounded-full mr-3"></div>
                                <span class="text-gray-700 font-medium">Lansia (65+)</span>
                            </div>
                            <div class="text-right">
                                <div class="text-xl font-bold text-gray-900 counter" data-target="{{ $distribusiUsia['lansia'] }}">0</div>
                                <div class="text-sm text-gray-500 counter-percent" data-target="{{ $totalPenduduk > 0 ? number_format(($distribusiUsia['lansia'] / $totalPenduduk) * 100, 1) : 0 }}">0%</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-r from-primary-500 to-primary-600 rounded-xl shadow-lg p-6 text-white">
                        <div class="text-center">
                            <div class="text-3xl font-bold mb-2 counter" data-target="{{ $totalPenduduk }}">0</div>
                            <div class="text-primary-100">Total Penduduk</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Galeri Section -->
    <section id="galeri" class="py-16 bg-gray-50 fade-right">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 zoom-in animate-item">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Galeri Kegiatan</h2>
                <p class="text-lg text-gray-600">Dokumentasi kegiatan terbaru Kelurahan Lebak Denok</p>
            </div>
            
            @if($galeriTerbaru->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($galeriTerbaru as $galeri)
                    @if($galeri->images->count() > 0)
                        <div class="relative group cursor-pointer rotate-in animate-item" onclick="window.location.href='{{ route('galeri.show', $galeri->id) }}'">
                            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform group-hover:scale-105">
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $galeri->images->first()->path) }}" 
                                         alt="{{ $galeri->judul }}" 
                                         class="w-full h-64 object-cover">
                                    @if($galeri->images->count() > 1)
                                        <div class="absolute top-4 right-4 bg-black/70 text-white px-3 py-1 rounded-full text-sm">
                                            +{{ $galeri->images->count() - 1 }} foto
                                        </div>
                                    @endif
                                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all duration-300"></div>
                                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                                        <h3 class="text-white font-semibold text-lg mb-1">{{ $galeri->judul }}</h3>
                                        <p class="text-white/80 text-sm">
                                            {{ $galeri->tanggal_kegiatan ? $galeri->tanggal_kegiatan->format('d M Y') : 'Tanggal tidak tersedia' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            @else
            <div class="text-center py-12">
                <div class="text-gray-500 text-lg">Belum ada galeri kegiatan</div>
            </div>
            @endif
        </div>
    </section>

    <!-- Berita Section -->
    <section id="berita" class="py-16 bg-white fade-left">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 flip-in animate-item">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Berita Terbaru</h2>
                <p class="text-lg text-gray-600">Informasi dan pengumuman terkini dari Kelurahan Lebak Denok</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($beritaTerbaru as $berita)
                <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow zoom-in animate-item">
                    @if($berita->gambar)
                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full h-48 object-cover">
                    @endif
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <span class="bg-primary-100 text-primary-600 px-3 py-1 rounded-full text-sm font-medium">
                                {{ ucfirst($berita->kategori) }}
                            </span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">{{ $berita->judul }}</h3>
                        <p class="text-gray-600 mb-4 line-clamp-3">{!! Str::limit(strip_tags($berita->konten), 120) !!}</p>
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-500">{{ $berita->created_at->format('d M Y') }}</div>
                            <a href="{{ route('berita.show', $berita->slug) }}" class="text-sm font-medium text-primary-600 hover:text-primary-700">Baca Selengkapnya</a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Lokasi Section -->
    <section id="lokasi" class="py-16 bg-white rotate-in">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 fade-up animate-item">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Lokasi Kami</h2>
                <p class="text-lg text-gray-600">Kantor Kelurahan Lebak Denok</p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="fade-left animate-item">
                    <div class="bg-gray-100 rounded-xl p-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Informasi Kontak</h3>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <svg class="w-6 h-6 text-primary-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <div>
                                    <p class="font-semibold text-gray-900">Alamat</p>
                                    <p class="text-gray-600">Jl. Raya Lebak Denok, Kelurahan Lebak Denok<br>Kota Cilegon, Banten</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <svg class="w-6 h-6 text-primary-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <div>
                                    <p class="font-semibold text-gray-900">Telepon</p>
                                    <p class="text-gray-600">(0254) 123-4567</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <svg class="w-6 h-6 text-primary-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <p class="font-semibold text-gray-900">Jam Operasional</p>
                                    <p class="text-gray-600">Senin - Jumat: 08:00 - 16:00</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="fade-right animate-item">
                    <div class="rounded-xl overflow-hidden shadow-lg">
                        <iframe 
                            src="https://www.google.com/maps?ll=-6.0325473,106.018487&q=Kelurahan+Lebak+Denok&z=17&output=embed"
                            width="100%" 
                            height="400" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                        <div class="bg-white p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="font-semibold text-gray-900">Kelurahan Lebak Denok</h4>
                                    <p class="text-sm text-gray-600">Kota Cilegon, Banten</p>
                                </div>
                                <a href="https://www.google.com/maps/place/Kelurahan+Lebak+Denok/@-6.0325473,106.018487,17z/data=!3m1!4b1!4m6!3m5!1s0x2e418e53677d2337:0x963db652a5a5bff8!8m2!3d-6.0325473!4d106.018487!16s%2Fg%2F11bc7nk__s?entry=ttu&g_ep=EgoyMDI1MDgyNS4wIKXMDSoASAFQAw%3D%3D" 
                                   target="_blank" 
                                   class="inline-flex items-center px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                    </svg>
                                    Buka di Maps
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="h-10 w-10">
                        <div>
                            <h3 class="text-xl font-bold">DIGIAPS</h3>
                            <p class="text-gray-400">Kelurahan Lebak Denok</p>
                        </div>
                    </div>
                    <p class="text-gray-400 mb-4">
                        Sistem Informasi Digital Administrasi Penduduk dan Statistik Kelurahan Lebak Denok, 
                        Kota Cilegon, Provinsi Banten.
                    </p>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Menu Utama</h4>
                    <ul class="space-y-2">
                        <li><a href="#beranda" class="text-gray-700 hover:text-primary-600 transition-colors">Beranda</a></li>
                        <li><a href="#penduduk" class="text-gray-700 hover:text-primary-600 transition-colors">Data Penduduk</a></li>
                        <li><a href="#galeri" class="text-gray-700 hover:text-primary-600 transition-colors">Galeri</a></li>
                        <li><a href="#berita" class="text-gray-700 hover:text-primary-600 transition-colors">Berita</a></li>
                        <li><a href="#kontak" class="text-gray-700 hover:text-primary-600 transition-colors">Kontak</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Layanan</h4>
                    <ul class="space-y-2">
                        <li><a href="/admin" class="text-gray-400 hover:text-white transition-colors">Admin Panel</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Surat Keterangan</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Data Statistik</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Pengaduan</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                <p class="text-gray-400">
                    &copy; {{ date('Y') }} DIGIAPS Kelurahan Lebak Denok. Semua hak dilindungi.
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Hero slider
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.slider-dot');
        let currentSlide = 0;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.toggle('active', i === index);
                slide.style.opacity = i === index ? '1' : '0';
            });
            
            dots.forEach((dot, i) => {
                dot.classList.toggle('bg-white', i === index);
                dot.classList.toggle('bg-white/50', i !== index);
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        // Auto slide
        if (slides.length > 1) {
            setInterval(nextSlide, 5000);
        }

        // Dot navigation
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                currentSlide = index;
                showSlide(currentSlide);
            });
        });

        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Population Chart with Animation
        let populationChart = null;
        let chartAnimated = false;
        
        function initChart() {
            const ctx = document.getElementById('populationChart');
            if (ctx) {
                const distribusiUsia = @json($distribusiUsia);
                const total = {{ $totalPenduduk ?? 0 }};
                
                const ageData = [
                    distribusiUsia.anak,
                    distribusiUsia.dewasa_muda,
                    distribusiUsia.dewasa,
                    distribusiUsia.lansia_awal,
                    distribusiUsia.lansia
                ];
                
                const hasData = ageData.some(value => value > 0);
                
                if (total > 0 && hasData) {
                    populationChart = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: ['Anak (0-17)', 'Dewasa Muda (18-30)', 'Dewasa (31-50)', 'Pra Lansia (51-65)', 'Lansia (65+)'],
                            datasets: [{
                                data: [0, 0, 0, 0, 0], // Start with zeros
                                backgroundColor: [
                                    '#10B981',
                                    '#3B82F6',
                                    '#8B5CF6',
                                    '#F59E0B',
                                    '#EF4444'
                                ],
                                borderWidth: 2,
                                borderColor: '#ffffff',
                                hoverOffset: 15
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    backgroundColor: 'rgba(0,0,0,0.8)',
                                    titleColor: '#fff',
                                    bodyColor: '#fff',
                                    callbacks: {
                                        label: function(context) {
                                            const value = context.parsed;
                                            const percentage = ((value / total) * 100).toFixed(1);
                                            return context.label + ': ' + value.toLocaleString() + ' (' + percentage + '%)';
                                        }
                                    }
                                }
                            },
                            animation: {
                                animateRotate: true,
                                animateScale: true,
                                duration: 2000,
                                easing: 'easeOutQuart'
                            },
                            cutout: '60%',
                            elements: {
                                arc: {
                                    borderWidth: 2
                                }
                            }
                        }
                    });
                    
                    // Store original data for animation
                    populationChart.originalData = ageData;
                } else {
                    ctx.width = 400;
                    ctx.height = 400;
                    const context = ctx.getContext('2d');
                    context.clearRect(0, 0, ctx.width, ctx.height);
                    context.font = '18px Inter, Arial, sans-serif';
                    context.textAlign = 'center';
                    context.fillStyle = '#9CA3AF';
                    context.fillText('Belum ada data penduduk', ctx.width/2, ctx.height/2);
                }
            }
        }
        
        function animateChart() {
            if (populationChart && !chartAnimated && populationChart.originalData) {
                chartAnimated = true;
                
                // Animate chart data
                populationChart.data.datasets[0].data = populationChart.originalData;
                populationChart.update('active');
                
                // Animate counters
                animateCounters();
            }
        }
        
        function resetChart() {
            if (populationChart && populationChart.originalData) {
                chartAnimated = false;
                populationChart.data.datasets[0].data = [0, 0, 0, 0, 0];
                populationChart.update('none');
                
                // Reset counters
                resetCounters();
            }
        }
        
        function animateCounters() {
            const counters = document.querySelectorAll('.counter');
            const counterPercents = document.querySelectorAll('.counter-percent');
            
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                animateValue(counter, 0, target, 2000);
            });
            
            counterPercents.forEach(counter => {
                const target = parseFloat(counter.getAttribute('data-target'));
                animateValuePercent(counter, 0, target, 2000);
            });
        }
        
        function resetCounters() {
            const counters = document.querySelectorAll('.counter');
            const counterPercents = document.querySelectorAll('.counter-percent');
            
            counters.forEach(counter => {
                counter.textContent = '0';
            });
            
            counterPercents.forEach(counter => {
                counter.textContent = '0%';
            });
        }
        
        function animateValue(element, start, end, duration) {
            const startTime = performance.now();
            
            function update(currentTime) {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);
                
                const easeOutQuart = 1 - Math.pow(1 - progress, 4);
                const current = Math.floor(start + (end - start) * easeOutQuart);
                
                element.textContent = current.toLocaleString();
                
                if (progress < 1) {
                    requestAnimationFrame(update);
                }
            }
            
            requestAnimationFrame(update);
        }
        
        function animateValuePercent(element, start, end, duration) {
            const startTime = performance.now();
            
            function update(currentTime) {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);
                
                const easeOutQuart = 1 - Math.pow(1 - progress, 4);
                const current = start + (end - start) * easeOutQuart;
                
                element.textContent = current.toFixed(1) + '%';
                
                if (progress < 1) {
                    requestAnimationFrame(update);
                }
            }
            
            requestAnimationFrame(update);
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            initChart();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('nav a[href^="#"]');
            
            // Continuous Scroll Animation Observer
            const observerOptions = {
                threshold: 0.15,
                rootMargin: '0px 0px -100px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-in');
                        
                        // Animate child items with delay
                        const animateItems = entry.target.querySelectorAll('.animate-item');
                        animateItems.forEach((item, index) => {
                            setTimeout(() => {
                                item.classList.add('animate-in');
                            }, index * 150);
                        });
                        
                        // Trigger chart animation for penduduk section
                        if (entry.target.id === 'penduduk') {
                            setTimeout(() => {
                                animateChart();
                            }, 500);
                        }
                    } else {
                        // Reset animation when element goes out of view
                        entry.target.classList.remove('animate-in');
                        const animateItems = entry.target.querySelectorAll('.animate-item');
                        animateItems.forEach(item => {
                            item.classList.remove('animate-in');
                        });
                        
                        // Reset chart animation for penduduk section
                        if (entry.target.id === 'penduduk') {
                            resetChart();
                        }
                    }
                });
            }, observerOptions);

            // Observe all animated sections and items
            document.querySelectorAll('.fade-up, .fade-left, .fade-right, .zoom-in, .rotate-in, .flip-in').forEach(element => {
                observer.observe(element);
            });
            
            function updateActiveNav() {
                let current = '';
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.clientHeight;
                    if (window.pageYOffset >= sectionTop - 200) {
                        current = section.getAttribute('id');
                    }
                });

                navLinks.forEach(link => {
                    const href = link.getAttribute('href').substring(1);
                    link.classList.remove('text-gray-900');
                    link.classList.add('text-gray-600');
                    
                    const underline = link.querySelector('div');
                    if (underline) {
                        if (href === current) {
                            underline.classList.remove('scale-x-0');
                            underline.classList.add('scale-x-100');
                            link.classList.remove('text-gray-600');
                            link.classList.add('text-gray-900');
                        } else {
                            underline.classList.remove('scale-x-100');
                            underline.classList.add('scale-x-0');
                        }
                    }
                });
            }

            window.addEventListener('scroll', updateActiveNav);
            updateActiveNav();

            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href').substring(1);
                    const targetSection = document.getElementById(targetId);
                    if (targetSection) {
                        targetSection.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>

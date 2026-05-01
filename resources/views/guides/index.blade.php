<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Browse Guides</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 text-slate-800 pt-20" style="background-image: url('{{ asset('wallpaperflare.com_wallpaper.jpg') }}'); background-size: cover; background-position: center; background-attachment: fixed;">

    <!-- Navbar -->
    <header class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 w-[95%] md:w-[90%] rounded-3xl backdrop-blur-xl bg-white/30 border border-white/20 shadow-2xl">
        <div class="container mx-auto flex justify-between items-center px-6 py-3 relative z-10">
            
            <div class="absolute inset-0 rounded-3xl bg-gradient-to-r from-blue-400 via-cyan-300 to-blue-500 opacity-20 blur-3xl pointer-events-none"></div>

            <h1 class="relative text-2xl font-extrabold text-blue-600">
                Travel<span class="text-gray-800">Navigator</span>
            </h1>

            <nav class="hidden md:flex items-center space-x-8 text-gray-700">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('destinations.index') }}">Destinations</a>
                <a href="{{ route('guides.index') }}">Guides</a>
                <a href="{{ route('blogs.index') }}">Blogs</a>
                <a href="#contact">Contact</a>
                <a href="/guide/login" class="text-blue-600 font-semibold">Guide Portal</a>
				
				
            </nav>



            <!-- ✅ Only Get Started Button remains -->
            <div class="hidden md:flex space-x-4">
                <a href="{{ route('guides.index') }}" class="px-5 py-2 text-white bg-blue-600 rounded-full shadow-lg hover:bg-blue-700 transition transform hover:-translate-y-1 hover:scale-105">
                    Get Started
                </a>
                <a href="{{ route('guides.apply') }}" class="px-5 py-2 text-blue-600 bg-white rounded-full shadow-lg hover:bg-gray-50 transition transform hover:-translate-y-1 hover:scale-105">
                    Become a Guide
                </a>
            </div>

            <button class="md:hidden text-2xl">☰</button>
        </div>
    </header>

    <div class="max-w-7xl mx-auto p-4">
        <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-4xl font-bold">Browse Local Tour Guides</h1>
                <p class="mt-2 text-slate-600">Find approved guides for your destination and book a local expert.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('guides.apply') }}" class="inline-flex items-center px-5 py-3 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition">Become a Guide</a>
                <a href="/guide/login" class="inline-flex items-center px-5 py-3 bg-green-600 text-white rounded-full hover:bg-green-700 transition">Guide Login</a>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-4 rounded-3xl bg-emerald-50 border border-emerald-200 p-4 text-emerald-800">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid gap-4 md:grid-cols-[240px_1fr]">
            <aside class="bg-white/40 backdrop-blur-[32px] rounded-3xl p-6 shadow-2xl border border-white/30">
                <h2 class="text-lg font-semibold mb-4">Filter by destination</h2>
                <form action="{{ route('guides.index') }}" method="get" class="space-y-4">
                    <select name="destination_id" class="w-full rounded-xl border border-slate-300 px-4 py-3" onchange="this.form.submit()">
                        <option value="">All destinations</option>
                        @foreach($destinations as $destination)
                            <option value="{{ $destination->id }}" {{ $destinationId == $destination->id ? 'selected' : '' }}>{{ $destination->name }}</option>
                        @endforeach
                    </select>
                </form>
            </aside>

            <main class="space-y-6">
                @if($guides->isEmpty())
                    <div class="bg-white/40 backdrop-blur-[32px] rounded-3xl shadow-2xl border border-white/30 p-8 text-center">
                        <h2 class="text-2xl font-semibold">No guides found</h2>
                        <p class="mt-2 text-slate-600">Try a different destination or apply to join as a guide.</p>
                    </div>
                @else
                    <div class="grid gap-6">
                        @foreach($guides as $guide)
                            <article class="bg-white/40 backdrop-blur-[32px] rounded-3xl overflow-hidden shadow-2xl border border-white/30 flex flex-col md:flex-row gap-6">
                                <div class="h-72 md:h-auto md:w-72 overflow-hidden">
                                    <img src="{{ $guide->photo ? asset($guide->photo) : 'https://via.placeholder.com/500x500?text=Guide' }}" alt="{{ $guide->name }}" class="w-full h-full object-cover">
                                </div>
                                <div class="p-6 flex-1 flex flex-col justify-between gap-4">
                                    <div>
                                        <h3 class="text-2xl font-semibold">{{ $guide->name }}</h3>
                                        <p class="mt-2 text-slate-600">{{ $guide->specialization }}</p>
                                        <p class="text-sm text-slate-500 mt-3"><strong>Languages:</strong> {{ $guide->languages }}</p>
                                        <p class="text-sm text-slate-500"><strong>Experience:</strong> {{ $guide->experience_years }} years</p>
                                        @if($guide->destination)
                                            <p class="text-sm text-slate-500"><strong>Destination:</strong> {{ $guide->destination->name }}</p>
                                        @endif
                                    </div>

                                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                        <div>
                                            <span class="text-xl font-bold text-slate-900">৳ {{ number_format($guide->price_per_day, 2) }}</span>
                                            <span class="text-sm text-slate-500">/ day</span>
                                        </div>
                                        <a href="{{ route('guides.show', $guide->id) }}" class="inline-flex items-center justify-center px-5 py-3 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition">View Profile</a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </main>
        </div>
    </div>
</body>
</html>

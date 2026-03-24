<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $destination->name }} - Cox’s Bazar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-200 via-sky-100 to-blue-50 font-sans">

<div class="max-w-5xl mx-auto p-4">

    <!-- Breadcrumb -->
    <nav class="text-sm text-gray-500 mb-4">
        <a href="{{ route('destinations.index') }}" class="hover:text-blue-600 transition">Home</a>
        <span class="mx-2">/</span>
        <span class="text-gray-700 font-medium">{{ $destination->name }}</span>
    </nav>

    <!-- Main Card -->
    <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-xl overflow-hidden border border-gray-200">

        <!-- Hero Image -->
        <div class="relative">
            <img src="{{ $destination->image ?? 'https://via.placeholder.com/800x300?text=No+Image' }}"
                 alt="{{ $destination->name }}"
                 class="w-full h-96 md:h-[400px] object-cover">

            <!-- Category Badge -->
            <span class="absolute top-5 left-5 bg-blue-600 text-white text-xs md:text-sm px-4 py-2 rounded-full shadow-lg">
                {{ $destination->category }}
            </span>
        </div>

        <div class="p-6 space-y-6">

            <!-- Title -->
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 drop-shadow-md">
                {{ $destination->name }}
            </h1>

            <!-- Description -->
            <div>
                <h2 class="text-lg font-semibold text-gray-700 mb-2">About</h2>
                @if($destination->description)
                    <p class="text-gray-600 leading-relaxed text-md md:text-lg">
                        {{ $destination->description }}
                    </p>
                @else
                    <p class="text-gray-400 italic">No description available.</p>
                @endif
            </div>

            <!-- Info Grid -->
            <div class="grid md:grid-cols-2 gap-4">
                <div class="bg-blue-50 p-4 rounded-xl shadow-inner">
                    <h3 class="font-semibold text-gray-700 mb-1">🎯 Attractions</h3>
                    @if($destination->attractions)
                        <p class="text-gray-600 text-sm">{{ $destination->attractions }}</p>
                    @else
                        <p class="text-gray-400 text-sm italic">No attractions listed.</p>
                    @endif
                </div>
                <div class="bg-blue-50 p-4 rounded-xl shadow-inner">
                    <h3 class="font-semibold text-gray-700 mb-1">📅 Best Time to Visit</h3>
                    @if($destination->best_time)
                        <p class="text-gray-600 text-sm">{{ $destination->best_time }}</p>
                    @else
                        <p class="text-gray-400 text-sm italic">Not specified.</p>
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap gap-4 mt-2">
                <a href="{{ route('destinations.index') }}"
                   class="px-5 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-full font-semibold transition flex items-center gap-2">
                   ← Back
                </a>
                <a href="{{ route('destinations.index') }}?query={{ urlencode($destination->category) }}"
                   target="_blank"
                   class="px-5 py-3 bg-gradient-to-r from-blue-500 to-sky-400 text-white rounded-full font-semibold hover:from-blue-600 hover:to-sky-500 transition flex items-center gap-2">
                   Explore Similar ↗
                </a>
            </div>

        </div>
    </div>

    <!-- Related Destinations -->
    @if(isset($related) && $related->count())
        <div class="mt-10">
            <h2 class="text-2xl font-bold text-gray-800 mb-5">You may also like</h2>
            <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach($related as $item)
                    <a href="/destinations/{{ $item->id }}"
                       class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:scale-105 transition duration-300">

                        <div class="relative h-44 md:h-48">
                            <img src="{{ $item->image ?? 'https://via.placeholder.com/300' }}"
                                 class="w-full h-full object-cover">
                        </div>

                        <div class="p-4">
                            <h3 class="font-semibold text-gray-800 text-md">{{ $item->name }}</h3>
                            <p class="text-xs text-gray-500">{{ $item->category }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

</div>
</body>
</html>
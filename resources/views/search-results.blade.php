<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Available Rooms</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="container mx-auto mt-10">

    <h1 class="text-2xl font-bold mb-6">Available Rooms</h1>

    @if($rooms->isEmpty())
        <p class="text-gray-500">No rooms found.</p>
    @else

    <div class="grid md:grid-cols-3 gap-6">

        @foreach($rooms as $room)
        <div class="bg-white rounded-xl shadow p-4">

            @if($room->image)
                <img src="{{ asset('storage/' . $room->image) }}"
                     class="w-full h-40 object-cover rounded mb-3">
            @endif

            <h2 class="text-lg font-semibold">{{ $room->name }}</h2>

            <p class="text-teal-600 font-bold">
                ৳ {{ number_format($room->price) }}
            </p>

            <p class="text-sm text-gray-500 mt-2">
                {{ \Illuminate\Support\Str::limit($room->description, 80) }}
            </p>

            <a href="/rooms/{{ $room->id }}"
               class="block mt-4 text-center bg-teal-500 text-white py-2 rounded hover:bg-teal-600">
                View Details
            </a>

        </div>
        @endforeach

    </div>

    @endif

</div>

</body>
</html>
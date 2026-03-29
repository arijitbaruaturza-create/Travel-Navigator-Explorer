<!-- resources/views/home.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Navigator Explorer - Cox's Bazar</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Header / Navbar -->
    <header class="bg-blue-600 text-white">
        <div class="container mx-auto flex justify-between items-center p-4">
            <h1 class="text-2xl font-bold">Travel Navigator Explorer</h1>
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="#" class="hover:underline">Home</a></li>
                    <li><a href="#destinations" class="hover:underline">Destinations</a></li>
                    <li><a href="#guides" class="hover:underline">Tour Guides</a></li>
                    <li><a href="#blogs" class="hover:underline">Blogs</a></li>
                    <li><a href="#contact" class="hover:underline">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>
	<div class="text-center my-6">
        <a href="{{ route('rooms.index') }}"
           class="bg-blue-600 text-white px-5 py-2 rounded-lg shadow hover:bg-blue-700 transition">
            Manager
        </a>
    </div>
    <!-- Hero Section -->
    <section class="relative bg-cover bg-center h-[80vh]" style="background-image: url('https://upload.wikimedia.org/wikipedia/commons/7/7d/Cox%27s_Bazar_Beach.jpg');">
        <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col justify-center items-center text-center text-white p-4">
            <h2 class="text-4xl md:text-6xl font-bold mb-4">Explore Cox's Bazar</h2>
            <p class="text-lg md:text-2xl mb-6">Plan your perfect beach getaway in Bangladesh</p>
            <a href="{{ route('destinations.index') }}"
                class="bg-yellow-400 text-gray-900 px-6 py-3 font-semibold rounded shadow hover:bg-yellow-500 transition">
                Discover Destinations
            </a>
        </div>
    </section>

    <!-- Search Bar -->
    <section class="py-10 bg-gray-100">
        <div class="container mx-auto flex justify-center">
            <div class="w-full md:w-2/3">
                <input type="text" placeholder="Search destinations, hotels, guides..." class="w-full p-4 rounded shadow focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>
    </section>

    <!-- Destinations Section -->
    <section id="destinations" class="py-12 container mx-auto">
        <h3 class="text-3xl font-bold text-center mb-8">Top Destinations in Cox's Bazar</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Destination Card Example -->
            <div class="bg-white rounded shadow hover:shadow-lg transition overflow-hidden">
                <img src="https://upload.wikimedia.org/wikipedia/commons/f/fc/Inani_Beach%2C_Cox%27s_Bazar_2.jpg" alt="Inani Beach" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h4 class="font-bold text-xl mb-2">Inani Beach</h4>
                    <p class="text-gray-600 mb-2">Famous for its coral stones and serene views, perfect for photography and relaxation.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-yellow-500 font-semibold">⭐⭐⭐⭐☆</span>
                        <a href="#" class="text-blue-600 hover:underline">Explore</a>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded shadow hover:shadow-lg transition overflow-hidden">
                <img src="https://upload.wikimedia.org/wikipedia/commons/3/36/Himchari_National_Park%2C_Cox%27s_Bazar.jpg" alt="Himchari" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h4 class="font-bold text-xl mb-2">Himchari National Park</h4>
                    <p class="text-gray-600 mb-2">Experience waterfalls, hills, and a rich variety of wildlife in this lush park.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-yellow-500 font-semibold">⭐⭐⭐⭐☆</span>
                        <a href="#" class="text-blue-600 hover:underline">Explore</a>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded shadow hover:shadow-lg transition overflow-hidden">
                <img src="https://upload.wikimedia.org/wikipedia/commons/d/d3/Sea_beach%2C_Cox%27s_Bazar.JPG" alt="Sea Beach" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h4 class="font-bold text-xl mb-2">Cox's Bazar Sea Beach</h4>
                    <p class="text-gray-600 mb-2">The longest natural sandy beach in the world, perfect for a sunset stroll.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-yellow-500 font-semibold">⭐⭐⭐⭐⭐</span>
                        <a href="#" class="text-blue-600 hover:underline">Explore</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tour Guides Section -->
    <section id="guides" class="py-12 bg-gray-50">
        <h3 class="text-3xl font-bold text-center mb-8">Hire Local Tour Guides</h3>
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Guide Card Example -->
            <div class="bg-white rounded shadow hover:shadow-lg transition overflow-hidden p-4 text-center">
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Guide" class="w-32 h-32 rounded-full mx-auto mb-4">
                <h4 class="font-bold text-xl mb-2">Rahim Uddin</h4>
                <p class="text-gray-600 mb-2">5 Years Experience | Adventure Tours</p>
                <p class="text-gray-800 font-semibold mb-2">৳ 1500/day</p>
                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Hire Guide</button>
            </div>
            <div class="bg-white rounded shadow hover:shadow-lg transition overflow-hidden p-4 text-center">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Guide" class="w-32 h-32 rounded-full mx-auto mb-4">
                <h4 class="font-bold text-xl mb-2">Fatima Begum</h4>
                <p class="text-gray-600 mb-2">7 Years Experience | Historical Tours</p>
                <p class="text-gray-800 font-semibold mb-2">৳ 2000/day</p>
                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Hire Guide</button>
            </div>
            <div class="bg-white rounded shadow hover:shadow-lg transition overflow-hidden p-4 text-center">
                <img src="https://randomuser.me/api/portraits/men/55.jpg" alt="Guide" class="w-32 h-32 rounded-full mx-auto mb-4">
                <h4 class="font-bold text-xl mb-2">Jahid Hasan</h4>
                <p class="text-gray-600 mb-2">3 Years Experience | City & Beach Tours</p>
                <p class="text-gray-800 font-semibold mb-2">৳ 1200/day</p>
                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Hire Guide</button>
            </div>
        </div>
    </section>

    <!-- Blogs Section -->
    <section id="blogs" class="py-12 container mx-auto">
        <h3 class="text-3xl font-bold text-center mb-8">Travel Blogs & Tips</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded shadow hover:shadow-lg transition overflow-hidden p-4">
                <h4 class="font-bold text-xl mb-2">Top 5 Beaches in Bangladesh</h4>
                <p class="text-gray-600 mb-2">Discover the most beautiful beaches to visit besides Cox's Bazar.</p>
                <a href="#" class="text-blue-600 hover:underline">Read More</a>
            </div>
            <div class="bg-white rounded shadow hover:shadow-lg transition overflow-hidden p-4">
                <h4 class="font-bold text-xl mb-2">Budget Travel Guide</h4>
                <p class="text-gray-600 mb-2">Plan your trip efficiently without breaking the bank.</p>
                <a href="#" class="text-blue-600 hover:underline">Read More</a>
            </div>
            <div class="bg-white rounded shadow hover:shadow-lg transition overflow-hidden p-4">
                <h4 class="font-bold text-xl mb-2">Hidden Gems of Cox's Bazar</h4>
                <p class="text-gray-600 mb-2">Explore less-known attractions and secret spots for an unforgettable experience.</p>
                <a href="#" class="text-blue-600 hover:underline">Read More</a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-12 bg-gray-50">
        <div class="container mx-auto max-w-2xl">
            <h3 class="text-3xl font-bold text-center mb-6">Get in Touch</h3>
            <form class="bg-white p-6 rounded shadow-md space-y-4">
                <div>
                    <label for="name" class="block mb-1 font-semibold">Name</label>
                    <input type="text" id="name" class="w-full p-3 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="email" class="block mb-1 font-semibold">Email</label>
                    <input type="email" id="email" class="w-full p-3 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="message" class="block mb-1 font-semibold">Message</label>
                    <textarea id="message" rows="5" class="w-full p-3 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700 transition">Send Message</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-blue-600 text-white py-6 mt-12">
        <div class="container mx-auto text-center">
            <p>&copy; {{ date('Y') }} Travel Navigator Explorer. All rights reserved.</p>
            <p>Cox's Bazar, Bangladesh</p>
        </div>
    </footer>

</body>
</html>
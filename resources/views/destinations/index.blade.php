<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cox’s Bazar Tourism Spots</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-blue-500 via-sky-400 to-blue-300 min-h-screen font-sans flex items-center justify-center"
      style="background-image: url('https://i.pinimg.com/1200x/70/73/27/707327c07ff1a9666bb6eaa8b1cc279b.jpg'); 
             background-size: cover; 
             background-position: center; 
             background-attachment: fixed;">
             
<div class="w-full max-w-lg">
    <!-- Title -->
    <h1 class="text-4xl font-bold text-white text-center mb-6 drop-shadow-lg">
        🌴 Explore Cox’s Bazar
    </h1>
    <!-- Search Box -->
    <div class="relative backdrop-blur-lg bg-white/80 p-4 rounded-xl shadow-xl">

        <!-- Input -->
        <div class="relative">
            <span class="absolute left-3 top-3 text-gray-400">🔍</span>

            <input type="text" id="searchQuery"
                placeholder="Search beaches, islands, places..."
                class="w-full pl-10 pr-10 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:outline-none">

            <!-- Clear Button -->
            <button id="clearBtn"
                class="absolute right-3 top-3 text-gray-400 hidden hover:text-red-500">
                ✕
            </button>
        </div>

        <!-- Loading -->
        <div id="loading" class="text-center text-sm text-gray-500 mt-2 hidden">
            🔄 Searching...
        </div>

        <!-- Results -->
        <div id="results"
            class="absolute left-0 right-0 bg-white mt-3 rounded-xl shadow-xl max-h-96 overflow-y-auto hidden z-50 animate-fadeIn">
        </div>
    </div>
</div>

<style>
@keyframes fadeIn {
    from {opacity: 0; transform: translateY(10px);}
    to {opacity: 1; transform: translateY(0);}
}
.animate-fadeIn {
    animation: fadeIn 0.2s ease-in-out;
}
</style>

<script>
const searchInput = document.getElementById('searchQuery');
const resultsDiv = document.getElementById('results');
const loading = document.getElementById('loading');
const clearBtn = document.getElementById('clearBtn');

let activeIndex = -1;
let currentResults = [];
let debounceTimer;

// Auto search from URL
window.onload = function() {
    const params = new URLSearchParams(window.location.search);
    const query = params.get('query');

    if (query) {
        searchInput.value = query;
        searchInput.focus();
        setTimeout(() => search(query), 300);
    }
};

// Highlight
function highlight(text, query) {
    const regex = new RegExp(`(${query})`, 'gi');
    return text.replace(regex, '<span class="bg-yellow-200 px-1 rounded">$1</span>');
}

// Truncate
function truncate(text, maxLength = 100) {
    return text?.length > maxLength ? text.substring(0, maxLength) + '...' : text;
}

// Render
function renderResults(data, query) {
    currentResults = data;
    activeIndex = -1;

    resultsDiv.classList.remove('hidden');

    if (data.length === 0) {
        resultsDiv.innerHTML = `
            <div class="p-6 text-center text-gray-500">
                😕 No destinations found
            </div>`;
        return;
    }

    resultsDiv.innerHTML = data.map((d, i) => `
        <div data-id="${d.id}" 
            class="flex items-start gap-3 p-3 hover:bg-blue-50 cursor-pointer transition rounded-lg">

            <img src="${d.image ?? 'https://via.placeholder.com/60'}"
                class="w-14 h-14 rounded-lg object-cover shadow">

            <div>
                <p class="font-semibold text-gray-800">${highlight(d.name, query)}</p>
                <p class="text-xs text-blue-500 font-medium">${highlight(d.category, query)}</p>
                <p class="text-sm text-gray-600">${highlight(truncate(d.description), query)}</p>
            </div>
        </div>
    `).join('');

    resultsDiv.querySelectorAll('div[data-id]').forEach((el, i) => {
        el.addEventListener('click', () => {
            window.location.href = `/destinations/${data[i].id}`;
        });
    });
}

// Search
function search(query) {
    if (!query.trim()) {
        resultsDiv.classList.add('hidden');
        loading.classList.add('hidden');
        clearBtn.classList.add('hidden');
        return;
    }

    loading.classList.remove('hidden');
    clearBtn.classList.remove('hidden');

    fetch(`{{ route("destinations.search") }}?query=${encodeURIComponent(query)}`)
        .then(res => res.json())
        .then(data => {
            loading.classList.add('hidden');
            renderResults(data, query);
        });
}

// Debounce
searchInput.addEventListener('input', () => {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(() => {
        search(searchInput.value);
    }, 300);
});

// Clear
clearBtn.addEventListener('click', () => {
    searchInput.value = '';
    resultsDiv.classList.add('hidden');
    clearBtn.classList.add('hidden');
});

// Keyboard nav
searchInput.addEventListener('keydown', (e) => {
    const items = resultsDiv.querySelectorAll('div[data-id]');
    if (!items.length) return;

    if (e.key === 'ArrowDown') {
        e.preventDefault();
        activeIndex = Math.min(activeIndex + 1, items.length - 1);
    }

    if (e.key === 'ArrowUp') {
        e.preventDefault();
        activeIndex = Math.max(activeIndex - 1, 0);
    }

    if (e.key === 'Enter' && activeIndex >= 0) {
        window.location.href = `/destinations/${currentResults[activeIndex].id}`;
    }

    items.forEach((el, i) => {
        el.classList.toggle('bg-blue-100', i === activeIndex);
    });
});

// Close dropdown
document.addEventListener('click', (e) => {
    if (!e.target.closest('.relative')) {
        resultsDiv.classList.add('hidden');
    }
});
</script>

</body>
</html>
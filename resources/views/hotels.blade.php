<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotels</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --ink:       #1a1a18;
            --cream:     #f7f4ef;
            --warm:      #ede8df;
            --accent:    #c8753a;
            --accent-lt: #f0e0d0;
            --muted:     #7a7671;
            --white:     #ffffff;
            --radius:    12px;
            --shadow:    0 4px 24px rgba(26,26,24,.08);
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--ink);
            min-height: 100vh;
        }

        /* ── HERO ── */
        .hero {
            position: relative; height: 240px;
            background: var(--ink); overflow: hidden;
        }
        .hero::before {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(135deg, #2a2420 0%, #3d2e1e 50%, #1a1a18 100%);
            opacity: .9;
        }
        .hero::after {
            content: '🏨'; position: absolute;
            font-size: 18rem; opacity: .04;
            right: -40px; bottom: -40px; line-height: 1;
        }
        .hero-content {
            position: relative; z-index: 1; height: 100%;
            display: flex; flex-direction: column;
            justify-content: center; padding: 0 56px;
        }
        .hero-tag {
            font-size: .72rem; font-weight: 500;
            letter-spacing: 3px; text-transform: uppercase;
            color: var(--accent-lt); margin-bottom: 12px;
        }
        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.8rem, 3.5vw, 2.6rem);
            color: var(--white); line-height: 1.2; margin-bottom: 12px;
        }
        .hero p { font-size: .93rem; color: rgba(255,255,255,.6); }

        /* ── MAIN ── */
        .main {
            max-width: 900px;
            margin: 0 auto;
            padding: 56px 40px 80px;
            display: flex; flex-direction: column; gap: 28px;
        }

        /* ── CARD ── */
        .card {
            background: var(--white);
            border: 1px solid var(--warm);
            border-radius: var(--radius);
            padding: 36px;
            box-shadow: var(--shadow);
        }
        .card h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem; margin-bottom: 8px;
        }
        .card .subtitle {
            font-size: .88rem; color: var(--muted);
            margin-bottom: 28px; padding-bottom: 20px;
            border-bottom: 1px solid var(--warm);
        }

        /* ── FORM ── */
        .form-group {
            display: flex; flex-direction: column; gap: 6px;
            margin-bottom: 18px;
        }
        .form-group label {
            font-size: .82rem; font-weight: 500;
            color: var(--muted); letter-spacing: .3px;
        }
        .form-group input,
        .form-group select {
            font-family: 'DM Sans', sans-serif;
            font-size: .93rem;
            padding: 12px 14px;
            border: 1.5px solid var(--warm);
            border-radius: 8px;
            background: var(--cream);
            color: var(--ink);
            outline: none;
            width: 100%;
            appearance: none;
            transition: border-color .18s, background .18s;
        }
        .form-group input:focus,
        .form-group select:focus {
            border-color: var(--accent);
            background: var(--white);
        }
        .select-wrapper { position: relative; }
        .select-wrapper::after {
            content: '▾'; position: absolute;
            right: 14px; top: 50%;
            transform: translateY(-50%);
            color: var(--muted); pointer-events: none;
        }
        .form-row {
            display: grid; grid-template-columns: 1fr 1fr; gap: 16px;
        }
        .submit-btn {
            width: 100%; padding: 13px;
            background: var(--ink); color: var(--white);
            border: none; border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: .95rem; font-weight: 500;
            cursor: pointer; margin-top: 4px;
            transition: background .18s;
        }
        .submit-btn:hover { background: var(--accent); }

        /* ── MAP ── */
        .map-card {
            background: var(--white);
            border: 1px solid var(--warm);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
        }
        .map-header {
            padding: 20px 28px;
            border-bottom: 1px solid var(--warm);
        }
        .map-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
        }
        #map { width: 100%; height: 420px; display: block; }

        /* ── SECTION TITLE ── */
        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem; color: var(--muted);
            padding-bottom: 12px;
            border-bottom: 1px solid var(--warm);
        }

        /* ── HOTEL CARD ── */
        .hotel-card {
            background: var(--white);
            border: 1px solid var(--warm);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            display: flex;
            min-height: 200px;
        }
        .hotel-card img {
            width: 320px;
            min-height: 200px;
            object-fit: cover;
            flex-shrink: 0;
            display: block;
        }
        .hotel-body {
            padding: 24px 28px; flex: 1;
            display: flex; flex-direction: column; justify-content: center;
            gap: 8px;
        }
        .hotel-body h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
        }
        .hotel-body p {
            font-size: .88rem; color: #666; line-height: 1.5;
        }
        .hotel-meta { font-size: .78rem; color: var(--muted); }

        /* ── DELETE BUTTON ── */
        .btn-delete {
            display: inline-block;
            margin-top: 10px;
            padding: 7px 16px;
            background: #fdecea;
            color: #b91c1c;
            border: none;
            border-radius: 6px;
            font-family: 'DM Sans', sans-serif;
            font-size: .82rem;
            font-weight: 500;
            cursor: pointer;
            transition: background .18s;
            width: auto;
        }
        .btn-delete:hover { background: #fca5a5; }

        @media (max-width: 600px) {
            .hero-content { padding: 0 24px; }
            .main { padding: 40px 20px 60px; }
            .card { padding: 24px 18px; }
            .form-row { grid-template-columns: 1fr; }
            .hotel-card { flex-direction: column; }
            .hotel-card img { width: 100%; min-height: unset; height: 220px; }
        }
    </style>
</head>
<body>

<!-- HERO -->
<div class="hero">
    <div class="hero-content">
        <span class="hero-tag">Management</span>
        <h1>Hotels</h1>
        <p>Add and manage hotel listings with live map.</p>
    </div>
</div>

<div class="main">

    <!-- ADD HOTEL FORM -->
    <div class="card">
        <h2>Add a New Hotel</h2>
        <p class="subtitle">Fill in the details to create a new hotel listing.</p>

        <form method="POST" action="/hotels">
            @csrf

            <div class="form-group">
                <label>Hotel Name</label>
                <input name="name" placeholder="e.g. Sea Pearl Beach Resort" required>
            </div>

            <div class="form-group">
                <label>Description</label>
                <input name="description" placeholder="Brief description..." required>
            </div>

            <div class="form-group">
                <label>Map Location</label>
                <input name="map_location" placeholder="e.g. Cox's Bazar, Bangladesh" required>
            </div>

            <div class="form-group">
                <label>Image URL</label>
                <input name="image" placeholder="https://...">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Latitude</label>
                    <input name="latitude" placeholder="e.g. 21.4272" required>
                </div>
                <div class="form-group">
                    <label>Longitude</label>
                    <input name="longitude" placeholder="e.g. 92.0058" required>
                </div>
            </div>

            <div class="form-group">
                <label>Destination</label>
                <div class="select-wrapper">
                    <select name="destination_id" required>
                        <option value="">Select a destination...</option>
                        @foreach($destinations as $d)
                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit" class="submit-btn">Add Hotel →</button>
        </form>
    </div>

    <!-- MAP -->
    <div class="map-card">
        <div class="map-header">
            <h2>All Hotels Map</h2>
        </div>
        <div id="map"></div>
    </div>

    <!-- HOTEL LIST -->
    @if($hotels->count())
        <p class="section-title">{{ $hotels->count() }} Hotel{{ $hotels->count() > 1 ? 's' : '' }} Listed</p>

        @foreach($hotels as $hotel)
            <div class="hotel-card">
                @if($hotel->image)
                    <img src="{{ $hotel->image }}" alt="{{ $hotel->name }}">
                @endif

                <div class="hotel-body">
                    <h3>{{ $hotel->name }}</h3>
                    <p>{{ $hotel->description }}</p>
                    <span class="hotel-meta">📍 {{ $hotel->map_location }} &nbsp;|&nbsp; {{ $hotel->latitude }}, {{ $hotel->longitude }}</span>

                    <form method="POST" action="/hotels/{{ $hotel->id }}"
                          onsubmit="return confirm('Delete this hotel?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">🗑 Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif

</div>

<!-- LEAFLET JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    const map = L.map('map').setView([23.6850, 90.3563], 7);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    const hotels = @json($hotels);

    hotels.forEach(h => {
        const lat = parseFloat(h.latitude);
        const lng = parseFloat(h.longitude);
        if (!isNaN(lat) && !isNaN(lng)) {
            L.marker([lat, lng])
                .addTo(map)
                .bindPopup(`<b>${h.name}</b><br>${h.description}`);
        }
    });

    setTimeout(() => map.invalidateSize(), 300);
</script>

</body>
</html>
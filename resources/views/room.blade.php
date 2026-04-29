<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $room->name }} — Hotel</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
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

        /* ── HERO IMAGE ── */
        .hero-img {
            width: 100%;
            height: 520px;
            overflow: hidden;
            background: var(--ink);
            position: relative;
        }
        .hero-img img {
            width: 100%; height: 100%;
            object-fit: cover; display: block;
        }
        .hero-img .img-placeholder {
            width: 100%; height: 100%;
            background: linear-gradient(135deg, #2a2420 0%, #3d2e1e 100%);
            display: flex; align-items: center; justify-content: center;
            font-size: 8rem; opacity: .2;
        }
        /* gradient overlay at bottom of image */
        .hero-img::after {
            content: '';
            position: absolute; bottom: 0; left: 0; right: 0;
            height: 180px;
            background: linear-gradient(to top, rgba(26,26,24,.7) 0%, transparent 100%);
        }
        /* room name overlaid on image */
        .hero-img .room-title {
            position: absolute; bottom: 0; left: 0; right: 0;
            z-index: 1;
            padding: 32px 56px;
        }
        .hero-img .room-title h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 4vw, 3rem);
            color: var(--white);
            line-height: 1.15;
            margin-bottom: 8px;
        }
        .hero-img .room-title .price {
            font-size: 1.1rem; font-weight: 500;
            color: var(--accent-lt);
        }

        /* ── MAIN ── */
        .main {
            max-width: 860px;
            margin: 0 auto;
            padding: 48px 40px 80px;
        }

        /* ── BACK LINK ── */
        .back-link {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: .85rem; font-weight: 500;
            color: var(--muted); text-decoration: none;
            margin-bottom: 36px;
            transition: color .18s;
        }
        .back-link:hover { color: var(--accent); }

        /* ── CONTENT GRID ── */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 32px;
            align-items: start;
        }

        /* ── LEFT: DETAILS ── */
        .details {}

        /* META PILLS */
        .meta-pills {
            display: flex; flex-wrap: wrap; gap: 10px;
            margin-bottom: 28px;
        }
        .pill {
            display: flex; align-items: center; gap: 6px;
            padding: 8px 16px;
            background: var(--white);
            border: 1px solid var(--warm);
            border-radius: 20px;
            font-size: .85rem; color: var(--ink); font-weight: 500;
        }

        /* DESCRIPTION */
        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem; font-weight: 700;
            margin-bottom: 14px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--warm);
        }
        .description {
            font-size: .95rem; color: #3a3a38;
            line-height: 1.85; margin-bottom: 36px;
        }

        /* SERVICES */
        .services-list {
            list-style: none;
            display: flex; flex-direction: column; gap: 10px;
            margin-bottom: 36px;
        }
        .services-list li {
            display: flex; align-items: center; gap: 10px;
            font-size: .9rem; color: var(--ink);
        }
        .services-list li::before {
            content: '✓';
            width: 22px; height: 22px;
            background: var(--accent-lt);
            color: var(--accent);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: .75rem; font-weight: 700;
            flex-shrink: 0;
        }
        .no-services {
            font-size: .9rem; color: var(--muted);
            font-style: italic;
        }

        /* ── RIGHT: BOOKING CARD ── */
        .booking-card {
            background: var(--white);
            border: 1px solid var(--warm);
            border-radius: var(--radius);
            padding: 28px 24px;
            box-shadow: var(--shadow);
            position: sticky;
            top: 24px;
        }
        .booking-card .price-big {
            font-family: 'Playfair Display', serif;
            font-size: 2rem; font-weight: 700;
            color: var(--accent);
            margin-bottom: 4px;
        }
        .booking-card .per-night {
            font-size: .82rem; color: var(--muted);
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--warm);
        }
        .booking-card .meta-row {
            display: flex; justify-content: space-between;
            font-size: .85rem; margin-bottom: 12px;
        }
        .booking-card .meta-row .label { color: var(--muted); }
        .booking-card .meta-row .val { font-weight: 500; }
        .booking-card .divider {
            border: none; height: 1px;
            background: var(--warm); margin: 16px 0;
        }
        .btn-calculate {
            display: block; width: 100%;
            padding: 13px;
            background: var(--accent); color: var(--white);
            border-radius: 8px; text-align: center;
            text-decoration: none;
            font-size: .93rem; font-weight: 500;
            margin-bottom: 10px;
            transition: background .18s;
        }
        .btn-calculate:hover { background: #b5622c; }
        .btn-back-card {
            display: block; width: 100%;
            padding: 12px;
            background: var(--white); color: var(--muted);
            border: 1.5px solid var(--warm);
            border-radius: 8px; text-align: center;
            text-decoration: none;
            font-size: .88rem; font-weight: 500;
            transition: border-color .18s, color .18s;
        }
        .btn-back-card:hover { border-color: var(--accent); color: var(--accent); }

        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            .hero-img { height: 340px; }
            .hero-img .room-title { padding: 24px; }
            .main { padding: 32px 20px 60px; }
            .content-grid { grid-template-columns: 1fr; }
            .booking-card { position: static; }
        }
    </style>
</head>
<body>

<!-- HERO IMAGE -->
<div class="hero-img">
    @if($room->image)
        <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->name }}">
    @else
        <div class="img-placeholder">🛏️</div>
    @endif
    <div class="room-title">
        <h1>{{ $room->name }}</h1>
        <p class="price">৳ {{ number_format($room->price) }} / night</p>
    </div>
</div>

<!-- MAIN -->
<div class="main">
    <a href="/rooms" class="back-link">← Back to Rooms</a>

    <div class="content-grid">

        <!-- LEFT -->
        <div class="details">

            <!-- META PILLS -->
            <div class="meta-pills">
                @if($room->sqft)
                    <div class="pill">📐 {{ $room->sqft }} sq ft</div>
                @endif
                @if($room->persons)
                    <div class="pill">👤 {{ $room->persons }} persons</div>
                @endif
                <div class="pill">📶 Free WiFi</div>
            </div>

            <!-- DESCRIPTION -->
            <h2 class="section-title">About This Room</h2>
            <p class="description">{!! nl2br(e($room->description)) !!}</p>

            <!-- SERVICES -->
            <h2 class="section-title">Services & Amenities</h2>
            @if($room->services)
                <ul class="services-list">
                    @foreach(explode(',', $room->services) as $service)
                        <li>{{ trim($service) }}</li>
                    @endforeach
                </ul>
            @else
                <p class="no-services">No services listed for this room.</p>
            @endif

        </div>

        <!-- RIGHT: BOOKING CARD -->
        <div class="booking-card">
            <p class="price-big">৳ {{ number_format($room->price) }}</p>
            <p class="per-night">per night</p>

            @if($room->sqft)
            <div class="meta-row">
                <span class="label">Room Size</span>
                <span class="val">{{ $room->sqft }} sq ft</span>
            </div>
            @endif

            @if($room->persons)
            <div class="meta-row">
                <span class="label">Max Guests</span>
                <span class="val">{{ $room->persons }} persons</span>
            </div>
            @endif

            <div class="meta-row">
                <span class="label">WiFi</span>
                <span class="val">Free</span>
            </div>

            <hr class="divider">

            <a href="/cost?room_id={{ $room->id }}" class="btn-calculate">Calculate Stay Cost →</a>
            <a href="/rooms" class="btn-back-card">← All Rooms</a>
        </div>

    </div>
</div>

</body>
</html>
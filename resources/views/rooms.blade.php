@php use Illuminate\Support\Str; @endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms — Manager</title>
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

        /* ── HERO BANNER ── */
        .hero {
            position: relative;
            height: 320px;
            overflow: hidden;
            background-image: url('{{ asset("banner.jpg") }}');
            background-size: cover;
            background-position: center;
        }
        /* dark overlay so text stays readable over photo */
        .hero::before {
            content: '';
            position: absolute; inset: 0;
            background: rgba(20, 14, 10, 0.62);
        }
        .hero-content {
            position: relative; z-index: 1;
            height: 100%;
            display: flex; flex-direction: column;
            justify-content: center;
            padding: 0 56px;
        }
        .hero-tag {
            font-size: .72rem; font-weight: 500;
            letter-spacing: 3px; text-transform: uppercase;
            color: var(--accent-lt); margin-bottom: 12px;
        }
        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.8rem, 3.5vw, 2.8rem);
            color: var(--white); line-height: 1.2;
            margin-bottom: 12px;
        }
        .hero p {
            font-size: .93rem;
            color: rgba(255,255,255,.65);
        }

        /* ── MAIN WRAPPER ── */
        .main {
            max-width: 1100px;
            margin: 0 auto;
            padding: 56px 40px 80px;
        }

        /* ── ADD ROOM FORM ── */
        .form-section {
            background: var(--white);
            border: 1px solid var(--warm);
            border-radius: var(--radius);
            padding: 36px;
            margin-bottom: 56px;
            box-shadow: var(--shadow);
        }
        .form-section h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem; font-weight: 700;
            margin-bottom: 28px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--warm);
        }
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }
        .form-group {
            display: flex; flex-direction: column; gap: 6px;
        }
        .form-group.full { grid-column: 1 / -1; }
        .form-group label {
            font-size: .82rem; font-weight: 500;
            color: var(--muted); letter-spacing: .3px;
        }
        .form-group input,
        .form-group textarea {
            font-family: 'DM Sans', sans-serif;
            font-size: .93rem;
            padding: 11px 14px;
            border: 1.5px solid var(--warm);
            border-radius: 8px;
            background: var(--cream);
            color: var(--ink);
            outline: none;
            transition: border-color .18s, background .18s;
            width: 100%;
        }
        .form-group input:focus,
        .form-group textarea:focus {
            border-color: var(--accent);
            background: var(--white);
        }
        .form-group textarea { resize: vertical; min-height: 100px; }
        .form-group input[type="file"] { padding: 9px 14px; cursor: pointer; }
        .form-group .hint {
            font-size: .75rem; color: var(--muted); margin-top: 2px;
        }
        .submit-btn {
            margin-top: 24px;
            display: inline-flex; align-items: center; gap: 8px;
            padding: 12px 32px;
            background: var(--ink); color: var(--white);
            border: none; border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: .93rem; font-weight: 500;
            cursor: pointer;
            transition: background .18s;
        }
        .submit-btn:hover { background: var(--accent); }

        /* ── ROOM LIST HEADER ── */
        .list-header {
            display: flex; align-items: baseline;
            justify-content: space-between;
            margin-bottom: 28px;
        }
        .list-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem; font-weight: 700;
        }
        .list-header span { font-size: .85rem; color: var(--muted); }

        /* ── ROOM CARDS ── */
        .rooms-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 24px;
        }
        .room-card {
            background: var(--white);
            border: 1px solid var(--warm);
            border-radius: var(--radius);
            overflow: hidden;
            transition: box-shadow .2s, transform .2s;
        }
        .room-card:hover {
            box-shadow: var(--shadow);
            transform: translateY(-4px);
        }
        .room-img {
            width: 100%; height: 190px;
            overflow: hidden; background: var(--warm);
        }
        .room-img img {
            width: 100%; height: 100%;
            object-fit: cover; display: block;
            transition: transform .3s;
        }
        .room-card:hover .room-img img { transform: scale(1.04); }
        .room-img-placeholder {
            width: 100%; height: 190px;
            background: linear-gradient(135deg, var(--warm) 0%, var(--accent-lt) 100%);
            display: flex; align-items: center; justify-content: center;
            font-size: 3rem;
        }
        .room-body { padding: 20px; }
        .room-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem; font-weight: 700; margin-bottom: 6px;
        }
        .room-price {
            font-size: .95rem; font-weight: 600;
            color: var(--accent); margin-bottom: 10px;
        }
        .room-meta {
            display: flex; gap: 8px; flex-wrap: wrap;
            margin-bottom: 10px;
        }
        .room-meta span {
            font-size: .78rem; color: var(--muted);
            background: var(--cream);
            padding: 4px 10px;
            border-radius: 20px;
            border: 1px solid var(--warm);
        }
        .room-desc {
            font-size: .85rem; color: var(--muted);
            line-height: 1.6; margin-bottom: 18px;
        }
        .room-actions { display: flex; gap: 8px; }
        .btn {
            flex: 1; padding: 9px 0;
            border: none; border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: .82rem; font-weight: 500;
            cursor: pointer; text-align: center;
            text-decoration: none; display: inline-block;
            transition: opacity .18s, transform .18s;
        }
        .btn:hover { opacity: .85; transform: translateY(-1px); }
        .btn-view   { background: var(--accent-lt); color: var(--accent); }
        .btn-edit   { background: #fef3c7; color: #92400e; }
        .btn-delete { background: #fee2e2; color: #991b1b; }

        /* ── EMPTY STATE ── */
        .empty {
            text-align: center; padding: 60px 20px;
            color: var(--muted); grid-column: 1 / -1;
        }
        .empty span { font-size: 3rem; display: block; margin-bottom: 12px; }

        /* ── RESPONSIVE ── */
        @media (max-width: 700px) {
            .hero { height: 260px; }
            .hero-content { padding: 0 24px; }
            .main { padding: 40px 20px 60px; }
            .form-grid { grid-template-columns: 1fr; }
            .form-section { padding: 24px 20px; }
        }
    </style>
</head>
<body>

<!-- HERO BANNER -->
<div class="hero">
    <div class="hero-content">
        <span class="hero-tag">Manager Panel</span>
        <h1>Room Management</h1>
        <p>Add, edit, and manage all available rooms from here.</p>
    </div>
</div>

<!-- MAIN -->
<div class="main">

    <!-- ADD ROOM FORM -->
    <div class="form-section">
        <h2>Add New Room</h2>
        <form action="/rooms" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label for="name">Room Name</label>
                    <input type="text" id="name" name="name" placeholder="e.g. Deluxe Suite" required>
                </div>
                <div class="form-group">
                    <label for="price">Price (৳)</label>
                    <input type="number" id="price" name="price" placeholder="e.g. 3500" required>
                </div>
                <div class="form-group">
                    <label for="sqft">Square Feet</label>
                    <input type="number" id="sqft" name="sqft" placeholder="e.g. 450">
                </div>
                <div class="form-group">
                    <label for="persons">Max Persons</label>
                    <input type="number" id="persons" name="persons" placeholder="e.g. 2">
                </div>
                <div class="form-group full">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" placeholder="Describe the room..." required></textarea>
                </div>
                <div class="form-group full">
                    <label for="services">Services & Amenities</label>
                    <input type="text" id="services" name="services" placeholder="e.g. Room Service, Air Conditioning, Mini Bar">
                    <span class="hint">Separate each service with a comma</span>
                </div>
                <div class="form-group">
                    <label for="image">Room Image</label>
                    <input type="file" id="image" name="image" accept="image/*">
                </div>
            </div>
            <button type="submit" class="submit-btn">Add Room →</button>
        </form>
    </div>

    <!-- ROOM LIST -->
    <div class="list-header">
        <h2>All Rooms</h2>
        <span>{{ count($rooms) }} room{{ count($rooms) !== 1 ? 's' : '' }} listed</span>
    </div>

    <div class="rooms-grid">
        @forelse($rooms as $room)
        <div class="room-card">
            @if($room->image)
                <div class="room-img">
                    <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->name }}">
                </div>
            @else
                <div class="room-img-placeholder">🛏️</div>
            @endif
            <div class="room-body">
                <p class="room-name">{{ $room->name }}</p>
                <p class="room-price">৳ {{ number_format($room->price) }}</p>
                <div class="room-meta">
                    @if($room->sqft)
                        <span>📐 {{ $room->sqft }} sq ft</span>
                    @endif
                    @if($room->persons)
                        <span>👤 {{ $room->persons }} persons</span>
                    @endif
                    <span>📶 Free WiFi</span>
                </div>
                <p class="room-desc">{{ Str::limit($room->description, 90) }}</p>
                <div class="room-actions">
                    <a href="/rooms/{{ $room->id }}" class="btn btn-view">View</a>
                    <a href="/rooms/edit/{{ $room->id }}" class="btn btn-edit">Edit</a>
                    <a href="/rooms/delete/{{ $room->id }}"
                       onclick="return confirm('Are you sure you want to delete this room?')"
                       class="btn btn-delete">Delete</a>
                </div>
            </div>
        </div>
        @empty
        <div class="empty">
            <span>🛏️</span>
            No rooms added yet. Use the form above to add your first room.
        </div>
        @endforelse
    </div>

</div>

</body>
</html>
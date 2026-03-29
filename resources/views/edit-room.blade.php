<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Room — Manager</title>
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
            height: 240px;
            background: var(--ink);
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(135deg, #2a2420 0%, #3d2e1e 50%, #1a1a18 100%);
            opacity: .9;
        }
        .hero::after {
            content: '✏️';
            position: absolute;
            font-size: 18rem;
            opacity: .04;
            right: -40px; bottom: -40px;
            line-height: 1;
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
            font-size: clamp(1.8rem, 3.5vw, 2.6rem);
            color: var(--white); line-height: 1.2;
            margin-bottom: 12px;
        }
        .hero p { font-size: .93rem; color: rgba(255,255,255,.6); }

        /* ── MAIN ── */
        .main {
            max-width: 760px;
            margin: 0 auto;
            padding: 56px 40px 80px;
        }

        /* ── BACK LINK ── */
        .back-link {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: .85rem; font-weight: 500;
            color: var(--muted); text-decoration: none;
            margin-bottom: 32px;
            transition: color .18s;
        }
        .back-link:hover { color: var(--accent); }

        /* ── FORM CARD ── */
        .form-card {
            background: var(--white);
            border: 1px solid var(--warm);
            border-radius: var(--radius);
            padding: 40px 36px;
            box-shadow: var(--shadow);
        }
        .form-card h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem; font-weight: 700;
            margin-bottom: 28px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--warm);
        }

        /* ── CURRENT IMAGE PREVIEW ── */
        .current-image {
            margin-bottom: 24px;
            padding: 16px;
            background: var(--cream);
            border-radius: 10px;
            border: 1px solid var(--warm);
        }
        .current-image p {
            font-size: .78rem; font-weight: 500;
            color: var(--muted); text-transform: uppercase;
            letter-spacing: 1px; margin-bottom: 10px;
        }
        .current-image img {
            width: 100%; max-height: 200px;
            object-fit: cover;
            border-radius: 8px; display: block;
        }

        /* ── FORM ── */
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
        .form-group textarea { resize: vertical; min-height: 120px; }
        .form-group input[type="file"] { padding: 9px 14px; cursor: pointer; }

        /* ── ACTIONS ── */
        .form-actions {
            display: flex; gap: 12px;
            margin-top: 28px; padding-top: 24px;
            border-top: 1px solid var(--warm);
        }
        .btn-submit {
            flex: 1;
            padding: 13px;
            background: var(--ink); color: var(--white);
            border: none; border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: .93rem; font-weight: 500;
            cursor: pointer;
            transition: background .18s;
        }
        .btn-submit:hover { background: var(--accent); }
        .btn-cancel {
            padding: 13px 28px;
            background: var(--white); color: var(--muted);
            border: 1.5px solid var(--warm); border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: .93rem; font-weight: 500;
            text-decoration: none;
            display: inline-flex; align-items: center;
            transition: border-color .18s, color .18s;
        }
        .btn-cancel:hover { border-color: var(--accent); color: var(--accent); }

        /* ── RESPONSIVE ── */
        @media (max-width: 600px) {
            .hero-content { padding: 0 24px; }
            .main { padding: 40px 20px 60px; }
            .form-card { padding: 24px 20px; }
            .form-grid { grid-template-columns: 1fr; }
            .form-actions { flex-direction: column; }
        }
    </style>
</head>
<body>

<!-- HERO -->
<div class="hero">
    <div class="hero-content">
        <span class="hero-tag">Manager Panel</span>
        <h1>Edit Room</h1>
        <p>Update the details for <strong style="color:var(--accent-lt);">{{ $room->name }}</strong></p>
    </div>
</div>

<!-- MAIN -->
<div class="main">

    <a href="/rooms" class="back-link">← Back to Room List</a>

    <div class="form-card">
        <h2>Update Room Details</h2>

        @if($room->image)
        <div class="current-image">
            <p>Current Image</p>
            <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->name }}">
        </div>
        @endif

        <form method="POST" action="/rooms/update/{{ $room->id }}" enctype="multipart/form-data">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label for="name">Room Name</label>
                    <input type="text" id="name" name="name" value="{{ $room->name }}" required>
                </div>
                <div class="form-group">
                    <label for="price">Price (৳)</label>
                    <input type="number" id="price" name="price" value="{{ $room->price }}" required>
                </div>
                <div class="form-group">
                    <label for="sqft">Square Feet</label>
                    <input type="number" id="sqft" name="sqft" value="{{ $room->sqft }}">
                </div>
                <div class="form-group">
                    <label for="persons">Max Persons</label>
                    <input type="number" id="persons" name="persons" value="{{ $room->persons }}">
                </div>
                <div class="form-group full">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" required>{{ $room->description }}</textarea>
                </div>
				<div class="form-group">
					<label>Services</label>
					<input type="text" name="services" value="{{ $room->services }}">
				</div>
                <div class="form-group full">
                    <label for="image">Replace Image <span style="font-weight:300; color:var(--muted)">(leave empty to keep current)</span></label>
                    <input type="file" id="image" name="image" accept="image/*">
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">Save Changes →</button>
                <a href="/rooms" class="btn-cancel">Cancel</a>
            </div>
        </form>
    </div>

</div>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cost Calculator — Hotel</title>
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

        /* ── HERO ── */
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
            content: '🏨';
            position: absolute;
            font-size: 18rem; opacity: .04;
            right: -40px; bottom: -40px; line-height: 1;
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
            color: var(--white); line-height: 1.2; margin-bottom: 12px;
        }
        .hero p { font-size: .93rem; color: rgba(255,255,255,.6); }

        /* ── MAIN ── */
        .main {
            max-width: 560px;
            margin: 0 auto;
            padding: 56px 40px 80px;
        }

        /* ── CALC CARD ── */
        .calc-card {
            background: var(--white);
            border: 1px solid var(--warm);
            border-radius: var(--radius);
            padding: 40px 36px;
            box-shadow: var(--shadow);
        }
        .calc-card h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem; font-weight: 700;
            margin-bottom: 8px;
        }
        .calc-card .subtitle {
            font-size: .88rem; color: var(--muted);
            margin-bottom: 32px;
            padding-bottom: 24px;
            border-bottom: 1px solid var(--warm);
        }

        /* ── FORM ── */
        .form-group {
            display: flex; flex-direction: column; gap: 6px;
            margin-bottom: 20px;
        }
        .form-group label {
            font-size: .82rem; font-weight: 500;
            color: var(--muted); letter-spacing: .3px;
        }
        .form-group select,
        .form-group input {
            font-family: 'DM Sans', sans-serif;
            font-size: .93rem;
            padding: 12px 14px;
            border: 1.5px solid var(--warm);
            border-radius: 8px;
            background: var(--cream);
            color: var(--ink);
            outline: none;
            transition: border-color .18s, background .18s;
            width: 100%;
            appearance: none;
        }
        .form-group select:focus,
        .form-group input:focus {
            border-color: var(--accent);
            background: var(--white);
        }
        .select-wrapper {
            position: relative;
        }
        .select-wrapper::after {
            content: '▾';
            position: absolute;
            right: 14px; top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            pointer-events: none;
            font-size: .85rem;
        }

        /* ── NIGHTS HELPER ── */
        .nights-hint {
            font-size: .78rem; color: var(--muted);
            margin-top: 4px;
        }

        /* ── SUBMIT ── */
        .submit-btn {
            width: 100%; padding: 14px;
            background: var(--ink); color: var(--white);
            border: none; border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: .95rem; font-weight: 500;
            cursor: pointer; margin-top: 8px;
            transition: background .18s;
        }
        .submit-btn:hover { background: var(--accent); }

        /* ── RESULT (shown after POST if passed back) ── */
        @if(isset($result))
        .result-box {
            margin-top: 28px; padding-top: 24px;
            border-top: 1px solid var(--warm);
            text-align: center;
        }
        @endif
        .result-box {
            margin-top: 28px; padding-top: 24px;
            border-top: 1px solid var(--warm);
            text-align: center;
        }
        .result-box .result-label {
            font-size: .8rem; font-weight: 500;
            letter-spacing: 2px; text-transform: uppercase;
            color: var(--muted); margin-bottom: 8px;
        }
        .result-box .result-amount {
            font-family: 'Playfair Display', serif;
            font-size: 2.4rem; font-weight: 700;
            color: var(--accent);
        }
        .result-box .result-detail {
            font-size: .85rem; color: var(--muted);
            margin-top: 6px;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 600px) {
            .hero-content { padding: 0 24px; }
            .main { padding: 40px 20px 60px; }
            .calc-card { padding: 28px 20px; }
        }
    </style>
</head>
<body>

<!-- HERO -->
<div class="hero">
    <div class="hero-content">
        <span class="hero-tag">Plan Your Stay</span>
        <h1>Cost Calculator</h1>
        <p>Find out how much your stay will cost before you book.</p>
    </div>
</div>

<!-- MAIN -->
<div class="main">
    <div class="calc-card">
        <h2>Calculate Your Stay</h2>
        <p class="subtitle">Select a room and enter the number of nights to get your total cost.</p>

        <form method="POST" action="/cost/calculate">
            @csrf
            <div class="form-group">
                <label for="room_id">Select Room</label>
                <div class="select-wrapper">
                    <select name="room_id" id="room_id" required>
                        <option value="" disabled selected>Choose a room...</option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}" {{ request('room_id') == $room->id ? 'selected' : '' }}>
                                {{ $room->name }} — ৳ {{ number_format($room->price) }} / night
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="nights">Number of Nights</label>
                <input type="number" name="nights" id="nights" min="1" placeholder="e.g. 3" required>
                <span class="nights-hint">Minimum 1 night</span>
            </div>

            <button type="submit" class="submit-btn">Calculate Total →</button>
        </form>

        @isset($result)
        <div class="result-box">
            <p class="result-label">Total Cost</p>
            <p class="result-amount">৳ {{ number_format($result['total']) }}</p>
            <p class="result-detail">{{ $result['room'] }} &times; {{ $result['nights'] }} night{{ $result['nights'] > 1 ? 's' : '' }}</p>
        </div>
        @endisset

    </div>
</div>

</body>
</html>
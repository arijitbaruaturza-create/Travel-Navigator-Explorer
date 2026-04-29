<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Budget Calculator</title>
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
            content: '✈️';
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
        }
        .form-group input:focus {
            border-color: var(--accent);
            background: var(--white);
        }
        .form-group .hint {
            font-size: .78rem; color: var(--muted);
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

        /* ── RESULT ── */
        .result-box {
            margin-top: 28px; padding-top: 24px;
            border-top: 1px solid var(--warm);
        }
        .result-box .result-label {
            font-size: .8rem; font-weight: 500;
            letter-spacing: 2px; text-transform: uppercase;
            color: var(--muted); margin-bottom: 16px;
            text-align: center;
        }
        .result-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid var(--warm);
            font-size: .92rem;
        }
        .result-row span:last-child { font-weight: 500; }
        .result-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 16px;
            margin-top: 4px;
        }
        .result-total .total-label {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem; font-weight: 700;
        }
        .result-total .total-amount {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem; font-weight: 700;
            color: var(--accent);
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
        <span class="hero-tag">Plan Your Trip</span>
        <h1>Travel Budget Calculator</h1>
        <p>Estimate your total travel cost before you go.</p>
    </div>
</div>

<!-- MAIN -->
<div class="main">
    <div class="calc-card">
        <h2>Calculate Your Budget</h2>
        <p class="subtitle">Fill in your trip details to get an estimated total cost.</p>

        <form method="POST" action="/travel-budget/calculate">
            @csrf

            <div class="form-group">
                <label for="hotel_cost">Hotel Cost per Night (৳)</label>
                <input type="number" name="hotel_cost" id="hotel_cost" min="0" placeholder="e.g. 2000" value="{{ old('hotel_cost') }}" required>
            </div>

            <div class="form-group">
                <label for="nights">Number of Nights</label>
                <input type="number" name="nights" id="nights" min="1" placeholder="e.g. 3" value="{{ old('nights') }}" required>
                <span class="hint">Minimum 1 night</span>
            </div>

            <div class="form-group">
                <label for="food_per_day">Food Cost per Day (৳)</label>
                <input type="number" name="food_per_day" id="food_per_day" min="0" placeholder="e.g. 500" value="{{ old('food_per_day') }}" required>
            </div>

            <div class="form-group">
                <label for="transport_cost">Total Transport Cost (৳)</label>
                <input type="number" name="transport_cost" id="transport_cost" min="0" placeholder="e.g. 1000" value="{{ old('transport_cost') }}" required>
            </div>

            <button type="submit" class="submit-btn">Calculate Total →</button>
        </form>

        @isset($result)
        <div class="result-box">
            <p class="result-label">Cost Breakdown</p>

            <div class="result-row">
                <span>Hotel ({{ $result['nights'] }} night{{ $result['nights'] > 1 ? 's' : '' }} × ৳{{ number_format($result['hotel_cost']) }})</span>
                <span>৳{{ number_format($result['hotel_total']) }}</span>
            </div>
            <div class="result-row">
                <span>Food ({{ $result['nights'] }} day{{ $result['nights'] > 1 ? 's' : '' }} × ৳{{ number_format($result['food_per_day']) }})</span>
                <span>৳{{ number_format($result['food_total']) }}</span>
            </div>
            <div class="result-row">
                <span>Transport</span>
                <span>৳{{ number_format($result['transport_cost']) }}</span>
            </div>

            <div class="result-total">
                <span class="total-label">Total</span>
                <span class="total-amount">৳{{ number_format($result['total']) }}</span>
            </div>
        </div>
        @endisset

    </div>
</div>

</body>
</html>
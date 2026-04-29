<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Result</title>
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
            content: '🧾';
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

        /* ── CARD ── */
        .card {
            background: var(--white);
            border: 1px solid var(--warm);
            border-radius: var(--radius);
            padding: 40px 36px;
            box-shadow: var(--shadow);
        }

        /* ── TOTAL ── */
        .total-section {
            text-align: center;
            padding-bottom: 28px;
            border-bottom: 1px solid var(--warm);
            margin-bottom: 28px;
        }
        .total-label {
            font-size: .78rem; font-weight: 500;
            letter-spacing: 3px; text-transform: uppercase;
            color: var(--muted); margin-bottom: 12px;
        }
        .total-amount {
            font-family: 'Playfair Display', serif;
            font-size: 3rem; font-weight: 700;
            color: var(--accent);
        }

        /* ── CATEGORY BADGE ── */
        .category-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--cream);
            border-radius: 8px;
            padding: 16px 20px;
            margin-bottom: 32px;
        }
        .category-section .cat-label {
            font-size: .82rem; font-weight: 500;
            color: var(--muted); letter-spacing: .3px;
        }
        .category-section .cat-value {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem; font-weight: 700;
            color: var(--ink);
        }

        /* ── BACK LINK ── */
        .back-link {
            display: inline-block;
            width: 100%;
            text-align: center;
            padding: 13px;
            background: var(--ink);
            color: var(--white);
            border-radius: 8px;
            font-size: .93rem; font-weight: 500;
            text-decoration: none;
            transition: background .18s;
        }
        .back-link:hover { background: var(--accent); }

        /* ── RESPONSIVE ── */
        @media (max-width: 600px) {
            .hero-content { padding: 0 24px; }
            .main { padding: 40px 20px 60px; }
            .card { padding: 28px 20px; }
        }
    </style>
</head>
<body>

<!-- HERO -->
<div class="hero">
    <div class="hero-content">
        <span class="hero-tag">Trip Summary</span>
        <h1>Budget Result</h1>
        <p>Here's a summary of your estimated travel cost.</p>
    </div>
</div>

<!-- MAIN -->
<div class="main">
    <div class="card">

        <div class="total-section">
            <p class="total-label">Total Estimated Cost</p>
            <p class="total-amount">৳ {{ number_format($total) }}</p>
        </div>

        <div class="category-section">
            <span class="cat-label">Budget Category</span>
            <span class="cat-value">{{ $category }}</span>
        </div>

        <a href="/travel-budget" class="back-link">← Recalculate</a>

    </div>
</div>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Guide Details</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; background: #f7f4ef; margin: 0; }
        .header { background: #1a1a18; color: white; padding: 20px 40px; display: flex; justify-content: space-between; align-items: center; }
        .header h2 { margin: 0; }
        .header a { color: #c8753a; text-decoration: none; font-weight: 500; }
        .main { max-width: 900px; margin: auto; padding: 40px; }
        .panel { background: white; border-radius: 18px; padding: 30px; box-shadow: 0px 18px 40px rgba(0,0,0,0.08); }
        .meta { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-top: 22px; }
        .meta div { padding: 18px; border-radius: 14px; background: #f8f5f1; }
        .actions { margin-top: 24px; display: flex; gap: 12px; flex-wrap: wrap; }
        .btn { padding: 12px 20px; border-radius: 12px; background: #c8753a; color: white; text-decoration: none; font-weight: 600; }
        .approve { background: #28a745; }
        .reject { background: #dc3545; }
    </style>
</head>
<body>
<div class="header">
    <h2>Guide Approval</h2>
    <a href="/admin/guides">Back to Applications</a>
</div>
<div class="main">
    <div class="panel">
        <h1>{{ $guide->name }}</h1>
        <p class="text-slate-600">{{ $guide->specialization }} · {{ $guide->languages }}</p>
        <div class="meta">
            <div><strong>Destination</strong><br>{{ $guide->destination->name ?? 'Any' }}</div>
            <div><strong>Experience</strong><br>{{ $guide->experience_years }} years</div>
            <div><strong>Price</strong><br>৳ {{ number_format($guide->price_per_day, 2) }}/day</div>
            <div><strong>Status</strong><br>{{ ucfirst($guide->status) }}</div>
        </div>
        <div class="mt-6">
            <h3>Bio</h3>
            <p>{{ $guide->bio ?: 'No bio provided.' }}</p>
        </div>
        <div class="actions">
            @if($guide->status === 'pending')
                <a href="/admin/guides/{{ $guide->id }}/approve" class="btn approve">Approve</a>
                <a href="/admin/guides/{{ $guide->id }}/reject" class="btn reject">Reject</a>
            @endif
            <a href="/admin/dashboard" class="btn">Admin Home</a>
        </div>
    </div>
</div>
</body>
</html>

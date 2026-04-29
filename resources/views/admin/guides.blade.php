<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Guide Applications</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; background: #f7f4ef; margin: 0; }
        .header { background: #1a1a18; color: white; padding: 20px 40px; display: flex; justify-content: space-between; align-items: center; }
        .header h2 { margin: 0; }
        .header a { color: #c8753a; text-decoration: none; font-weight: 500; }
        .main { max-width: 1100px; margin: auto; padding: 40px; }
        .flash { padding: 12px; margin-bottom: 20px; border-radius: 6px; font-size: 14px; }
        .flash.success { background: #d4edda; color: #155724; }
        .flash.error { background: #f8d7da; color: #721c24; }
        .card { background: white; padding: 20px; border-radius: 10px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0px 3px 8px rgba(0,0,0,0.08); }
        .card-info h4 { margin: 0 0 5px 0; }
        .card-info p { margin: 2px 0; }
        .btn { padding: 10px 18px; background: #c8753a; color: white; text-decoration: none; border-radius: 6px; font-weight: 500; }
        .btn:hover { background: #b06330; }
        .badge { display: inline-flex; padding: 6px 12px; border-radius: 999px; font-size: 12px; font-weight: 600; }
        .pending { background: #fff3cd; color: #856404; }
        .approved { background: #d4edda; color: #155724; }
        .rejected { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
<div class="header">
    <h2>Guide Applications</h2>
    <a href="/admin/logout">Logout</a>
</div>
<div class="main">
    @if(session('success'))
        <div class="flash success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="flash error">{{ session('error') }}</div>
    @endif

    @forelse($guides as $guide)
        <div class="card">
            <div class="card-info">
                <h4>{{ $guide->name }}</h4>
                <p>Destination: {{ $guide->destination->name ?? 'Any' }}</p>
                <p>Experience: {{ $guide->experience_years }} years</p>
                <p>Status: <span class="badge {{ $guide->status }}">{{ ucfirst($guide->status) }}</span></p>
            </div>
            <a href="/admin/guides/{{ $guide->id }}" class="btn">View</a>
        </div>
    @empty
        <p>No guide applications yet.</p>
    @endforelse
</div>
</body>
</html>

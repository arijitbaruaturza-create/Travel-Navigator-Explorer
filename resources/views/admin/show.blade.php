<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Room Details</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            background: #f7f4ef;
            padding: 40px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            max-width: 700px;
            margin: auto;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.1);
        }

        .card img {
            width: 100%;
            max-width: 400px;
            display: block;
            margin-bottom: 15px;
            border-radius: 8px;
        }

        h2 {
            margin-top: 0;
            color: #333;
        }

        p {
            margin: 8px 0;
            line-height: 1.5;
        }

        .btn {
            padding: 10px 18px;
            margin-right: 10px;
            text-decoration: none;
            border-radius: 6px;
            color: white;
            font-weight: 500;
        }

        .approve { background: #28a745; }
        .approve:hover { background: #218838; }

        .reject { background: #dc3545; }
        .reject:hover { background: #c82333; }

        .back {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #c8753a;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>{{ $room->name }}</h2>

    @if($room->image)
        <img src="{{ asset('storage/'.$room->image) }}" alt="{{ $room->name }}">
    @endif

    <p><strong>Price:</strong> ৳ {{ $room->price }}</p>
    <p><strong>Persons:</strong> {{ $room->persons ?? 'N/A' }}</p>
    <p><strong>Square Feet:</strong> {{ $room->sqft ?? 'N/A' }}</p>
    <p><strong>Description:</strong> {{ $room->description }}</p>
    <p><strong>Services:</strong> {{ $room->services ?? 'N/A' }}</p>
    <p><strong>Status:</strong> <strong>{{ ucfirst($room->status) }}</strong></p>

    @if($room->status === 'pending')
        <a href="/admin/approve/{{ $room->id }}" class="btn approve">Approve</a>
        <a href="/admin/reject/{{ $room->id }}" class="btn reject">Reject</a>
    @endif

    <a href="/admin/dashboard" class="back">← Back to Dashboard</a>
</div>

</body>
</html>
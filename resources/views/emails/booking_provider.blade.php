<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Booking Notification</title>
</head>
<body>
    <h2>Hello {{ $booking->boarding->provider->name }},</h2>

    <p>{{ $booking->user->name }} has {{ $booking->status }} your boarding:</p>

    <ul>
        <li><strong>Boarding</strong> {{ $booking->boarding->title }}</li>
        <li><strong>User Contact</strong> {{ $booking->user->phone }} | {{ $booking->user->email }}</li>
        <li><strong>Paid</strong> Rs. {{ $booking->amount }}</li>
    </ul>

    <p>Trust score increased by this booking (if booked).</p>
</body>
</html>

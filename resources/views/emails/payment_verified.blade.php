<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran Terverifikasi</title>
</head>
<body>
    <h1>Halo, {{ $order->user->name }}!</h1>
    <p>Pembayaran untuk pesanan #{{ $order->id }} telah diverifikasi.</p>
    <p>Silakan login ke akun Anda untuk mengunduh tiket dan invoice.</p>
    <p><a href="{{ route('tickets.show', $order->id) }}">Lihat Tiket</a></p>
    <p>Salam,<br>Tim Phinisi Point</p>
</body>
</html>

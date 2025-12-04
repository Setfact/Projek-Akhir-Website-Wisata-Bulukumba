<!DOCTYPE html>
<html>
<head>
    <title>Pesanan Diterima</title>
</head>
<body>
    <h1>Halo, {{ $order->user->name }}!</h1>
    <p>Terima kasih telah memesan tiket di Phinisi Point.</p>
    <p>Detail Pesanan:</p>
    <ul>
        <li>ID Pesanan: #{{ $order->id }}</li>
        <li>Destinasi: {{ $order->destination->name }}</li>
        <li>Jumlah Tiket: {{ $order->quantity }}</li>
        <li>Total Harga: Rp {{ number_format($order->total_price, 0, ',', '.') }}</li>
    </ul>
    <p>Mohon tunggu verifikasi pembayaran dari admin kami.</p>
    <p>Salam,<br>Tim Phinisi Point</p>
</body>
</html>

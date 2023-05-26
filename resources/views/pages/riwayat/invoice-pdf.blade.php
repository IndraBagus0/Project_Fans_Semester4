<!DOCTYPE html>
<html>

<head>
    <title>Invoice Penjualan - Fans Vision</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .total {
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>

<body>
    <h1>Invoice
    </h1>
    <h1> Fans Vision Jember</h1>

    <p>Nama Penjual: John Doe</p>
    <p>Tanggal Transaksi: 25 Mei 2023</p>
    <p>Nama Kasir: Jane Smith</p>

    <table>
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Fan AC 123</td>
                <td>Rp 1.500.000</td>
                <td>2</td>
            </tr>
            <tr>
                <td>Fan AC 456</td>
                <td>Rp 2.000.000</td>
                <td>1</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        Total: Rp 5.000.000
    </div>

    <script>
        window.print();
    </script>
</body>

</html>

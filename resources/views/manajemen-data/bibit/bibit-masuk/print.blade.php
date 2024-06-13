<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Bibit Masuk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Form Bibit Masuk</h1>
        <table>
            <thead>
                <tr>
                    <th>Tanggal Masuk</th>
                    <th> : </th>
                    <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <th>Nama Pemasok</th>
                    <th> : </th>
                    <td>{{ $data->supplier }}</td>
                </tr>
                <tr>
                    <th>Nama Penerima</th>
                    <th> : </th>
                    <td>{{ $data->penerima }}</td>
                </tr>
                <tr>
                    <th>Jenis Bibit</th>
                    <th> : </th>
                    <td>{{ $data->bibit }}</td>
                </tr>
                <tr>
                    <th>Jumlah Bibit</th>
                    <th> : </th>
                    <td>{{ $data->stok }}</td>
                </tr>
            </thead>
        </table>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
@if ($type == 'excel')
    @php
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename=Daftar Aset ' . $company . ' - ' . date('d-m-Y') . '.xls');
    @endphp
@endif

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        * {
            font-size: 15px;
            font-family: Calibri, Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif;
        }

        table,
        td,
        th {
            border: 0.5px solid black;
            padding: 5px;
        }

        table {
            border-collapse: collapse;
            overflow-x: auto;
        }
    </style>
</head>

<body>
    <h4>DAFTAR DATA ASET {{ strtoupper($company) }}</h4>
    <table>
        <tr>
            <th>No</th>
            @foreach ($tableHeader as $th)
                <th>{{ $th }}</th>
            @endforeach
        </tr>
        @foreach ($datas as $kd => $data)
            <tr>
                <td style="text-align:center;">{{ $kd + 1 }}</td>
                @foreach ($data as $td)
                    <td style="max-width:100px;">{{ $td }}</td>
                @endforeach
            </tr>
        @endforeach
    </table>
</body>

</html>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Compras</title>
</head>
<body>
    <h1>Relatório de Compras</h1>
    <p><strong>Período: </strong>
        {{ \Carbon\Carbon::parse($compras->first()->created_at)->format('d/m/Y') }} - 
        {{ \Carbon\Carbon::parse($compras->last()->created_at)->format('d/m/Y') }}
    </p>

    <table border="1" cellpadding="5" style="border-collapse: collapse;">
        <thead>
            <tr>
                <th>Nome do Produto</th>
                <th>Valor Pago</th>
                <th>Status</th>
                <th>Data da Compra</th>
            </tr>
        </thead>
        <tbody>
            @foreach($compras as $compra)
                <tr>
                    <td>{{ $compra->produto->nome }}</td>
                    <td>{{ number_format($compra->valor_pago, 2, ',', '.') }}</td>
                    <td>{{ $compra->status }}</td>
                    <td>{{ $compra->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

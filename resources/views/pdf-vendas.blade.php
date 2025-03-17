<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Vendas</title>
</head>
<body>
    <h1>Relatório de Vendas</h1>
    <p><strong>Período: </strong>{{ \Carbon\Carbon::parse($vendas->first()->created_at)->format('d/m/Y') }} - 
        {{ \Carbon\Carbon::parse($vendas->last()->created_at)->format('d/m/Y') }}</p>

    <table border="1" cellpadding="5" style="border-collapse: collapse;">
        <thead>
            <tr>
                <th>Nome do Produto</th>
                <th>Nome do Comprador</th>
                <th>Valor Pago</th>
                <th>Data da Venda</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vendas as $venda)
                <tr>
                    <td>{{ $venda->produto->nome }}</td>
                    <td>{{ $venda->comprador->name }}</td>
                    <td>{{ number_format($venda->valor_pago, 2, ',', '.') }}</td>
                    <td>{{ $venda->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

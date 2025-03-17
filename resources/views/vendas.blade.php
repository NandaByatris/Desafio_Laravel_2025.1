@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Histórico de Vendas</h1>

    <form action="{{ route('vendas.pdf') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="data_inicio">Data de Início</label>
            <input type="date" name="data_inicio" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="data_fim">Data de Fim</label>
            <input type="date" name="data_fim" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Gerar Relatório PDF</button>
    </form>
    
    <table class="table mt-4">
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
</div>
@endsection

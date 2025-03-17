@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Histórico de Compras</h1>

    <form action="{{ route('compras.pdf') }}" method="POST">
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
</div>
@endsection

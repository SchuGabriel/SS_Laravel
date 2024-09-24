@extends("layout")
@section("pageTitle", "Produtos")
@section("content")
<div class="container">
    <h1>Produtos</h1>
    <a href="{{ route('produto.create') }}">Cadastrar Produto</a>
    <table>
        <tr>
            <th>Referencia</th>
            <th>Nome</th>
            <th>Cod_similar</th>
            <th>Ações</th>
        </tr>
        @foreach($produtos as $produto)
        <tr>
            <td>{{ $produto->referencia }}</td>
            <td>{{ $produto->nome }}</td>
            <td>
                @if($produto->cod_similar->isEmpty())
                N/A
                @else
                @foreach($produto->cod_similar as $codSimilar)
                {{ $codSimilar->nome }}<br>
                @endforeach
                @endif
            </td>
            <td>
                <a href="{{ route('produto.edit', ['id' => $produto->id]) }}">Editar</a>
                <br>
                <form action="{{ route('produto.destroy', ['id' => $produto->id]) }}" method="post">
                    @method('delete')
                    @csrf
                    <button type="submit">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
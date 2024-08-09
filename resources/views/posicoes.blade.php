@extends("layout")
@section("pageTitle", "Posicao")
@section("content")
<div class="container">
    <h1>Posicao</h1>
    <a href="{{ route('posicao.create') }}">Cadastrar Posicao</a>
    <table>
        <tr>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
        @foreach($posicoes as $posicao)
        <tr>
            <td>{{ $posicao->nome }}</td>
            <td><a href="{{ route('posicao.edit', ['id' => $posicao->id]) }}">Editar</a>
                <br>
                <form action="{{ route('posicao.destroy', ['id' => $posicao->id]) }}" method="post">Deletar
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
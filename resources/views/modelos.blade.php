@extends("layout")
@section("pageTitle", "Modelos")
@section("content")
<div class="container">
    <h1>Modelos</h1>
    <a href="{{ route('modelo.create') }}">Cadastrar Modelo</a>
    <table>
        <tr>
            <th>Montadora</th>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
        @foreach($modelos as $modelo)
        <tr>
            <td>{{ $modelo->montadora->nome }}</td>
            <td>{{ $modelo->nome }}</td>
            <td><a href="{{ route('modelo.edit', ['id' => $modelo->id]) }}">Editar</a>
                <br>
                <form action="{{ route('modelo.destroy', ['id' => $modelo->id]) }}" method="post">Deletar
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
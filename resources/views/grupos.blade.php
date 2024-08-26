@extends("layout")
@section("pageTitle", "Grupo")
@section("content")
<div class="container">
    <h1>Grupo</h1>
    <a href="{{ route('grupo.create') }}">Cadastrar Grupo</a>
    <table>
        <tr>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
        @foreach($grupos as $grupo)
        <tr>
            <td>{{ $grupo->nome }}</td>
            <td><a href="{{ route('grupo.edit', ['id' => $grupo->id]) }}">Editar</a>
                <br>
                <form action="{{ route('grupo.destroy', ['id' => $grupo->id]) }}" method="post">
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
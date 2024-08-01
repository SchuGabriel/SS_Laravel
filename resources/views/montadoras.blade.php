@extends("layout")
@section("pageTitle", "Montadoras")
@section("content")
<div class="container">
    <h1>Montadora</h1>
    <a href="{{ route('montadora.create') }}">Cadastrar Montadora</a>
    <table>
        <tr>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
        @foreach($montadoras as $montadora)
        <tr>
            <td>{{ $montadora->nome }}</td>
            <td><a href="{{ route('montadora.edit', ['id' => $montadora->id]) }}">Editar</a>
                <br>
                <form action="{{ route('montadora.destroy', ['id' => $montadora->id]) }}" method="post">Deletar
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
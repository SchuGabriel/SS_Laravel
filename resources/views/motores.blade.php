@extends("layout")
@section("pageTitle", "Motor")
@section("content")
<div class="container">
    <h1>Motor</h1>
    <a href="{{ route('motor.create') }}">Cadastrar Motor</a>
    <table>
        <tr>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
        @foreach($motores as $motor)
        <tr>
            <td>{{ $motor->nome }}</td>
            <td><a href="{{ route('motor.edit', ['id' => $motor->id]) }}">Editar</a>
                <br>
                <form action="{{ route('motor.destroy', ['id' => $motor->id]) }}" method="post">Deletar
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
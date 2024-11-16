@extends("layout")
@section("pageTitle", "Consulta com IA")
@section("content")
<div class="container">
    <h1>IA</h1>
    <form action="{{ route('chat.send') }}" method="POST">
        @csrf
        <label for="message">Manda a boa ai:</label>
        <textarea id="message" name="message" rows="4" required></textarea>
        <button type="submit">Enviar</button>
    </form>
</div>
@endsection
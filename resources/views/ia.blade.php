@extends("layout")
@section("pageTitle", "Consulta com IA")
@section("content")
<div class="container">
    <h1>ChatGPT Integration</h1>
    <form action="{{ route('chat.send') }}" method="GET">
        @csrf
        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="4" required></textarea>
        <button type="submit">Send</button>
    </form>
</div>
@endsection
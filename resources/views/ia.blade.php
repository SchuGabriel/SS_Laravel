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
<script>
document.addEventListener("DOMContentLoaded", function () {
    const recordButton = document.getElementById("recordButton");
    const messageInput = document.getElementById("message");

    // Verifica se o navegador suporta a API de Reconhecimento de Fala
    if ("webkitSpeechRecognition" in window) {
        const recognition = new webkitSpeechRecognition();
        recognition.continuous = false;
        recognition.interimResults = false;
        recognition.lang = "pt-BR";

        recordButton.addEventListener("click", () => {
            recognition.start();
            recordButton.textContent = "🎙️ Gravando...";
        });

        recognition.onresult = (event) => {
            const transcript = event.results[0][0].transcript;
            messageInput.value = transcript;
            recordButton.textContent = "🎤";
        };

        recognition.onerror = (event) => {
            console.error("Erro no reconhecimento:", event.error);
            recordButton.textContent = "🎤";
        };

        recognition.onend = () => {
            recordButton.textContent = "🎤";
        };
    } else {
        recordButton.disabled = true;
        alert("O reconhecimento de voz não é suportado neste navegador.");
    }
});
</script>
@endsection
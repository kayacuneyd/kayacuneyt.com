<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Moved header to the top
header('Content-Type: application/json');
ob_start(); // Start output buffering

try {
    require_once __DIR__ . '/../vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->safeLoad();

    $openai_api_key = $_ENV['OPENAI_API_KEY'] ?? '';
    $elevenlabs_api_key = $_ENV['ELEVENLABS_API_KEY'] ?? '';

    if (!$openai_api_key || !$elevenlabs_api_key) {
        throw new Exception("API anahtarları eksik.");
    }

    $data = json_decode(file_get_contents('php://input'), true);
    $userMessage = trim($data['message'] ?? '');

    if ($userMessage === '') {
        throw new Exception("Boş mesaj alındı.");
    }

    // 🧠 OpenAI GPT yanıtı
    $openai_payload = [
        "model" => "gpt-4",
        "messages" => [
            ["role" => "system", "content" => "You are a helpful assistant that replies in the user's language (Turkish, English or German)."],
            ["role" => "user", "content" => $userMessage]
        ],
        "temperature" => 0.7
    ];

    $openai_opts = [
        "http" => [
            "method" => "POST",
            "header" => [
                "Content-Type: application/json",
                "Authorization: Bearer $openai_api_key"
            ],
            "content" => json_encode($openai_payload)
        ]
    ];

    $openai_ctx = stream_context_create($openai_opts);
    $openai_response = file_get_contents("https://api.openai.com/v1/chat/completions", false, $openai_ctx);

    if ($openai_response === false) {
        throw new Exception("OpenAI yanıt alınamadı.");
    }

    $gptData = json_decode($openai_response, true);
    $reply = $gptData['choices'][0]['message']['content'] ?? 'Üzgünüm, bir hata oluştu.';

    // 🔊 ElevenLabs
    $voice_id = 'EXAVITQu4vr4xnSDxMaL';
    $tts_payload = [
        "text" => $reply,
        "model_id" => "eleven_monolingual_v1",
        "voice_settings" => [
            "stability" => 0.5,
            "similarity_boost" => 0.7
        ]
    ];

    $tts_opts = [
        "http" => [
            "method" => "POST",
            "header" => [
                "Content-Type: application/json",
                "xi-api-key: $elevenlabs_api_key"
            ],
            "content" => json_encode($tts_payload)
        ]
    ];

    $tts_ctx = stream_context_create($tts_opts);
    $audio = file_get_contents("https://api.elevenlabs.io/v1/text-to-speech/$voice_id", false, $tts_ctx);

    if ($audio === false) { // Check if audio content was fetched
        throw new Exception("Ses içeriği ElevenLabs'ten alınamadı.");
    }

    $filename = 'reply_' . time() . '.mp3';
    $filePath = __DIR__ . "/../assets/chatbot/$filename";
    $bytesWritten = file_put_contents($filePath, $audio);
    if ($bytesWritten === false) {
        throw new Exception("Oluşturulan ses dosyası sunucuya yazılamadı. İzinleri kontrol edin.");
    }

    ob_end_clean(); // Clean (erase) the output buffer and turn off output buffering
    header('Content-Type: application/json'); // Re-set header for successful response
    echo json_encode([
        "reply" => $reply,
        "audioUrl" => "/assets/chatbot/$filename"
    ]);
} catch (Exception $e) {
    ob_end_clean(); // Clean (erase) the output buffer and turn off output buffering
    if (!headers_sent()) {
        header('Content-Type: application/json'); // Ensure JSON header is set for error response
    }
    http_response_code(500); // Set HTTP status code for error
    echo json_encode(["error" => $e->getMessage()]);
}
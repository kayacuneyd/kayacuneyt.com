<?php
header('Content-Type: application/json');

// Autoload & .env yükle
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();

// API anahtarlarını al
$openai_api_key = $_ENV['OPENAI_API_KEY'] ?? '';
$elevenlabs_api_key = $_ENV['ELEVENLABS_API_KEY'] ?? '';

if (empty($openai_api_key) || empty($elevenlabs_api_key)) {
    echo json_encode(['error' => 'API keys not found.']);
    exit;
}

// Kullanıcı mesajı al
$data = json_decode(file_get_contents('php://input'), true);
$userMessage = trim($data['message'] ?? '');

if ($userMessage === '') {
    echo json_encode(['error' => 'Empty message received.']);
    exit;
}

// OpenAI → Yanıt al
$openai_url = "https://api.openai.com/v1/chat/completions";
$openai_payload = [
    "model" => "gpt-4",
    "messages" => [
        ["role" => "system", "content" => "You are a helpful assistant that replies in the user's language (Turkish, English or German)."],
        ["role" => "user", "content" => $userMessage]
    ],
    "temperature" => 0.7
];

$openai_context = stream_context_create([
    "http" => [
        "method" => "POST",
        "header" => [
            "Content-Type: application/json",
            "Authorization: Bearer $openai_api_key"
        ],
        "content" => json_encode($openai_payload)
    ]
]);

$openai_response = file_get_contents($openai_url, false, $openai_context);
$gptData = json_decode($openai_response, true);
$reply = $gptData['choices'][0]['message']['content'] ?? 'Üzgünüm, şu anda yanıt veremiyorum.';

// ElevenLabs → Ses oluştur
$voice_id = 'EXAVITQu4vr4xnSDxMaL'; // Default voice
$tts_url = "https://api.elevenlabs.io/v1/text-to-speech/$voice_id";
$tts_payload = [
    "text" => $reply,
    "model_id" => "eleven_monolingual_v1",
    "voice_settings" => [
        "stability" => 0.5,
        "similarity_boost" => 0.7
    ]
];

$tts_context = stream_context_create([
    "http" => [
        "method" => "POST",
        "header" => [
            "Content-Type: application/json",
            "xi-api-key: $elevenlabs_api_key"
        ],
        "content" => json_encode($tts_payload)
    ]
]);

$audio = file_get_contents($tts_url, false, $tts_context);
if (!$audio) {
    echo json_encode(['reply' => $reply, 'audioUrl' => null, 'error' => 'Ses üretilemedi.']);
    exit;
}

// MP3 olarak kaydet
$filename = 'reply_' . time() . '.mp3';
$audioPath = __DIR__ . "/../assets/chatbot/$filename";
file_put_contents($audioPath, $audio);

// Yanıt gönder
echo json_encode([
    "reply" => $reply,
    "audioUrl" => "/assets/chatbot/$filename"
]);

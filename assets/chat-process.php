<?php
header('Content-Type: application/json');

$openai_api_key = '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';
$elevenlabs_api_key = 'sk_5230c888d709ad204ad72ac0c650086a930504657a430029';
$voice_id = 'EXAVITQu4vr4xnSDxMaL';

$data = json_decode(file_get_contents('php://input'), true);
$userMessage = $data['message'] ?? 'Merhaba';

$openai_url = "https://api.openai.com/v1/chat/completions";
$openai_payload = [
    "model" => "gpt-4",
    "messages" => [
        ["role" => "system", "content" => "You are a helpful assistant that replies in the user's language (Turkish, English or German)."],
        ["role" => "user", "content" => $userMessage]
    ],
    "temperature" => 0.7
];

$options = [
    "http" => [
        "method" => "POST",
        "header" => [
            "Content-Type: application/json",
            "Authorization: Bearer $openai_api_key"
        ],
        "content" => json_encode($openai_payload)
    ]
];

$context = stream_context_create($options);
$response = file_get_contents($openai_url, false, $context);
$gptData = json_decode($response, true);
$reply = $gptData['choices'][0]['message']['content'] ?? "Üzgünüm, şu anda yanıt veremiyorum.";

$tts_url = "https://api.elevenlabs.io/v1/text-to-speech/$voice_id";
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
            "xi-api-key: $elevenlabs_api_key",
            "Content-Type: application/json"
        ],
        "content" => json_encode($tts_payload)
    ]
];

$tts_ctx = stream_context_create($tts_opts);
$audio = file_get_contents($tts_url, false, $tts_ctx);

$filename = "reply_" . time() . ".mp3";
file_put_contents("assets/chatbot/$filename", $audio);

echo json_encode([
    "reply" => $reply,
    "audioUrl" => "/assets/chatbot/$filename"
]);
?>

async function playVoice() {
  const apiKey = 'sk_5230c888d709ad204ad72ac0c650086a930504657a430029'; // BURAYA API KEY
  const voiceId = 'EXAVITQu4vr4xnSDxMaL'; // Rachel gibi bir sesin ID'si

  const response = await fetch(`https://api.elevenlabs.io/v1/text-to-speech/${voiceId}`, {
    method: 'POST',
    headers: {
      'xi-api-key': apiKey,
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      text: "Hoş geldiniz! Ben Cüneyt Kaya'nın portfolyo sitesindesiniz. Size nasıl yardımcı olabilirim?",
      model_id: "eleven_monolingual_v1",
      voice_settings: {
        stability: 0.5,
        similarity_boost: 0.7
      }
    })
  });

  const blob = await response.blob();
  const audio = new Audio(URL.createObjectURL(blob));
  audio.play();
}

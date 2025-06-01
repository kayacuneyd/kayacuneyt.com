document.addEventListener('DOMContentLoaded', () => {
  console.log("Chatbot hazır.");

  const sendBtn = document.getElementById('send-button');
  const inputBox = document.getElementById('user-input');
  const speakBtn = document.getElementById('speak-button');

  if (sendBtn && inputBox) {
    sendBtn.addEventListener('click', sendMessage);
    inputBox.addEventListener('keydown', function (e) {
      if (e.key === 'Enter') sendMessage();
    });
  }

  if (speakBtn) {
    speakBtn.addEventListener('click', startVoiceRecognition);
  }

  // Sayfa yüklendiğinde karşılama mesajı
  playVoice();
});

function appendMessage(role, message) {
  const chatLog = document.getElementById('chat-log');
  const messageDiv = document.createElement('div');
  messageDiv.className = role;
  messageDiv.textContent = message;
  chatLog.appendChild(messageDiv);
  chatLog.scrollTop = chatLog.scrollHeight;
}

function sendMessage() {
  const input = document.getElementById('user-input');
  const message = input.value.trim();
  if (!message) return;

  appendMessage('user', message);
  input.value = '';

  fetch('/assets/chatbot/chat-process.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ message })
  })
    .then(res => {
      if (!res.ok) {
        // Log the response text if it's not OK
        return res.text().then(text => {
          throw new Error(`HTTP error! Status: ${res.status}, Response: ${text}`);
        });
      }
      return res.text(); // Get response as text first
    })
    .then(text => {
      try {
        const data = JSON.parse(text); // Try to parse as JSON
        if (data.reply) appendMessage('bot', data.reply);
        if (data.audioUrl) playAudio(data.audioUrl);
      } catch (err) {
        // Log the text that failed to parse and the error
        console.error('JSON parse hatası (sendMessage):', err, 'Alınan metin:', text);
        appendMessage('bot', 'Bir hata oluştu. Sunucudan gelen yanıt işlenemedi.'); // User-friendly message
      }
    })
    .catch(err => {
      console.error('Hata (sendMessage):', err);
      // Display a generic error message to the user for network or other unexpected errors
      appendMessage('bot', 'Mesaj gönderilirken bir sorun oluştu. Lütfen tekrar deneyin.');
    });
}

function playAudio(audioUrl) {
  const audio = new Audio(audioUrl);
  audio.play();
}

function startVoiceRecognition() {
  console.log("🎤 Sesli mesaj başlatılıyor...");
  if (!('webkitSpeechRecognition' in window)) {
    alert('Tarayıcınız bu özelliği desteklemiyor.');
    return;
  }

  const recognition = new webkitSpeechRecognition();
  recognition.lang = 'tr-TR';
  recognition.interimResults = false;
  recognition.maxAlternatives = 1;

  recognition.onresult = function (event) {
    const voiceText = event.results[0][0].transcript;
    document.getElementById('user-input').value = voiceText;
    sendMessage();
  };

  recognition.onerror = function (event) {
    console.error('🎤 Voice recognition error:', event.error);
  };

  recognition.start();
}

function playVoice() {
  fetch('/assets/chatbot/chat-process.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ message: 'Hoş geldiniz! Ben Cüneyt Kaya. Size nasıl yardımcı olabilirim?' })
  })
  .then(res => {
    return res.text().then(text => { // Get text first regardless of res.ok
      if (!res.ok) {
        // Log the text for not-ok responses and then throw an error
        console.error(`playVoice() HTTP error! Status: ${res.status}. Response text:`, text);
        throw new Error(`HTTP error! Status: ${res.status}`);
      }
      return text; // Pass text along if res.ok
    });
  })
  .then(text => {
    try {
      const data = JSON.parse(text);
      if (data.reply) appendMessage('bot', data.reply);
      if (data.audioUrl) playAudio(data.audioUrl);
    } catch (err) {
      // This block will catch JSON.parse errors. The 'text' variable is in scope.
      console.error('JSON parse hatası (playVoice):', err, 'Alınan metin:', text);
      appendMessage('bot', 'Karşılama mesajı alınırken bir sorun oluştu.'); // User-friendly message
    }
  })
  .catch(err => {
    // This will catch network errors or the error thrown from !res.ok
    console.error('Genel playVoice() hatası:', err);
    // Avoid appending another message if one was already added by JSON parse error
    if (!document.querySelector('#chat-log .bot:last-child') || !document.querySelector('#chat-log .bot:last-child').textContent.includes('Karşılama mesajı alınırken')) {
        appendMessage('bot', 'Karşılama hizmetiyle bağlantı kurulamadı.');
    }
  });
}
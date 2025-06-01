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
    .then(res => res.json())
    .then(data => {
      if (data.reply) appendMessage('bot', data.reply);
      if (data.audioUrl) playAudio(data.audioUrl);
    })
    .catch(err => console.error('Hata:', err));
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
      if (!res.ok) throw new Error(`HTTP error! Status: ${res.status}`);
      return res.text(); // önce text olarak al
    })
    .then(text => {
      try {
        const data = JSON.parse(text); // sonra JSON'a çevir
        if (data.reply) appendMessage('bot', data.reply);
        if (data.audioUrl) playAudio(data.audioUrl);
      } catch (err) {
        console.error('JSON parse hatası (playVoice):', err, text);
      }
    })
    .catch(err => console.error('playVoice() hatası:', err));
}
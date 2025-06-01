// 📁 chatbot.js

document.getElementById('send-button').addEventListener('click', sendMessage);
document.getElementById('user-input').addEventListener('keydown', function (e) {
  if (e.key === 'Enter') sendMessage();
});
document.getElementById('speak-button').addEventListener('click', startVoiceRecognition);

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
  console.log("Sesli mesaj başlatılıyor...");
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
    console.error('Voice recognition error:', event.error);
  };

  recognition.start();
}

function playVoice() {
  // İlk karşılama mesajı için
  fetch('/assets/chatbot/chat-process.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ message: 'Hoş geldiniz! Ben Cüneyt Kaya. Size nasıl yardımcı olabilirim?' })
  })
    .then(res => res.json())
    .then(data => {
      if (data.reply) appendMessage('bot', data.reply);
      if (data.audioUrl) playAudio(data.audioUrl);
    })
    .catch(err => console.error('playVoice() hatası:', err));
}

window.addEventListener('DOMContentLoaded', playVoice);
async function sendMessage() {
  const input = document.getElementById("user-input");
  const message = input.value.trim();
  if (!message) return;

  addMessageToLog("Sen", message);
  input.value = "";

  const res = await fetch("/chat-process.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ message })
  });

  const data = await res.json();
  addMessageToLog("Asistan", data.reply);
  playAudio(data.audioUrl);
}

function addMessageToLog(sender, text) {
  const chatLog = document.getElementById("chat-log");
  const div = document.createElement("div");
  div.className = "chat-message";
  div.innerHTML = `<strong>${sender}:</strong> ${text}`;
  chatLog.appendChild(div);
  chatLog.scrollTop = chatLog.scrollHeight;
}

function playAudio(url) {
  const audio = new Audio(url);
  audio.play();
}

const eyeIcon = document.getElementById("eye-icon");
const passwordField = document.getElementById("senha");

eyeIcon.addEventListener("click", function () {
  if (passwordField.type === "password") {
    passwordField.type = "text";
    eyeIcon.classList.remove("fa-eye-slash");
    eyeIcon.classList.add("fa-eye");
  } else {
    passwordField.type = "password";
    eyeIcon.classList.remove("fa-eye");
    eyeIcon.classList.add("fa-eye-slash");
  }
});

const chatBtn = document.getElementById("chat-btn");
const chatBox = document.getElementById("chat-box");
const sendBtn = document.getElementById("send-btn");
const userInput = document.getElementById("user-input");
const messages = document.getElementById("messages");

chatBtn.addEventListener("click", function () {
  // Alternar visibilidade do chat com animação
  if (chatBox.style.display === "block") {
    chatBox.classList.remove("show");
    setTimeout(() => (chatBox.style.display = "none"), 300);
  } else {
    chatBox.style.display = "block";
    setTimeout(() => chatBox.classList.add("show"), 10);
  }
});

sendBtn.addEventListener("click", function () {
  const userMessage = userInput.value.trim();
  if (userMessage) {
    // Criar mensagem do usuário
    const userMsg = document.createElement("div");
    userMsg.classList.add("message", "user");
    userMsg.innerHTML = `<div class="msg">${userMessage}</div>`;
    messages.appendChild(userMsg);
    userInput.value = ""; // Limpar campo de input

    // Rolagem automática para a última mensagem
    messages.scrollTop = messages.scrollHeight;

    // Simular resposta do bot
    setTimeout(function () {
      const botMessage = document.createElement("div");
      botMessage.classList.add("message", "bot");
      botMessage.innerHTML = `<div class="msg">${getChatResponse(
        userMessage
      )}</div>`;
      messages.appendChild(botMessage);

      // Rolagem automática para a última mensagem
      messages.scrollTop = messages.scrollHeight;
    }, 1000);
  }
});

function getChatResponse(message) {
  // Respostas básicas para perguntas comuns
  message = message.toLowerCase();
  if (message.includes("quero tirar uma duvida sobre minha senha")) {
    return "Para você se cadastrar, sua senha tem que ter pelo menos 8 caracteres.";
  }
  if (message.includes("email")) {
    return "Certifique-se de que o e-mail inserido está correto e ativo.";
  }
  if (message.includes("olá") || message.includes("oi")) {
    return "Olá! Como posso te ajudar?";
  }
  return "Desculpe, não entendi sua dúvida. Tente perguntar sobre 'senha', 'e-mail' ou 'olá'.";
}

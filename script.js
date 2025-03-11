// Função para alternar a visibilidade da senha
const eyeIcon = document.getElementById("eye-icon");
const passwordField = document.getElementById("senha");

eyeIcon.addEventListener("click", function () {
  if (passwordField.type === "password") {
    passwordField.type = "text"; // Mostrar a senha
    eyeIcon.classList.remove("fa-eye-slash");
    eyeIcon.classList.add("fa-eye"); // Trocar ícone
  } else {
    passwordField.type = "password"; // Ocultar a senha
    eyeIcon.classList.remove("fa-eye");
    eyeIcon.classList.add("fa-eye-slash"); // Trocar ícone
  }
});

// Funções do Chat (mantidas da versão refinada)
const chatBtn = document.getElementById("chat-btn");
const chatBox = document.getElementById("chat-box");
const sendBtn = document.getElementById("send-btn");
const userInput = document.getElementById("user-input");
const messages = document.getElementById("messages");
const closeChatBtn = document.getElementById("close-chat");

chatBtn.addEventListener("click", toggleChatBoxVisibility);
closeChatBtn.addEventListener("click", () => chatBox.classList.remove("show"));
sendBtn.addEventListener("click", handleUserMessage);
userInput.addEventListener("keypress", function (e) {
  if (e.key === "Enter" && !e.shiftKey) {
    e.preventDefault();
    handleUserMessage();
  }
});

function toggleChatBoxVisibility() {
  if (chatBox.classList.contains("show")) {
    chatBox.classList.remove("show");
  } else {
    chatBox.classList.add("show");
  }
}

function handleUserMessage() {
  const userMessage = userInput.value.trim();
  if (userMessage) {
    displayUserMessage(userMessage);
    userInput.value = ""; // Limpar campo de input

    setTimeout(() => {
      displayBotMessage(generateBotResponse(userMessage));
    }, 1000); // Simula resposta do bot
  }
}

function displayUserMessage(message) {
  const userMsg = document.createElement("div");
  userMsg.classList.add("message", "user");
  userMsg.innerHTML = `<div class="msg">${message}</div>`;
  messages.appendChild(userMsg);
  scrollMessagesToBottom();
}

function displayBotMessage(message) {
  const botMsg = document.createElement("div");
  botMsg.classList.add("message", "bot");
  botMsg.innerHTML = `<div class="msg">${message}</div>`;
  messages.appendChild(botMsg);
  scrollMessagesToBottom();
}

function scrollMessagesToBottom() {
  messages.scrollTop = messages.scrollHeight;
}

function generateBotResponse(userMessage) {
  const responses = {
    olá: "Olá! Como posso te ajudar?",
    oi: "Oi! O que posso fazer por você?",
    problema:
      "Desculpe, parece que você está tendo um problema. Como posso ajudar?",
    suporte:
      "Nossa equipe de suporte está disponível 24/7. Por favor, nos envie uma mensagem detalhada.",
    senha: "Sua senha deve ter pelo menos 8 caracteres",
    email:
      "Seu email deve ser um email valido, tera que ter um dominio correto",
    obrigado: "De nada! Se precisar de algo mais, é só chamar.",
    tchau: "Tchau! Volte sempre que precisar de ajuda.",
  };

  return (
    responses[userMessage.toLowerCase()] ||
    "Desculpe, não entendi sua dúvida. Tente perguntar sobre 'problema' ou 'suporte'."
  );
}

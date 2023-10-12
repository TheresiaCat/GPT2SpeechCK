document.addEventListener("DOMContentLoaded", function () {
    const userBubble = document.querySelector("#user-bubble");
    const botBubble = document.querySelector("#bot-bubble");
    const messageInput = document.querySelector("#message-input");
    const sendButton = document.querySelector("#send-button");
    const chatContainer = document.querySelector("#chat-container");
    const changeContentButton = document.querySelector("#change-content-button");
    

    // Bei Button-Klicken oder Enter-Taste wird der Inhalt des Inputfeldes übergeben an die Funktion "sendMessage"
    sendButton.addEventListener("click", sendMessage);
    messageInput.addEventListener("keydown", function (event) {
        if (event.keyCode === 13) {
            sendMessage();
        }
    });

    function sendMessage() {
        const userMessage = messageInput.value.trim(); // Input wird in Variable gespeichert, trim entfernt Leerzeichen am Anfang und Ende des Strings

        if (userMessage !== "") {
            // Sende Nachricht an die API und erhalte eine Antwort (fehlt noch)
            // Beispielantwort von der API
            const botResponse = "Hallo world";

            // Erstelle einen neuen qna-container für diese Runde
            const qnaContainer = document.createElement("div");
            qnaContainer.classList.add("qna-container");

            // Nachrichten in den entsprechenden Container-bubbles ausgeben und zum qna-container hinzufügen
            displayMessage(userMessage, "user-message", userBubble, qnaContainer);
            displayMessage(botResponse, "bot-message", botBubble, qnaContainer);

            // Füge den qna-container dem chat-container hinzu
            chatContainer.appendChild(qnaContainer);

            // Eingabefeld leeren 
            messageInput.value = "";
        }
    }

    function displayMessage(textmessage, authorMessage, bubbleContainer, qnaContainer) {
        const messageElement = document.createElement("div");
        messageElement.classList.add("message", authorMessage);
        messageElement.textContent = textmessage;
        bubbleContainer.appendChild(messageElement);

        // Füge die Nachricht zum qna-container hinzu
        qnaContainer.appendChild(messageElement);
    }

    changeContentButton.addEventListener("click", loadDoc);
    function loadDoc() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
           document.getElementById("demo").innerHTML = this.responseText;
          }
        };
        xhttp.open("GET", "ajax_info.txt", true);
        xhttp.send();
      }
});


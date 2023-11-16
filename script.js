document.addEventListener("DOMContentLoaded", function () {
    const userBubble = document.querySelector("#user-bubble");
    const botBubble = document.querySelector("#bot-bubble");
    const messageInput = document.querySelector("#message-input");
    const sendButton = document.querySelector("#send-button");
    const chatContainer = document.querySelector("#chat-container");

    // Bei Button-Klicken oder Enter-Taste wird der Inhalt des Inputfeldes übergeben an die Funktion "sendMessage"
    sendButton.addEventListener("click", sendMessage);
    messageInput.addEventListener("keydown", function (event) {
        if (event.keyCode === 13) {
            sendMessage();
        }
    });

    
    function sendMessage() {
        // Input in Variable gespeichert, trim entfernt Leerzeichen am Anfang und Ende
        const userMessage = messageInput.value.trim(); 

        if (userMessage !== "") {
            // Sende Nachricht an die API und erhalte eine Antwort (fehlt noch)
            // Beispielantwort von der API
            const formdata = new FormData()
            formdata.append("demoMessage",userMessage)
            const urlformdata = new URLSearchParams(formdata)
            loadPhpContent(urlformdata, function (botResponse) {
                

                let audiohtml = `${botResponse.textresponse}<audio controls>
                <source src="${botResponse.audiourl}" type="audio/wav">
              </audio>`
            console.log(botResponse); 
                

                // Erstelle einen neuen qna-container für diese Runde
                const qnaContainer = document.createElement("div");
                qnaContainer.classList.add("qna-container");

                // Nachrichten in den entsprechenden Container-bubbles ausgeben und zum qna-container hinzufügen
                displayMessage(userMessage, "user-message", userBubble, qnaContainer);
                displayMessage(audiohtml, "bot-message", botBubble, qnaContainer);

                // Füge den qna-container dem chat-container hinzu
                chatContainer.appendChild(qnaContainer);

                // Eingabefeld leeren 
                messageInput.value = "";
            });
        }
    }


    function displayMessage(textmessage, authorMessage, bubbleContainer, qnaContainer) {
        const messageElement = document.createElement("div");
        messageElement.classList.add("message", authorMessage);
        messageElement.innerHTML = textmessage;
        bubbleContainer.appendChild(messageElement);

        // Füge die Nachricht zum qna-container hinzu
        qnaContainer.appendChild(messageElement);
    }

    //Anfrage an PHP mit Übergabe von Text und Entgegennehmen von echo 
    async function loadPhpContent(formdata, callback) {
        const response = await fetch("/PHP/api.php",{
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: formdata
        })
        if(response.ok){
            response.json().then((text)=>{
                callback(text)
            })
        }
    }
});
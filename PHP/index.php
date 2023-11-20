<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatanwendung GPT2Speech</title>
    <link rel="stylesheet" href="../mystyle.css">
    <script src="../script.js"></script>
</head>
<body>
    <?php
      session_start();
      if(isset($_SESSION['logged_in'])){
        print_r('<form action="logout.php"><input type="submit" value="logout"></form>');
        print_r('<form action="deleteAcc.php"><input type="submit" value="delete my Acc"></form>');
        print_r('<form action="viewLastChat.php"><input type="submit" value="View last Chat"></form>');
      }
      else{
        print_r('<form action="../login.html"><input type="submit" value="login"></form>');
      }
    ?>
    <div id="chat-container">
        <div class="qna-container"><!--jede QnA wird ein neuer Container erstellt-->
            <div id="user-bubble">
                <!-- Usernachrichten werden hier angezeigt -->
            </div>
            <div id="bot-bubble">
                <!-- Botnachrichten werden hier angezeigt -->
            </div>
        </div>
        <div id="user-input">
            <input type="text" id="message-input" placeholder="Nachricht eingeben...">
            <button id="send-button"><img src="../assets/icon-send.png"></button>
        </div>
    </div>

</body>
</html>
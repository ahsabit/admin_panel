<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Admin Panel | Zelab</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/fontawesome-pro-5.15.3-web/css/all.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/chat-style.css">
</head>
<body>
    <?php require_once("slider.inc.php"); ?>
    <section class="main">
        <div class="main-wrapper">
            <?php require_once("header.inc.php"); ?>
            <div class="content-wrapper">
              <div class="--dark-theme" id="chat">
                <div class="chat__conversation-board">
                  <div class="chat__conversation-board__message-container">
                    <div class="chat__conversation-board__message__person">
                      <div class="chat__conversation-board__message__person__avatar">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Monika Figi"/>
                      </div>
                      <span class="chat__conversation-board__message__person__nickname">Monika Figi</span>
                    </div>
                    <div class="chat__conversation-board__message__context">
                      <div class="chat__conversation-board__message__bubble">
                        <span>Somewhere stored deep, deep in my memory banks is the phrase &quot;It really whips the llama's ass&quot;. | 12:00PM</span>
                      </div>
                    </div>
                    <div class="chat__conversation-board__message__options">
                      <span>Jan 1, 2024</span>
                    </div>
                  </div>
                  <div class="chat__conversation-board__message-container">
                    <div class="chat__conversation-board__message__person">
                      <div class="chat__conversation-board__message__person__avatar">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Monika Figi"/>
                      </div>
                      <span class="chat__conversation-board__message__person__nickname">Monika Figi</span>
                    </div>
                    <div class="chat__conversation-board__message__context">
                      <div class="chat__conversation-board__message__bubble">
                        <span>WE MUST FIND HIM!! | 12:02PM</span>
                      </div>
                      <div class="chat__conversation-board__message__bubble">
                        <span>Wait ... | 12:03PM</span>
                      </div>
                    </div>
                    <div class="chat__conversation-board__message__options">
                      <span>Jan 1, 2024</span>
                    </div>
                  </div>
                  <div class="chat__conversation-board__message-container reversed">
                    <div class="chat__conversation-board__message__person">
                      <div class="chat__conversation-board__message__person__avatar"><img src="https://randomuser.me/api/portraits/men/9.jpg" alt="Dennis Mikle"/></div><span class="chat__conversation-board__message__person__nickname">Dennis Mikle</span>
                    </div>
                    <div class="chat__conversation-board__message__context">
                      <div class="chat__conversation-board__message__bubble">
                        <span>Winamp's still an essential. | 12:04PM</span>
                      </div>
                    </div>
                    <div class="chat__conversation-board__message__options">
                      <span>Jan 1, 2024</span>
                    </div>
                  </div>
                </div>
                <div class="chat__conversation-panel">
                  <div class="chat__conversation-panel__container">
                    <input class="chat__conversation-panel__input panel-item" placeholder="Type a message..."/>
                    <button class="chat__conversation-panel__button panel-item btn-icon send-message-button">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" data-reactid="1036">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
              <div class="people-finder">
                <ul class="people-list">
                  <li class="people chat-id-1 chat-active">
                    <div class="pep">
                      <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Monika Fingi" class="prof-picture">
                    </div>
                    <div class="pep-right">
                      <span class="pep-name">Monika Fingi</span>
                      <p class="pep-message-title">Somewhere stored deep, deep ... .</p>
                    </div>
                  </li>
                  <li class="people chat-id-2">
                    <div class="pep">
                      <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Monika Fingi" class="prof-picture">
                    </div>
                    <div class="pep-right">
                      <span class="pep-name">Monika Fingi</span>
                      <p class="pep-message-title">Somewhere stored deep, deep ... .</p>
                    </div>
                  </li>
                  <li class="people chat-id-3">
                    <div class="pep">
                      <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Monika Fingi" class="prof-picture">
                    </div>
                    <div class="pep-right">
                      <span class="pep-name">Monika Fingi</span>
                      <p class="pep-message-title">Somewhere stored deep, deep ... .</p>
                    </div>
                  </li>
                </ul> 
              </div>
            </div>
        </div>
    </section>
    <?php require_once("footer.inc.php");?>
    <span id="identity">chat</span>
    <script src="js/main.js"></script>
</body>
</html>
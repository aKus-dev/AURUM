<div class="chat-mobile-menu hiddeMenuMobileChat">

    <div class="content">
        <div class="container-btn">
            <button id="chatsBtn">Finalizar</button>
            <button id="usuariosBtn" class="usuarios">Usuarios</button>
        </div>

        <div id="chats-mobile">
            <div class="user">
                <div class="text-center">
                    <div class="pt-3">
                        <h3 class="finalizar">Finaliza el chat</h3>

                        <form action="../mail/finalizar.php" id="finalizar-chat" method="post">
                            <p class="finalizarText">Al dar en finalizar, se enviara un resumen de los mensajes enviados a los correos de los usuarios de este chat, ¡Asegurate de que todas tus dudas se hayan aclarado!</p>
                            <input type="hidden" name="idChat" value="<?php echo $idChat ?>">
                            
                            <button class="bg-main btn-end">Finalizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="usuarios-mobile" class="display-none">
            <div id="usuarios_mobile">

            </div>
        </div>

    </div>
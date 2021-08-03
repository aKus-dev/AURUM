<div class="chat-mobile-menu hiddeMenuMobileChat">

    <div class="content">
        <div class="container-btn">
            <button id="chatsBtn">Chats</button>
            <button id="usuariosBtn">Usuarios</button>
        </div>

        <div id="chats-mobile">
            <div class="user">
                <div class="text-center">
                    <div class="pt-3">
                        <h3>Finaliza el chat</h3>

                        <form action="sql/finalizar.php" id="finalizar-chat" method="post">
                            <p>Al enviar este formulario, estas finalizando el chat, ¡Asegurate de que todas tus dudas se hayan aclarado!</p>

                            <textarea name="resumen" placeholder="Escribe un resumen"></textarea>
                            <button class="bg-main">Finalizar</button>
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
<div class="chat-mobile-menu hiddeMenuMobileChat">

    <div class="content">
        <div class="container-btn">
            <button id="chatsBtn">Chats</button>
            <button id="usuariosBtn">Usuarios</button>
        </div>

        <div id="chats-mobile">
            <div class="user">
                <div class="text-center">
                    <h3>Otros chats activos</h3>

                    <div class="chat-active">
                        <p class="materia">Matemática</p>
                        <p>Creado por: <span>Manuel Ugarte</span> </p>

                        <a href="#"">
                        <i class=" fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div id="usuarios-mobile" class="display-none">
            <?php Chat::cargarHostMobile($idChat, $db); ?>

            <!--  Usuario que se unió -->
           <?php Chat::cargarUsuariosMobile($idChat, $db); ?>
        </div>

    </div>
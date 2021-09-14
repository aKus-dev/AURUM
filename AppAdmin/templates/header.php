<header class=" admin-header">
    <div>
        <a href="/AppAdmin/index.php">
            <img class="header__aurum" src="/build/img/AURUM.svg" alt="AURUm">
        </a>
    </div>

    <!-- Iconos versión mobile -->
    <div class="flex-icons-admin">
        <!-- Icono de notificacion -->
        <div class="notification">
            <div class="notification__icon">
                <p>5</p>
            </div>
            <i class="far fa-bell icon"></i>
        </div>

        <div class="flexRow">
            <!-- Imagen del administrador -->
            <div>
                <img class="system-image pointer" src="<?php echo $_SESSION['imagen'] ?>" alt="">
            </div>

            <!-- Cerrar sesión -->
            <abbr title="Cerrar sesión">
                <a style="font-size: 2.2rem; color: #FFF;" href="/AppAdmin/logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </abbr>

        </div>
    </div>
</header>
<header class=" admin-header">
    <div>
        <a href="/Administrador/index.php">
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

            <!-- Icono de flecha hacia abajo -->
            <div>
                <i class="fas fa-chevron-down icon arrow-down pointer"></i>
            </div>
        </div>
    </div>
    </header>
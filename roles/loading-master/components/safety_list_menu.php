<nav class="menu">
    <div id="toggle-button"><img src="../../../assets/img/nav.png" class="toggle"></div>

    <a href="../../../index.php" class="logo">
        <img src="../../../assets/img/logo.svg" alt="Logo de Oiltanking">
    </a>

    <a href="../../../processes/logout.php" class="access">
        <span class="access-mobile icon-logout"></span><span class="access-desktop">Cerrar sesión</span>
    </a>
    <p class="name">Bienvenido, <?php echo $nombre." ".$apellido; ?></p>
</nav>

<div id="sidebar">
    <ul>
        <li><a href="new_safety_list.php">Nueva Safety Check List</a></li>
        <li><a href="safety_lists_unfinished.php">Lista de Safety Check Lists sin finalizar</a></li>
        <li><a href="safety_lists_finished.php">Lista de Safety Check Lists finalizadas</a></li>
        <li><a href="../menu.php">Volver al inicio</a></li>
    </ul>
</div>
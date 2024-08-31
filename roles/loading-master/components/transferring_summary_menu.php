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
        <li><a href="new_transferring_summary.php">Nuevo resumen de transferencia</a></li>
        <li><a href="summaries_list_unfinished.php">Listado de resúmenes sin finalizar</a></li>
        <li><a href="summaries_list_finished.php">Listado de resúmenes finalizados</a></li>
        <li><a href="../menu.php">Volver al inicio</a></li>
    </ul>
</div>
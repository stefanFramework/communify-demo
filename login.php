<?php
if (!session_id()) {
    session_start();
}

require_once 'fb-config.php';

try {

    $permissions = [
            'email',
            'public_profile',
            'instagram_basic',
            'publish_to_groups',
            'pages_manage_metadata',
            'pages_manage_posts',
            'pages_read_engagement',
            'pages_show_list'
    ]; // Generar permisos opcionales

    $helper = $fb->getRedirectLoginHelper();
    $loginUrl = $helper->getLoginUrl('http://localhost:8888/communify-demo/login-callback.php', $permissions);

    /* Aquí el enlace a la página de login Facebook*/
    echo '<a href="' . htmlspecialchars($loginUrl) . '">Iniciar sesión con Facebook!</a>';

} catch (Throwable $ex) {
    echo 'Error: ' . $ex->getMessage();
}

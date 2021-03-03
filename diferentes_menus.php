<?php
/*
Plugin Name: Cambios en los menus
Plugin URI: 
Description: Este es un plugin de pruebas para cambiar los menus
Version: 0.01
*/ 
function Activar(){

}

function Desactivar(){
    flush_rewrite_rules();
}

register_activation_hook(__FILE__, 'Activar');
register_deactivation_hook(__FILE__, 'Desactivar');


// Cambios en los menus

    /*
        Se realiza un cambio en el menu dependiendo el rol del usuario, ésto se verifica con la función "current_user_can"
        la cual valida si es un editor, author, subscriber, administrator, contributor o super admin, despues de saber en
        que rol se encuentra el usuario oculta algunos items del menu mediante la función "remove_menu_page" tomando como
        parametro la url o parte de la url del item el cual quieres ocultar.
    */

add_action( 'admin_init', 'remove_items' );
function remove_items() {

    if ( current_user_can( 'editor' ) ) {
        remove_menu_page('edit-comments.php'); // Ocultando comentarios
        remove_menu_page('edit.php'); // Ocultando las entradas/post
    }

    if ( current_user_can( 'author' ) ) {
        remove_menu_page('tools.php'); // Ocultando herramientas 
        remove_menu_page('upload.php'); // Ocultando medios
    }

    if ( current_user_can( 'subscriber' ) ) {
        remove_menu_page('index.php'); // Ocultando escritorio del suscriptor
    }

}

<?php
/*
Plugin Name: Crear Widgets
Plugin URI: 
Description: Este es un plugin de pruebas para crear Widgets
Version: 0.01
*/ 
function Activaremos(){

}

function Desactivaremos(){

}

register_activation_hook(__FILE__, 'Activaremos');
register_deactivation_hook(__FILE__, 'Desactivaremos');


function creacion_widget() {
echo "Primer Widget Creado";
}

function add_widget() {
    wp_add_dashboard_widget('add_widget', 'Ejemplo de Widget en Escritorio', 'creacion_widget');
}
add_action('wp_dashboard_setup', 'add_widget' );

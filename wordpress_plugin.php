<?php
/*
Plugin Name: Wordpress Plugin
Plugin URI: 
Description: Este es un plugin de pruebas 
Version: 0.01
*/ 
function Activar(){

}

function Desactivar(){

}

register_activation_hook(__FILE__, 'Activar');
register_deactivation_hook(__FILE__, 'Desactivar');


// Creación de Página o Post

function crearPagina( $user_id ) {

	$user_id = get_current_user_id();

    $post_data = array(
        'post_title' => 'Pagina creada mediante PHP',
        'post_content' => 'Pagina creada mediante PHP en WordPress',
        'post_status' => 'publish', 
        'post_author' => $user_id,
        'post_type' => 'page' // Utilizar el valor 'post' en caso de crear un nuevo post
    );

	 wp_insert_post( $post_data );

}

add_action( 'admin_init', 'crearPagina' );



// Crear nuevo Usuario

add_action('init', 'add_user');
function add_user() {
    $username = 'Gilberts';
    $email = 'Gilb@example.com';
    $password = '123';

    $user_id = username_exists( $username );
    if ( !$user_id && email_exists($email) == false ) {
        $user_id = wp_create_user( $username, $password, $email );
        if( !is_wp_error($user_id) ) {
            $user = get_user_by( 'id', $user_id );
            $user->set_role( 'administrator' );
        }
    }
}



// Ocultar Widgets

add_action('wp_dashboard_setup', 'remove_widgets');

function remove_widgets(){
    // Eliminando widgets del dashboard
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');   
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');  
    remove_meta_box('dashboard_activity', 'dashboard', 'normal');  
    remove_meta_box('dashboard_primary', 'dashboard', 'side');   
    remove_meta_box('dashboard_site_health', 'dashboard', 'side');  
    
    // Eliminar widget de Elementor que aparece al activar su plugin
    remove_meta_box('e-dashboard-overview', 'dashboard', 'normal');   
}



// Ocultar Widget de alguna Página

function remove_search() {
    unregister_widget( 'WP_Widget_Search' ); // Ocultando widget de busqueda
}
add_action( 'widgets_init', 'remove_search' );



// Cambiar el color de algun sitio en el Dashboard

add_action ('admin_footer', 'add_color');

function add_color(){

    // Cambio de color del menu en el dashboard 
    echo '<style>

            #adminmenu,#adminmenu li,#adminmenu li ul,#adminmenu li ul li,#adminmenuwrap,#adminmenuback,.wp-submenu  
            {background: gray !important}

            #wp-toolbar, .nojq 
            {background: gray !important}

		</style>';

}


    
// Creación de Widgets

function creacion_widget() {
    echo "Primer Widget Creado";
}

function add_widget() {
    wp_add_dashboard_widget('add_widget', 'Ejemplo de Widget en Escritorio', 'creacion_widget');
}
add_action('wp_dashboard_setup', 'add_widget' );
    

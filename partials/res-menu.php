<?php
    /**
     * Creando el menu POP-UP
     */

     if(!function_exists('res_menu_pop_up')){
        function res_menu_pop_up(){
            add_menu_page(
                'Menú Pop-Up',
                'Menú Pop-Up',
                'manage_options',
                'res_popup',
                'res_options_menu_popup',
                'dashicons-megaphone',
                12
            );
        }
        add_action('admin_menu', 'res_menu_pop_up');
     }

     //Funcion callback para 

     if(!function_exists('res_options_menu_popup')){ 
        function res_options_menu_popup(){
            if(isset($_GET['edit']) && isset($_GET['id'])){
                include plugin_dir_path(__DIR__).'admin/res-display-menu-edit.php'; 
            }else{
                include plugin_dir_path(__DIR__).'admin/res-display-menu.php';
            }
        }

     }
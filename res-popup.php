<?php
    /**
     * plugin Name: Res PopUp
     * Plugin URI:   https://nikocrow.com
     * Description: Plugin to create pop-up's
     * version: 1.0.0
     * Author: NikocCrow
     * License: GPL2
     * Licence URI: https://www.gnu.org/licenses/gpl-2-0.html
     * Text Domain: pop-up
     * Domain Path: /languajes
     */

     function res_install(){
        //accion al activar el plugin
        require_once 'activador.php';
     }
     register_activation_hook(__FILE__, 'res_install');


     function res_desactivador(){
        //todo accion al desactivar el plugin
        flush_rewrite_rules();
     }
     register_deactivation_hook(__FILE__, 'res_desactivador');


     //administrador o menu de opciones del plugin aqui
     require_once 'partials/res-menu.php';
    //agrega estilos y scripts del plugin aqui
     require_once 'partials/res-archivos.php';


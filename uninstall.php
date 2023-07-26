<?php
    /**
     *  Se activa cuando este plugin es desinstalado
     */
    

     if(!defined('WP_UNINSTALL_PLUGIN')){
        exit();
     }

     /**
      * Agrega todo el codigo necesario para eliminar 
      * Bases de datos , limpiar cache, limpiar enlaces permanentes,etc..
      *en la desinstalacion del plugin
      */
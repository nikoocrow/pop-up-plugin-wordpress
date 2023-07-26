<?php

    /**
     * Aqui llamaremos los archivos css y js
     */

    //No deja filtrar los css a otras paginas que no sean del nombre del hook
    function enqueue_style($hook){
        if($hook != 'toplevel_page_res_popup'){
          return;
        }
        // añade admin css y boostrap css
        wp_enqueue_style('admin-style-CSS',plugin_dir_url(__DIR__).'admin/css/app-admin.css', array() , '1.0.0', 'all');
        wp_enqueue_style('bootstrap-min-CSS',plugin_dir_url(__DIR__).'helpers/bootstrap-4.0/css/bootstrap.min.css', array() , '4.0.0', 'all');
    }
    add_action('admin_enqueue_scripts','enqueue_style'); //hook de styles aqui

    //No deja filtrar los scripts a otras paginas que no sean del nombre del hook
    function enqueue_scripts($hook){
         if($hook != 'toplevel_page_res_popup'){
            return;
        }
           //añade boostrap js y admin.js
        wp_enqueue_script('admin-JS',plugin_dir_url(__DIR__).'admin/js/app-popup.js', array('jquery'), '4.0.0', true);
        wp_enqueue_script('bootstrap-JS',plugin_dir_url(__DIR__).'helpers/bootstrap-4.0/js/bootstrap.min.js', array('jquery') , '1.0.0', true);
          //Funcion localize
          wp_localize_script('admin-script', 'dataPopup',
           array(
                'url'        => admin_url('admin-ajax.php'),
                'seguridad'  => wp_create_nonce('resdata_seg'),
                'objeto'     => get_option('res_popup')
           ));
    }
    add_action('admin_enqueue_scripts', 'enqueue_scripts'); //hook de js aqui


    //Funcion para rescibir el ajax

    function res_data_popup(){
      check_ajax_referer('resdata_seg', 'nonce');
      if(current_user_can('manage_options')){ 
         extract($_POST, EXTR_OVERWRITE);

         if($tipo == 'add'){
            if(get_option('res_popup' == null)){
               $args [] = array(
                  'nombre' => $nombre,
                  'id'     => $id
               );
               $data = add_option('res_popup', $args, true);
               $json = json_encode([
                  'data'   => $data,
                  'objeto' => $args
               ]);
            }
             else if(get_option('res_popup') != null){
                $args = array(
                    'nombre' => $nombre,
                    'id'     => $id
                );
                $objeto = get_option('res_popup');
                array_push($datos_u, $args);
                $data = update_option('res_popup', $datos_u, true);

                $json = json_encode([
                  'objeto'  => $objeto,
                  'datos_u' => $datos_u,
                  'id'      => $id
                ]);
            }
         }
         echo $json;
         wp_die();
      }
    }
    add_action('wp_ajax_res_data_popup', 'res_data_popup');
    
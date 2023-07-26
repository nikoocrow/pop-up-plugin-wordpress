<?php
/**
 *  Aqui creamos el HTML de Administracion del Plugin
 */


 $dato = get_option('res_popup');   

 ?>

 <div class="container-fluid page-menu" style="background-color: #f1f1f1">
    <h3>Dashboard</h3>
    <div class="row">
        <!--Bloque1-->
        <div class="col-sm-12">
            <div class="card mb-3" style="max-width:100%">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img class="img-fluid" src="<?php echo plugin_dir_url(__FILE__) . 'imgs/img-pop-up.png'; ?>" alt="imagen aqui">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Title</h5>
                                <p class="card-text">
                                   Gana dinero promocionando algun tipo de producto o servicio
                                </p>
                                <p class="card-text">
                                    <small class="text-muted">Convierte tus visitas en ganancias</small>
                                </p>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
          <!--Bloque2-->
           <div class="col-sm-12">
                <div class="card text-dark mb-3">
                    <div class="card-header">
                        <h6 class="res-box-title">Pop-ups</h6>
                    </div>
                    <p class="card-text">
                        En esta parte podrás editar o eliminar tu pop-up, cada vez que crees uno aparecera
                        justo debajo con su respectivo shortcode para que lo pegues en las paginas donde quieras que aparezca.
                    </p>
                    <table class="table" id="tableId">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Shortcode</th>
                                <th scope="col">Opciones</th>
                            </tr>
                            <tbody>
                                 <?php 
                                    if($dato != ''){
                                       foreach($dato as $key => $datos):
                                            $output = "
                                            <tr id='$datos[id]' data-nombre='$datos[nombre]'>
                                                <th scope='row'>$datos[nombre]</th>
                                                    <td>Pop up navidad</td>
                                                        <td>
                                                    <a href='#' class='btn btn-outline-info' id='btn_editar' type='button'>
                                                        <span class='dashicons dashicons-welcome-write-blog'></span>
                                                    </a>
                                                    <a href='#' class='btn btn-outline-danger' id='btn_eliminar' type='button'>
                                                        <span class='dashicons dashicons-trash'></span>
                                                    </a>
                                                </td>
                                            </tr>
                                            ";
                                            echo $output;
                                       endforeach;

                                    }  else{

                                        echo $output = '';

                                    }
                                 ?>
                            </tbody>
                        </thead>
                    </table>
                    <!---->
                                <a href="#" class="btn btn-primary text-uppercase btn-crear" id="btn_crear" type="button">
                                           <span>Crear</span>
                                </a>
                   
                </div>
           </div>
    </div>
 </div>

 <?php include 'res_modal.php'; ?>

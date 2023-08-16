<?php

    $nombre      = $_GET['edit'];
    $id          = $_GET['id'];
    $nombrePopup = $nombre. '-ID-' .$id;

    $dataEditPopup = get_option($nombrePopup);

    var_dump($dataEditPopup);

    $titulo        = ($dataEditPopup != null ? $dataEditPopup[0]['titulo'] : '');
    $subtitulo     = ($dataEditPopup != null ? $dataEditPopup[0]['subtitulo'] : '');
    $imagen        = ($dataEditPopup != null ? $dataEditPopup[0]['imagen'] : '');
    $texto         = ($dataEditPopup != null ? $dataEditPopup[0]['texto'] : '');
    $buttonCheck   = ($dataEditPopup != null ? $dataEditPopup[0]['buttonCheck'] : false);
    $buttonTitle   = ($dataEditPopup != null ? $dataEditPopup[0]['buttonTitle'] : '');
    $buttonCheck1  = ($dataEditPopup != null ? $dataEditPopup[0]['buttonCheck1'] : 'true');
    $buttonCheck2  = ($dataEditPopup != null ? $dataEditPopup[0]['buttonCheck2'] : 'false');
    $buttonUrl     = ($dataEditPopup != null ? $dataEditPopup[0]['buttonUrl'] : '');

?>

<div class="container-fluid page-edit-popup">
    <div class="row block-01">
        <div class="card text-dark bg-light mb-3 mt-3" style="min-width:100%">
            <h5><?php echo $nombre; ?></h5>
        </div>        
    </div>
    <div class="btn-volver-atras px-0">
            <button type="button" class="btn btn-warning" id="volverAtras">
                <span class="dashicons dashicons-undo"></span>
                Volver atras
            </button>
        </div>
</div>
    
    <div class="row block-02">
        <form action="" method="post" style="min-width:100%">
            <!--bloque01-->
            <div class="col-sm-12">
                <div class="card text-dark bg-light mb-3" style="min-width:100%">
                        <div class="card-body">
                            <div class="buttonsActions">
                                <buton type="button" class="btn btn-secondary" id="btnPreview">
                                        <span class="dashicons dashicons-visibility"></span>
                                        Previsualizar
                                </buton>
                                <buton type="button" class="btn btn-info" id="btnSave" data-nombre="<?php echo $nombrePopup; ?>">
                                        <span class="dashicons dashicons-cloud-upload"></span>
                                        Guardar
                                </buton>
                            </div>
                        </div>
                </div>
            </div>
               <!--bloque02-->
            <div class="col-sm-12">
                <div class="card border-light mb-3" style="min-width:100%">
                        <div class="card-header"><h5>Contenido</h5></div>
                            <div class="card-body">
                                <!-- Titulo-->
                                <div class="row campo-titulo">
                                        <div class="col-sm-12 col-md-4">
                                            <h6>Titulo</h6>
                                            <p>Añade un titulo y subtitulo para tu pop-up</p>
                                        </div>
                                        <div class="col-sm-12 col-md-8">
                                            <div class="mb-3">
                                                <label for="titulo" class="form-label">Título (opcional)</label>
                                                <input type="text" class="form-control" id="titulo" placeholder="Título" value="<?php echo $titulo;?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="subtitulo" class="form-label">Subtítulo (opcional)</label>
                                                <input type="text" class="form-control" id="subtitulo" placeholder="Subtítulo" value="<?php echo $subtitulo;?>">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12">
                                            <div class="divider"></div>
                                        </div>
                                    </div>

                                    <!--imagen-->
                                    <div class="row campo-imagen">
                                            <div class="col-sm-12 col-md-4">
                                                <h6>Imagen</h6>
                                                <p>Añade aqui una imagen de fondo para tu pop-up</p>
                                            </div>
                                            <div class="col-sm-12 col-md-8">
                                                <h5>Imagen de Fondo</h5>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="imgFondo" placeholder="#" arial-label="#" arial-describedby="basic-addon2" value="<?php echo $imagen;?>">
                                                    <span class="input-group-text" id="basic-addon2">@</span>
                                                </div>
                                                <div class="imagen mt-3" id="imagen">
                                                    <img src="<?php echo $imagen; ?>" alt="" class="img-fliuid">
                                                </div>
                                        </div>
                                        <div class="col-12 col-sm-12">
                                            <div class="divider"></div>
                                        </div>


                                        <!--Contenido-->
                                    <div class="row campo-imagen">
                                            <div class="col-sm-12 col-md-4">
                                                <h6>Contenido</h6>
                                                <p>Añade aqui el texto para tu pop-up, este texto se vera reflejado en el curpo del pop-up cuando guardes</p>
                                            </div>
                                                <div class="col-sm-12 col-md-8">
                                                 <div class="mb-3" id="myContent">
                                                    <?php
                                                        $content = $texto;
                                                        $editor_id = $id;
                                                        $args = array(
                                                            'tinymce'       => true,
                                                            'content_css'   => '/wp-content/themes/mytheme/css/tinymce-editor.css', //ruta para dar estilos al editor de texto
                                                            'media_buttons' => true,    
                                                            'textarea_rows' => 8
                                                        );
                                                        $texto = wp_editor($content, $editor_id, $args);
                                                    ?>
                                                 </div>       
                                           </div>
                                        <div class="col-12 col-sm-12">
                                            <div class="divider"></div>
                                        </div>
                                    </div>

                                        <!--Call to action-->
                                        <div class="row campo-callToAction">
                                            <div class="col-sm-12 col-md-4">
                                                <h6>Llamada a la accion</h6>
                                                <p>Añade aqui el nombre para tu boton de llamada a la accion, por ejemplo
                                                   ver más o ver el siguiente enlace y luego añade la url hacia donde quieras redirigir. 
                                                </p>
                                            </div>
                                                <div class="col-sm-12 col-md-8">
                                                    <label class="switch" id="switch">
                                                        <input type="checkbox" data-check="<?php echo $buttonCheck; ?>">
                                                        <div class="slider round"></div>
                                                    </label>
                                                    <div id="camposSwitch" class="camposSwitch">
                                                         <div class="card text-dark bg-light mb3 col-md-12" style="mx-width:100%">
                                                                <div class="card-body row">
                                                                    <div class="col-12 col-sm-6">
                                                                         <div class="mb-3">
                                                                            <label for="btnText1" class="btnText1">
                                                                                Título para el boton
                                                                            </label>
                                                                            <input type="text" class="form-control" id="btnText1" placeholder="titulo para el boton" value="<?php echo $buttonTitle; ?>">
                                                                         </div>
                                                                    </div>
                                                                    <div class="col-12 col-sm-6">
                                                                        <div class="mb-3">
                                                                             <h6>Abrir el link </h6>
                                                                             <input type="radio" class="btn-check" name="tabsOptions" id="newTab" autocomplete="off" data-check="<?php echo $buttonCheck1; ?>"> 
                                                                             <label for="newTab" class="btn btn-outline-secondary">Nueva Ventana</label>

                                                                             <input type="radio" class="btn-check" name="tabsOptions" id="sameTab" autocomplete="off" data-check="<?php echo $buttonCheck2; ?>"> 
                                                                             <label for="sameTab" class="btn btn-outline-secondary">Misma Ventana</label>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-sm-12">
                                                                        <div class="mb-3">
                                                                            <label for="btnUrl" class="btnUrl">URL del Boton</label>
                                                                            <input type="text"  class="form-control" id="btnUrl" placeholder="Escriba la url para el boton" value="<?php echo $buttonUrl; ?>">
                                                                        </div>
                                                                    </div>    
                                                                </div>
                                                         </div>
                                                    </div>
                                                </div>
                                        <div class="col-12 col-sm-12">
                                            <div class="divider"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                 </div>  
        </form> 
    </div>
</div>
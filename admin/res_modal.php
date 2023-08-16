<!--Modal-->
<div class="modal modalData" id="Modalpopup" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Creando el popup</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="text-center">
            Inserta el nombre para tu modal y haz click en guardar
        </p>
        <!--Formulario-->
        <form action="" method="post">
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Nombre</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="dataNom" data-id="<?php $id;?>" value="">
                </div>
            </div>
            <div class="divider">
                <div class="line"></div>
                    <div class="res-data-button">
                        <a href="#" type="button" class="btn btn-primary" id="btnguardar">Guardar</a>
                </div>
            </div>
        </form>
         <!--Formulario-->
      </div>
    </div>
  </div>
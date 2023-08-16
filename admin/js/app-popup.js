/**
 * Archivo JS en la parte de administracion
 */
$ = jQuery.noConflict();


//Variables Globales
var modalNombre;
var modalId;
var popupNombre;
var popupid;

//Variables Globales para el Marco Multimedia.

var marco;
var imgDataEdit = $('.block-02 #imgFondo');
var imagen = $('.campo-imagen #imgFondo img');

         

//Ajax edit pop-up
var tituloDataEdit    = $('.block-02 #titulo');
var subtituloDataEdit = $('.block-02 #subtitulo');
var btnTitle          = $('#camposSwitch #btnText1');
var btnCheck          = $('#switch input[type=checkbox]');
var btnCheck1         = $('#camposSwitch #newTab');
var btnCheck2         = $('#camposSwitch #sameTab');
var btnUrl            = $('#camposSwitch #btnUrl');
var URLactual         = window.location;


$(document).ready(function(){
   $('#btn_crear').on('click', function(){ 
      var Modalpopup = new bootstrap.Modal(document.getElementById('Modalpopup'),{
         keyboard: false
       })
       Modalpopup.show();
   })
})


//Boton guardar PopUp
$(document).ready(function(){
   $('.modalData #btnguardar').on('click', function(){ 
      modalNombre = $('.modalData #dataNom').val();
      modalId = Math.floor(Math.random()*100);

      //Guarda los datos del modal accede a la variable del Archivo "res-archivos.php" wp_localize_script
      $.ajax({
         url: dataPopup.url,
         type:'post',
         dataType:'json',
         data:{
            action:  'res_data_popup',
            nonce:    dataPopup.seguridad,
            nombre:   modalNombre,
            id:       modalId,
            tipo:    'add',
            datos_u:  dataPopup.objeto   
         },
         
         success: function(res){
            console.log(res.objeto);
            console.log(res.datos_u);

          setTimeout(function(){
                  var Modalpopup = new bootstrap.Modal(document.getElementById('Modalpopup'),{
                     keyboard: false
                  })
                  Modalpopup.hide();
            }, 1500);

          location.href ="?page=res_popup&edit=" + modalNombre + "&id=" + modalId;
                            
         }
      })
   })
})


//Boton para Editar pop-up redirige a la pagina del popup
$(document).ready(function(){
   
   $('#tableId tr #btn_editar').on('click',function(){
      var item = $(this);
      var tr   = item.parent().parent();
      popupNombre = tr.attr('data-nombre');
      popupId     = tr.attr('id');
      location.href = "?page=res_popup&edit=" + popupNombre + "&id=" + popupId;
   })
})



//Boton para volver atras
$(document).ready(function(){
   $('#volverAtras').on('click',function(){
      location.href = "?page=res_popup";
   })
})


//Boton Switch para habilitar mas opciones

$(document).ready(function(){
  

   $('.switch').on('click', function(){
      var check = $('#switch input[type=checkbox]');
      if(check.is(':checked')){
         $('#camposSwitch').show(1000);
      } else{
         $('#camposSwitch').hide(1000); 
      }
   })
})



//Crea Marco multimedia.

$(document).ready(function(){
    $('#imgFondo').on('click',function(e){
         e.preventDefault();

         if(marco){
            marco.open();
            return
         }

         marco = wp.media({
            frame:  'select',
            titulo: 'Seleccionar imagen para el popup',
            button: {
                 text: 'usar esta imagen'
            },
            multiple: false,
            library:  {
               type: 'image'
            }
         })

         marco.on('select',function(){
            var imgPopup  = marco.state().get('selection').first().toJSON();
            var urlLimpia = limpiar_ruta(imgPopup.url);
            imgDataEdit.val(urlLimpia);
            imagen.attr('src',urlLimpia);   
         })
         marco.open();

    })
})

//Limpiar la Ruta 
function limpiar_ruta(url){
   //Servidor Local
   var local = /restaurante.local/;
      if(local.test(local)){
         var url_pathname = location.pathname;
         var indexPost    = url_pathname.indexOf('wp-admin');
         var url_post     = url_pathname.substring(0, indexPost);
         var url_delete   = location.protocol + '//' + location.host + url_post;
         return url_post + url.replace(url_delete,'');
      }else{
         //Servidor remoto
         var url_real = location.protocol + '//' + location.hostname
         return url.replace(url_real,'');

      }

}


//Ajax Edit Pop-up
$(document).ready(function(){

   $('.block-02 #btnSave').on('click', function(){

      var titulo        = tituloDataEdit.val();
      var subtitulo     = subtituloDataEdit.val();
      var imagenUrl     = imgDataEdit.val();
      var textDataEdit  = tinyMCE.activeEditor.getContent();
      var dataNombre    = $(this).attr('data-nombre');
      var buttonCheck   = btnCheck.is(':checked');
      var buttonTitle   = btnTitle.val();
      var buttonCheck1  = btnCheck1.is(':checked');
      var buttonCheck2  = btnCheck2.is(':checked');
      var buttonUrl     = btnUrl.val();

      $.ajax({
         url:       dataCreatePopup.url,
         type:     'post',
         dataType: 'json',
         data:{
               action:       'res_create_popup',
               nonce:         dataCreatePopup.seguridad,
               nombre:        dataNombre,
               titulo:        titulo,
               subtitulo:     subtitulo,
               imagen:        imagenUrl,
               texto:         textDataEdit,
               buttonCheck:   buttonCheck,
               buttonTitle:   buttonTitle,
               buttonCheck1:  buttonCheck1,
               buttonCheck2:  buttonCheck2,
               buttonUrl:     buttonUrl,
               tipo:          'create'
         }, 
            success: function(res){

               location.href = URLactual;
               console.log(res.data);
               console.log(res.objeto);
            }
      })


   })

})

//Funcion onload para las opciones del botón call to action
window.onload = function(){
   // Se recuperan los valores de la URL
   var valores = window.location.search;
   //Instanciamos la clase URLSearchParams y creamos el Objeto
   var urlParams = new URLSearchParams(valores);
   // Cerifica si existe un parametro
   var edit   = urlParams.has('edit');
   var idEdit = urlParams.has('id');

   var checkbox = $('#switch input[type=checkbox]');
   var validate = checkbox.attr('data-check');

   //Radio Buttons
   var radioButton1   = $('#camposSwitch #newTab');
   var validateRadio1 = radioButton1.attr('data-check');

   var radioButton2   = $('#camposSwitch #sameTab');
   var validateRadio2 = radioButton2.attr('data-check');





   //Convertimos el string true a un valor booleano

   validate = (validate === 'true');
   if(edit == true && idEdit == true){
         if(validate == true){
               checkbox.prop('checked', true);
         } else {
            checkbox.prop('checked', false);
            $('#camposSwitch').hide();
         }

         // validacion de Radio Buttons
         if(validateRadio1 == 'true'){
             radioButton1.prop('checked', true);
         } else{
             radioButton1.prop('checked', false);
         }

         if(validateRadio2 == 'true'){
            radioButton2.prop('checked', true);
        } else{
            radioButton2.prop('checked', false);
        }
   }
}


//Evento para Previsualizar Popup
$(document).ready(function(){
   $('#btnPreview').on('click', function(e){
      e.preventDefault();
         var titulo       = tituloDataEdit.val();
         var subtitulo    = subtituloDataEdit.val();
         var imgUrl       = imagen.attr('src');
         var texto        = tinyMCE.activeEditor.getContent();
         var buttonTitle  = btnTitle.val();
         var buttonCheck1 = btnCheck1.attr('data-check');
         var buttonUrl    = btnUrl.val();
         
         modal_edit(titulo, subtitulo, imgUrl, texto,buttonTitle, buttonCheck1, buttonUrl);
         console.log(imgUrl);


   })
})


//Funcion para añadir el popup

function modal_edit(titulo, subtitulo, imgUrl, texto,buttonTitle, buttonCheck1, buttonUrl){
   var ventana = '';
   if(buttonCheck1 == 'true'){
      ventana = '_blank';
   } else{
       ventana = '_self';
   }

   var html = '';

   html +='';
   html += `
   <!--Modal-->
   <div class="modal modalData" id="modalPreview" tabindex="-1">
     <div class="modal-dialog modal-dialog-centered">
       <div class="modal-content">
             <div class="row">
              <div class="col-4 col-sm-4">
                     <div class="class-imgFondo"  style="background-image: url(${imgUrl})"></div>
              </div>
   
              <div class="col-8 col-sm-8">
               <div class="row mb-3 mt-2">
                  <div class="col-12 col-sm-12 d-flex justify-content-end pd-btnclose">
                         <div class="col-1">
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close">
                              <div class="boton-close">
                                <span aria-hidden="true">x</span>
                              </div>
                           </button>
                         </div>
                  </div>
               </div>
                 <div class="mb-4 row">
                       <div class="col-12 pd-textmodal">
                               <div class="content-popup text-center">
                                   <h4>${titulo}</h4>
                                   <h6>${subtitulo}</h6>
                                    <p>
                                       ${texto}
                                    </p>
                               </div>
                       </div>
                 </div>
                 <div class="mb-5 row">
                   <div class="col-12 pd-text-modal btn-callAction text-center">
                       <a href="${buttonUrl}" class="btn btn-success" target="${ventana}">
                           <span>${buttonTitle}</span>
                       </a>
                   </div>
                 </div>
              </div>
         </div>
         
       </div>
     </div>
   </div>`;
   $('.page-edit-popup').append(html);
  // Abre modal
   var Modalpopup = new bootstrap.Modal(document.getElementById('modalPreview'),{
      keyboard: false
    })
    Modalpopup.show();
}








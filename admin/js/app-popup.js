/**
 * Archivo JS en la parte de administracion
 */
$ = jQuery.noConflict();


//Variables Globales
var modalNombre;
var modalId;
var popupNombre;
var popupid;

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
         dataType: 'json',
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

            location.href ="?page=res_popup&edit=" + modalNombre + "&id" + modalId;
                            
         }
      })
   })
})
/**
 * @file A JavaScript file for the theme.
 * 
 * In order for this JavaScript to be loaded on pages, see the instructions in
 * the README.txt next to this file.
 */

// JavaScript should be made compatible with libraries other than jQuery by
// wrapping it with an "anonymous closure". See:
// - http://drupal.org/node/1446420
// - http://www.adequatelygood.com/2010/3/JavaScript-Module-Pattern-In-Depth
(function($, Drupal, window, document, undefined) {
  $.extend({
    getUrlVars : function() {
      var vars = [], hash;
      var hashes = window.location.href.slice(
          window.location.href.indexOf('?') + 1).split('&');
      for ( var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
      }
      return vars;
    },
    getUrlVar : function(name) {
      // example.com?param1=name&param2=&id=6
      // jQuery(".field-content
      // a").attr("href").val(jQuery(".field-content
      // a").attr("href")+"?page="+p);

      return $.getUrlVars()[name];
    }
  });

  // JQUERY READY
  $(document).ready(
      function() {
        // $(".download-file").find("a").html("Descargar");
        /**/
        $(".messagesxxx").dialog({
          dialogClass : "alert",
          modal : true,
          buttons : [ {
            text : "Ok",
            click : function() {
              $(this).dialog("close");
            }
          } ]
        });

        // PARA EL REPRODUCTOR PRINCIPAL AL ABRIR colorbox
        $(".colorbox-node").click(function() {
          if (jwplayer)
            jwplayer().stop();
        });

        // Elimina colorbox de los href
        $("a[href*='colorbox']").each(function() {
          this.href = this.href.replace('colorbox/', '');

        });

        // Redimensiona el popup pels videos
        $(document).bind(
            "cbox_complete",
            function() {
              $(".jwplayer-video").parents("#cboxLoadedContent")
                  .css("overflow", "hidden");
              parent.jQuery.colorbox.resize({
                height : 390
              });

            });
        
        //BUSCADOR BOTON
        $(".buscador input[type=submit]").attr('value',"");
        $("#search-api-page-search-form input[type=submit]").attr('value',"");

        //HIPICPORTA ACTIVE
        if (location.pathname.match(/profile-anunciante/)){
          $("li.menu-1831 a").addClass("active-trail active");
          $("li.menu-1831").addClass("active-trail active");          
        }
        
        
        $('.ctools-modal-content').attr('style', '');
        $('#modal-content').attr('style', '');
        // jQuery(".messages").dialog();
        // AMAGO
        // /user\/login/
        
        if (location.pathname.match(/user\/login/))
          $(".bloque-login-hipic a").trigger("click");
        if (location.pathname.match(/user\/register/))
          $("#modal_register a").trigger("click");
        if ($("body").hasClass('page-node-849login'))
          $(".bloque-login-hipic a").trigger("click");

        /*
         * AÑADO url param page=x para sincronizar los listados debajo
         * de los nodos ej: estas en pag=2 y abres un vínculo, se debe
         * mantener en pag=2
         */
        var ruta = $(".field-content a").attr("href");
        var pagina = $.getUrlVar('page');

        if (pagina != undefined){
          var nex = (ruta.indexOf("?") == -1) ? "?" : "&";
          $(".field-content a").each(function() {
            ruta = $(this).attr("href");
            if (ruta && ruta.indexOf("page") != -1)
              $(this).attr("href", ruta + nex + "page=" + pagina);
          });
        }

        $("#portal-detalle-empresa-tabs").tabs();

        $("#edit-profile-anunciante-facturacion-field-documento-main-es").change(function() {
          var op = $(this).val();
          if (op != 143) {
            $("#edit-profile-anunciante-facturacion-field-nif-und-0-nif").val("");
            $('.form-item-profile-anunciante-facturacion-name-field-es-0-value label').html(Drupal.t('Name'));
          }
          else {
            $('.form-item-profile-anunciante-facturacion-name-field-es-0-value label').html(Drupal.t('Authorized person or proxy name'));
          }
        });
        $("#edit-profile-anunciante-facturacion-field-documento-main-es").trigger('change');

        //PLACEHOLDER BUSCADORS
        $(".buscador-general input").attr("placeholder",Drupal.t("Search on the web..."));
        $("#search-api-page-search-form-buscador-videos-pagina input").attr("placeholder","Search videos...");
        $("#search-api-page-search-form-result-buscador-noticias input").attr("placeholder","Search news...");
        $("#search-api-page-search-form-buscador-eventos input").attr("placeholder","Search events...");
        $("#search-api-page-search-form-buscador2-market input").attr("placeholder", Drupal.t("Search on") + " hipicmarket...");
        $("#search-api-page-search-form-buscador-hipicportal input").attr("placeholder","Search...");

        $("textarea").attr("maxlength","200");

      }); // JQUERY READY
})(jQuery, Drupal, this, this.document);

//SUBMIT SERMEPA
function calc() {
  document.getElementById('edit-submit').style.display = 'none';
  vent = window.open(
          '',
          'tpv',
          'width=725,height=750,scrollbars=no,resizable=yes,status=yes,menubar=no,location=no');
  // vent.moveTo(eje_x,eje_y);
  jQuery("#hipic-sermepa-prepara-form").submit(); 
}

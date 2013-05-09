(function ($) {

  Drupal.behaviors.HipicCustomizations = {
    attach: function (context, settings) {
      $('.views-widget-filter-field_evento_categoria_tid_i18n', context).once('HipicCustomizations', function () {
        var submit = $(this).parent('.views-exposed-widgets').find('input.form-submit');
        $(this).find('.form-type-radio label').click(function() {
          var input_value = $(this).prev().val();
          submit.click();
        });
      });
    }
  };

})(jQuery);

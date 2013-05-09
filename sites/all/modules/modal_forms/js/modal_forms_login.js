(function ($) {

Drupal.behaviors.initModalFormsLogin = {
  attach: function (context, settings) {
    $("a[href*='/user/login'], a[href*='?q=user/login']", context).once('init-modal-forms-login', function () {
      this.href = this.href.replace(/user\/login/,'modal_forms/nojs/login');
      
  	jQuery('.ctools-modal-content').attr('style','');
	jQuery('#modal-content').attr('style','');
  
    }).addClass('ctools-use-modal ctools-modal-modal-popup-small');    
  }
};

})(jQuery);

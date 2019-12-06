var wp_scripts = (function () {
  'use strict';

  jQuery(window).ready(function($){
    var nextBtn = $("#wpmc-next");

    if (nextBtn && nextBtn.length > 0) {
      var cloneBtn = nextBtn.clone();

      cloneBtn.attr('id', "wpmc-next-clone");
      cloneBtn.appendTo(nextBtn.parent());
      nextBtn.attr('style','display:none !important');
      
      cloneBtn.on('click', function(e) {
        var formInputs = $('.wpmc-step-billing .woocommerce-billing-fields > input:text');
        formInputs.removeClass('error');
        var emptyInputs = formInputs.filter(function() { return $(this).val() == ""; });
        var isValid = true;
        if (emptyInputs.length > 0) {
          emptyInputs.addClass('error');
          isValid = false;
        } 

        if (!$('#phone').val().match(/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im)) {
          $('#phone').addClass('error');
          isValid = false;
        }

        if (!$('#email').val().match(/\S+@\S+\.\S+/)) {
          $('#email').addClass('error');
          isValid = false;
        }

        if (!isValid) {
          return false;
        }

        cloneBtn.remove();
        nextBtn.removeAttr('style');
        nextBtn.trigger('click');
      });
    }
  });

  var scripts = {

  };

  return scripts;

}());

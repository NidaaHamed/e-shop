$(function(){
  'use strict';
  //Hide Placeholder On Form Focus
  $('[placeholder]').focus(function() {
    $(this).attr('data-text',$(this).attr('placeholder'));
    $(this).attr('placeholder','');
  }).blur(function(){
    $(this).attr('placeholder',$(this).attr('data-text'));
  });

   $('#eye').click(function(){
        if($(this).hasClass('fa-eye-slash')){

          $(this).removeClass('fa-eye-slash');

          $(this).addClass('fa-eye');

          $('#password').attr('type','text');

        }else{

          $(this).removeClass('fa-eye');

          $(this).addClass('fa-eye-slash');

          $('#password').attr('type','password');
        }
    });

    $('.confirm').click(function(){
      return confirm('Are You Sure');
    });

});

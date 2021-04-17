$(document).ready(function(){
  //banner owl OwlCarousel2
  $("#banner-area .owl-carousel").owlCarousel({
    dots:true,
    items:1
  });

  //top sale owl owlCarousel
  $("#top-sale .owl-carousel").owlCarousel({
    loop:true,
    nav:true,
    dots:false,
    responsive:{
      0:{
        items:1
      },
      470:{
        items:2
      },
      650:{
        items:3
      },
      920:{
        items:4
      },
      1100:{
        items:5

      }
    }
  });


  //isotope filter
  var $grid = $(".grid").isotope({
    itemSelector:'.grid-item',
    layoutMode:'fitRows'
  });

  //filter items on button click
  $(".button-group").on("click","button",function(){
    var filterValue=$(this).attr("data-filter");
    $grid.isotope({filter:filterValue});
  });

  //top sale owl owlCarousel
  $("#new-products .owl-carousel").owlCarousel({
    loop:true,
    nav:false,
    dots:true,
    responsive:{
      0:{
        items:1
      },
      470:{
        items:2
      },
      650:{
        items:3
      },
      920:{
        items:4
      },
      1100:{
        items:5

      }
    }
  });

  //blogs owlCarousel
  $("#blogs .owl-carousel").owlCarousel({
    loop:true,
    nav:false,
    dots:true,
    responsive:{
      0:{
        items:1
      },
      600:{
        items:3
      }
    }
  });

  //product quantity section
  let $qty_up=$(".qty .qty-up");
  let $qty_down=$(".qty .qty-down");


  //click on qty up button
  $qty_up.click(function(e){
    let $input=$(`.qty_input[data-id='${$(this).data("id")}']`);
    if ($input.val()>=1 && $input.val()<=9) {
      $input.val(function(i,oldval){
        return ++oldval;
      });
    }
  });

  //click on qty down button
  $qty_down.click(function(e){
    let $input=$(`.qty_input[data-id='${$(this).data("id")}']`);
    if ($input.val()>1 && $input.val()<=10) {
      $input.val(function(i,oldval){
        return --oldval;
      });
    }
  });

  //Hide Placeholder On Form Focus
  $('[placeholder]').focus(function() {
    $(this).attr('data-text',$(this).attr('placeholder'));
    $(this).attr('placeholder','');
  }).blur(function(){
    $(this).attr('placeholder',$(this).attr('data-text'));
  });

});

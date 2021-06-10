$("#back_top").click(function(){
   document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
});
$("#close_prod").click(function(){
     $("#show_item").fadeOut();   
    $("#slider").fadeIn();
    $("#product_list").fadeIn();
    $("#footer").fadeIn();
});
$("#btn_cart").click(function(){
    $("#slider").fadeOut();
    $("#product_list").fadeOut();
    $("#footer").fadeOut();
    $("#cart").fadeIn();
    $("#cart1").trigger("click");
});
$("#close_cart").click(function(){
     $("#cart").fadeOut();   
    $("#slider").fadeIn();
    $("#product_list").fadeIn();
    $("#footer").fadeIn();
});

$(".product").click(function(){
    $("#slider").fadeOut();
    $("#product_list").fadeOut();
    $("#footer").fadeOut();
    $("#show_item").fadeIn();
});
$("#home").click(function(){
    $("#register").fadeOut();
    $("#login").fadeOut();
    $("#seller").fadeOut();    
    $("#slider").fadeIn();
    $("#product_list").fadeIn();
    $("#footer").fadeIn();
    $("#back_top").trigger("click");    
});
$("#dd_login").click(function(){
    $("#register").fadeOut();
    $("#seller").fadeOut();    
    $("#slider").fadeOut();
    $("#product_list").fadeOut();
    $("#footer").fadeOut();
    $("#login").fadeIn();
 });

$("#dd_register").click(function(){
    $("#login").fadeOut();
    $("#seller").fadeOut();    
    $("#slider").fadeOut();
    $("#product_list").fadeOut();
    $("#footer").fadeOut();
    $("#register").fadeIn();
 });
$("#dd_seller").click(function(){
    $("#login").fadeOut();
    $("#register").fadeOut();        
    $("#slider").fadeOut();
    $("#product_list").fadeOut();
    $("#footer").fadeOut();
    $("#seller").fadeIn();
 });
$("#cart_menu h5").click(function(){
    console.log("hello");
    $("#cart_menu h5").removeClass("selected");
    $(this).addClass("selected");
  $(".page").addClass("hide"); $("#page_"+this.id).removeClass("hide");
});

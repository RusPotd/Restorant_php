$(document).ready(function() {
    $("#home").trigger("click");
});
$(".seller_menu").click(function(){
    console.log(this.id);
   $(".s_page").addClass("hide");
    $(".seller_menu").removeClass("active");
    $(this).addClass("active");
    $("#"+this.id+"_page").removeClass("hide");
});

$("#s_btn_checkout").click(function(){
    $("#checkout").trigger("click");
});
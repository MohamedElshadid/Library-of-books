/*global $, alert, console*/

$(function () {
    
    'use strict';
    
    // Swaper
        var swiper = new Swiper('.swiper-container', {
      effect: 'coverflow',
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: 'auto',
      coverflowEffect: {
        rotate: 60,
        stretch: 0,
        depth: 150,
        modifier: 2,
        slideShadows : true,
      },
      pagination: {
        el: '.swiper-pagination',
      },
    });
    
});
// Wrap every letter in a span
$('.ml6 .letters').each(function(){
  $(this).html($(this).text().replace(/([^\x00-\x80]|\w)/g, "<span class='letter'>$&</span>"));
});
$(".like").on('click',function(e){
    console.log(this);
    $.ajax({
        type: "GET",
        url: "/addFav",
        data: {
            bookID: $(this).data('target')
        },
       
        success: (response) => {
            
            $(this).toggleClass("fa-heart fa-heart-o");
        },
        error: function(response) {
            // alert the error if any error occured
            alert(response);
        }
    });
});

$(".deleteRecord").click(function(){
    var id = $(this).data("id");
    var token = $("meta[name='csrf-token']").attr("content");
   
    $.ajax(
    {
        url: "/category/bookDestroy/"+id,
        type: 'POST',
        data: {
            "id": id,
            "_token": token,
        },
        success: function (){
            console.log("it Works");
        }
    });
   
});
$(document).ready(function () {

    $("body").on("click","#deleteComment",function(e){
   
       e.preventDefault();
       var id = $(this).data("id");
       var $ele = $(this).parent().parent();
       var token = $("meta[name='csrf-token']").attr("content");
       var url = e.target;
   
       $.ajax(
           {
             url: url.href, //or you can use url: "company/"+id,
             type: 'GET',
             data: {
               _token: token,
                   id: id
           },
           success: function (response){
            $ele.fadeOut().remove();
           }
        });
         return false;
      });
       
   
   });
   $(document).ready(function () {

    $("body").on("click","#deleteBook",function(e){
   
       e.preventDefault();
       var id = $(this).data("id");
       var $ele = $(this).parent().parent().parent().parent();
       var token = $("meta[name='csrf-token']").attr("content");
       var url = e.target;
   
       $.ajax(
           {
             url: url.href, //or you can use url: "company/"+id,
             type: 'GET',
             data: {
               _token: token,
                   id: id
           },
           success: function (response){
            $ele.fadeOut().remove();
           }
        });
         return false;
      });
       
   
   });
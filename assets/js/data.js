$(document).ready(function() {
    // $('.one-time').slick({
    //     dots: true,
    //     infinite: true,
    //     speed: 300,
    //     slidesToShow: 1,
    //     adaptiveHeight: true,
    //     arrows: false
    // });

    // $('.testimonialslider').slick({
    //     dots: false,
    //     infinite: true,
    //     speed: 300,
    //     slidesToShow: 4,
    //     arrows: true,
    //     slidesToScroll: 1,
    //     centerPadding: '60px',
    //     prevArrow: '<button type="button" class="slick-custom-arrow slick-prev"> <i class="fa fa-angle-left" aria-hidden="true"></i> </button>',

    //     nextArrow: '<button type="button" class="slick-custom-arrow slick-next">  <i class="fa fa-angle-right" aria-hidden="true"></i> </button>',
    //     responsive: [{
    //             breakpoint: 991,
    //             settings: {
    //                 slidesToShow: 3,
    //                 slidesToScroll: 1,
    //                 infinite: true,
    //                 dots: true
    //             }
    //         },
    //         {
    //             breakpoint: 600,
    //             settings: {
    //                 slidesToShow: 2,
    //                 slidesToScroll: 2
    //             }
    //         },
    //         {
    //             breakpoint: 480,
    //             settings: {
    //                 slidesToShow: 1,
    //                 slidesToScroll: 1
    //             }
    //         }
    //     ]
    // });

    $('.customtabs li').click(function() {
        // console.log("hello");
        var tab_id = $(this).attr('data-tab');
        // console.log(tab_id);
        $(".cartab-link.carcurrent").removeClass('carcurrent');
        $('.featuredcar.featuredblock').removeClass('featuredblock');

        $(this).addClass('carcurrent');
        $("#" + tab_id).addClass('featuredblock');
    });
    $('.productcarslide').slick({
        dots: true,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        adaptiveHeight: true,
        arrows: false
    });


    $('.producttabs li').click(function() {
        // console.log("hello");
        var tab_id = $(this).attr('data-tab');
        // console.log(tab_id);
        $(".productreview.prdtabblock").removeClass('prdtabblock');
        $('.prdsubpart.prdsubactive').removeClass('prdsubactive');

        $(this).addClass('prdtabblock');
        $("#" + tab_id).addClass('prdsubactive');
    });

    $('.variandown li').click(function() {
        $('.varainround.variantroundactive ').removeClass('variantroundactive');
        $(this).addClass('variantroundactive');

    });
    $("#navbar-toggle i").click(function() {
        // console.log('hello');
        $(".navbarcustom .navbar-nav").slideToggle();
    });

    // /collection page accordian

    $(function() {
        $('.acc__title').click(function(j) {
          
          var dropDown = $(this).closest('.acc__card').find('.acc__panel');
          $(this).closest('.acc').find('.acc__panel').not(dropDown).slideUp();
          
          if ($(this).hasClass('active')) {
            $(this).removeClass('active');
          } else {
            $(this).closest('.acc').find('.acc__title.active').removeClass('active');
            $(this).addClass('active');
          }
          
          dropDown.stop(false, true).slideToggle();
          j.preventDefault();
        });
      });


    $(".filtemobflex").on("click", function () {
  var clsbox = $('.filtersubtitlemobile');
  clsbox.toggleClass('boxclsactive'); 
  $('.clsoverlay').css("display","block");    
 });

 $(".fafaclose i").on("click", function () {
    // console.log("ckidwd");
    $('.clsoverlay').css("display","none");
    $('.filtersubtitlemobile.boxclsactive').removeClass('boxclsactive');
 });

 $(".sorticon").on("click", function () {
var sorcls = $('.sortcontain');
sorcls.toggleClass('sortcontainactive'); 
$('.clsoverlay').css("display","block"); 

 });

 $(".clsoverlay").on("click", function () {
    $('.clsoverlay').css("display","none"); 
    $('.sortcontain.sortcontainactive').removeClass('sortcontainactive');
 });

 $(".sortround .clsvarainround").on("click", function () {
    // console.log("clickevent");
    $('.clsvarainround.clsvariantroundactive ').removeClass('clsvariantroundactive');
    $(this).addClass('clsvariantroundactive');
  
});
   });
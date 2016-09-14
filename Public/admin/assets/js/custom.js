
/*=============================================================
    Authour URI: www.binarytheme.com
    License: Commons Attribution 3.0

    http://creativecommons.org/licenses/by/3.0/

    100% To use For Personal And Commercial Use.
    IN EXCHANGE JUST GIVE US CREDITS AND TELL YOUR FRIENDS ABOUT US
   
    ========================================================  */


(function ($) {
    "use strict";
    var mainApp = {

        metisMenu: function () {

            /*====================================
            METIS MENU 
            ======================================*/

            $('#main-menu').metisMenu();

        },


        loadMenu: function () {

            /*====================================
            LOAD APPROPRIATE MENU BAR
         ======================================*/

            $(window).bind("load resize", function () {
                if ($(this).width() < 768) {
                    $('div.sidebar-collapse').addClass('collapse')
                } else {
                    $('div.sidebar-collapse').removeClass('collapse')
                }
            });
        },
        slide_show: function () {

            /*====================================
           SLIDESHOW SCRIPTS
        ======================================*/

            $('#carousel-example').carousel({
                interval: 3000 // THIS TIME IS IN MILLI SECONDS
            })
        },
        reviews_fun: function () {
            /*====================================
         REWIEW SLIDE SCRIPTS
      ======================================*/
            $('#reviews').carousel({
                interval: 2000 //TIME IN MILLI SECONDS
            })
        },
        wizard_fun: function () {
            /*====================================
            //horizontal wizrd code section
             ======================================*/
            /*$(function () {
                $("#wizard").steps({
                    headerTag: "h2",
                    bodyTag: "section",
                    transitionEffect: "slideLeft"
                });
            });*/
            /*====================================
            //vertical wizrd  code section
            ======================================*/
           /* $(function () {
                $("#wizardV").steps({
                    headerTag: "h2",
                    bodyTag: "section",
                    transitionEffect: "slideLeft",
                    stepsOrientation: "vertical"
                });
            });*/
        },
       
        
    };
    $(document).ready(function () {
        mainApp.metisMenu();
        mainApp.loadMenu();
        mainApp.slide_show();
        mainApp.reviews_fun();
        mainApp.wizard_fun();
        $('#main-menu a').on('click',function(){
            sessionStorage.curMenu = $('#main-menu a').index($(this));
        });
        if(sessionStorage.curMenu){
            var $curMenu = $('#main-menu a').eq(sessionStorage.curMenu);
            var nav_second_level = false;
            var nav_third_level  = false;
                $curMenu.addClass('active-menu');
                if($curMenu.parent().parent().hasClass('nav-second-level')){
                    nav_second_level = true;
                }
                if($curMenu.parent().parent().hasClass('nav-third-level')){
                    nav_third_level = true;
                }
                if(nav_third_level){
                    $curMenu.parents('.nav-second-level').addClass('collpase in');
                    // $curMenu.parents('.nav-second-level').prev().addClass('active-menu-top');
                    $curMenu.parents('.nav-third-level').addClass('collpase in');
                    $curMenu.parents('.nav-third-level').prev().addClass('active-menu-top');
                    $curMenu.parents('.nav-third-level').parent().addClass('active');
                }
                if(nav_second_level){
                    $curMenu.parents('.nav-second-level').addClass('collapse in');
                    $curMenu.parents('.nav-second-level').prev().addClass('active-menu-top');
                    $curMenu.parents('.nav-second-level').parent().addClass('active');
                }
        }
       
    });
}(jQuery));
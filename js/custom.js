var resel, reselact, resel1, reselact1;

$(document).ready(function(){

    $("[data-toggle=modal]").on("click", function (e) {
        var $this = $(this);
        var $form = $($this.attr("data-target"));
        var caption = $this.data("caption");
        var text = $this.data("text");
        var type = $this.data("type");
        var button = $this.data("button");
        var info = $this.data("info");

        $form.find(".text").html(info);
        $form.find(".form__caption").text(caption);
        $form.find(".form__p").text(text);
        $form.find(".form__button").text(button);
        $form.find("input[name=type]").val(type);
    });

    $(".js-send").on("click", function (e) {
        e.preventDefault();
        var $form = $(this).parents("form");

        var formData = new FormData($form[0]);
        var phone = $form.find("input[name=phone]").val();
        if ((phone != "") && (phone != undefined)) {
            // отправляем событие

            // yaCounter54660379.reachGoal("form");
            // gtag('event', "Форма", {'event_category': "site", 'event_action': "form"});

            $.ajax({
                url: '/send-mail.php',
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                dataType: 'JSON',
                success: function (data) {

                }
            });

            $(".send-phone").text(phone);

            $(".modal").modal("hide");
            $("#thanks").modal("show");

            $form[0].reset();

        } else {
            alert("Пожалуйста, укажите корректный номер телефона, чтобы мы смогли с вами связаться");
        }
    });

    topNavigation();

    // dropdownHover();

    arrowUp();
    $('.arrow-up').click(function(){
        $('body,html').animate({ scrollTop: 0 }, 400);
    });

    if($("div").is(".swiper-container_result")) {
        var swiper = new Swiper('.swiper-container_result', {
            pagination: {
                el: '.swiper-pagination_result',
                type: 'progressbar'
            },
            navigation: {
                nextEl: '.swiper-button-next_result',
                prevEl: '.swiper-button-prev_result'
            }
        });

        resel = $(".swiper-slide_result").length;
        if(resel<10){
            resel = '0' + resel;
        }
        $('.result-navigation__count-text').text(resel);
        reselact = $('.swiper-container_result .swiper-slide-active').index();
        countSlider();

        swiper.on('slideChangeTransitionStart', function () {
            countSlider();
        });
    }

    if($("div").is(".swiper-container_review")) {
        var swiper1 = new Swiper('.swiper-container_review', {
            pagination: {
                el: '.swiper-pagination_review',
                type: 'progressbar'
            },
            navigation: {
                nextEl: '.swiper-button-next_review',
                prevEl: '.swiper-button-prev_review'
            }
        });

        resel1 = $(".swiper-slide_review").length;
        if(resel1<10){
            resel1 = '0' + resel1;
        }
        $('.review-navigation__count-text').text(resel1);
        reselact1 = $('.swiper-container_review .swiper-slide-active').index();
        countSlider1();

        swiper1.on('slideChangeTransitionStart', function () {
            countSlider1();
        });
    }


    vacancyBlock();

    contactScroll();

});

$(function () {
    var $formPhone = $("form input[name=phone]");
    $("#in4").mask("+9 (999) 999-9999");
});

$(function () {
    var $formPhone = $(".content input[name=phone]");
    $("#phone").mask("+9 (999) 999-9999");
});

$(function () {
    var $formPhone = $(".content input[name=phone]");
    $("#phone1").mask("+9 (999) 999-9999");
});

$(function () {
    var $formPhone = $(".content input[name=phone]");
    $("#phone2").mask("+9 (999) 999-9999");
});

$(window).on("resize", function(){
    var wwindow=$(window).width();
    if(wwindow>767&&$('#menuModal').hasClass('in')){
        $('#menuModal').modal('hide');
    }
});

$(window).on("scroll resize load", function() {
    topNavigation();
    arrowUp();
});


// function dropdownHover() {
//     var hDrop, hTopNav = 0;
//     $(".section-header .dropdown").mouseover(function() {
//         $(this).addClass('open');
//         hDrop = $(this).find('.dropdown-menu').outerHeight();
//         hTopNav = $('.top-navigation').outerHeight();
//         $('.top-navigation').height(hDrop+hTopNav-60);
//     })
//         .mouseout(function() {
//             $(this).removeClass('open');
//             $('.top-navigation').height('auto');
//     });
// }

function topNavigation() {
    if( $(window).scrollTop() > $(".top-navigation").outerHeight()) {
        $(".top-navigation").addClass("sticky");
    } else {
        $(".top-navigation").removeClass("sticky");
    }
}

function arrowUp() {
    if( $(window).scrollTop() > $(".section-top").outerHeight()) {
        $(".arrow-up").fadeIn();
    } else {
        $(".arrow-up").fadeOut();
    }
}

function vacancyBlock() {
    $('.result-item__link_vacancy').click(function(){
        if($(this).closest('.result-item_vacancy').hasClass('active')) {
            $(this).closest('.result-item_vacancy').removeClass('active');
            $(this).closest('.result-item_vacancy').find('.result-item__hide-box').slideUp('fast');
        }
        else {
            $('.result-item_vacancy').removeClass('active');
            $('.result-item__hide-box').slideUp('fast');
            $(this).closest('.result-item_vacancy').addClass('active');
            $(this).closest('.result-item_vacancy').find('.result-item__hide-box').slideDown('fast');
        }
    });
}

function contactScroll() {
    var cont;
    $('.contact-link').click(function(){
        $('#menuModal').modal('hide');
        cont = $('.contact').offset().top;
        $('body,html').animate({ scrollTop: cont }, 500);
    });
}

function countSlider() {
    reselact = $('.swiper-container_result .swiper-slide-active').index()+1;
    if(reselact<10){
        reselact = '0' + reselact;
    }
    $('.result-navigation__count-text_active').text(reselact);
}

function countSlider1() {
    reselact1 = $('.swiper-container_review .swiper-slide-active').index()+1;
    if(reselact1<10){
        reselact1 = '0' + reselact1;
    }
    $('.review-navigation__count-text_active').text(reselact1);
}
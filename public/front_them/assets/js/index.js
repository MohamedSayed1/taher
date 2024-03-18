function inVisible(element) {
    //Checking if the element is
    //visible in the viewport
    var WindowTop = $(window).scrollTop();
    var WindowBottom = WindowTop + $(window).height();
    var ElementTop = element.offset().top;
    var ElementBottom = ElementTop + element.height();
    //animating the element if it is
    //visible in the viewport
    if ((ElementBottom <= WindowBottom) && ElementTop >= WindowTop)
        animate(element);
}

function animate(element) {
    //Animating the element if not animated before
    if (!element.hasClass('ms-animated')) {
        var maxval = element.data('max');
        var html = element.html();
        element.addClass("ms-animated");
        $({
            countNum: element.html()
        }).animate({
            countNum: maxval
        }, {
            //duration 5 seconds
            duration: 5000,
            easing: 'linear',
            step: function() {
                element.html(Math.floor(this.countNum) + html);
            },
            complete: function() {
                element.html(this.countNum + html);
            }
        });
    }

}

//When the document is ready
$(function() {
    //This is triggered when the
    //user scrolls the page
    $(window).scroll(function() {
        //Checking if each items to animate are
        //visible in the viewport
        $("h2[data-max]").each(function() {
            inVisible($(this));
        });
    })
});

// Slider
const swiper = new Swiper('.swiper', {
    // Optional parameters
    direction: 'horizontal',
    loop: true,
    clickable: true,
    centeredSlides: true,
    autoplay: true,
    breakpoints: {
        640: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 40,
        },
        1024: {
            slidesPerView: 3,
            spaceBetween: 50,
        },
    },
    // If we need pagination
    pagination: {
        el: '.swiper-pagination',
    },
});

const onlySwiper = new Swiper('.one-slide', {
    // Optional parameters
    direction: 'horizontal',
    loop: false,
    clickable: true,
    centeredSlides: true,
    autoplay: false,
    breakpoints: {
        640: {
            slidesPerView: 1,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        1024: {
            slidesPerView: 2,
            spaceBetween: 0,
        },
    },
    // If we need pagination
    pagination: {
        el: '.swiper-pagination',
    },
});

const moreSwiper = new Swiper('.more-slide', {
    // Optional parameters
    direction: 'horizontal',
    loop: true,
    clickable: true,
    centeredSlides: true,
    autoplay: false,
    breakpoints: {
        640: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 40,
        },
        1024: {
            slidesPerView: 2,
            spaceBetween: 50,
        },
    },
    // If we need pagination
    pagination: {
        el: '.swiper-pagination',
    },
});


// Toggle Passwords Visibility

$(document).on('click', '#login-password-btn', function() {
    $("#login-eye-icon").toggleClass("fa-eye fa-eye-slash");
    var input = $("#login-password");
    input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
});

$(document).on('click', '#signup-password-btn', function() {
    $("#signup-eye-icon").toggleClass("fa-eye fa-eye-slash");
    var input = $("#signup-password");
    input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
});

$(document).on('click', '#signup-confirm-password-btn', function() {
    $("#signup-confirm-eye-icon").toggleClass("fa-eye fa-eye-slash");
    var input = $("#signup-confirm-password");
    input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
});

$(document).on('click', '#reset-password-eye-btn', function() {
    $("#reset-password-eye-icon").toggleClass("fa-eye fa-eye-slash");
    var input = $("#reset-password-input");
    input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
});

$(document).on('click', '#reset-confirm-password-btn', function() {
    $("#reset-confirm-password-icon").toggleClass("fa-eye fa-eye-slash");
    var input = $("#reset-confirm-password");
    input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
});

// Change Password

$(document).on('click', '#change-current-password-btn', function() {
    $("#change-current-password-icon").toggleClass("fa-eye fa-eye-slash");
    var input = $("#change-current-password");
    input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
});

$(document).on('click', '#change-new-password-btn', function() {
    $("#change-new-password-icon").toggleClass("fa-eye fa-eye-slash");
    var input = $("#change-new-password");
    input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
});

$(document).on('click', '#change-confirm-password-btn', function() {
    $("#change-confirm-password-icon").toggleClass("fa-eye fa-eye-slash");
    var input = $("#change-confirm-password");
    input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
});

// Toggle packages and offers

$(document).on('click', '#packages-btn', function() {
    $("#packages-btn").addClass('active');
    $("#offers-btn").removeClass('active');
    $("#packages-cards").css('display', 'flex');
    $("#offers-cards").css('display', 'none');
});

$(document).on('click', '#offers-btn', function() {
    $("#offers-btn").addClass('active');
    $("#packages-btn").removeClass('active');
    $("#offers-cards").css('display', 'flex');
    $("#packages-cards").css('display', 'none');
});

// Toggle Profile Tabs

$(document).on('click', '#personal-info', function() {
    $("#personal-info").addClass('active');
    $("#personal-sub").removeClass('active');
    $("#personal-password").removeClass('active');
    $("#personal-info-wrapper").css('display', 'flex');
    $("#personal-sub-wrapper").css('display', 'none');
    $("#personal-password-wrapper").css('display', 'none');
});

$(document).on('click', '#personal-sub', function() {
    $("#personal-sub").addClass('active');
    $("#personal-info").removeClass('active');
    $("#personal-password").removeClass('active');
    $("#personal-sub-wrapper").css('display', 'flex');
    $("#personal-info-wrapper").css('display', 'none');
    $("#personal-password-wrapper").css('display', 'none');
});

$(document).on('click', '#personal-password', function() {
    $("#personal-password").addClass('active');
    $("#personal-sub").removeClass('active');
    $("#personal-info").removeClass('active');
    $("#personal-password-wrapper").css('display', 'flex');
    $("#personal-sub-wrapper").css('display', 'none');
    $("#personal-info-wrapper").css('display', 'none');
});

// Tests Style Toggle

$(document).on('click', '#grid-btn', function() {
    $(".test-card").each(function(index, element) {
        console.log(element);
        $(element).removeClass("col-lg-4 col-md-6 col-sm-12");
        $(element).addClass("col-lg-3 col-md-3 col-sm-6");
    });
    $(".test-long-wrapper").each(function(index, element) {
        $(element).removeClass("test-long-wrapper");
        $(element).addClass("test-card-wrapper");
    });
});

$(document).on('click', '#lines-btn', function() {
    $(".test-card").each(function(index, element) {
        console.log(element);
        $(element).addClass("col-lg-4 col-md-6 col-sm-12");
        $(element).removeClass("col-lg-3 col-md-3 col-sm-6");
    });
    $(".test-card-wrapper").each(function(index, element) {
        $(element).addClass("test-long-wrapper");
        $(element).removeClass("test-card-wrapper");
    });
});

// Result Progress
var value = $('.result-progress').attr('data-value');
var left = $('.result-progress').find('.progress-left .progress-bar');
var right = $('.result-progress').find('.progress-right .progress-bar');

if (value > 0) {
    if (value <= 50) {
        right.css('transform', 'rotate(' + percentageToDegrees(value) + 'deg)')
    } else {
        right.css('transform', 'rotate(180deg)')
        left.css('transform', 'rotate(' + percentageToDegrees(value - 50) + 'deg)')
    }
}

function percentageToDegrees(percentage) {

    return percentage / 100 * 360

}

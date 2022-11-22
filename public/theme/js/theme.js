const feedback = document.querySelector('.feedback__slider');
const feedback_offset = 300;

function feedbackUpdateHeight(height) {
    if (!height) return false;
    feedback.style.height = `${height + feedback_offset}px`;
}

if (feedback) {
    feedbackUpdateHeight(feedback.querySelector('.feedback__item').offsetHeight);

    const feedback_slider = new Swiper(feedback, {
        direction: 'vertical',
        slidesPerView: 'auto',
        autoHeight: true,
        centeredSlides: true,
        spaceBetween: 30,
        grabCursor: true,
        loop: false,
        mousewheel: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });

    feedback_slider.on('slideChange', () => {
        setTimeout(() => {
            feedbackUpdateHeight(feedback_slider.slides[feedback_slider.activeIndex].offsetHeight);
        }, 300);
    });
}

var swiper = new Swiper('.blog-slider', {
    spaceBetween: 30,
    effect: 'fade',
    loop: true,
    mousewheel: {
        invert: false,
    },
    breakpoints: {
        640: {
            slidesPerView: 1,
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
    // autoHeight: true,
    pagination: {
        el: '.blog-slider__pagination',
        clickable: true,
    }
});


// Owlcarousel
var swiper = new Swiper(".mySwiper", {
    slidesPerView: 4,
    initialSlide: 2,
    loop: true,
    centeredSlides: true,
    watchOverflow: false,
    responsive: true,
    breakpoints: {
        640: {
            slidesPerView: 1,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 1,
            spaceBetween: 40,
        },
        1024: {
            slidesPerView: 1,
            spaceBetween: 50,
        },


    },
    spaceBetween: 30,

    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});


$(function () {


    $('.form_ajaxi').submit(function (event) {
        $(".loader").show();

        event.preventDefault();

        $.ajax({
            url: $(this).attr("action"),
            type: $(this).attr("method"),
            data: $(this).serialize(),
            headers: {
                "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr('content')
            },
            success: function (result) {
                //$('.form_ajaxi').trigger("reset");
                if (result.success) {

                    toastr.success(result.success);

                    if (result.url == 'reload') {

                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    } else if (result.url) {
                        setTimeout(function () {
                            window.location = result.url;
                        }, 2000);
                    }


                } else if (result.error) {
                    toastr.error(result.error);
                } else {
                    alert(data);
                }

                $(".loader").hide();

            }

        });

    });
});

toastr.options = {
    "rtl": true,
    "closeButton": true,
    "debug": true,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-bottom-left",
    "preventDuplicates": true,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}


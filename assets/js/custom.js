jQuery(document).ready(function ($) {
    $(".r-p-slider-container").slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        prevArrow:
            '<div class="slide-arrow prev-arrow"></div>',
        nextArrow:
            '<div class="slide-arrow next-arrow"></div>',
    })
});
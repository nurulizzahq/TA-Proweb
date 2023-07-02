$(".owl-carousel").owlCarousel({
    loop: false,
    margin: 10,
    auto: true,
    responsiveClass: true,
    responsive: {
        0: {
            items: 1,
            nav: false,
        },
        600: {
            items: 2,
            nav: false,
        },
        1000: {
            items: 3,
            nav: false,
        },
    },
});

import Splide from '@splidejs/splide';

window.addEventListener('load', function () {
    let mainNavigation = document.getElementById('primary-navigation')
    let mainNavigationToggle = document.getElementById('primary-menu-toggle')

    if(mainNavigation && mainNavigationToggle) {
        mainNavigationToggle.addEventListener('click', function (e) {
            e.preventDefault()
            mainNavigation.classList.toggle('hidden')
        })
    }
})

document.addEventListener( 'DOMContentLoaded', function () {

    var elms = document.getElementsByClassName( 'hero-splide' );
    for ( var i = 0; i < elms.length; i++ ) {
        new Splide( elms[ i ], {
            type: 'loop',
            speed: 700,
            interval: 4000,
            autoplay: true,
        } ).mount();
    }

    var elms = document.getElementsByClassName( 'logo-splide' );
    for ( var i = 0; i < elms.length; i++ ) {
        new Splide( elms[ i ], {
            type: 'loop',
            speed: 700,
            interval: 4000,
            autoplay: true,
            perPage: 4,
            perMove: 1,
            breakpoints: {
                480: {
                    perPage: 1,
                },
                782: {
                    perPage: 2,
                },
                960: {
                    perPage: 3,
                },
                1280: {
                    perPage: 4,
                },
                1440: {
                    perPage: 4,
                },
            },
        } ).mount();
    }

    var elms = document.getElementsByClassName( 'testimonials-splide' );
    for ( var i = 0; i < elms.length; i++ ) {
        new Splide( elms[ i ], {
            type: 'loop',
            speed: 700,
            interval: 4000,
            autoplay: true,
        } ).mount();
    }

    var elms = document.getElementsByClassName( 'info-block-splide' );
    for ( var i = 0; i < elms.length; i++ ) {
        new Splide( elms[ i ], {
            type: 'loop',
            speed: 700,
            interval: 4000,
            autoplay: true,
            perPage: 3,
            perMove: 1,
            padding: '7%',
            lazyLoad: true,
            breakpoints: {
                480: {
                    perPage: 1,
                },
                782: {
                    perPage: 2,
                },
            },
        } ).mount();
    }
} );
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.css');
require('bootstrap/dist/css/bootstrap.min.css');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');
require('popper.js');
require('bootstrap');

require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');


import ScrollReveal from 'scrollreveal';
ScrollReveal().reveal('.fade-in', {
    distance: '110%',
    origin: 'bottom',
    delay: 200,
    duration: 500,
    reset: true
});
ScrollReveal().reveal('.fade-right', {
    distance: '110%',
    origin: 'right',
    delay: 400,
    duration: 800,
    reset: true
});
ScrollReveal().reveal('.fade-left', {
    distance: '110%',
    origin: 'left',
    delay: 200,
    duration: 800,
    reset: true
});

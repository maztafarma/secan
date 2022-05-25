const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js([
    'resources/js/app.js',
    'public/js/front.js',
    'public/vendors/jquery-ajax-form-submit/jquery.form.min.js',
], 'public/js/secan_plugins.js')
    .js([
        'resources/js/app.js',
        'public/vendors/fastclick/lib/fastclick.js',
        'public/vendors/nprogress/nprogress.js',
        'public/vendors/Chart.js/dist/Chart.min.js',
        'public/vendors/gauge.js/dist/gauge.min.js',
        'public/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js',
        'public/vendors/iCheck/icheck.min.js',
        'public/vendors/skycons/skycons.js',
        'public/vendors/Flot/jquery.flot.js',
        'public/vendors/Flot/jquery.flot.pie.js',
        'public/vendors/Flot/jquery.flot.time.js',
        'public/vendors/Flot/jquery.flot.stack.js',
        'public/vendors/Flot/jquery.flot.resize.js',
        'public/vendors/flot.orderbars/js/jquery.flot.orderBars.js',
        'public/vendors/flot-spline/js/jquery.flot.spline.min.js',
        'public/vendors/flot.curvedlines/curvedLines.js',
        'public/vendors/DateJS/build/date.js',
        'public/vendors/jqvmap/dist/jquery.vmap.js',
        'public/vendors/jqvmap/dist/maps/jquery.vmap.world.js',
        'public/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js',
        'public/vendors/moment/moment.js',
        'public/vendors/bootstrap-daterangepicker/daterangepicker.js',
        'public/vendors/HoldOn/src/js/HoldOn.js',
        'public/vendors/jquery-ajax-form-submit/jquery.form.min.js',
        'public/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js',
        'public/vendors/jquery.hotkeys/jquery.hotkeys.js',
        'public/vendors/google-code-prettify/src/prettify.js',
        'public/vendors/jquery-tokeninput/src/jquery.tokeninput.js',
        'public/vendors/select2/dist/js/select2.full.min.js',
        'public/js/custom_cms.js',
    ], 'public/js/cms.js')
    .styles([
        'public/vendors/bootstrap/dist/css/bootstrap.css',
        'public/css/style.default.css',
        'public/css/custom.css',
        'public/css/maps.css',
    ], 'public/css/secan_plugins.css')
    .styles([
        'public/vendors/bootstrap/dist/css/bootstrap.min.css',
        'public/vendors/font-awesome/css/font-awesome.min.css',
        'public/vendors/nprogress/nprogress.css',
        'public/vendors/iCheck/skins/flat/green.css',
        'public/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css',
        'public/vendors/jqvmap/dist/jqvmap.min.css',
        'public/vendors/bootstrap-daterangepicker/daterangepicker.css',
        'public/vendors/HoldOn/src/css/HoldOn.css',
        'public/vendors/google-code-prettify/bin/prettify.min.css',
        'public/vendors/select2/dist/css/select2.min.css',
        'public/vendors/jquery-tokeninput/styles/token-input.css',
        'public/vendors/jquery-tokeninput/styles/token-input-facebook.css',
        'public/vendors/jquery-tokeninput/styles/token-input-mac.css',
        'public/css/custom_cms.css',
    ], 'public/css/cms.css')
    .options({
        processCssUrls: false
    });;

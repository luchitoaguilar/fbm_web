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

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css');
    mix.copyDirectory('resources/js/modules', 'public/assets/js/modules');

const actualizar = false;

// if (!actualizar) {
//     if (mix.config) {
//         mix.options({
//             terser: {}
//         });
//     } else {
//         mix.copyDirectory('resources/js/modules', 'public/assets/js/modules');
//     }

//     // mix.copy('resources/js/ladda.js', 'public/assets/js/ladda.js');
//     // mix.copy('node_modules/vue-select/dist/vue-select.css', 'public/assets/css/vue-select.css');
//     // // mix.js('resources/js/app2.js', 'public/assets/js/app2.js');

//     // mix.version(['public/assets/js']);
//     // mix.version(['public/assets/css']);

// }

mix.copy('node_modules/sweetalert2/dist/', 'public/assets/plugins/sweetalert2/dist/');
mix.copy('node_modules/toastr/build/', 'public/assets/plugins/toastr/build/');
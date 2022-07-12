const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.js("resources/js/app.js", "public/js").postCss(
//     "resources/css/app.css",
//     "public/css",
//     [
//         //
//     ]
// );
// mix.js(
//     [
//         "public/theme/frontend/plinko/js/lib.js",
//         "public/theme/frontend/plinko/js/main.bundle.js",
//         "public/theme/frontend/plinko/js/gui.js",
//         "public/theme/frontend/plinko/js/plinko.js",
//     ],
//     "public/js"
// );
mix.browserSync("127.0.0.1:8000");

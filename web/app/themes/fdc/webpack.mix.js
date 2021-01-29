let mix = require('laravel-mix');
const tailwindcss = require('tailwindcss')

let atImport = require('postcss-import');
require('laravel-mix-purgecss');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */

mix
    .setPublicPath('assets')

    .js('src/js/app.js', 'js')

    .sass('src/sass/app.scss', '../build/css/app.css')
    .sass('src/sass/includes/_tailwind_utilities.scss', '../build/css/tailwind_utilities.css')

    // .purgeCss({
    //     enabled: mix.inProduction(),
    //     content: [
    //         './assets/**/*.blade.php',
    //         './assets/**/*.html',
    //         './src/js/**/*.js',
    //         './src/js/**/*.vue',
    //     ]
    // })

    .options({
        processCssUrls: false,
        postCss: [
            atImport(), tailwindcss('tailwind.config.js')],
    })

    // .sourceMaps(false, 'source-map')
    // .copy('build/js/*.js.map', './assets/js/')
    // .copy('build/css/*.css.map', './assets/css/')

    .combine(
        ['build/css/app.css', 'build/css/tailwind_utilities.css'],
        'assets/css/app.css'
    )

    .browserSync({
        proxy: 'faithdrivenconsumer.test',
        ui: false,
        files: ['./assets/js/**/*.js','./assets/css/app.css','./*.php','./inc/*.php','./page-templates/*.php','./loops/*.php'],
        watchOptions: {
            ignored: /node_modules/
        },
        // ignore: ['assets/js/*.js']
    })
    .webpackConfig({
        externals: {
            "jquery": "jQuery"
        }
    });
    // .autoload({
    //     jquery: ['$', 'window.jQuery'],
    // });

if (mix.inProduction()) {

    let colors = ['purple'];
    let WhiteListClasses = [
        "blockquote",
        "ul",
        "btn",
    ];
    for (var i = 0; i < colors.length; i++) {
        WhiteListClasses.push(
            'text-white',
            'hover:text-white',
            'bg-white',
            'hover:bg-white',
            'text-c-' + colors[i],
            'text-c-'+ colors[i] +'-light',
            'text-c-'+ colors[i] +'-lighter',
            'text-c-'+ colors[i] +'-dark',
            'text-c-'+ colors[i] +'-darker',
            'bg-c-'+ colors[i],
            'bg-c-'+ colors[i] +'-light',
            'bg-c-'+ colors[i] +'-lighter',
            'bg-c-'+ colors[i] +'-dark',
            'bg-c-'+ colors[i] +'-darker',
            'hover:text-c-'+ colors[i],
            'hover:text-c-'+ colors[i],
            'hover:text-c-'+ colors[i] +'-light',
            'hover:text-c-'+ colors[i] +'-lighter',
            'hover:text-c-'+ colors[i] +'-dark',
            'hover:text-c-'+ colors[i] +'-darker',
            'hover:bg-c-'+ colors[i],
            'hover:bg-c-'+ colors[i] +'-light',
            'hover:bg-c-'+ colors[i] +'-lighter',
            'hover:bg-c-'+ colors[i] +'-dark',
            'hover:bg-c-'+ colors[i] +'-darker',
        );
    }


    mix.purgeCss({
      enabled: true,
      extend: {
        content: [
            './*.php',
            './inc/layout.php',
            './inc/TailwindsCSS_Menu_Walker.php',
            './page-templates/*.php',
            './loops/layouts.php',
            './assets/**/*.blade.php',
            './assets/**/*.html',
            './src/js/**/*.js',
            './src/js/**/*.vue',
        ],
        whitelist: WhiteListClasses,
        whitelistPatterns: [
          /fs/,
          /mfp/,
          /slick/,
        ],
      },
    });
    mix.version();
}

// Full API
// mix.js(src, output);
// mix.react(src, output); <-- Identical to mix.js(), but registers React Babel compilation.
// mix.preact(src, output); <-- Identical to mix.js(), but registers Preact compilation.
// mix.coffee(src, output); <-- Identical to mix.js(), but registers CoffeeScript compilation.
// mix.ts(src, output); <-- TypeScript support. Requires tsconfig.json to exist in the same folder as webpack.mix.js
// mix.extract(vendorLibs);
// mix.sass(src, output);
// mix.less(src, output);
// mix.stylus(src, output);
// mix.postCss(src, output, [require('postcss-some-plugin')()]);
// mix.browserSync('my-site.test');
// mix.combine(files, destination);
// mix.babel(files, destination); <-- Identical to mix.combine(), but also includes Babel compilation.
// mix.copy(from, to);
// mix.copyDirectory(fromDir, toDir);
// mix.minify(file);
// mix.sourceMaps(); // Enable sourcemaps
// mix.version(); // Enable versioning.
// mix.disableNotifications();
// mix.setPublicPath('path/to/public');
// mix.setResourceRoot('prefix/for/resource/locators');
// mix.autoload({}); <-- Will be passed to Webpack's ProvidePlugin.
// mix.webpackConfig({}); <-- Override webpack.config.js, without editing the file directly.
// mix.babelConfig({}); <-- Merge extra Babel configuration (plugins, etc.) with Mix's default.
// mix.then(function () {}) <-- Will be triggered each time Webpack finishes building.
// mix.when(condition, function (mix) {}) <-- Call function if condition is true.
// mix.override(function (webpackConfig) {}) <-- Will be triggered once the webpack config object has been fully generated by Mix.
// mix.dump(); <-- Dump the generated webpack config object to the console.
// mix.extend(name, handler) <-- Extend Mix's API with your own components.
// mix.options({
//   extractVueStyles: false, // Extract .vue component styling to file, rather than inline.
//   globalVueStyles: file, // Variables file to be imported in every component.
//   processCssUrls: true, // Process/optimize relative stylesheet url()'s. Set to false, if you don't want them touched.
//   purifyCss: false, // Remove unused CSS selectors.
//   terser: {}, // Terser-specific options. https://github.com/webpack-contrib/terser-webpack-plugin#options
//   postCss: [] // Post-CSS options: https://github.com/postcss/postcss/blob/master/docs/plugins.md
// });

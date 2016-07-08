var elixir  = require('laravel-elixir'),
    gulp    = require('gulp'),
    htmlmin = require('gulp-htmlmin');
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir.extend('compress', function() {
    new elixir.Task('compress', function() {
        return gulp.src('./storage/framework/views/*')
            .pipe(htmlmin({
                collapseWhitespace:    true,
                removeAttributeQuotes: true,
                removeComments:        true,
                minifyJS:              true,
            }))
            .pipe(gulp.dest('./storage/framework/views/'));
    })
        .watch('./storage/framework/views/*');
});

//HTML
elixir(function(mix) {
    mix.compress();
});

//CSS
elixir(function(mix) {
    mix.styles([
        'default.css',
        'font-awesome.min.css',
        'nprogress.css'
    ]);
});

//Javascript
elixir(function(mix) {
    mix.scripts([
       'nprogress.js',
        'app.js'
    ]);
});


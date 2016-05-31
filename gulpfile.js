var elixir = require('laravel-elixir');
var gutils = require('gulp-util');
var b = elixir.config.js.browserify;

require('laravel-elixir-vueify');

if (gutils.env._.indexOf('watch') > -1) {
    b.plugins.push({
        name: "browserify-hmr",
        options : {}
    });
}

elixir(function(mix) {
    mix.sass('app.scss');
    mix.browserify('app.js');

    mix.scripts([
        'node_modules/jquery/dist/jquery.js',
        'node_modules/bootstrap-sass/assets/javascripts/bootstrap.js'
    ], 'public/js/vendors.js', './');

    mix.version(['css/app.css', 'js/vendors.js', 'js/app.js']);

    if (process.env.NODE_ENV !== 'production') {
        mix.browserSync({
            proxy: 'donasangre.local',
            files: [
                elixir.config.get('public.css.outputFolder') + '/**/*.css',
                elixir.config.get('public.versioning.buildFolder') + '/rev-manifest.json',
            ]
        });
    }
});

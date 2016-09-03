var elixir = require('laravel-elixir');

require('laravel-elixir-vue');

elixir(function(mix) {
    mix.sass('app.scss', 'public/css/app.css', false, {
        includePaths: [
            './node_modules'
        ]
    });

    mix.webpack('app.js');

    mix.copy([
        'node_modules/font-awesome/fonts',
        'node_modules/bootstrap-sass/assets/fonts/bootstrap'
    ], 'public/fonts');

    mix.copy('resources/assets/images', 'public/images');

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

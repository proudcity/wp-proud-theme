// webpack.mix.js

let mix = require('laravel-mix');

mix.webpackConfig({
    devtool: "source-map"
});

mix.sass('assets/styles/proud.scss','dist/styles', {
    sassOptions:{
        outputStyle: "compressed",
        includePaths: [
            'bower_components/bootstrap-sass-official/assets/stylesheets',
            'bower_components/bourbon/dist',
            'bower_components/proudcity-patterns/app'
        ],
    }
})
    .sass('assets/styles/proud-vendor.scss', 'dist/styles', {
        sassOptions:{
            outputStyle: "compressed",
            includePaths: [
                'bower_components/bootstrap-sass-official/assets/stylesheets',
                'bower_components/bourbon/dist',
                'bower_components/proudcity-patterns/app'
            ],
        }
})
    .sass('assets/styles/editor.scss', 'dist/styles', {
        sassOptions:{
            outputStyle: "compressed",
            includePaths: [
                'bower_components/bootstrap-sass-official/assets/stylesheets',
                'bower_components/bourbon/dist',
                'bower_components/proudcity-patterns/app'
            ],
        }
})
    .sass('assets/styles/ie9-and-below.scss', 'dist/styles', {
        sassOptions:{
            outputStyle: "compressed",
            includePaths: [
                'bower_components/bootstrap-sass-official/assets/stylesheets',
                'bower_components/bourbon/dist',
                'bower_components/proudcity-patterns/app'
            ],
        }
})
    .js( 'assets/scripts/customizer.js', 'dist/scripts')
    .js( 'assets/scripts/main.js', 'dist/scripts')
    .js( 'assets/scripts/modernizr.js', 'dist/scripts')
    .minify(
        [
            'dist/scripts/customizer.js',
            'dist/scripts/main.js',
            'dist/scripts/modernizr.js'
        ]
    )
    .sourceMaps();

/**
 * @todo change our enqueue so we use the minify version of scripts on production
 * @todo do I need to add in the default 'npm build:production' scripts and such that are generated during a laravel project install?
 *  - see first laracasts video: https://laracasts.com/series/learn-laravel-mix
 * @todo add image minification in here from the old guplfile
 * @todo why are we adding our own jquery in the dist/scripts directory. We should stop doing that
 */
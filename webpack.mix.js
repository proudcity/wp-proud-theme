// webpack.mix.js

let mix = require('laravel-mix');

const{ exec } = require('child_process');

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
});
// add sourcemaps
// webpack.mix.js

let mix = require('laravel-mix');

const{ exec } = require('child_process');

mix.before(()=>{
    exec('git clone git@github.com:proudcity/proudcity-patterns.git bower_components/proudcity-patterns');
});

mix.sass('assets/styles/proud.scss','dist/styles');
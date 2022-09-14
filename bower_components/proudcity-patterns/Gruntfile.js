'use strict';

module.exports = function(grunt) {

  require('load-grunt-tasks')(grunt);


	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		app: 'app',
		dist: 'dist',

		sass: {
			options: {
				includePaths: [
				  'bower_components/bootstrap-sass-official/assets/stylesheets',
          'bower_components/bourbon/dist'
				]
			},
			dist: {
				options: {
					outputStyle: 'extended'
				},
				files: {
					'<%= app %>/css/proudcity-patterns.css': '<%= app %>/pattern-scss/patterns.scss'
				}
			}
		},

		watch: {
			grunt: {
				files: ['Gruntfile.js'],
				tasks: ['sass']
			},
			sass: {
				files: '<%= app %>/pattern-scss/**/*.scss',
				tasks: ['sass']
			},
			livereload: {
				files: ['<%= app %>/js/**/*.js', '<%= app %>/css/**/*.css'],
				options: {
					livereload: true
				}
			}
		}
	});

	
	grunt.registerTask('compile-sass', ['sass']);
	
	grunt.registerTask('default', ['compile-sass', 'watch']);
};

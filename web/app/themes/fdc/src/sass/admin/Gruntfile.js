const sass = require('node-sass');

module.exports = function(grunt) {

	require('matchdep').filterDev('grunt-*').forEach( grunt.loadNpmTasks );

	// Project configuration.
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		sass: {
			options: {
				implementation: sass,
			},
			colors: {
				options: {
					outputStyle: 'compact',
					noCache: true,
					sourcemap: false
				},
				expand: true,
				cwd: '.',
				dest: '../../../assets/css',
				ext: '.css',
				src: [
					'admin-style.scss'
				]
			}
		},

		watch: {
			sass: {
				files: ['**/*.scss', ],
				tasks: ['sass:colors']
			}
		}

	});

	// Default task(s).
	grunt.registerTask('default', ['sass']);

};

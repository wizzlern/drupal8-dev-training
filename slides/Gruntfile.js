module.exports = function(grunt) {

	// Project configuration
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		sass: {
			core: {
				src: 'css/source/style.scss',
				dest: 'css/style.css'
			},
		}

	});

	// Dependencies
	grunt.loadNpmTasks( 'grunt-sass' );
	
	// Default task
	grunt.registerTask( 'default', [ 'css' ] );

	// Core framework CSS
	grunt.registerTask( 'css-core', [ 'sass:core'] );

	// All CSS
	grunt.registerTask( 'css', [ 'sass'] );

};

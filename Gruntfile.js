'use strict';
module.exports = function (grunt) {

    // load all grunt tasks
    require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

    grunt.initConfig({

        pkg: grunt.file.readJSON('package.json'),

        // Define watch tasks
        watch: {
            options: {
                livereload: true
            },
            sass: {
                files: ['assets/src/sass/**/*.scss'],
                tasks: ['sass:front', 'autoprefixer:front', 'notify:sass']
            },
            js: {
                files: ['assets/src/js/*.js'],
                tasks: ['uglify:front', 'notify:js']
            },
            js_admin: {
                files: ['assets/src/js/admin/*.js'],
                tasks: ['uglify:admin', 'notify:js']
            },
            livereload: {
                files: ['**/*.html', '**/*.php', 'assets/dist/images/**/*.{png,jpg,jpeg,gif,webp,svg}', '!**/*ajax*.php']
            }
        },

        // SASS
        sass: {
            options: {
                sourceMap: true
            },
            front: {
                files: {
                    'assets/dist/css/ld-rei-front.min.css': 'assets/src/sass/main.scss'
                }
            }
        },

        // Auto prefix our CSS with vendor prefixes
        autoprefixer: {
            options: {
                map: true
            },
            front: {
                src: 'assets/dist/css/ld-rei-front.min.css'
            }
        },

        // Uglify and concatenate
        uglify: {
            options: {
                sourceMap: true
            },
            front: {
                files: {
                    'assets/dist/js/ld-rei-front.min.js': ['assets/src/js/*.js']
                }
            },
            admin: {
                files: {
                    'assets/dist/js/ld-rei-admin.min.js': ['assets/src/js/admin/*.js']
                }
            }
        },

        notify: {
            js: {
                options: {
                    title: '<%= pkg.name %>',
                    message: 'JS Complete'
                }
            },
            sass: {
                options: {
                    title: '<%= pkg.name %>',
                    message: 'SASS Complete'
                }
            },
        }

    });

    // Register our main task
    grunt.registerTask('Watch', ['watch']);
};
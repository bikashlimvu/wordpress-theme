module.exports = function(grunt) {
    // Project configuration.
    grunt.initConfig({
        watch: {
            js: {
                files: 'js/**/*.js',
                tasks: ['uglify:js'],
            },
            css: {
                files: 'sass/**/*.scss',
                tasks: ['sass:css'],
            }
        },
        sass: {
            css: {
                options: {
                    style: 'expanded'
                  },
                files: {
                    'css/site.css': ['sass/site.scss']
                }
            }
        },
        uglify: {
            js: {
                // options: {
                //     sourceMap: true,
                // },
                files: {
                    'js/site.min.js': ['js/site.js']
                }
            }
        },
        browserSync: {
            default_options: {
                bsFiles: {
                    src: [
                        "css/site.css",
                        "*.html"
                    ]
                },
                options: {
                    server: {
                        baseDir: "./"
                    },
                    watchTask: true
                }
            }
        },
    });
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-browser-sync');
    grunt.registerTask('default',['browserSync', 'watch']);
    grunt.registerTask('develop',['watch', 'sass', 'uglify']);
}

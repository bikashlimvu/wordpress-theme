module.exports = function(grunt) {
    // Project configuration.
    grunt.initConfig({
        watch: {
            js: {
                files: ['**/*.js'],
                tasks: ['uglify:js'],
            },
            css: {
                files: ['**/*.sass'],
                tasks: ['sass:css'],
            }
        },
        sass: {
            css: {
                files: {
                    'css/site.css': ['sass/site.scss']
                }
            }
        },
        uglify: {
            js: {
                options: {
                    sourceMap: true,
                    sourceMapName: 'path/to/sourcemap.map'
                },
                // files: [{
                //     cwd: 'js/',
                //     src: '**/*.js',
                //     dest: 'js/',
                //     expand: true,
                //     flatten: false,
                //     ext: 'min.js'
                // }]
                files: {
                    'js/site.min.js': ['js/site.js']
                }
            }
        },
        browserSync: {
            default_options: {
                bsFiles: {
                    src: [
                        "css/*.css",
                        "*.html"
                    ]
                },
                options: {
                    server: {
                        baseDir: "./"
                    }
                }
            }
        }
    });
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-browser-sync');
    grunt.registerTask('default',['browserSync', 'watch']);
    grunt.registerTask('sync',['browserSync']);
}

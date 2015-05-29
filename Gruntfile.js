module.exports = function(grunt) {

    //Initializing the configuration object
    grunt.initConfig({
        // Task configuration
        copy: {
            fuentes: {
                files: [
                    {expand: true, cwd: './mvp-theme/bower_components/fontawesome/fonts/',  src:['**'] , dest: './web/assets/fonts'},
                    {expand: true, cwd: './mvp-theme/bower_components/bootstrap/fonts/',  src:['**'] , dest: './web/assets/fonts'},
                    {expand: true, cwd: './mvp-theme/bower_components/bootstrap-fileinput/css/',  src:['**'] , dest: './web/assets/csstemp'},

                ]
            }
        },
        less: {
            development: {
                options: {
                    compress: true  //minifying the result
                },
                files: {
                    //compiling frontend.less into frontend.css
                    "./web/assets/csstemp/frontend.css":"./web/assets/less/frontend.less",
                    //compiling backend.less into backend.css
                    "./web/assets/csstemp/backend.css":"./web/assets/less/backend.less" //,

                }
            }
        },
        concat: {
            options: {
                separator: '\n'
            },
            css_frontend: {
                src: ['./web/assets/csstemp/frontend.css', 'web/assets/csstemp/fileinput.css'],
                dest: './web/assets/css/frontend.css'
            },
            css_backend: {
                src: ['./web/assets/csstemp/backend.css', 'web/assets/csstemp/fileinput.css'],
                dest: './web/assets/css/backend.css'
            },
            js_frontend: {
                src: [
                    './mvp-theme/bower_components/jquery/dist/jquery.js',
                    './mvp-theme/bower_components/bootstrap/dist/js/bootstrap.js',
                    './mvp-theme/bower_components/slimscroll/jquery.slimscroll.min.js',
                    './mvp-theme/bower_components/bootstrap-fileinput/js/fileinput.js',
                    './mvp-theme/global/js/mvpready-core.js',
                    './mvp-theme/global/js/mvpready-helpers.js',
                    './mvp-theme/js/mvpready-landing.js.js'
                    ],
                dest: './web/assets/js/frontend.js'
            },
            js_backend: {
                src: [
                    './mvp-theme/bower_components/jquery/dist/jquery.js',
                    './mvp-theme/bower_components/bootstrap/dist/js/bootstrap.js',
                    './mvp-theme/bower_components/slimscroll/jquery.slimscroll.min.js', //Para scrtoll to top
                    './mvp-theme/bower_components/bootstrap-fileinput/js/fileinput.js',
                    './mvp-theme/global/js/mvpready-core.js',
                    './mvp-theme/global/js/mvpready-helpers.js',
                    './mvp-theme/js/mvpready-admin.js'
                    ],
                dest: './web/assets/js/backend.js'
            }
        },
        cssmin: {
            target: {
                files: [{
                    expand: true,
                    cwd: './web/assets/css',
                    src: ['*.css', '!*.min.css'],
                    dest: './web/assets/css',
                    ext: '.css'
                }]
            }
        },
        uglify: {
            options: {
                mangle: false  // Use if you want the names of your functions and variables unchanged
            },
            frontend: {
                files: {
                    './web/assets/js/frontend.js': './web/assets/js/frontend.js'
                }
            },
            backend: {
                files: {
                    './web/assets/js/backend.js': './web/assets/js/backend.js'
                }
            }
        },
        watch: {
            js_frontend: {
                files: [
                    //watched files
                    './mvp-theme/bower_components/jquery/dist/jquery.js',
                    './mvp-theme/bower_components/bootstrap/dist/js/bootstrap.js',
                    './mvp-theme/js/mvpready-landing.js'
                ],
                tasks: ['concat:js_frontend','uglify:frontend'],     //tasks to run
                options: {
                    livereload: true                        //reloads the browser
                }
            },
            js_backend: {
                files: [
                    //watched files
                    './mvp-theme/bower_components/jquery/dist/jquery.js',
                    './mvp-theme/bower_components/bootstrap/dist/js/bootstrap.js',
                    './mvp-theme/js/mvpready-admin.js'
                ],
                tasks: ['concat:js_backend','uglify:backend'],     //tasks to run
                options: {
                    livereload: true                        //reloads the browser
                }
            },
            less: {
                files: ['./web/assets/less/*.less'],     //watched files
                tasks: ['less'],                                //tasks to run
                options: {
                    livereload: true                            //reloads the browser
                }
            },
            css: {
                files: ['./web/assets/css/*.css'],     //watched files
                tasks: ['concat:css_frontend','concat:css_backend','cssmin'],                                //tasks to run
                options: {
                    livereload: true                            //reloads the browser
                }
            }
        }
    });

    // Plugin loading
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-filessrc');
    grunt.loadNpmTasks('grunt-newer');

    // Task definition
    grunt.registerTask('default', ['copy','less','concat','cssmin','uglify']);
};
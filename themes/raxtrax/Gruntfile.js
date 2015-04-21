module.exports = function (grunt) {
  var tasks = {
    less: {
      options: {
        syncImport: true, // imports are read top-down
        stripBanners: true, // do not include header comments
        ieCompat: false,
        compress: true
      },
      main: {
        options: {
          paths: ["./less"]
        },
        files: {
          "./style.css": "./less/style.less"
        }
      }
    },
    watch: {
      less: {
        files: ['./less/**/*.less', './less/*.less'],
        tasks: ['less:main']
      }
    }
  };


  /*==========  config  ==========*/

  grunt.config.init(tasks);


  /*==========  npm task registry  ==========*/

  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-less');

  /*==========  compile tasks  ==========*/


  /*==========  build tasks  ==========*/


  /*==========  server tasks  ==========*/

};

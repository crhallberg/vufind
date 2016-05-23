module.exports = function(grunt) {
  require('jit-grunt')(grunt); // Just in time library loading

  grunt.initConfig({
    // File deletion
    clean: {
      uglify: ['themes/bootstrap3/js/vendor.min.js']
    },
    // LESS compilation
    less: {
      compile: {
        options: {
          paths: ["themes/bootprint3/less", "themes/bootstrap3/less"],
          compress: true,
          modifyVars: {
            'fa-font-path': '"fonts"',
            'img-path': '"../images"',
          }
        },
        files: {
          "themes/bootstrap3/css/compiled.css": "themes/bootstrap3/less/bootstrap.less",
          "themes/bootprint3/css/compiled.css": "themes/bootprint3/less/bootprint.less",
        }
      }
    },
    // SASS compilation
    sass: {
      compile: {
        options: {
          loadPath: ["themes/bootprint3/sass", "themes/bootstrap3/sass"],
          style: 'compress'
        },
        files: {
          "themes/bootstrap3/css/compiled.css": "themes/bootstrap3/sass/bootstrap.scss",
          "themes/bootprint3/css/compiled.css": "themes/bootprint3/sass/bootprint.scss"
        }
      }
    },
    // Convert LESS to SASS
    lessToSass: {
      convert: {
        files: [
          {
            expand: true,
            cwd: 'themes/bootstrap3/less',
            src: ['*.less', 'components/*.less'],
            ext: '.scss',
            dest: 'themes/bootstrap3/sass'
          },
          {
            expand: true,
            cwd: 'themes/bootprint3/less',
            src: ['*.less'],
            ext: '.scss',
            dest: 'themes/bootprint3/sass'
          }
        ],
        options: {
          replacements: [
            { // Replace ; in include with ,
              pattern: /(\s+)@include ([^\(]+)\(([^\)]+)\);/gi,
              replacement: function (match, space, $1, $2) {
                return space+'@include '+$1+'('+$2.replace(/;/g, ',')+');';
              },
              order: 3
            },
            { // Inline &:extends converted
              pattern: /&:extend\(([^\)]+)\)/gi,
              replacement: '@extend $1',
              order: 3
            },
            { // Inline variables not default
              pattern: / !default; }/gi,
              replacement: '; }',
              order: 3
            },
            {  // VuFind: Correct paths
              pattern: 'vendor/bootstrap/bootstrap',
              replacement: 'vendor/bootstrap',
              order: 4
            },
            {
              pattern: '$fa-font-path: "../../../fonts" !default;',
              replacement: '$fa-font-path: "fonts";',
              order: 4
            },
            {
              pattern: '$img-path: "../../images" !default;',
              replacement: '$img-path: "../images";',
              order: 4
            },
            { // VuFind: Bootprint fixes
              pattern: '@import "bootstrap";\n@import "variables";',
              replacement: '@import "variables", "bootstrap";',
              order: 4
            },
            {
              pattern: '$brand-primary: #619144 !default;',
              replacement: '$brand-primary: #619144;',
              order: 4
            }
          ]
        }
      }
    },
    // JS styling
    eslint: {
      options: {
        configFile: '.eslintrc.json'
      },
      bootstrap3: ['themes/bootstrap3/js/*.js']
    },
    // JS compression
    uglify: {
      options: {
        mangle: false
      },
      vendor_min_bs3: { // after running uglify:vendor_min, change your theme.config.php
        files: {    // to only load vendor.min.js instead of all the js/vendor files
          'themes/bootstrap3/js/vendor.min.js': [
            'themes/bootstrap3/js/vendor/jquery.min.js',       // these two need to go first
            'themes/bootstrap3/js/vendor/bootstrap.min.js',
            'themes/bootstrap3/js/vendor/*.js',
            'themes/bootstrap3/js/autocomplete.js',
            '!themes/bootstrap3/js/vendor/bootstrap-slider.js' // skip, not "use strict" compatible
          ]
        }
      }
    },
    compress: {
      copy: {
        root_theme: {
          expand: true,
          src: 'themes/root',
          dest: 'dest/' + (grunt.option('theme') || 'new') + '_pkgd'
        },
        from_theme: {
          expand: true,
          src: 'themes/' + grunt.option('from'),
          dest: 'dest/' + (grunt.option('theme') || 'new') + '_pkgd'
        },
      },
    }
  });

  grunt.registerTask('js', ['clean:uglify', 'eslint', 'uglify']);
  grunt.registerTask('default', ['less', 'js']);

  grunt.registerMultiTask('compress', function() {
    if (!grunt.option('theme')) {
      grunt.log.writeln('Please specify a theme with --theme=X');
      return false;
    }
    grunt.log.writeln('Compressing theme: ' + grunt.option('theme') + ' to ' + grunt.option('theme') + '_pkgd');
    grunt.log.writeln('- Copying root');
    grunt.log.writeln('- Copying parent');
    grunt.log.writeln('- Copying parent');
    grunt.log.writeln('- Copying theme');
    grunt.log.writeln('- Compressing LESS to css/');
    grunt.log.writeln('- Removing LESS source');
    grunt.log.writeln('- Compressing JS to temp/');
    grunt.log.writeln('- Removing JS source');
    grunt.log.writeln('- Moving JS from temp/ to js/');
    grunt.log.writeln('- Removing temp/');
    grunt.log.writeln('- Creating theme.config.php');
  });
};
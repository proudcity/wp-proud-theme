import { defineConfig } from 'vite';
import { resolve } from 'path';
import { viteStaticCopy } from 'vite-plugin-static-copy';

export default defineConfig({
  plugins: [
    viteStaticCopy({
      targets: [
        {
          src: 'assets/fonts/*',
          dest: 'fonts'
        }
      ]
    })
  ],
  css: {
    preprocessorOptions: {
      scss: {
        api: 'legacy',
        silenceDeprecations: ['import', 'global-builtin', 'legacy-js-api', 'slash-div', 'if-function'],
        quietDeps: true,
        logger: {
          warn: () => {} // Suppress Bourbon deprecation warnings
        },
        includePaths: [
          'node_modules/bootstrap-sass/assets/stylesheets',
          'node_modules/bourbon/app/assets/stylesheets',
          'node_modules/proudcity-patterns/app'
        ]
      }
    }
  },
  build: {
    outDir: 'dist',
    rollupOptions: {
      input: {
        // SCSS entry points
        'styles/proud': resolve(__dirname, 'assets/styles/proud.scss'),
        'styles/proud-vendor': resolve(__dirname, 'assets/styles/proud-vendor.scss'),
        'styles/editor': resolve(__dirname, 'assets/styles/editor.scss'),
        'styles/ie9-and-below': resolve(__dirname, 'assets/styles/ie9-and-below.scss'),
        // JS entry points
        'scripts/main': resolve(__dirname, 'assets/scripts/main.js'),
        'scripts/customizer': resolve(__dirname, 'assets/scripts/customizer.js'),
        'scripts/modernizr': resolve(__dirname, 'assets/scripts/modernizr.js'),
        'scripts/bootstrap': resolve(__dirname, 'node_modules/bootstrap-sass/assets/javascripts/bootstrap.js')
      },
      output: {
        // Keep predictable filenames for WordPress
        // Output JS as .min.js to match WordPress enqueue expectations
        entryFileNames: '[name].min.js',
        chunkFileNames: '[name].min.js',
        assetFileNames: '[name][extname]'
      }
    },
    sourcemap: true,
    cssMinify: true,
    minify: 'terser',
    terserOptions: {
      format: {
        comments: false
      }
    }
  }
});

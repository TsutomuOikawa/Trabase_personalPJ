import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/editor.js',
                'resources/js/google-map.js',
                'resources/js/japan-map.js',
                'resources/js/jquery.japan-map.min.js',
                'resources/sass/app.scss'
            ],
            refresh: true,
        }),
    ],
});

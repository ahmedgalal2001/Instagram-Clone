import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/navbar.css',
                'resources/js/navbar.js',
                'resources/js/home.js',
                'resources/css/home.css',
                'resources/css/fontawesome-free-6.5.1-web/css/all.min.css',
            ],
            refresh: true,
        }),
    ],
});

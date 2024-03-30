import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/navbar.css',
                'resources/js/editprofile.js',
                'resources/css/edit-profile.css',
            ],
            refresh: true,
        }),
    ],
});

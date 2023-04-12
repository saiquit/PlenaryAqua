import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/front.js',
                'resources/sass/app.scss',
                'resources/sass/front.scss',
                'resources/css/rfront.css',
            ],
            refresh: true,
        }),
    ],
});

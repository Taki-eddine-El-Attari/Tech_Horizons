import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/show.css',
                'resources/css/auth.css',
                'resources/css/index.css',
                'resources/css/statistiques.css',
                'resources/css/historiques.css',
                'resources/js/show.js',
                'resources/js/index.js',
                'resources/js/historiques.js'  
            ],
            refresh: true,
        }),
    ],
});

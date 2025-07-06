import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/assets/sass/app.scss', 'resources/assets/sass/layout.scss', 'resources/assets/sass/sidebar.scss', 'resources/assets/js/app.js'],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '$': 'jquery',
            'jquery': 'jquery',
            '@': 'resources/',
        },
    },
})

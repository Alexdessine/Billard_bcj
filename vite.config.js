import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/css/comite.css',
                'resources/css/adminStyle.css', 
                'resources/css/footer.css', 
                'resources/css/mentions.css', 
                'resources/css/nav_style.css', 
                'resources/css/style.css', 
                'resources/css/bootstrap.css', 
                'resources/js/app.js',
                'resources/js/maps.js'
            ],
            refresh: true,
        }),
    ],
});

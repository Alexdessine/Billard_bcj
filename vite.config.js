import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/nav.css',
                'resources/css/style.css',
                'resources/css/footer.css',
                'resources/js/app.js',
                'resources/js/maps.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        minify: 'esbuild', // ou 'terser' si besoin d'options avancées
        sourcemap: false,  // désactive les fichiers .map en prod
        cssCodeSplit: true, // permet de séparer le CSS par fichier JS
        rollupOptions: {
            output: {
                manualChunks: undefined, // réduit le nombre de fichiers JS
            },
        },
    },
});

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
        }),
    ],
    build: {
        outDir: 'public/build/', // Asegúrate de que esta ruta coincida con la configuración de Laravel
        manifest: 'manifest.json',
        // Otros ajustes de construcción según tus necesidades
    },
});

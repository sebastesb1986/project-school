import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            // No se recomienda usar refresh: true en producción
        }),
    ],
    build: {
        outDir: 'public/build/', // Asegúrate de que esta ruta coincida con la configuración de Laravel
        manifest: true,
        // Otros ajustes de construcción según tus necesidades
    },
});

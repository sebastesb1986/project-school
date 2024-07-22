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
        minify: true,
        brotliSize: true,
        sourcemap: false,
        manifest: true,
        outDir: 'public/build/',
    },
});

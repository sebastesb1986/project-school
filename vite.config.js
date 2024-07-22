import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    base: 'https://salgado-school-30c338bdf4e3.herokuapp.com', // Reemplaza con el nombre de tu aplicación en Heroku
    plugins: [
        vue(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            mode: 'production',
            extract: true,
            minify: true,
        }),
    ],
});

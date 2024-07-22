<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>README - Genuine Digital School</title>
    </head>
    <body>
        <h1>Genuine Digital School - Proyecto Desplegable Prueba</h1>

        <h2>Descripción</h2>
        <p>Este proyecto facilita la interacción entre DialogFlow y el framework Laravel 11.</p>

        <h2>Ver demo</h2>
        <p>Puedes ver una demostración del proyecto en <a href="https://salgado-school-30c338bdf4e3.herokuapp.com" target="_blank">Genuine Digital School Demo</a>.</p>

        <h2>Cómo añadir elementos</h2>
        <p>Para agregar productos y categorías, utiliza las siguientes credenciales en la URL <a href="https://salgado-school-30c338bdf4e3.herokuapp.com/admi" target="_blank">Admin Genuine Digital School</a>:</p>
        <ul>
            <li><strong>Credenciales:</strong></li>
            <li>Email: admin2024@gmailcom</li>
            <li>Contraseña: admin1234</li>
        </ul>

        <h2>Tecnologías utilizadas</h2>
        <ul>
            <li>Framework PHP Laravel 11</li>
            <li>PHP 8.2</li>
            <li>Vue 3 (integrado dentro del framework Laravel)</li>
            <li>JavaScript</li>
        </ul>

        <h2>Pasos de instalación en un entorno local</h2>
        <p>Si deseas implementar esta aplicación en tu entorno local, sigue estos pasos:</p>
        <ol>
            <li>Clona el repositorio:</li>
            <pre><code>git clone https://github.com/sebastesb1986/project-school.git</code></pre>

            <li>Genera la clave de la aplicación y realiza las instalaciones necesarias:</li>
            <pre><code>php artisan key:generate</code></pre>
            <pre><code>composer install</code></pre>
            <pre><code>npm install</code></pre>

            <li>Genera la clave secreta para JWT:</li>
            <pre><code>php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"</code></pre>
            <pre><code>php artisan jwt:secret</code></pre>

            <li>Copia el archivo <code>.env.example</code> a <code>.env</code> y configura tu entorno local:</li>
            <pre>
                <code>DB_CONNECTION=mysql
                DB_HOST=TU HOST
                DB_PORT=TU PUERTO
                DB_DATABASE=d48fgtdaq01a04
                DB_USERNAME=TU USERNAME
                DB_PASSWORD=TU_PASSWORD</code>
            </pre>

            <li>Ejecuta las migraciones y los seeders:</li>
            <pre><code>php artisan migrate:refresh --seed</code></pre>

            <li>Configura <code>vite.config.js</code> dentro de <code>resources/js/app.js</code>:</li>
            <pre><code>import { defineConfig } from 'vite';
            import laravel from 'laravel-vite-plugin';
            import vue from '@vitejs/plugin-vue';

            export default defineConfig({
                plugins: [
                    vue(),
                    laravel({
                        input: ['resources/css/app.css', 'resources/js/app.js'],
                        refresh: true
                    }),
                ],
            });</code></pre>

            <li>Actualiza la configuración de axios en <code>resources/js/app.js</code> para el entorno local:</li>
            <pre><code>axios.defaults.baseURL = 'http://127.0.0.1:8000/api';</code></pre>

            <li>Inicia el servidor de desarrollo y el servidor de Laravel:</li>
            <pre><code>php artisan serve</code></pre>
            <pre><code>npm run dev</code></pre>

            <li>Accede a la aplicación desde tu navegador:</li>
            <ul>
                <li>Sitio principal: <a href="http://127.0.0.1:8000" target="_blank">http://127.0.0.1:8000</a></li>
                <li>Panel de administración: <a href="http://127.0.0.1:8000/admin" target="_blank">http://127.0.0.1:8000/admin</a></li>
            </ul>
        </ol>

        <h2>Utilización de la herramienta</h2>
        <p>Una vez en la demo o en tu entorno local, se abrirá una ventana de chat. Comienza con un saludo (por ejemplo, "hola" o "hi") y recibirás un mensaje de bienvenida. Podrás interactuar eligiendo una categoría y ver los productos disponibles.</p>
        <p>¡Es sencillo! Todo está diseñado para ser intuitivo y fácil de usar.</p>

        <p>Para cualquier consulta o comentario, contáctame en <a href="mailto:salgadosb1986@gmail.com">salgadosb1986@gmail.com</a>. Te brindaré soporte en el menor tiempo posible.</p>

        <p>¡Saludos!</p>
    </body>
</html>

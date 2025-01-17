import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue(),
        ssr()
    ],
    server: {
        host: 'localhost', // Asegúrate de que esté en localhost
        port: 3000,        // Cambia a 3000 si quieres usar ese puerto
        strictPort: true,  // Esto hará que Vite solo se ejecute en el puerto 3000
    },
    build: {
        ssr: 'resources/js/ssr.js', // Archivo de SSR
    },
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js'),
        },
    },
});

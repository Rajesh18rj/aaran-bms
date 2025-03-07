import {
    defineConfig
} from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: [`resources/views/**/*`,
                `Aaran/**/Livewire/**/*.blade.php`,
                `Aaran/**/*.blade.php`,
                'Aaran/**/*.js',
                'Aaran/**/*.vue'
            ],
        }),
        tailwindcss(),
    ],
    server: {
        cors: true,
    },
});

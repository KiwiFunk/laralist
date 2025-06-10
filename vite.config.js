import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    build: {
        rollupOptions: {
            output: {
                manualChunks: undefined,
            },
        },
        // Ensure Alpine.js works in production
        minify: 'terser',
        terserOptions: {
            compress: {
                drop_console: false, // Keep console logs for debugging
            },
        },
    },
});

import { defineConfig } from 'vite';
import path from 'path';

// https://vitejs.dev/config/
export default defineConfig(({ mode }) => ({
    plugins: [],
    base: mode === 'production' ? '/assets/build/' : '/',
    root: path.resolve(__dirname, './resources/app'),
    server: {
        strictPort: true,
        port: 5133,
    },
    build: {
        outDir: path.resolve(__dirname, './public/assets/build'),
        emptyOutDir: true,
        manifest: true,
        rollupOptions: {
            input: path.resolve(__dirname, './resources/app/main.js'),
        },
    },
    resolve: {
        alias: {
            '@': path.resolve(__dirname, './resources/app'),
        },
    },
}));
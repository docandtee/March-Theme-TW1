import { defineConfig } from 'vite'
import tailwindcss from '@tailwindcss/vite'
import { resolve } from 'path'

export default defineConfig(({ command }) => {
    const isBuild = command === 'build';

    return {
        base: isBuild ? '/wp-content/themes/docandtee-tailwind-v1/dist/' : '/',
        server: {
            port: 3000,
            cors: true,
            origin: 'http://localhost:8000',
        },
        build: {
            manifest: true,
            outDir: 'dist',
            assetsDir: 'assets',
            rollupOptions: {
                input: [
                    'resources/js/app.js',
                    'resources/css/app.css',
                    'resources/css/editor-style.css'
                ],
                output: {
                    assetFileNames: (assetInfo) => {
                        // Preserve images folder structure for CSS-referenced assets
                        if (assetInfo.name && assetInfo.name.match(/\.(svg|png|jpg|jpeg|gif|webp)$/)) {
                            return 'images/[name].[hash][extname]';
                        }
                        return 'assets/[name].[hash][extname]';
                    },
                },
            },
        },
        resolve: {
            alias: {
                '@images': resolve(__dirname, 'resources/images'),
            },
        },
        plugins: [
            tailwindcss(),
        ],
    }
});


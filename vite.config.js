import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
  server: {
    host: '0.0.0.0',
  },
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/js/pages/top/index.tsx',
        'resources/js/pages/update/index.tsx',
      ],
      refresh: true,
    }),
    react(),
  ],
});

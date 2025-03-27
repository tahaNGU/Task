import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import path from 'path'
export default defineConfig({
    resolve: {
        alias: {
            '@': path.resolve(__dirname, './resources/js'),
        },
    },
    plugins: [vue()],
    server: {
        proxy: {
            '/api': 'http://localhost',  // برای اتصال به بک‌اند لاراول
        },
    },
})

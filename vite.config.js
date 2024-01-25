import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'
import vitePluginRequire from 'vite-plugin-require'
import path from 'path'

export default defineConfig({
    plugins: [
        vue(),
        laravel(['resources/css/app.css', 'resources/js/app.js']),
        vitePluginRequire.default(),
    ],
    resolve: {
        extensions: ['.mjs', '.js', '.ts', '.jsx', '.tsx', '.json', '.vue'],
        alias: {
            '~': path.resolve(__dirname, './resources/js'),
        },
    },
})

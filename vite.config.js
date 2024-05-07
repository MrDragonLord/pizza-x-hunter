import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'
import vitePluginRequire from 'vite-plugin-require'
import path from 'path'

export default defineConfig({
    plugins: [
        vue(),
        laravel(['resources/js/app.js']),
        vitePluginRequire.default(),
    ],
    resolve: {
        extensions: [
            '.mjs',
            '.js',
            '.ts',
            '.jsx',
            '.tsx',
            '.json',
            '.vue',
            '.css',
        ],
        alias: {
            '~': '/resources/js',
            '@img': '/resources/img',
            '@css': '/resources/css',
            'vue-calendar3': path.resolve(
                __dirname,
                'node_modules/vue-calendar-3/dist/',
            ),
        },
    },
})

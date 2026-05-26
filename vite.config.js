import { defineConfig } from 'vite';

export default defineConfig({
    css: {
        preprocessorOptions: {
            scss: {
                silenceDeprecations: ['color-functions', 'global-builtin', 'import', 'if-function'],
            },
        },
    },
    plugins: [
        {
            name: 'fix-font-urls',
            generateBundle(_, bundle) {
                for (const [name, chunk] of Object.entries(bundle)) {
                    if (name.endsWith('.css') && chunk.source) {
                        chunk.source = chunk.source.replaceAll('./fonts/', '/fonts/');
                    }
                }
            },
        },
    ],
    build: {
        outDir: 'source',
        emptyOutDir: false,
        manifest: false,
        rollupOptions: {
            input: {
                app: 'assets/app.js',
                style: 'assets/app.scss',
                fonts: 'node_modules/bootstrap-icons/font/fonts/bootstrap-icons.woff',
                fonts2: 'node_modules/bootstrap-icons/font/fonts/bootstrap-icons.woff2'
            },
            output: {
                entryFileNames: 'js/[name].js',
                assetFileNames: (assetInfo) => {
                    if (/\.(woff2?|ttf|eot|otf)$/.test(assetInfo.name)) {
                        return 'fonts/[name][extname]';
                    }
                    if (/\.css$/.test(assetInfo.name)) {
                        return 'css/app[extname]';
                    }
                    return 'assets/[name][extname]';
                },
            },
        },
    },
});

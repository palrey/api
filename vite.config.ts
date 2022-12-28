import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react-swc';
import { fileURLToPath } from 'url';

// https://vitejs.dev/config/
export default defineConfig({
	plugins: [react()],
	resolve: {
		alias: {
			'@': fileURLToPath(new URL('client/src', import.meta.url)),
		}
	},
	root: 'ui',
	// build: {
	//     outDir: '../public/ui/',
	//     emptyOutDir: true,
	// },
	// base: '/ui/'
});

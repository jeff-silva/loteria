const { join } = require('path');
const { copySync, removeSync, rename } = require('fs-extra');
require('dotenv').config();

let u = new URL(process.env.CLIENT_URL || 'http://localhost:3000');

export default {
	srcDir: 'client',

	server: {host:u.hostname, port:u.port},

	// Disable server-side rendering: https://go.nuxtjs.dev/ssr-mode
	ssr: false,

	// Target: https://go.nuxtjs.dev/config-target
	target: 'static',

	env: {
		APP_NAME: process.env.APP_NAME,
		APP_DESCRIPTION: process.env.APP_DESCRIPTION,
		APP_URL: process.env.APP_URL,
		CLIENT_URL: process.env.CLIENT_URL,
	},

	// Global page headers: https://go.nuxtjs.dev/config-head
	head: {
		title: 'app-laravel-nuxt',
		meta: [
			{ charset: 'utf-8' },
			{ name: 'viewport', content: 'width=device-width, initial-scale=1' },
			{ hid: 'description', name: 'description', content: '' },
			{ name: 'format-detection', content: 'telephone=no' }
		],
		link: [
			{ rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
		],
	},

	// Global CSS: https://go.nuxtjs.dev/config-css
	css: ['@/app.scss'],

	// Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
	plugins: ['@/app.js', '@/plugins/helpers.js'],

	// Auto import components: https://go.nuxtjs.dev/config-components
	components: true,

	// Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
	// PWA module configuration: https://go.nuxtjs.dev/pwa
	buildModules: [
		['@nuxtjs/pwa', {

			// https://pwa.nuxtjs.org/icon
			icon: {
				source: '@/static/icon.png',
			},
			
			// https://pwa.nuxtjs.org/meta
			meta: {
				title: (process.env.APP_NAME||'APP_NAME'),
				author: 'jeferson.i.silva@gmail.com',
			},

			// https://pwa.nuxtjs.org/manifest
			manifest: {
				name: (process.env.APP_NAME||'APP_NAME'),
				short_name: (process.env.APP_NAME||'APP_NAME'),
				description: (process.env.APP_DESCRIPTION||'APP_DESCRIPTION'),
				display: "fullscreen",
				background_color: '#222222',
				lang: (process.env.APP_LANG || 'en'),
				useWebmanifestExtension: true,
			},

			// https://pwa.nuxtjs.org/workbox
			workbox: {
				enabled: true,
				config: {debug:false},
				cacheNames: {prefix: process.env.APP_ID, suffix: 'v1'},
				// runtimeCaching: [
				// 	{
				// 		urlPattern: 'https://fonts.googleapis.com/.*',
				// 		handler: 'cacheFirst',
				// 		method: 'GET',
				// 		strategyOptions: { cacheableResponse: { statuses: [0, 200] } }
				// 	},
				// ],
			},
		}],
	],

	// Modules: https://go.nuxtjs.dev/config-modules
	modules: [
		// https://go.nuxtjs.dev/axios
		['@nuxtjs/axios', {
			proxy: true,
		}],

		// https://go.nuxtjs.dev/pwa
		['@nuxtjs/pwa', {}],

		// https://go.nuxtjs.dev/content
		// ['@nuxt/content', {}],

		// https://auth.nuxtjs.org/
		['@nuxtjs/auth-next', {
			// https://dev.auth.nuxtjs.org/api/options#redirect
			redirect: {
				login: '/',
				logout: '/',
				callback: false,
				home: false,
			},

			strategies: {
				// https://dev.auth.nuxtjs.org/providers/laravel-jwt
				// https://github.com/nuxt-community/auth-module/blob/dev/src/providers/laravel/jwt/index.ts
				'jwt': {
					provider: 'laravel/jwt',
					url: '/',
					name: 'jwt',
					endpoints: {
						login: {method:'POST', url:'/api/login'},
						refresh: {method:'POST', url:'/api/refresh'},
						logout: {method:'POST', url:'/api/logout'},
						user: {method:'POST', url:'/api/me'},
					},
					token: {
						property: 'access_token',
						maxAge: (60 * 60),
					},
					refreshToken: {
						maxAge: (20160 * 60),
					},
				},
			},
		}],
	],

	// Axios module configuration: https://go.nuxtjs.dev/config-axios
	axios: {},

	proxy: {
		'/api/': process.env.APP_URL,
	},

	

	// Content module configuration: https://go.nuxtjs.dev/config-content
	content: {},

	// Build Configuration: https://go.nuxtjs.dev/config-build
	build: {
	transpile: [/^element-ui/],

	extend(config, ctx) {
			config.resolve.alias['vue'] = 'vue/dist/vue.common';
		},
	},

	hooks: {
		generate: {
			done (generator) {
			const publicDir = join(__dirname, 'public');
			removeSync(join(publicDir, '_nuxt'));
			removeSync(join(publicDir, 'dev'));
			copySync(generator.nuxt.options.generate.dir, publicDir);
			rename(join(publicDir, 'index.html'), join(publicDir, 'app.html'));
			removeSync(generator.nuxt.options.generate.dir);
			},
		},
	},
}

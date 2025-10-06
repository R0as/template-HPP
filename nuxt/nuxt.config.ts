import tailwindcss from "@tailwindcss/vite";

export default defineNuxtConfig({
  compatibilityDate: "2025-07-15",
  devtools: { enabled: true },
  css: ['~/assets/css/main.css'],

  vite: {
    plugins: [
      tailwindcss(),
    ],
  },

  modules: ["@qirolab/nuxt-sanctum-authentication"],

  laravelSanctum: {
    /**
         * The base URL of the Laravel API.
         * @example http://laravel-api.test
         * @required
         */
    apiUrl: 'http://localhost:8000',

    /**
         * Authentication mode: 'cookie' or 'token'
         * - 'cookie' for SPA cookie authentication,
         * - 'token' for API token authentication
         *
         * @default 'cookie'
         */
    authMode: 'cookie',
  },


});
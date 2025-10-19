import tailwindcss from "@tailwindcss/vite";

export default defineNuxtConfig({
  compatibilityDate: "2025-07-15",
  devtools: { enabled: true },
  css: ['~/assets/css/main.css',],

  vite: {
    plugins: [
      tailwindcss(),
    ],
  },

  modules: ["@qirolab/nuxt-sanctum-authentication", '@primevue/nuxt-module'],

  primevue: {
    options: {
      theme: {
      }
    }
  },

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
    redirect: {
      /**
       * Determines whether to keep the requested route when redirecting after login.
       * @default false
       */
      enableIntendedRedirect: false,

      /**
       * Path to redirect to when access requires user authentication.
       * If set to false, a 403 error is triggered.
       * @default '/login'
       */
      loginPath: '/auth/login',

      /**
       * URL to redirect to when guest access is required (user must not be authenticated).
       * If set to false, the plugin will throw an 403 error.
       * @default '/'
       */
      guestOnlyRedirect: '/dashboard',

      /**
       * URL to redirect to after a successful login.
       * If set to false, no redirection occurs.
       * @default '/'
       */
      redirectToAfterLogin: '/dashboard',

      /**
       * URL to redirect to after logout.
       * If set to false, no redirection occurs.
       * @default '/'
       */
      redirectToAfterLogout: '/',
    },


    sanctumEndpoints: {
      /**
       * The endpoint to request a new CSRF token.
       * @default '/sanctum/csrf-cookie'
       */
      csrf: '/sanctum/csrf-cookie',

      /**
       * The endpoint to send user credentials to authenticate.
       * @default '/login'
       */
      login: '/api/tokens/create',

      /**
       * The endpoint to destroy current user session.
       * @default '/logout'
       */
      logout: '/api/tokens/delete',

      /**
       * The endpoint to fetch current user data.
       * @default '/api/user'
       */
      user: '/api/user',
    },


    authMode: 'token',

    token: {
      /**
       * The key to store the token in the storage.
       * @default 'AUTH_TOKEN'
       */
      storageKey: 'AUTH_TOKEN',

      /**
       * The storage provider to use for the token.
       * Options: 'cookie' or 'localStorage'
       * @default 'cookie'
       */
      provider: 'cookie',
    },

  },

});
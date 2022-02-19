export default {
  // Target: https://go.nuxtjs.dev/config-target
  target: "static",

  // Global page headers: https://go.nuxtjs.dev/config-head
  server: {
    host: "0.0.0.0",
  },
  // serverMiddleware: [
  //   { path: "/server-middleware", handler: "~/server-middleware/rest.js" },
  // ],
  head: {
    title: "m2n",
    htmlAttrs: {
      lang: "en",
    },
    meta: [
      { charset: "utf-8" },
      { name: "viewport", content: "width=device-width, initial-scale=1" },
      { hid: "description", name: "description", content: "" },
    ],
    link: [
      { rel: "icon", type: "image/x-icon", href: "/favicon.ico" },
      { rel: "preconnect", href: "https://fonts.gstatic.com" },
      { rel: "preconnect", href: "https://fonts.googleapis.com" },
      { rel: "stylesheet", href: "https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" },
    ],
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: ["@/assets/style.min.css", "@/static/slick.css"],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
    {
      src: "~/plugins/slider.js",
      mode: "client",
    },
  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
    // https://go.nuxtjs.dev/tailwindcss
    "@nuxtjs/tailwindcss",
    // "@nuxtjs/google-fonts",
    "~/modules/class-purge.js",
  ],
  // googleFonts: {
  //   families: {
  //     Nunito: true,
  //     Roboto: true,
  //     "Open Sans": true,
  //   },
  // },

  // modules: https://go.nuxtjs.dev/config-modules
  modules: [
    // https://go.nuxtjs.dev/axios
    "@nuxtjs/axios",
    "@nuxtjs/proxy",
    // "@nuxt/content"
  ],
  proxy: {
    // '/api': 'https://m2n.nfshost.com/'
    "/api": {
      target: "https://m2n.nfshost.com/",
      changeOrigin: true,
      pathRewrite: {
        "^/api/": "/wp-json/",
      },
    },
    // "/oauth": {
    //   target: "http://m2n.nfshost.com/",
    //   changeOrigin: true,
    //   pathRewrite: {
    //     "^/oauth/":"/oauth1/"
    //   }
    // }
  },
  // Axios module configuration: https://go.nuxtjs.dev/config-axios
  axios: {
    proxy: true,
  },

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {},
  purgeCSS: {
    paths: ["components/**/*.vue", "layouts/**/*.vue", "pages/**/*.vue"],
  },
};

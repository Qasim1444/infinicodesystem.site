// https://nuxt.com/docs/api/configuration/nuxt-config

const siteUrl = process.env.SITE_URL || 'https://infinicodesystem.site'

export default defineNuxtConfig({
  ssr: true,

  modules: ['@nuxtjs/robots', '@nuxtjs/sitemap'],

  css: ['~/assets/css/main.css'],

  postcss: {
    plugins: {
      tailwindcss: {},
      autoprefixer: {},
    },
  },

  /**
   * 🔥 Runtime API config (BEST PRACTICE)
   */
  runtimeConfig: {
    public: {
      apiBase: 'https://api.infinicodesystem.site/api/v1',
    },
  },

  /**
   * Sitemap (static + dynamic posts)
   */
  sitemap: {
    hostname: siteUrl,
    gzip: true,
    urls: [
      { loc: `${siteUrl}/` },
      { loc: `${siteUrl}/about` },
      { loc: `${siteUrl}/contact` },
      { loc: `${siteUrl}/projects` },
      { loc: `${siteUrl}/services` },
      { loc: `${siteUrl}/blog` },
    ],
  },

  robots: {
    UserAgent: '*',
    Allow: '/',
    Sitemap: `${siteUrl}/sitemap.xml`,
  },

  app: {
    head: {
      link: [
        {
          rel: 'stylesheet',
          href: 'https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css',
        },
      ],
    },
  },

  compatibilityDate: '2026-05-18',
  devtools: { enabled: true },
})
// https://nuxt.com/docs/api/configuration/nuxt-config
<<<<<<< HEAD
const siteUrl = process.env.SITE_URL || 'http://127.0.0.1:3000'

export default defineNuxtConfig(async () => {
  const postsResponse = await fetch('http://127.0.0.1:8000/api/v1/posts').catch(() => null)
  const postsJson = postsResponse ? await postsResponse.json().catch(() => null) : null
  const posts = Array.isArray(postsJson) ? postsJson : postsJson?.data ?? []
  const postUrls = posts
    .filter((post: any) => post?.slug)
    .map((post: any) => ({
      loc: `${siteUrl}/blog/${post.slug}`,
      lastmod: post.updated_at || post.created_at,
      images: post.image
        ? [{
            loc: `${siteUrl}/storage/${post.image}`,
            title: post.title,
          }]
        : undefined,
    }))
  const prerenderRoutes = posts
    .filter((post: any) => post?.slug)
    .map((post: any) => `/blog/${post.slug}`)
=======

const siteUrl = process.env.SITE_URL || 'https://infinicodesystem.site'

export default defineNuxtConfig({
  ssr: true,
>>>>>>> c116e3694b98c75da1524cb66a950af1c1512c85

<<<<<<< HEAD
  modules: ['@nuxtjs/robots', '@nuxtjs/sitemap'],

  css: ['~/assets/css/main.css'],

  postcss: {
    plugins: {
      tailwindcss: {},
      autoprefixer: {},
=======
  return {
    ssr: true,
    modules: ['@nuxtjs/robots', '@nuxtjs/sitemap'],
    css: ['~/assets/css/main.css'],
    runtimeConfig: {
      public: {
        apiBase: 'http://127.0.0.1:8000/api/v1',
      },
    },
    postcss: {
      plugins: {
        tailwindcss: {},
        autoprefixer: {},
      },
>>>>>>> 7da49c13202f9a9ce49528064a5cd45b84c2fcd3
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
// https://nuxt.com/docs/api/configuration/nuxt-config
const siteUrl = process.env.SITE_URL || 'https://infinicodesystem.site'

export default defineNuxtConfig(async () => {
  const postsResponse = await fetch('https://api.infinicodesystem.site/api/v1/posts').catch(() => null)
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

  return {
    ssr: true,
    modules: ['@nuxtjs/robots', '@nuxtjs/sitemap'],
    css: ['~/assets/css/main.css'],
    runtimeConfig: {
      public: {
        apiBase: 'https://api.infinicodesystem.site/api/v1',
      },
    },
    postcss: {
      plugins: {
        tailwindcss: {},
        autoprefixer: {},
      },
    },
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
        ...postUrls,
      ],
    },
    nitro: {
      prerender: {
        routes: prerenderRoutes,
      },
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
  }
})

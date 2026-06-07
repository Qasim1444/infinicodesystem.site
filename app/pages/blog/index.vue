<template>
  <div class="pt-24 px-6 max-w-6xl mx-auto">
    <h1 class="text-5xl font-bold mb-12 text-center">
      Blog
    </h1>

    <!-- Loading -->
    <div v-if="pending" class="text-center py-20">
      <p class="text-gray-500 animate-pulse">
        Loading blog posts...
      </p>
    </div>

    <!-- Error -->
    <div v-else-if="error" class="text-center py-20 text-red-500">
      Failed to load posts.
    </div>

    <!-- Empty -->
    <div v-else-if="!posts?.length" class="text-center py-20 text-gray-400">
      No posts found.
    </div>

    <!-- Grid -->
    <div v-else class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
      <PostCard
        v-for="post in posts"
        :key="post.id"
        :post="post"
      />
    </div>
  </div>
</template>

<script setup lang="ts">
const config = useRuntimeConfig()
const nuxtApp = useNuxtApp()

useSeoMeta({
  title: 'Blog — infinicodesystem.site',
  description: 'Latest web development insights and articles.',
  ogTitle: 'Blog — infinicodesystem.site',
  ogDescription: 'Latest insights and tutorials.',
  ogType: 'website',
  ogUrl: 'api.infinicodesystem.site/blog',
})

useHead({
  link: [
    {
      rel: 'canonical',
      href: 'api.infinicodesystem.site/blog',
    },
  ],
})

const { data: posts, pending, error } = await useAsyncData(
  'all-posts',
  async () => {
    return await $fetch(`${config.public.apiBase}/posts`)
  },
  {
    default: () => [],
    watch: [],
    getCachedData: (key: string) =>
      nuxtApp.payload.data[key] || nuxtApp.static.data[key],
  }
)
</script>
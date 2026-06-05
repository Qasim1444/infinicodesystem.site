<template>
  <div class="pt-24 px-6 max-w-6xl mx-auto">
    <h1 class="text-5xl font-bold mb-12 text-center">
      Journal
    </h1>

    <!-- Loading State -->
    <div v-if="pending" class="text-center py-20">
      <p class="animate-pulse text-gray-500">Loading blog posts...</p>
    </div>

    <!-- Error State -->
    <div v-else-if="error" class="text-center py-20 text-red-500">
      <p>Failed to load posts. Please try again later.</p>
    </div>

    <!-- Empty State -->
    <div v-else-if="!posts?.length" class="text-center py-20 text-gray-400">
      No posts found.
    </div>

    <!-- Posts Grid -->
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

/**
 * SEO (better structured)
 */
useSeoMeta({
  title: 'Blog — infinicodesystem.site',
  description:
    'Read the latest agency and web development insights from infinicodesystem.site.',
  ogTitle: 'Blog — infinicodesystem.site',
  ogDescription:
    'Latest insights, tutorials, and updates from infinicodesystem.site.',
  ogType: 'website',
  ogUrl: 'https://infinicodesystem.site/blog',
})

useHead({
  link: [
    {
      rel: 'canonical',
      href: 'https://infinicodesystem.site/blog',
    },
  ],
})

/**
 * Fetch with caching + better key management
 */
const { data: posts, pending, error } = await useAsyncData(
  'all-posts',
  async () => {
    const res = await $fetch(`${config.public.apiBase}/posts`, {
      method: 'GET',
    })

    return res?.data ?? res
  },
  {
    lazy: false,
    server: true,
    default: () => [],
  }
)
</script>
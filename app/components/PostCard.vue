<template>
  <NuxtLink :to="`/blog/${post.slug}`" class="group block">
    
    <!-- Card -->
    <div
      class="relative overflow-hidden rounded-3xl aspect-video
             bg-zinc-900 border border-white/10
             shadow-lg hover:shadow-violet-500/20
             transition-all duration-500
             group-hover:-translate-y-1"
    >

      <!-- Image -->
      <img
        v-if="post.image"
        :src="`api.infinicodesystem.site/storage/${post.image}`"
        class="w-full h-full object-cover
               group-hover:scale-110 transition duration-700 ease-out"
        alt=""
      />

      <!-- Strong Gradient Overlay -->
      <div
        class="absolute inset-0
               bg-gradient-to-t from-black/95 via-black/40 to-transparent"
      />

      <!-- Soft Glass Highlight -->
      <div
        class="absolute inset-0 opacity-0 group-hover:opacity-100
               transition duration-500
               bg-gradient-to-tr from-violet-500/10 via-transparent to-cyan-500/10"
      />

      <!-- Content -->
      <div class="absolute bottom-0 left-0 right-0 p-6 text-white z-10">

        <!-- Category -->
        <!-- <div
          v-if="post.category?.name"
          class="mb-3"
        >
          <span
            class="inline-flex items-center text-[11px] uppercase tracking-widest
                   px-3 py-1 rounded-full
                   bg-white/10 backdrop-blur-md
                   border border-white/20
                   text-violet-300
                   shadow-sm"
          >
            {{ post.category.name }}
          </span>
        </div> -->

        <!-- Title -->
        <h3
          class="text-xl font-semibold leading-snug mb-2
                 line-clamp-2 group-hover:text-white transition"
        >
          {{ post.title }}
        </h3>

        <!-- Excerpt -->
        <!-- <p class="text-sm text-zinc-300/80 line-clamp-2 leading-relaxed">
          {{ getExcerpt(post) }}
        </p> -->

      </div>

      <!-- Hover glow border -->
      <div
        class="absolute inset-0 rounded-3xl
               ring-1 ring-white/0 group-hover:ring-violet-500/30
               transition duration-500"
      ></div>

    </div>

  </NuxtLink>
</template>

<script setup lang="ts">
defineProps<{ post: any }>()

const getExcerpt = (post: any) => {
  if (!post.content) return ''
  const text = post.content.replace(/<[^>]+>/g, '')
  return text.length > 130 ? text.substring(0, 130) + '...' : text
}
</script>
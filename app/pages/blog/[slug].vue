<template>
  <div class="pt-24 pb-16 px-6 max-w-4xl mx-auto">
    <!-- Loading State -->
    <div v-if="pending" class="text-center py-20">
      <p class="text-zinc-400">Loading post...</p>
    </div>

    <!-- Error State -->
    <div v-else-if="error" class="text-center py-20 text-red-500">
      <p>Error loading post: {{ error.message }}</p>

      <button
        @click="refresh"
        class="mt-4 px-6 py-3 bg-violet-600 rounded-xl text-white"
      >
        Try Again
      </button>
    </div>

    <!-- Blog Post -->
    <article
      v-else-if="post"
      class="prose prose-invert max-w-none"
    >
      <!-- Featured Image -->
      <img
        v-if="post.image"
        :src="`http://127.0.0.1:8000/storage/${post.image}`"
        alt="Featured Image"
        class="w-full h-96 object-cover rounded-3xl mb-10"
      >

      <!-- Title -->
      <h1 class="text-5xl md:text-6xl font-bold leading-tight mb-6">
        {{ post.title }}
      </h1>

      <!-- Meta -->
      <div class="post-meta">
        <span
          v-if="post.category"
          class="category-badge"
        >
          {{ post.category.name }}
        </span>

        <span>
          {{
            new Date(post.created_at).toLocaleDateString(
              'en-US',
              {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
              }
            )
          }}
        </span>
      </div>

      <!-- Content -->
      <ClientOnly>
        <div
          class="content-body"
          v-html="sanitizeHtml(post.content)"
        ></div>
      </ClientOnly>

      <!-- Tags -->
      <div
        v-if="post.tags?.length"
        class="tags"
      >
        <span
          v-for="tag in post.tags"
          :key="tag.id"
          class="tag-item"
        >
          #{{ tag.name }}
        </span>
      </div>

      <!-- Comments -->
      <CommentSection :post-id="post.id" />
    </article>

    <!-- Not Found -->
    <div
      v-else
      class="text-center py-20 text-zinc-400"
    >
      Post not found.
    </div>
  </div>
</template>

<script setup lang="ts">
const siteUrl = 'http://127.0.0.1:8000'
const route = useRoute()

const {
  data: post,
  pending,
  error,
  refresh
} = await useAsyncData(
  `post-${route.params.slug}`,
  async () => {
    return await $fetch(
      `http://127.0.0.1:8000/api/v1/posts/${route.params.slug}`
    )
  }
)

useHead(() => {
  const article = post.value

  if (!article) {
    return {
      title: 'Blog Post | infinicodesystem.site',
      meta: [
        {
          name: 'robots',
          content: 'index, follow'
        }
      ]
    }
  }

  return {
    title: `${article.title} | infinicodesystem.site`,

    meta: [
      {
        name: 'description',
        content:
          article.excerpt ||
          article.title ||
          'Read this article on infinicodesystem.site'
      },

      {
        name: 'robots',
        content: 'index, follow'
      },

      {
        property: 'og:title',
        content: article.title
      },

      {
        property: 'og:description',
        content:
          article.excerpt ||
          article.title
      },

      {
        property: 'og:type',
        content: 'article'
      },

      {
        property: 'og:url',
        content: `${siteUrl}/blog/${route.params.slug}`
      },

      {
        property: 'og:image',
        content: article.image
          ? `http://127.0.0.1:8000/storage/${article.image}`
          : ''
      }
    ],

    link: [
      {
        rel: 'canonical',
        href: `${siteUrl}/blog/${route.params.slug}`
      }
    ]
  }
})

/**
 * Sanitize HTML content to prevent XSS attacks
 * Allows safe HTML tags commonly used in blog content
 * Only runs on client-side (SSR-safe)
 */
const sanitizeHtml = (html: string) => {
  if (!html) return ''
  
  // Check if we're on the server (document doesn't exist in Node.js environment)
  if (process.server || typeof document === 'undefined') return html
  
  // Create a temporary DOM element
  const temp = document.createElement('div')
  temp.innerHTML = html
  
  // List of allowed tags
  const allowedTags = new Set([
    'P', 'BR', 'STRONG', 'B', 'EM', 'I', 'U', 'S',
    'H1', 'H2', 'H3', 'H4', 'H5', 'H6',
    'UL', 'OL', 'LI', 'DL', 'DT', 'DD',
    'BLOCKQUOTE', 'CODE', 'PRE',
    'A', 'IMG', 'TABLE', 'THEAD', 'TBODY', 'TH', 'TR', 'TD',
    'HR', 'DIV', 'SPAN', 'SECTION', 'ARTICLE', 'STYLE'
  ])
  
  // Allowed attributes
  const allowedAttributes = {
    'A': ['href', 'title', 'target'],
    'IMG': ['src', 'alt', 'title', 'width', 'height'],
    'DIV': ['class', 'style'],
    'SPAN': ['class', 'style'],
    'TABLE': ['class', 'style'],
    'TD': ['style'],
    'TH': ['style'],
    'TR': ['style'],
    '*': ['class', 'id', 'style']
  }
  
  const walk = (node: Node) => {
    if (node.nodeType === Node.ELEMENT_NODE) {
      const element = node as Element
      
      if (!allowedTags.has(element.tagName)) {
        const fragment = document.createDocumentFragment()
        while (element.firstChild) {
          fragment.appendChild(element.firstChild)
        }
        element.parentNode?.replaceChild(fragment, element)
        return
      }
      
      // Remove disallowed attributes
      const allowedAttrs = allowedAttributes[element.tagName] || allowedAttributes['*'] || []
      Array.from(element.attributes).forEach(attr => {
        if (!allowedAttrs.includes(attr.name.toLowerCase())) {
          element.removeAttribute(attr.name)
        }
      })
      
      Array.from(element.childNodes).forEach(walk)
    } else if (node.nodeType === Node.COMMENT_NODE) {
      node.parentNode?.removeChild(node)
    }
  }
  
  walk(temp)
  return temp.innerHTML
}
</script>

<style scoped>
/* Main Article Container */
article {
  @apply bg-zinc-900 rounded-2xl p-6 border border-zinc-800 overflow-hidden;
}

/* Featured Image */
article img:first-child {
  @apply rounded-2xl;
}

/* Title */
article h1 {
  @apply text-zinc-100;
}

/* Meta Information */
.post-meta {
  @apply flex flex-wrap items-center gap-4 text-sm text-zinc-400 mb-10;
}

/* Category Badge */
.category-badge {
  @apply bg-violet-600 text-white px-4 py-2 rounded-full;
}

/* Content Wrapper */
.content-body {
  @apply text-zinc-200;
}

/* Headings */
.content-body :deep(h1),
.content-body :deep(h2),
.content-body :deep(h3),
.content-body :deep(h4),
.content-body :deep(h5),
.content-body :deep(h6) {
  @apply text-zinc-100 mt-8 mb-4 font-bold;
}

/* Paragraphs */
.content-body :deep(p) {
  @apply mb-5 text-zinc-200 leading-relaxed;
}

/* Links */
.content-body :deep(a) {
  @apply text-violet-400 underline;
}

/* Lists */
.content-body :deep(ul),
.content-body :deep(ol) {
  @apply ml-6 my-6;
}

.content-body :deep(li) {
  @apply mb-2 text-zinc-200;
}

/* Images Inside Content */
.content-body :deep(img) {
  @apply rounded-xl my-6 max-w-full;
}

/* Tables */
.content-body :deep(table) {
  @apply w-full border-collapse bg-zinc-800 rounded-xl overflow-hidden my-6;
}

.content-body :deep(th) {
  @apply bg-zinc-700 text-zinc-100 px-4 py-3 text-left;
}

.content-body :deep(td) {
  @apply px-4 py-3 border-t border-zinc-700 text-zinc-200;
}

/* Blockquotes */
.content-body :deep(blockquote) {
  @apply border-l-4 border-violet-500 pl-4 italic text-zinc-300 my-6;
}

/* Code */
.content-body :deep(pre) {
  @apply bg-zinc-950 p-4 rounded-xl overflow-x-auto my-6;
}

.content-body :deep(code) {
  @apply text-violet-300;
}

/* Horizontal Rule */
.content-body :deep(hr) {
  @apply border-zinc-700 my-8;
}

/* Section Header */
.content-body :deep(.sec-head) {
  @apply flex items-center gap-3 bg-violet-900/20 px-4 py-3 rounded-lg mb-6 mt-8 border-l-4 border-violet-500;
}

/* Cards */
.content-body :deep(.factor-card),
.content-body :deep(.example-card),
.content-body :deep(.tip-box),
.content-body :deep(.cta-box) {
  @apply bg-zinc-800 rounded-xl p-6 border border-zinc-700 my-6;
}

/* Badges */
.content-body :deep(.badge),
.content-body :deep(.pill) {
  @apply bg-violet-600 text-white text-xs px-3 py-1 rounded-full;
}

/* Tags */
.tags {
  @apply mt-12 flex flex-wrap gap-2;
}

.tag-item {
  @apply text-xs bg-zinc-800 text-zinc-300 px-4 py-2 rounded-full;
}
</style>
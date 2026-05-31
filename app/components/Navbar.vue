<template>
  <nav class="fixed top-0 w-full bg-zinc-950/90 backdrop-blur-md z-50 border-b border-zinc-800">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
      <NuxtLink to="/" class="text-2xl font-bold tracking-tight">
        infinicodesystem<span class="text-violet-500">.</span>
      </NuxtLink>

      <div class=" md:flex items-center space-x-10">
        <NuxtLink 
          v-for="link in navigationLinks" 
          :key="link.path"
          :to="link.path" 
          class="text-sm uppercase tracking-widest text-zinc-300 hover:text-white transition"
        >
          {{ link.name }}
        </NuxtLink>
      </div>

      <div class=" md:block">
        <button 
          @click="contactClick"
          class="bg-violet-600 text-white px-6 py-2.5 rounded-full text-sm font-medium hover:bg-violet-500 transition"
        >
          Let's Talk
        </button>
      </div>

      <button 
        @click="mobileMenuOpen = !mobileMenuOpen" 
        class="md:hidden text-white p-2"
        aria-label="Toggle menu"
      >
        <svg v-if="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
        <svg v-else class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>

    <div v-show="mobileMenuOpen" class="md:hidden bg-zinc-900 border-t border-zinc-800">
      <div class="px-6 py-6 space-y-4">
        <NuxtLink 
          v-for="link in navigationLinks" 
          :key="link.path"
          :to="link.path" 
          @click="mobileMenuOpen = false"
          class="block text-sm uppercase tracking-widest text-zinc-300 hover:text-white transition"
        >
          {{ link.name }}
        </NuxtLink>
        <button 
          @click="contactClickAndClose"
          class="w-full bg-violet-600 text-white px-6 py-2.5 rounded-full text-sm font-medium hover:bg-violet-500 transition"
        >
          Let's Talk
        </button>
      </div>
    </div>
  </nav>
</template>

<script setup>
const mobileMenuOpen = ref(false)

const navigationLinks = [
  { name: 'Home', path: '/' },
  { name: 'Projects', path: '/projects' },
  { name: 'Services', path: '/services' },
  { name: 'Blog', path: '/blog' },
  { name: 'About', path: '/about' },
  { name: 'Contact', path: '/contact' }
]

const contactClick = () => {
  navigateTo('/contact')
}

const contactClickAndClose = () => {
  mobileMenuOpen.value = false
  navigateTo('/contact')
}
</script>
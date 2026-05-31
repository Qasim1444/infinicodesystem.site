<!-- app.vue -->
<template>
  <div class="min-h-screen bg-zinc-950 text-white font-sans">
    <Navbar />
    <NuxtPage />
    <Footer />
  </div>
</template>

<script setup>
useHead({
  title: 'infinicodesystem.site - Modern Digital Agency ',
  meta: [{ name: 'description', content: 'Modern Digital Agency & Blog' }]
})
</script>

<style global lang="postcss">
</style>
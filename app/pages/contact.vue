<template>
  <div class="pt-24 pb-20 px-6 max-w-2xl mx-auto">
    <div class="text-center mb-12">
      <h1 class="text-6xl font-bold tracking-tighter mb-4">Let's Work Together</h1>
      <p class="text-zinc-400 text-lg">Tell us about your project and we'll get back to you soon.</p>
    </div>

    <form @submit.prevent="submitForm" class="space-y-8">
      <div class="grid md:grid-cols-2 gap-6">
        <input v-model="form.name" type="text" placeholder="Your Name" required
          class="bg-zinc-900 border border-zinc-700 rounded-2xl px-6 py-4 focus:outline-none focus:border-violet-500">
        <input v-model="form.email" type="email" placeholder="Email Address" required
          class="bg-zinc-900 border border-zinc-700 rounded-2xl px-6 py-4 focus:outline-none focus:border-violet-500">
      </div>

      <input v-model="form.subject" type="text" placeholder="Project Subject" required
        class="w-full bg-zinc-900 border border-zinc-700 rounded-2xl px-6 py-4 focus:outline-none focus:border-violet-500">

      <textarea v-model="form.message" rows="8" placeholder="Tell us about your project..." required
        class="w-full bg-zinc-900 border border-zinc-700 rounded-3xl px-6 py-5 focus:outline-none focus:border-violet-500 resize-none"></textarea>

      <div class="flex items-center gap-3">
        <input v-model="form.subscribe" type="checkbox" id="subscribe"
          class="w-5 h-5 rounded bg-zinc-900 border border-zinc-700 focus:ring-violet-500">
        <label for="subscribe" class="text-zinc-400 cursor-pointer">Subscribe to our newsletter</label>
      </div>

      <button type="submit"
        class="w-full bg-violet-600 hover:bg-violet-700 py-5 rounded-2xl text-lg font-medium transition">
        Send Message
      </button>

      <button v-if="form.subscribe" type="button" @click="subscribeNewsletter"
        class="w-full bg-zinc-800 hover:bg-zinc-700 py-3 rounded-2xl text-sm font-medium transition">
        Subscribe to Newsletter
      </button>
    </form>

    <div class="mt-16 text-center text-zinc-400">
      <p>Or email us directly at <span class="text-violet-400">info@infinicodesystem.site</span></p>
    </div>
  </div>
</template>

<script setup>
import { reactive } from 'vue'

const form = reactive({
  name: '',
  email: '',
  subject: '',
  message: '',
  subscribe: false
})

const submitForm = async () => {
  alert('Thank you! We will contact you soon. (Demo)')
  form.name = ''
  form.email = ''
  form.subject = ''
  form.message = ''
  form.subscribe = false
}

const subscribeNewsletter = async () => {
  if (!form.email) {
    alert('Please enter your email address first.')
    return
  }

  try {
    const response = await fetch('http://127.0.0.1:8000/api/subscribe', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
      },
      body: JSON.stringify({ email: form.email })
    })

    if (response.ok) {
      alert('Successfully subscribed to our newsletter!')
    } else {
      const data = await response.json()
      alert(data.message || 'Subscription failed. Please try again.')
    }
  } catch (error) {
    alert('An error occurred. Please try again later.')
  }
}
</script>

import { defineEventHandler, readBody, createError } from 'h3'

export default defineEventHandler(async (event) => {
  const body = await readBody(event)
  const { email } = body

  if (!email || !email.includes('@')) {
    throw createError({
      statusCode: 400,
      statusMessage: 'Valid email is required'
    })
  }

  return {
    message: 'Successfully subscribed to newsletter',
    subscriber: {
      id: Date.now(),
      email,
      created_at: new Date().toISOString(),
      updated_at: new Date().toISOString()
    }
  }
})

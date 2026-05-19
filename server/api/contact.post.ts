import { defineEventHandler, readBody, createError } from 'h3'

export default defineEventHandler(async (event) => {
  const body = await readBody(event)
  const { name, email, subject, message, subscribe } = body

  if (!name || !email || !subject || !message) {
    throw createError({
      statusCode: 400,
      statusMessage: 'All fields are required'
    })
  }

  if (!email.includes('@')) {
    throw createError({
      statusCode: 400,
      statusMessage: 'Valid email is required'
    })
  }

  const contact = {
    id: Date.now(),
    name,
    email,
    subject,
    message,
    created_at: new Date().toISOString(),
    updated_at: new Date().toISOString()
  }

  if (subscribe) {
    // Subscribe logic would go here
  }

  return {
    status: true,
    message: 'Thank you for contacting us!',
    data: contact
  }
})
<template>
  <NotFoundInline
    v-if="!engineer"
    :title="localized('That engineering role doesn’t exist', 'هذا التخصص الهندسي غير متوفر')"
    :text="localized('Browse the engineering roles we can help you hire for.', 'استعرض التخصصات الهندسية التي يمكننا مساعدتك في توظيفها.')"
    back-to="/engineers"
    :back-label="localized('All Engineers', 'جميع المهندسين')"
  />

  <div v-else class="engineer-detail">
    <section class="page-hero">
      <div class="bg-grid" aria-hidden="true" />
      <div class="bg-glow engineer-detail__glow" aria-hidden="true" />
      <div class="container">
        <nav class="breadcrumbs" aria-label="Breadcrumb" v-reveal>
          <Link href="/">{{ localized('Home', 'الرئيسية') }}</Link>
          <span class="sep">/</span>
          <Link href="/engineers">{{ localized('Engineers', 'المهندسون') }}</Link>
          <span class="sep">/</span>
          <span aria-current="page">{{ engineerTitle }}</span>
        </nav>
        <div class="page-hero__inner">
          <span class="icon-tile engineer-detail__icon" v-reveal><AppIcon :name="engineer.icon" /></span>
          <span class="eyebrow" v-reveal="40">{{ localized('Flexible engineering talent', 'خبرات هندسية مرنة') }}</span>
          <h1 class="display engineer-detail__title" v-reveal="60">{{ localized('Hire', 'استعن بـ') }} {{ engineerTitle }}</h1>
          <p class="lead" v-reveal="120">{{ engineerText('short') }}</p>
          <div class="btn-group" v-reveal="180">
            <Link href="/contact" class="btn btn--primary btn--lg">
              {{ localized('Discuss this role', 'ناقش هذا التخصص') }} <AppIcon name="arrow-right" class="icon-arrow" />
            </Link>
            <Link href="/engineers" class="btn btn--ghost btn--lg">{{ localized('Browse all engineers', 'استعرض جميع المهندسين') }}</Link>
          </div>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="container engineer-detail__intro-grid">
        <div>
          <SectionHeading
            :eyebrow="localized('Role overview', 'نظرة عامة على الدور')"
            :title="localized('A specialist who fits your team', 'متخصص ينسجم مع فريقك')"
          />
          <p class="engineer-detail__overview">{{ engineerText('overview') }}</p>
        </div>
        <aside class="engineer-detail__capabilities card">
          <h2>{{ localized('How they can help', 'كيف يمكنهم مساعدتك') }}</h2>
          <ul class="feature-list">
            <li v-for="capability in engineerText('capabilities')" :key="capability">
              <AppIcon name="check-circle" :size="18" /> {{ capability }}
            </li>
          </ul>
        </aside>
      </div>
    </section>

    <section class="section surface-elev">
      <div class="container engineer-detail__stack-grid">
        <div>
          <SectionHeading
            :eyebrow="localized('Relevant expertise', 'الخبرات المناسبة')"
            :title="localized('Tools that match your project', 'أدوات تناسب مشروعك')"
          >
            {{ localized('The exact stack depends on your product and existing systems. These are common tools for this role.', 'تتحدد التقنيات وفق منتجك وأنظمتك الحالية. وهذه أدوات شائعة لهذا التخصص.') }}
          </SectionHeading>
        </div>
        <div class="cluster engineer-detail__technologies">
          <span v-for="technology in engineer.technologies" :key="technology" class="tag">{{ technology }}</span>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="container">
        <SectionHeading
          :eyebrow="localized('How hiring works', 'خطوات التوظيف')"
          :title="localized('A simple way to add the right skills', 'طريقة بسيطة لإضافة المهارات المناسبة')"
        />
        <div class="grid grid-3 engineer-detail__process">
          <article v-for="(step, index) in process" :key="step.title" class="card engineer-detail__step">
            <span class="engineer-detail__step-index">0{{ index + 1 }}</span>
            <h3>{{ step.title }}</h3>
            <p>{{ step.text }}</p>
          </article>
        </div>
      </div>
    </section>

    <CtaBand
      :eyebrow="localized('Let’s talk about your team', 'لنتحدث عن فريقك')"
      :title="localized(`Looking for ${engineer.title}?`, `هل تبحث عن ${engineerTitle}؟`)"
      :text="localized('Share the role, timeline and skills you have in mind. We’ll help you work out the next step.', 'شاركنا الدور والجدول الزمني والمهارات المطلوبة، وسنساعدك في تحديد الخطوة التالية.')"
      :primary-label="localized('Contact our team', 'تواصل مع فريقنا')"
      primary-to="/contact"
      :secondary-label="localized('All engineering roles', 'جميع الأدوار الهندسية')"
      secondary-to="/engineers"
    />
  </div>
</template>

<script setup>
import { computed, inject } from 'vue'
import { Link } from '@inertiajs/vue3'
import AppIcon from '@/Components/ui/AppIcon.vue'
import SectionHeading from '@/Components/ui/SectionHeading.vue'
import CtaBand from '@/Components/ui/CtaBand.vue'
import NotFoundInline from '@/Components/ui/NotFoundInline.vue'
import { engineers, engineerHiringProcess } from '@/engineerContent'

const props = defineProps({ slug: { type: String, default: '' } })
const { preferences } = inject('sitePreferences')
const engineer = computed(() => engineers.find((item) => item.slug === props.slug) ?? null)
const isArabic = computed(() => preferences.locale === 'ar')
const engineerTitle = computed(() => engineer.value ? (isArabic.value ? engineer.value.titleAr : engineer.value.title) : '')
const process = computed(() => engineerHiringProcess[isArabic.value ? 'ar' : 'en'])

function localized(english, arabic) {
  return isArabic.value ? arabic : english
}

function engineerText(field) {
  if (!engineer.value) return ''

  return isArabic.value ? engineer.value[`${field}Ar`] ?? engineer.value[field] : engineer.value[field]
}
</script>

<style scoped>
.engineer-detail__glow { top: -180px; right: -120px; }
.engineer-detail__icon { margin-bottom: var(--space-5); }
.engineer-detail__title { max-width: 18ch; }
.engineer-detail__intro-grid,
.engineer-detail__stack-grid { display: grid; grid-template-columns: 1fr 1fr; gap: clamp(2rem, 6vw, 5rem); align-items: start; }
.engineer-detail__overview { max-width: 64ch; color: var(--text-body); line-height: 1.85; }
.engineer-detail__capabilities { padding: clamp(1.5rem, 3vw, 2.5rem); }
.engineer-detail__capabilities h2 { margin-bottom: var(--space-5); color: var(--text-hi); font-size: var(--fs-lg); }
.engineer-detail__technologies { align-content: start; }
.engineer-detail__step { padding: var(--space-6); }
.engineer-detail__step-index { color: var(--cyan); font-weight: 800; }
.engineer-detail__step h3 { margin: var(--space-3) 0; color: var(--text-hi); }
.engineer-detail__step p { margin: 0; color: var(--text-body); line-height: 1.7; }
@media (max-width: 800px) {
  .engineer-detail__intro-grid,
  .engineer-detail__stack-grid { grid-template-columns: 1fr; }
}
</style>

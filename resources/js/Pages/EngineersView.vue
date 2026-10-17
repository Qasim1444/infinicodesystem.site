<template>
  <div class="engineers-page">
    <section class="page-hero">
      <div class="bg-grid" aria-hidden="true" />
      <div class="container">
        <nav class="breadcrumbs" aria-label="Breadcrumb" v-reveal>
          <Link href="/">{{ localized('Home', 'الرئيسية') }}</Link>
          <span class="sep">/</span>
          <span aria-current="page">{{ localized('Engineers', 'المهندسون') }}</span>
        </nav>
        <div class="page-hero__inner">
          <span class="eyebrow" v-reveal>{{ localized('Flexible engineering talent', 'خبرات هندسية مرنة') }}</span>
          <h1 class="display" v-reveal="60">
            {{ localized('Meet the engineers', 'تعرّف على المهندسين') }}
            <span class="text-accent">{{ localized('who move work forward', 'الذين يدفعون العمل للأمام') }}</span>
          </h1>
          <p class="lead" v-reveal="120">
            {{ localized(
              'Add experienced engineers to your team for a project, a product milestone or ongoing delivery. Start with the skills you need and a clear plan for working together.',
              'أضف مهندسين ذوي خبرة لفريقك لمشروع أو مرحلة من المنتج أو تسليم مستمر. ابدأ بالمهارات المطلوبة وخطة واضحة للتعاون.'
            ) }}
          </p>
          <div class="btn-group" v-reveal="180">
            <Link href="/contact" class="btn btn--primary">
              {{ localized('Talk to our team', 'تحدث إلى فريقنا') }} <AppIcon name="arrow-right" class="icon-arrow" />
            </Link>
            <a href="#engineering-roles" class="btn btn--ghost">{{ localized('Explore engineers', 'استكشف المهندسين') }}</a>
          </div>
        </div>
      </div>
    </section>

    <section id="engineering-roles" class="section">
      <div class="container">
        <SectionHeading
          :eyebrow="localized('Engineering roles', 'الأدوار الهندسية')"
          :title="localized('Find the expertise your roadmap needs', 'اعثر على الخبرات التي تحتاجها خطتك')"
        >
          {{ localized('Browse focused engineering roles, then open a dedicated page to see how each specialist can contribute.', 'استعرض الأدوار الهندسية ثم افتح صفحة كل تخصص لمعرفة كيف يمكن للمهندس المساهمة.') }}
        </SectionHeading>

        <div v-for="(group, groupIndex) in hiringGroups" :key="group.en" class="engineers-group" v-reveal="groupIndex * 60">
          <h2 class="engineers-group__title">{{ localized(group.en, group.ar) }}</h2>
          <div class="grid grid-3">
            <Link v-for="engineer in group.engineers" :key="engineer.slug" :href="`/engineers/${engineer.slug}`" class="engineer-card card card--hover card--interactive">
              <span class="icon-tile"><AppIcon :name="engineer.icon" /></span>
              <h3>{{ engineerTitle(engineer) }}</h3>
              <p>{{ localized(engineer.short, engineer.shortAr) }}</p>
              <span class="link-arrow engineer-card__link">
                {{ localized('Explore this role', 'استكشف هذا التخصص') }} <AppIcon name="arrow-right" />
              </span>
            </Link>
          </div>
        </div>
      </div>
    </section>

    <section class="section surface-elev engineer-process">
      <div class="container">
        <SectionHeading
          :eyebrow="localized('A straightforward start', 'بداية واضحة')"
          :title="localized('From role brief to working together', 'من تحديد الدور إلى بدء التعاون')"
        />
        <div class="grid grid-3 engineer-process__grid">
          <article v-for="(step, index) in process" :key="step.title" class="engineer-process__step card">
            <span class="engineer-process__index">0{{ index + 1 }}</span>
            <h3>{{ step.title }}</h3>
            <p>{{ step.text }}</p>
          </article>
        </div>
      </div>
    </section>

    <CtaBand
      :eyebrow="localized('Build your team', 'كوّن فريقك')"
      :title="localized('Tell us which skills you need', 'أخبرنا بالمهارات التي تحتاجها')"
      :text="localized('We’ll talk through your goals, team setup and timeline, then suggest a practical way to get started.', 'سنناقش أهدافك وتركيبة الفريق والجدول الزمني ثم نقترح طريقة عملية للبدء.')"
      :primary-label="localized('Discuss your requirements', 'ناقش متطلباتك')"
      primary-to="/contact"
      :secondary-label="localized('View services', 'استعرض الخدمات')"
      secondary-to="/services"
    />
  </div>
</template>

<script setup>
import { computed, inject } from 'vue'
import { Link } from '@inertiajs/vue3'
import AppIcon from '@/Components/ui/AppIcon.vue'
import SectionHeading from '@/Components/ui/SectionHeading.vue'
import CtaBand from '@/Components/ui/CtaBand.vue'
import { engineerGroups, engineers, engineerHiringProcess } from '@/engineerContent'

const { preferences } = inject('sitePreferences')
const hiringGroups = computed(() => [
  {
    en: 'AI & Data Engineers',
    ar: 'مهندسو الذكاء الاصطناعي والبيانات',
    engineers: engineers.filter((engineer) => engineer.group === 'AI & Data Engineers'),
  },
  ...engineerGroups.map((group) => ({
    ...group,
    engineers: group.links.map((link) => engineers.find((engineer) => engineer.slug === link.slug)).filter(Boolean),
  })),
])
const process = computed(() => engineerHiringProcess[preferences.locale === 'ar' ? 'ar' : 'en'])

function localized(english, arabic) {
  return preferences.locale === 'ar' ? arabic : english
}

function engineerTitle(engineer) {
  return preferences.locale === 'ar' ? engineer.titleAr : engineer.title
}
</script>

<style scoped>
.engineers-group + .engineers-group { margin-top: var(--space-8); }
.engineers-group__title { margin-bottom: var(--space-5); color: var(--text-hi); font-size: var(--fs-xl); }
.engineer-card { display: flex; flex-direction: column; align-items: flex-start; height: 100%; }
.engineer-card h3 { margin: var(--space-5) 0 var(--space-3); color: var(--text-hi); font-size: var(--fs-lg); }
.engineer-card p { margin-bottom: var(--space-5); color: var(--text-muted); line-height: 1.7; flex: 1; }
.engineer-card__link { margin-top: auto; color: var(--text-hi); }
.engineer-card:hover .engineer-card__link { color: var(--cyan); }
.engineer-process__step { padding: var(--space-6); }
.engineer-process__index { color: var(--cyan); font-weight: 800; }
.engineer-process__step h3 { margin: var(--space-3) 0; color: var(--text-hi); }
.engineer-process__step p { margin: 0; color: var(--text-body); line-height: 1.7; }
</style>

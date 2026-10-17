<template>
  <NotFoundInline
    v-if="!service"
    :title="localized('That service doesn’t exist', 'هذه الخدمة غير متوفرة')"
    :text="localized('We couldn’t find the service you were looking for. Browse everything we offer instead.', 'لم نعثر على الخدمة المطلوبة. يمكنك استعراض جميع خدماتنا.')"
    back-to="/services"
    :back-label="localized('All Services', 'جميع الخدمات')"
  />

  <div v-else class="service-detail">
    <!-- HERO -->
    <section class="page-hero">
      <div class="bg-grid" aria-hidden="true" />
      <div class="bg-glow service-detail__glow" aria-hidden="true" />
      <div class="container">
        <nav class="breadcrumbs" aria-label="Breadcrumb" v-reveal>
          <Link href="/">{{ localized('Home', 'الرئيسية') }}</Link>
          <span class="sep">/</span>
          <Link href="/services">{{ localized('Services', 'الخدمات') }}</Link>
          <span class="sep">/</span>
          <span aria-current="page">{{ serviceTitle }}</span>
        </nav>
        <div class="page-hero__inner">
          <span class="icon-tile service-detail__icon" v-reveal><AppIcon :name="service.icon" /></span>
          <h1 class="display service-detail__title" v-reveal="60">{{ serviceTitle }}</h1>
          <p class="lead" v-reveal="120">{{ serviceField('short') }}</p>
          <div class="btn-group" v-reveal="180">
            <Link href="/consultation#book" class="btn btn--primary btn--lg">
              {{ localized('Get a Free Consultation', 'احصل على استشارة مجانية') }} <AppIcon name="arrow-right" class="icon-arrow" />
            </Link>
            <Link href="/work" class="btn btn--ghost btn--lg">{{ localized('See related work', 'شاهد أعمالنا ذات الصلة') }}</Link>
          </div>
        </div>
      </div>
    </section>

    <!-- SERVICE OVERVIEW + OUTCOMES -->
    <section class="section service-overview">
      <div class="container service-overview__grid">
        <div v-reveal>
          <SectionHeading
            :eyebrow="localized('A closer look', 'نظرة أعمق')"
            :title="localized('Built around the way your team works', 'مصممة لتناسب طريقة عمل فريقك')"
          />
          <p class="service-overview__copy">{{ serviceContent.overview }}</p>
        </div>
        <div class="service-outcomes" v-reveal="100">
          <h2 class="service-detail__eyebrow">{{ localized('What this helps you achieve', 'ما الذي ستحققه') }}</h2>
          <article v-for="(outcome, index) in serviceContent.outcomes" :key="outcome" class="service-outcome card">
            <span class="service-outcome__index">0{{ index + 1 }}</span>
            <p>{{ outcome }}</p>
          </article>
        </div>
      </div>
    </section>

    <!-- PROBLEM / SOLUTION -->
    <section class="section section--flush-top">
      <div class="container">
        <div class="ps-grid">
          <article class="ps-card card" v-reveal>
            <h2 class="ps-card__title"><span class="dot" /> {{ localized('The challenge', 'التحدي') }}</h2>
            <p>{{ serviceField('problem') }}</p>
          </article>
          <article class="ps-card card ps-card--accent" v-reveal="80">
            <h2 class="ps-card__title"><span class="dot dot--accent" /> {{ localized('How we help', 'كيف نساعدك') }}</h2>
            <p>{{ serviceField('solution') }}</p>
          </article>
        </div>
      </div>
    </section>

    <!-- WHAT'S INCLUDED + STACK -->
    <section class="section surface-elev">
      <div class="container">
        <div class="incl-grid">
          <div v-reveal>
        <SectionHeading :eyebrow="localized('What’s included', 'ما الذي تتضمنه الخدمة')" :title="localized(`Everything in our ${service.title.toLowerCase()}`, `كل ما تحتاجه في خدمة ${serviceTitle}`)" />
            <ul class="feature-list incl-list">
              <li v-for="f in serviceFeatures" :key="f">
                <AppIcon name="check-circle" :size="18" /> {{ f }}
              </li>
            </ul>
          </div>
          <aside class="incl-side card" v-reveal="80">
            <h3 class="incl-side__label">{{ localized('Typical stack', 'التقنيات المستخدمة') }}</h3>
            <div class="cluster incl-side__tech">
              <span v-for="t in service.tech" :key="t" class="tag">{{ t }}</span>
            </div>
            <div class="incl-side__divider" />
            <h3 class="incl-side__label">{{ localized('Why CodeWire', 'لماذا نحن') }}</h3>
            <ul class="incl-side__why">
              <li><AppIcon name="check" :size="16" /> {{ localized('Senior engineers on every project', 'مهندسون خبراء في كل مشروع') }}</li>
              <li><AppIcon name="check" :size="16" /> {{ localized('Clear scope and honest estimates', 'نطاق واضح وتقديرات واقعية') }}</li>
              <li><AppIcon name="check" :size="16" /> {{ localized('You own the code and the IP', 'الكود والملكية الفكرية لك') }}</li>
            </ul>
            <Link href="/consultation#book" class="btn btn--primary btn--block incl-side__cta">
              {{ localized('Start a project', 'ابدأ مشروعًا') }}
            </Link>
          </aside>
        </div>
      </div>
    </section>

    <!-- DELIVERY PROCESS -->
    <section class="section service-process surface-elev">
      <div class="container">
        <SectionHeading
          :eyebrow="localized('How we work', 'طريقة عملنا')"
          :title="localized('A clear path from first conversation to launch', 'مسار واضح من أول محادثة حتى الإطلاق')"
        >
          {{ localized('You stay close to the work at every stage, with clear decisions and useful progress to review.', 'تبقى قريبًا من العمل في كل مرحلة، مع قرارات واضحة وتقدم ملموس يمكنك مراجعته.') }}
        </SectionHeading>
        <div class="service-process__grid">
          <article v-for="(step, index) in localizedDeliverySteps" :key="step.title" class="service-process__step" v-reveal="index * 60">
            <span class="service-process__number">0{{ index + 1 }}</span>
            <h3>{{ step.title }}</h3>
            <p>{{ step.text }}</p>
          </article>
        </div>
      </div>
    </section>

    <!-- USE CASES -->
    <section class="section service-use-cases">
      <div class="container service-use-cases__grid">
        <div>
          <SectionHeading
            :eyebrow="localized('Where it fits', 'مجالات الاستخدام')"
            :title="localized('Support for real product work', 'دعم لاحتياجات المنتجات الفعلية')"
          >
            {{ localized('Every engagement is shaped to your product, customers and operating context.', 'نصمم كل تعاون وفق منتجك وعملائك وطريقة عمل شركتك.') }}
          </SectionHeading>
        </div>
        <ul class="service-use-cases__list">
          <li v-for="useCase in serviceContent.useCases" :key="useCase">
            <AppIcon name="arrow-right" class="icon-arrow" />
            <span>{{ useCase }}</span>
          </li>
        </ul>
      </div>
    </section>

    <!-- SERVICE FAQ -->
    <section class="section surface-elev service-faq">
      <div class="container service-faq__grid">
        <SectionHeading
          :eyebrow="localized('Common questions', 'أسئلة شائعة')"
          :title="localized('Before we get started', 'قبل أن نبدأ')"
        >
          {{ localized('A few answers to help you plan the next step.', 'إجابات تساعدك على التخطيط للخطوة التالية.') }}
        </SectionHeading>
        <div class="service-faq__items">
          <details v-for="faq in serviceContent.faqs" :key="faq.question" class="service-faq__item card">
            <summary>{{ faq.question }}<AppIcon name="plus" :size="18" /></summary>
            <p>{{ faq.answer }}</p>
          </details>
        </div>
      </div>
    </section>

    <!-- RELATED SERVICES -->
    <section v-if="related.length" class="section">
      <div class="container">
        <SectionHeading :eyebrow="localized('Explore more', 'اكتشف المزيد')" :title="localized('Related services', 'خدمات ذات صلة')">
          {{ localized('We cover the whole product lifecycle — here’s what pairs well with this.', 'نغطي دورة حياة المنتج كاملة، وهذه خدمات تكمل الخدمة الحالية.') }}
        </SectionHeading>
        <div class="grid grid-3">
          <ServiceCard
            v-for="(s, i) in related"
            :key="s.slug"
            v-reveal="i * 60"
            :service="s"
            :learn-more-label="localized('Learn more', 'اعرف المزيد')"
          />
        </div>
      </div>
    </section>

    <CtaBand
      :eyebrow="localized(`Ready to talk ${service.title.toLowerCase()}?`, `هل تريد التحدث عن ${serviceTitle}؟`)"
      :title="localized('Tell us the problem — we’ll map the solution', 'أخبرنا عن التحدي وسنقترح الحل')"
      :text="localized('Book a free, no-pressure consultation. We’ll help you scope the work and recommend the right approach.', 'احجز استشارة مجانية بلا التزام. سنساعدك في تحديد نطاق العمل واختيار النهج المناسب.')"
      :primary-label="localized('Book a Consultation', 'احجز استشارة')"
      primary-to="/consultation"
      :secondary-label="localized('View Our Work', 'شاهد أعمالنا')"
      secondary-to="/work"
    />
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { computed, inject, onMounted } from 'vue'
import { trackViewContent } from '@/meta-pixel'
import AppIcon from '@/Components/ui/AppIcon.vue'
import SectionHeading from '@/Components/ui/SectionHeading.vue'
import ServiceCard from '@/Components/ui/ServiceCard.vue'
import CtaBand from '@/Components/ui/CtaBand.vue'
import NotFoundInline from '@/Components/ui/NotFoundInline.vue'
import { serviceArabic } from '@/serviceTranslations'
import { deliverySteps, servicePageContent } from '@/servicePageContent'

const props = defineProps({
  service: { type: Object, default: null },
  services: { type: Array, default: () => [] },
  slug: { type: String, default: '' },
})
const services = props.services
const service = computed(() => props.service)
const { preferences } = inject('sitePreferences')
const serviceContent = computed(() => {
  if (!service.value) return { overview: '', outcomes: [], useCases: [], faqs: [] }

  const language = preferences.locale === 'ar' ? 'ar' : 'en'

  return servicePageContent[service.value.slug]?.[language] ?? servicePageContent[service.value.slug]?.en
})
const localizedDeliverySteps = computed(() => deliverySteps[preferences.locale === 'ar' ? 'ar' : 'en'])
const arabicServiceTitles = {
  'web-development': 'تطوير تطبيقات الويب',
  'mobile-development': 'تطوير تطبيقات الجوال',
  'ui-ux-design': 'تصميم واجهات وتجربة المستخدم',
  'wordpress-development': 'تطوير ووردبريس وأنظمة إدارة المحتوى',
  'ecommerce-development': 'تطوير التجارة الإلكترونية',
  'ai-integration': 'تكامل الذكاء الاصطناعي',
  'devops-cloud': 'ديف أوبس والحلول السحابية',
  'qa-testing': 'ضمان الجودة والاختبار',
  'digital-transformation': 'التحول الرقمي',
}
const serviceTitle = computed(() => service.value ? serviceDisplayTitle(service.value) : '')
const serviceFeatures = computed(() => {
  if (!service.value) return []
  if (preferences.locale !== 'ar') return service.value.features

  return serviceArabic[service.value.slug]?.features ?? service.value.features
})
const related = computed(() =>
  service.value
    ? services
        .filter((s) => s.slug !== service.value.slug)
        .slice(0, 3)
        .map((s) => ({
          ...s,
          title: serviceDisplayTitle(s),
          short: preferences.locale === 'ar' ? serviceArabic[s.slug]?.short ?? s.short : s.short,
        }))
    : []
)

function localized(english, arabic) {
  return preferences.locale === 'ar' ? arabic : english
}

function serviceField(field) {
  if (!service.value) return ''
  if (preferences.locale !== 'ar') return service.value[field]

  return serviceArabic[service.value.slug]?.[field] ?? service.value[field]
}

function serviceDisplayTitle(item) {
  if (preferences.locale !== 'ar') return item.title

  return arabicServiceTitles[item.slug] ?? item.title
}

onMounted(() => {
  if (!service.value) return
  trackViewContent({
    contentName: service.value.title,
    contentType: 'service',
    contentIds: [service.value.slug],
  })
})
</script>

<style scoped>
.service-detail__glow { top: -180px; right: -120px; }
.service-detail__icon { margin-bottom: var(--space-5); }
.service-detail__title { max-width: 16ch; }
.service-overview__grid,
.service-use-cases__grid,
.service-faq__grid {
  display: grid;
  grid-template-columns: 0.9fr 1.1fr;
  gap: clamp(2rem, 6vw, 5rem);
  align-items: start;
}
.service-overview__copy { max-width: 60ch; color: var(--text-body); line-height: 1.85; }
.service-detail__eyebrow {
  margin-bottom: var(--space-4);
  color: var(--text-faint);
  font-size: var(--fs-xs);
  letter-spacing: var(--ls-wide);
  text-transform: uppercase;
}
.service-outcomes { display: grid; gap: var(--space-3); }
.service-outcome { display: flex; align-items: flex-start; gap: var(--space-4); padding: var(--space-4) var(--space-5); }
.service-outcome p { margin: 0; color: var(--text-hi); font-weight: 600; line-height: 1.55; }
.service-outcome__index,
.service-process__number { color: var(--blue); font-weight: 800; font-size: var(--fs-sm); }
.service-process__grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: var(--space-5); }
.service-process__step { padding-top: var(--space-5); border-top: 1px solid var(--border); }
.service-process__step h3 { margin: var(--space-3) 0 var(--space-2); color: var(--text-hi); font-size: var(--fs-lg); }
.service-process__step p { margin: 0; color: var(--text-body); line-height: 1.7; }
.service-use-cases__list { display: grid; gap: var(--space-3); margin: 0; padding: 0; list-style: none; }
.service-use-cases__list li { display: flex; align-items: center; gap: var(--space-3); padding: var(--space-4) var(--space-5); border: 1px solid var(--border); border-radius: var(--radius-lg); background: var(--surface); color: var(--text-hi); font-weight: 600; }
.service-use-cases__list :deep(.icon) { color: var(--blue); flex: 0 0 auto; }
.service-faq__grid { grid-template-columns: 0.7fr 1.3fr; }
.service-faq__items { display: grid; gap: var(--space-3); }
.service-faq__item { padding: var(--space-4) var(--space-5); }
.service-faq__item summary { display: flex; align-items: center; justify-content: space-between; gap: var(--space-4); color: var(--text-hi); font-weight: 700; cursor: pointer; list-style: none; }
.service-faq__item summary::-webkit-details-marker { display: none; }
.service-faq__item summary :deep(.icon) { color: var(--blue); flex-shrink: 0; transition: transform 0.2s ease; }
.service-faq__item[open] summary :deep(.icon) { transform: rotate(45deg); }
.service-faq__item p { margin: var(--space-3) 0 0; padding-top: var(--space-3); border-top: 1px solid var(--border); color: var(--text-body); line-height: 1.75; }

/* Problem / solution */
.ps-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-5);
}
.ps-card { padding: clamp(1.75rem, 3vw, 2.5rem); }
.ps-card--accent { border-color: var(--yellow-tint-2); }
.ps-card__title {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: var(--fs-sm);
  text-transform: uppercase;
  letter-spacing: 0.08em;
  color: var(--text-hi);
  margin-bottom: var(--space-4);
}
.ps-card p { color: var(--text-body); line-height: 1.7; }
.dot { width: 8px; height: 8px; border-radius: 50%; background: var(--text-faint); }
.dot--accent { background: var(--yellow); }

/* Included */
.incl-grid {
  display: grid;
  grid-template-columns: 1.2fr 0.8fr;
  gap: clamp(2rem, 5vw, 4rem);
  align-items: start;
}
.incl-list {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-4) var(--space-5);
}
.incl-list li {
  display: flex;
  align-items: flex-start;
  gap: 10px;
  color: var(--text-body);
  font-size: var(--fs-sm);
}
.incl-list :deep(.icon) { color: var(--yellow); flex-shrink: 0; margin-top: 1px; }
.incl-side {
  padding: clamp(1.75rem, 3vw, 2.5rem);
  position: sticky;
  top: calc(var(--header-h) + 20px);
}
.incl-side__label {
  font-size: var(--fs-xs);
  text-transform: uppercase;
  letter-spacing: var(--ls-wide);
  color: var(--text-faint);
  margin-bottom: var(--space-4);
}
.incl-side__divider { height: 1px; background: var(--border); margin: var(--space-6) 0; }
.incl-side__why { display: flex; flex-direction: column; gap: var(--space-3); }
.incl-side__why li {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: var(--fs-sm);
  color: var(--text-body);
}
.incl-side__why :deep(.icon) { color: var(--yellow); flex-shrink: 0; }
.incl-side__cta { margin-top: var(--space-6); }

@media (max-width: 900px) {
  .service-overview__grid,
  .service-use-cases__grid,
  .service-faq__grid { grid-template-columns: 1fr; }
  .service-process__grid { grid-template-columns: repeat(2, 1fr); }
  .ps-grid { grid-template-columns: 1fr; }
  .incl-grid { grid-template-columns: 1fr; }
  .incl-side { position: static; }
}
@media (max-width: 560px) {
  .service-process__grid { grid-template-columns: 1fr; }
  .incl-list { grid-template-columns: 1fr; }
}
</style>

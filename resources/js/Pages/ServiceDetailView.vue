<template>
  <NotFoundInline
    v-if="!service"
    :title="localized('That service doesn’t exist', 'هذه الخدمة غير متوفرة')"
    :text="localized('We couldn’t find the service you were looking for. Browse everything we offer instead.', 'لم نعثر على الخدمة المطلوبة. يمكنك استعراض جميع خدماتنا.')"
    back-to="/services"
    :back-label="localized('All Services', 'جميع الخدمات')"
  />

  <main v-else class="service-detail" :class="`service-detail--${service.slug}`" :dir="preferences.locale === 'ar' ? 'rtl' : 'ltr'">
    <section class="service-hero">
      <div class="service-hero__glow" aria-hidden="true" />
      <div class="container">
        <nav class="breadcrumbs" aria-label="Breadcrumb" v-reveal>
          <Link href="/">{{ localized('Home', 'الرئيسية') }}</Link><span class="sep">/</span>
          <Link href="/services">{{ localized('Services', 'الخدمات') }}</Link><span class="sep">/</span>
          <span aria-current="page">{{ serviceTitle }}</span>
        </nav>

        <div class="service-hero__grid">
          <div class="service-hero__copy">
            <span class="service-kicker" v-reveal><AppIcon :name="service.icon" :size="17"/> {{ showcase.eyebrow }}</span>
            <h1 class="display" v-reveal="60">{{ showcase.heading }}</h1>
            <p class="lead" v-reveal="120">{{ showcase.description }}</p>
            <div class="btn-group" v-reveal="180">
              <Link href="/consultation#book" class="btn btn--primary btn--lg">{{ localized('Plan this service', 'ناقش هذه الخدمة') }} <AppIcon name="arrow-right" class="icon-arrow" /></Link>
              <Link href="/work" class="btn btn--ghost btn--lg">{{ localized('See our work', 'شاهد أعمالنا') }}</Link>
            </div>
          </div>
          <div class="service-hero__visual" v-reveal="100">
            <ServiceVisual :slug="service.slug" :copy="showcase" />
          </div>
        </div>
        <div class="service-metrics" v-reveal="220">
          <article v-for="metric in showcase.metrics" :key="metric[1]" class="service-metric">
            <strong>{{ metric[0] }}</strong><span>{{ metric[1] }}</span>
          </article>
        </div>
      </div>
    </section>

    <section class="section service-story">
      <div class="container service-story__grid">
        <div class="service-story__intro" v-reveal>
          <span class="section-eyebrow">{{ localized('The opportunity', 'الفرصة') }}</span>
          <h2>{{ showcase.sectionTitle }}</h2>
          <p>{{ showcase.sectionCopy }}</p>
          <p class="service-story__overview">{{ serviceContent.overview }}</p>
        </div>
        <div class="service-outcomes" v-reveal="100">
          <h3>{{ localized('What changes for your team', 'ما الذي سيتغير لفريقك') }}</h3>
          <article v-for="(outcome, index) in serviceContent.outcomes" :key="outcome" class="service-outcome">
            <span>0{{ index + 1 }}</span><p>{{ outcome }}</p><AppIcon name="arrow-up-right" :size="18" />
          </article>
        </div>
      </div>
    </section>

    <section class="section service-capabilities surface-elev">
      <div class="container service-capabilities__grid">
        <div class="service-capabilities__heading" v-reveal>
          <span class="section-eyebrow">{{ localized('What we deliver', 'ما نقدمه') }}</span>
          <h2>{{ localized('The right capabilities for this work', 'القدرات المناسبة لهذا العمل') }}</h2>
          <p>{{ serviceField('solution') }}</p>
          <div class="service-capabilities__stack">
            <span>{{ localized('Typical technologies', 'تقنيات مستخدمة') }}</span>
            <div class="cluster"><span v-for="technology in service.tech" :key="technology" class="tag">{{ technology }}</span></div>
          </div>
        </div>
        <div class="capability-grid" v-reveal="90">
          <article v-for="(feature, index) in serviceFeatures" :key="feature" class="capability-card">
            <span class="capability-card__number">0{{ index + 1 }}</span>
            <AppIcon :name="featureIcons[index % featureIcons.length]" :size="20" />
            <h3>{{ feature }}</h3>
          </article>
        </div>
      </div>
    </section>

    <section class="section service-approach">
      <div class="container">
        <div class="service-approach__head" v-reveal>
          <div><span class="section-eyebrow">{{ localized('A tailored approach', 'نهج مخصص') }}</span><h2>{{ showcase.sectionTitle }}</h2></div>
          <p>{{ localized('We shape the plan around the risks, users and systems specific to this service.', 'نصمم الخطة وفق المخاطر والمستخدمين والأنظمة الخاصة بهذه الخدمة.') }}</p>
        </div>
        <div class="service-steps" :class="`service-steps--${service.slug}`">
          <article v-for="(step, index) in showcase.steps" :key="step[1]" class="service-step" v-reveal="index * 70">
            <span class="service-step__number">{{ step[0] }}</span><div><h3>{{ step[1] }}</h3><p>{{ step[2] }}</p></div>
            <span v-if="index < showcase.steps.length - 1" class="service-step__connector"><AppIcon name="arrow-right" :size="17" /></span>
          </article>
        </div>
        <div class="service-uses" v-reveal="180">
          <span>{{ localized('Typical project fit', 'أمثلة على المشاريع المناسبة') }}</span>
          <ul><li v-for="useCase in serviceContent.useCases" :key="useCase"><AppIcon name="check-circle" :size="17"/>{{ useCase }}</li></ul>
        </div>
      </div>
    </section>

    <section class="section service-faq surface-elev">
      <div class="container service-faq__grid">
        <div><span class="section-eyebrow">{{ localized('Service questions', 'أسئلة حول الخدمة') }}</span><h2>{{ localized('Details before you decide', 'تفاصيل تساعدك على اتخاذ القرار') }}</h2><p>{{ localized('Tell us where you are today and we’ll help you choose a sensible next step.', 'أخبرنا عن وضعك الحالي وسنساعدك في اختيار الخطوة المناسبة.') }}</p></div>
        <div class="service-faq__items">
          <details v-for="faq in serviceContent.faqs" :key="faq.question" class="service-faq__item">
            <summary>{{ faq.question }}<AppIcon name="plus" :size="18" /></summary><p>{{ faq.answer }}</p>
          </details>
        </div>
      </div>
    </section>

    <section v-if="related.length" class="section service-related">
      <div class="container">
        <div class="service-related__head"><div><span class="section-eyebrow">{{ localized('Connected expertise', 'خبرات تكمل بعضها') }}</span><h2>{{ localized('Services that pair well with this', 'خدمات تكمل هذه الخدمة') }}</h2></div><Link href="/services" class="link-arrow">{{ localized('All services', 'جميع الخدمات') }} <AppIcon name="arrow-right" /></Link></div>
        <div class="grid grid-3"><ServiceCard v-for="(item, index) in related" :key="item.slug" v-reveal="index * 60" :service="item" :learn-more-label="localized('Explore service', 'استكشف الخدمة')" /></div>
      </div>
    </section>

    <CtaBand
      :eyebrow="localized(`Ready to talk ${service.title.toLowerCase()}?`, `هل تريد التحدث عن ${serviceTitle}؟`)"
      :title="localized('Let’s plan the right next step', 'لنخطط للخطوة المناسبة')"
      :text="localized('Book a free consultation to discuss your goals, constraints and the best way to move this work forward.', 'احجز استشارة مجانية لمناقشة أهدافك وقيودك وأفضل طريقة للمضي قدمًا.')"
      :primary-label="localized('Book a consultation', 'احجز استشارة')" primary-to="/consultation"
      :secondary-label="localized('View our work', 'شاهد أعمالنا')" secondary-to="/work"
    />
  </main>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { computed, inject, onMounted } from 'vue'
import { trackViewContent } from '@/meta-pixel'
import AppIcon from '@/Components/ui/AppIcon.vue'
import CtaBand from '@/Components/ui/CtaBand.vue'
import NotFoundInline from '@/Components/ui/NotFoundInline.vue'
import ServiceCard from '@/Components/ui/ServiceCard.vue'
import ServiceVisual from '@/Components/ui/ServiceVisual.vue'
import { serviceArabic } from '@/serviceTranslations'
import { servicePageContent } from '@/servicePageContent'
import { serviceShowcases } from '@/serviceShowcases'

const props = defineProps({
  service: { type: Object, default: null },
  services: { type: Array, default: () => [] },
  slug: { type: String, default: '' },
})
const { preferences } = inject('sitePreferences')
const service = computed(() => props.service)
const language = computed(() => preferences.locale === 'ar' ? 'ar' : 'en')
const showcase = computed(() => serviceShowcases[service.value?.slug]?.[language.value] ?? serviceShowcases['web-development'].en)
const serviceContent = computed(() => servicePageContent[service.value?.slug]?.[language.value] ?? servicePageContent[service.value?.slug]?.en ?? { overview: '', outcomes: [], useCases: [], faqs: [] })
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
const serviceTitle = computed(() => service.value ? (language.value === 'ar' ? arabicServiceTitles[service.value.slug] : service.value.title) : '')
const serviceFeatures = computed(() => {
  if (!service.value) return []
  if (language.value !== 'ar') return service.value.features

  return serviceArabic[service.value.slug]?.features ?? service.value.features
})
const related = computed(() => service.value
  ? props.services.filter((item) => item.slug !== service.value.slug).slice(0, 3).map((item) => ({
      ...item,
      title: language.value === 'ar' ? arabicServiceTitles[item.slug] ?? item.title : item.title,
      short: language.value === 'ar' ? serviceArabic[item.slug]?.short ?? item.short : item.short,
    }))
  : [])
const featureIcons = ['layers', 'zap', 'target', 'shield-check', 'layout', 'cpu']

function localized(english, arabic) {
  return language.value === 'ar' ? arabic : english
}

function serviceField(field) {
  if (!service.value) return ''
  if (language.value !== 'ar') return service.value[field]

  return serviceArabic[service.value.slug]?.[field] ?? service.value[field]
}

onMounted(() => {
  if (!service.value) return
  trackViewContent({ contentName: service.value.title, contentType: 'service', contentIds: [service.value.slug] })
})
</script>

<style scoped>
.service-detail{--blue:var(--yellow);--surface:var(--bg-white);--surface-elev:var(--bg-elev);--service-accent:var(--blue);--service-accent-soft:var(--yellow-tint);overflow:hidden}.service-detail--mobile-development{--service-accent:#2cbad1;--service-accent-soft:rgba(44,186,209,.14)}.service-detail--ui-ux-design{--service-accent:#a46be5;--service-accent-soft:rgba(164,107,229,.14)}.service-detail--wordpress-development{--service-accent:#397bd0;--service-accent-soft:rgba(57,123,208,.14)}.service-detail--ecommerce-development{--service-accent:#e98a50;--service-accent-soft:rgba(233,138,80,.14)}.service-detail--ai-integration{--service-accent:#8769e8;--service-accent-soft:rgba(135,105,232,.14)}.service-detail--devops-cloud{--service-accent:#2da58d;--service-accent-soft:rgba(45,165,141,.14)}.service-detail--qa-testing{--service-accent:#37966d;--service-accent-soft:rgba(55,150,109,.14)}.service-detail--digital-transformation{--service-accent:#487fd7;--service-accent-soft:rgba(72,127,215,.14)}
.service-hero{position:relative;padding:var(--space-5) 0 clamp(3.2rem,7vw,6rem);background:var(--surface-elev);isolation:isolate}.service-hero:before{position:absolute;inset:0;z-index:-1;background-image:linear-gradient(color-mix(in srgb,var(--service-accent) 4%,transparent) 1px,transparent 1px),linear-gradient(90deg,color-mix(in srgb,var(--service-accent) 4%,transparent) 1px,transparent 1px);background-size:54px 54px;mask-image:linear-gradient(to bottom,black,transparent 85%);content:""}.service-hero__glow{position:absolute;z-index:-1;top:8%;right:-8%;width:50vw;height:50vw;border-radius:50%;background:radial-gradient(circle,color-mix(in srgb,var(--service-accent) 16%,transparent),transparent 68%);pointer-events:none}.service-detail[dir=rtl] .service-hero__glow{right:auto;left:-8%}.service-hero__grid{display:grid;grid-template-columns:1fr 1fr;align-items:center;gap:clamp(2rem,5vw,4.5rem);padding-top:clamp(2rem,5vw,4rem)}.service-hero__copy{max-width:620px}.service-hero__copy h1{max-width:13ch;margin:var(--space-4) 0;font-size:clamp(2.6rem,5vw,4.9rem);line-height:1.06;letter-spacing:-.045em}.service-hero__copy .lead{max-width:58ch;color:var(--text-body);line-height:1.8}.service-kicker{display:inline-flex;align-items:center;gap:9px;color:var(--service-accent);font-size:var(--fs-xs);font-weight:800;letter-spacing:.12em;text-transform:uppercase}.service-hero__visual{min-width:0}.service-hero__visual :deep(.service-visual){transform:rotate(1deg)}.service-metrics{display:grid;grid-template-columns:repeat(3,1fr);margin-top:clamp(2.5rem,5vw,4.4rem);border-top:1px solid var(--border);border-bottom:1px solid var(--border)}.service-metric{display:flex;align-items:baseline;gap:12px;padding:17px 20px}.service-metric+.service-metric{border-inline-start:1px solid var(--border)}.service-metric strong{color:var(--service-accent);font-size:var(--fs-lg);font-weight:800;white-space:nowrap}.service-metric span{color:var(--text-muted);font-size:var(--fs-xs)}
.service-story__grid{display:grid;grid-template-columns:.95fr 1.05fr;gap:clamp(2.5rem,7vw,6rem);align-items:start}.section-eyebrow{display:block;margin-bottom:var(--space-3);color:var(--service-accent);font-size:var(--fs-xs);font-weight:800;letter-spacing:.12em;text-transform:uppercase}.service-story__intro h2,.service-capabilities h2,.service-approach h2,.service-faq h2,.service-related h2{margin:0 0 var(--space-4);font-size:clamp(1.8rem,3vw,2.8rem);line-height:1.15;letter-spacing:-.035em}.service-story__intro>p,.service-capabilities__heading>p,.service-faq__grid>div>p{color:var(--text-body);line-height:1.8}.service-story__overview{padding-top:var(--space-4);border-top:1px solid var(--border);color:var(--text-muted)!important;font-size:var(--fs-sm)}.service-outcomes{display:grid;gap:0}.service-outcomes h3{margin:0 0 var(--space-3);font-size:var(--fs-lg)}.service-outcome{display:grid;grid-template-columns:38px 1fr 20px;align-items:center;gap:13px;padding:17px 0;border-bottom:1px solid var(--border)}.service-outcome>span{color:var(--service-accent);font-size:var(--fs-xs);font-weight:800}.service-outcome p{margin:0;color:var(--text-hi);font-weight:650;line-height:1.55}.service-outcome :deep(.icon){color:var(--service-accent)}
.service-capabilities__grid{display:grid;grid-template-columns:.75fr 1.25fr;gap:clamp(2rem,6vw,5rem);align-items:start}.service-capabilities__heading{position:sticky;top:calc(var(--header-h) + 24px)}.service-capabilities__heading>p{margin-bottom:var(--space-6)}.service-capabilities__stack{padding-top:var(--space-5);border-top:1px solid var(--border)}.service-capabilities__stack>span{display:block;margin-bottom:var(--space-3);color:var(--text-muted);font-size:var(--fs-xs);font-weight:700}.capability-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:12px}.capability-card{position:relative;min-height:154px;padding:clamp(16px,2.5vw,24px);border:1px solid var(--border);border-radius:var(--radius-lg);background:var(--surface);transition:transform .2s,border-color .2s}.capability-card:hover{transform:translateY(-4px);border-color:color-mix(in srgb,var(--service-accent) 50%,var(--border))}.capability-card> :deep(.icon){display:block;margin:13px 0;color:var(--service-accent)}.capability-card h3{max-width:26ch;margin:0;font-size:var(--fs-sm);line-height:1.5}.capability-card__number{position:absolute;top:17px;right:17px;color:var(--text-faint);font-size:.65rem}.service-detail[dir=rtl] .capability-card__number{right:auto;left:17px}
.service-approach__head{display:flex;justify-content:space-between;align-items:end;gap:2rem;margin-bottom:var(--space-7)}.service-approach__head>div{max-width:650px}.service-approach__head p{max-width:350px;margin:0;color:var(--text-muted);line-height:1.7}.service-steps{display:grid;grid-template-columns:repeat(3,1fr);gap:14px}.service-step{position:relative;display:flex;flex-direction:column;justify-content:space-between;min-height:245px;padding:clamp(20px,3vw,30px);border:1px solid var(--border);border-radius:var(--radius-lg);background:var(--surface);overflow:hidden}.service-step:before{position:absolute;inset:auto -10% -50% 35%;height:70%;border-radius:50%;background:radial-gradient(circle,var(--service-accent-soft),transparent 70%);content:"";pointer-events:none}.service-step__number{color:var(--service-accent);font-size:var(--fs-sm);font-weight:800}.service-step h3{margin:0 0 var(--space-2);font-size:var(--fs-lg)}.service-step p{margin:0;color:var(--text-muted);font-size:var(--fs-sm);line-height:1.65}.service-step__connector{position:absolute;top:24px;right:22px;color:var(--service-accent)}.service-detail[dir=rtl] .service-step__connector{right:auto;left:22px}.service-steps--ui-ux-design .service-step{border-radius:4px 22px 4px 22px}.service-steps--ecommerce-development .service-step{border-radius:20px 6px 20px 6px}.service-steps--devops-cloud .service-step{border-top:3px solid var(--service-accent)}.service-steps--qa-testing .service-step{background:linear-gradient(145deg,var(--surface),var(--service-accent-soft))}.service-steps--digital-transformation .service-step{min-height:210px}.service-uses{display:grid;grid-template-columns:.65fr 1.35fr;gap:1.5rem;margin-top:clamp(2.5rem,5vw,4rem);padding:24px;border:1px solid var(--border);border-radius:var(--radius-lg);background:var(--surface-elev)}.service-uses>span{color:var(--text-muted);font-size:var(--fs-xs);font-weight:800;letter-spacing:.1em;text-transform:uppercase}.service-uses ul{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin:0;padding:0;list-style:none}.service-uses li{display:flex;align-items:flex-start;gap:8px;color:var(--text-body);font-size:var(--fs-xs);line-height:1.55}.service-uses li :deep(.icon){flex:none;color:var(--service-accent)}
.service-faq__grid{display:grid;grid-template-columns:.7fr 1.3fr;gap:clamp(2rem,6vw,5rem);align-items:start}.service-faq__items{display:grid;gap:10px}.service-faq__item{padding:18px 20px;border:1px solid var(--border);border-radius:var(--radius-md);background:var(--surface)}.service-faq__item summary{display:flex;align-items:center;justify-content:space-between;gap:20px;color:var(--text-hi);font-weight:700;cursor:pointer;list-style:none}.service-faq__item summary::-webkit-details-marker{display:none}.service-faq__item summary :deep(.icon){flex:none;color:var(--service-accent);transition:transform .2s}.service-faq__item[open] summary :deep(.icon){transform:rotate(45deg)}.service-faq__item p{margin:14px 0 0;padding-top:13px;border-top:1px solid var(--border);color:var(--text-body);line-height:1.7}.service-related__head{display:flex;justify-content:space-between;align-items:end;gap:1rem;margin-bottom:var(--space-6)}.service-related__head h2{margin-bottom:0}.service-related__head>.link-arrow{flex:none;color:var(--service-accent)}
@media(max-width:960px){.service-hero__grid{grid-template-columns:1fr}.service-hero__copy{max-width:760px}.service-hero__visual{max-width:650px;width:100%;margin-inline:auto}.service-story__grid,.service-capabilities__grid,.service-faq__grid{grid-template-columns:1fr}.service-capabilities__heading{position:static}.service-approach__head{align-items:start;flex-direction:column}.service-approach__head p{max-width:600px}.service-uses{grid-template-columns:1fr}.service-uses ul{grid-template-columns:repeat(3,1fr)}}
@media(max-width:640px){.service-hero__copy h1{font-size:clamp(2.45rem,12vw,3.6rem)}.service-metric{display:flex;flex-direction:column;gap:4px;padding:13px 10px}.service-metric strong{font-size:var(--fs-sm)}.service-metric span{font-size:.65rem}.capability-grid{grid-template-columns:1fr}.capability-card{min-height:120px}.service-steps{grid-template-columns:1fr}.service-step{min-height:190px}.service-step__connector{transform:rotate(90deg)}.service-detail[dir=rtl] .service-step__connector{transform:rotate(-90deg)}.service-uses ul{grid-template-columns:1fr}.service-related__head{align-items:start;flex-direction:column}}
</style>

<template>
  <div class="services-page">
    <!-- HERO -->
    <section class="page-hero">
      <div class="bg-grid" aria-hidden="true" />
      <div class="container">
        <nav class="breadcrumbs" aria-label="Breadcrumb" v-reveal>
          <Link href="/">{{ localized('Home', 'الرئيسية') }}</Link>
          <span class="sep">/</span>
          <span aria-current="page">{{ localized('Services', 'الخدمات') }}</span>
        </nav>
        <div class="page-hero__inner">
          <h1 class="display" v-reveal="60">
            {{ localized('Software that fits how you', 'برمجيات تناسب طريقة عملك') }}
            <span class="text-accent">{{ localized('actually work', 'بالفعل') }}</span>
          </h1>
          <p class="lead" v-reveal="120">
            {{ localized(
              'From custom web and mobile apps to AI, cloud and QA — we cover the full product lifecycle with one senior team, so nothing falls through the cracks.',
              'من تطبيقات الويب والجوال المخصصة إلى الذكاء الاصطناعي والسحابة وضمان الجودة، نغطي دورة حياة المنتج كاملة بفريق خبير واحد.'
            ) }}
          </p>
          <div class="btn-group" v-reveal="180">
            <Link href="/contact" class="btn btn--primary">
              {{ localized('Get a Free Consultation', 'احصل على استشارة مجانية') }} <AppIcon name="arrow-right" class="icon-arrow" />
            </Link>
            <Link href="/work" class="btn btn--ghost">{{ localized('See the results', 'شاهد النتائج') }}</Link>
          </div>
        </div>

        <!-- Jump nav -->
        <div class="services-jump" v-reveal="220">
          <a v-for="s in services" :key="s.slug" :href="`#${s.slug}`" class="tag services-jump__tag">
            {{ serviceTitle(s) }}
          </a>
        </div>
      </div>
    </section>

    <!-- SERVICE BLOCKS -->
    <section
      v-for="(s, i) in services"
      :id="s.slug"
      :key="s.slug"
      class="section service-block"
      :class="i % 2 === 1 ? 'surface-elev' : ''"
    >
      <div class="container">
        <div class="service-block__grid" :class="{ 'service-block__grid--rev': i % 2 === 1 }">
          <div class="service-block__intro" v-reveal>
            <span class="icon-tile"><AppIcon :name="s.icon" /></span>
            <span class="service-block__index">{{ localized('Service', 'خدمة') }} {{ String(i + 1).padStart(2, '0') }}</span>
            <h2 class="h2">{{ serviceTitle(s) }}</h2>
            <p class="service-block__short">{{ serviceField(s, 'short') }}</p>

            <div class="service-block__pt">
              <h3 class="service-block__ptitle"><span class="dot" /> {{ localized('The challenge', 'التحدي') }}</h3>
              <p>{{ serviceField(s, 'problem') }}</p>
            </div>
            <div class="service-block__pt">
              <h3 class="service-block__ptitle service-block__ptitle--accent"><span class="dot dot--accent" /> {{ localized('How we help', 'كيف نساعدك') }}</h3>
              <p>{{ serviceField(s, 'solution') }}</p>
            </div>
          </div>

          <div class="service-block__detail" v-reveal="80">
            <div class="card service-block__card">
              <h3 class="service-block__caption">{{ localized('What’s included', 'ما الذي تتضمنه الخدمة') }}</h3>
              <ul class="feature-list">
                <li v-for="f in serviceFeatures(s)" :key="f">
                  <AppIcon name="check-circle" :size="18" /> {{ f }}
                </li>
              </ul>
              <h3 class="service-block__caption">{{ localized('Typical stack', 'التقنيات المستخدمة') }}</h3>
              <div class="cluster">
                <span v-for="t in s.tech" :key="t" class="tag">{{ t }}</span>
              </div>
              <div class="service-block__links">
                <Link :href="`/services/${s.slug}`" class="link-arrow service-block__link service-block__link--primary">
                  {{ localized('See full details', 'عرض التفاصيل') }} <AppIcon name="arrow-right" />
                </Link>
                <Link href="/contact" class="link-arrow service-block__link">
                  {{ localized('Discuss a project', 'ناقش مشروعك') }} <AppIcon name="arrow-right" />
                </Link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="engagement-models" class="section engagement-section surface-elev">
      <div class="container">
        <SectionHeading
          :eyebrow="localized('Engagement models', 'نماذج التعاون')"
          :title="localized('A team structure that fits your goals', 'فريق يناسب أهدافك')"
          center
        >
          {{ localized('Choose the level of support that fits your roadmap, timeline and in-house capacity.', 'اختر مستوى الدعم المناسب لخطتك الزمنية وفريقك الداخلي وأهدافك.') }}
        </SectionHeading>
        <div class="grid grid-3">
          <article v-for="model in engagementModels" :key="model.en" class="card engagement-card">
            <span class="icon-tile"><AppIcon :name="model.icon" /></span>
            <h3>{{ localized(model.en, model.ar) }}</h3>
            <p>{{ localized(model.description, model.descriptionAr) }}</p>
            <Link :href="`/contact?model=${model.slug}`" class="link-arrow">
              {{ localized('Talk to our team', 'تواصل مع فريقنا') }} <AppIcon name="arrow-right" />
            </Link>
          </article>
        </div>
      </div>
    </section>

    <section id="industries" class="section industries-section">
      <div class="container">
        <SectionHeading
          :eyebrow="localized('Industries', 'القطاعات')"
          :title="localized('Built for the way your industry works', 'حلول مصممة لطبيعة قطاعك')"
          center
        >
          {{ localized('We adapt the product, integrations and delivery plan to the needs of your market.', 'نكيّف المنتج والتكاملات وخطة التنفيذ وفق احتياجات سوقك.') }}
        </SectionHeading>
        <div class="grid grid-4">
          <article v-for="industry in industries" :key="industry.en" class="card industry-card">
            <span class="icon-tile"><AppIcon :name="industry.icon" /></span>
            <h3>{{ localized(industry.en, industry.ar) }}</h3>
            <p>{{ localized(industry.description, industry.descriptionAr) }}</p>
          </article>
        </div>
      </div>
    </section>

    <CtaBand
      :eyebrow="localized('Not sure where to start?', 'غير متأكد من أين تبدأ؟')"
      :title="localized('Tell us the problem — we’ll map the solution', 'أخبرنا عن التحدي وسنقترح الحل')"
      :text="localized('Book a free, no-pressure consultation. We’ll help you scope the work and recommend the right approach, even if that turns out not to be us.', 'احجز استشارة مجانية بلا التزام. سنساعدك في تحديد نطاق العمل واختيار النهج المناسب.')"
    />
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { inject } from 'vue'
import AppIcon from '@/Components/ui/AppIcon.vue'
import CtaBand from '@/Components/ui/CtaBand.vue'
import SectionHeading from '@/Components/ui/SectionHeading.vue'
import { serviceArabic } from '@/serviceTranslations'
const { services } = defineProps({
  services: { type: Array, default: () => [] },
})
const { preferences } = inject('sitePreferences')

const serviceTitles = {
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

function localized(english, arabic) {
  return preferences.locale === 'ar' ? arabic : english
}

function serviceTitle(service) {
  return preferences.locale === 'ar' ? serviceTitles[service.slug] ?? service.title : service.title
}

function serviceField(service, field) {
  if (preferences.locale !== 'ar') return service[field]

  return serviceArabic[service.slug]?.[field] ?? service[field]
}

function serviceFeatures(service) {
  if (preferences.locale !== 'ar') return service.features

  return serviceArabic[service.slug]?.features ?? service.features
}

const engagementModels = [
  { slug: 'flexible', icon: 'users', en: 'Flexible Teams', ar: 'فرق مرنة', description: 'Add the expertise you need as project priorities shift.', descriptionAr: 'أضف الخبرات التي تحتاجها مع تغيّر أولويات المشروع.' },
  { slug: 'dedicated', icon: 'briefcase', en: 'Dedicated Teams', ar: 'فرق مخصصة', description: 'Work with a stable team aligned with your product roadmap.', descriptionAr: 'اعمل مع فريق ثابت ومتوافق مع خطة تطوير منتجك.' },
  { slug: 'end-to-end', icon: 'layers', en: 'End-to-End Delivery', ar: 'التنفيذ من البداية إلى النهاية', description: 'Move from discovery and design through launch and support.', descriptionAr: 'انتقل من دراسة الفكرة والتصميم إلى الإطلاق والدعم.' },
]

const industries = [
  { icon: 'heart', en: 'Healthcare', ar: 'الرعاية الصحية', description: 'Secure digital experiences for providers and patients.', descriptionAr: 'تجارب رقمية آمنة لمقدمي الرعاية والمرضى.' },
  { icon: 'cloud', en: 'Software as a Service', ar: 'البرمجيات كخدمة', description: 'Reliable SaaS products built for recurring growth.', descriptionAr: 'منتجات SaaS موثوقة ومهيأة للنمو المستمر.' },
  { icon: 'cart', en: 'E-commerce & Retail', ar: 'التجارة الإلكترونية والتجزئة', description: 'Smooth storefronts, payments and operations.', descriptionAr: 'متاجر ومدفوعات وعمليات سلسة.' },
  { icon: 'send', en: 'Logistics & Distribution', ar: 'الخدمات اللوجستية والتوزيع', description: 'Connected workflows for inventory and delivery.', descriptionAr: 'سير عمل مترابط للمخزون والتوصيل.' },
]
</script>

<style scoped>
.services-jump {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-3);
  margin-top: clamp(2.5rem, 5vw, 4rem);
  padding-top: var(--space-6);
  border-top: 1px solid var(--border);
}
.services-jump__tag {
  cursor: pointer;
}
.engagement-section,
.industries-section { scroll-margin-top: var(--header-h); }
.engagement-card,
.industry-card { height: 100%; }
.engagement-card h3,
.industry-card h3 { margin-top: var(--space-5); margin-bottom: var(--space-3); font-size: 1.2rem; }
.engagement-card p,
.industry-card p { min-height: 4.5em; margin-bottom: var(--space-5); color: var(--text-muted); font-size: var(--fs-sm); }
.engagement-card .link-arrow { color: var(--text-hi); }

.service-block {
  scroll-margin-top: calc(var(--header-h) + 20px);
}
.service-block__grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: clamp(2rem, 5vw, 4.5rem);
  align-items: center;
}
.service-block__grid--rev .service-block__intro {
  order: 2;
}
.service-block__index {
  display: block;
  margin: var(--space-5) 0 var(--space-3);
  font-size: var(--fs-xs);
  letter-spacing: var(--ls-wide);
  text-transform: uppercase;
  color: var(--yellow);
}
.service-block__short {
  font-size: var(--fs-lead);
  color: var(--text-body);
  margin: var(--space-4) 0 var(--space-6);
}
.service-block__pt {
  margin-bottom: var(--space-5);
}
.service-block__pt p {
  color: var(--text-muted);
  font-size: var(--fs-sm);
  line-height: 1.7;
}
.service-block__ptitle {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: var(--fs-sm);
  text-transform: uppercase;
  letter-spacing: 0.08em;
  color: var(--text-hi);
  margin-bottom: var(--space-3);
}
.dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: var(--text-faint);
}
.dot--accent {
  background: var(--yellow);
}

.service-block__card {
  padding: clamp(1.75rem, 3vw, 2.5rem);
}
.service-block__caption {
  font-size: var(--fs-sm);
  text-transform: uppercase;
  letter-spacing: var(--ls-wide);
  color: var(--text-faint);
  margin-bottom: var(--space-4);
}
.service-block__caption:not(:first-child) {
  margin-top: var(--space-6);
}
.feature-list {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-3) var(--space-4);
}
.feature-list li {
  display: flex;
  align-items: flex-start;
  gap: 10px;
  font-size: var(--fs-sm);
  color: var(--text-body);
}
.feature-list :deep(.icon) {
  color: var(--yellow);
  flex-shrink: 0;
  margin-top: 1px;
}
.service-block__link {
  margin-top: var(--space-6);
}
.service-block__links {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-4) var(--space-6);
  margin-top: var(--space-6);
}
.service-block__links .service-block__link {
  margin-top: 0;
}
.service-block__link--primary {
  color: var(--text-hi);
}
.service-block__link--primary:hover {
  color: var(--yellow);
}

@media (max-width: 900px) {
  .service-block__grid {
    grid-template-columns: 1fr;
  }
  .service-block__grid--rev .service-block__intro {
    order: 0;
  }
  .feature-list {
    grid-template-columns: 1fr 1fr;
  }
}
@media (max-width: 560px) {
  .feature-list {
    grid-template-columns: 1fr;
  }
  .services-jump {
    gap: var(--space-2);
  }
}
</style>

<template>
  <header ref="headerElement" class="header" :class="{ 'header--solid': scrolled || menuOpen || servicesMenuOpen || engineersMenuOpen }">
    <div class="container container--wide header__inner">
      <SiteLogo variant="dark" />

      <nav class="header__nav" aria-label="Primary">
        <template v-for="item in nav" :key="item.to">
          <button
            v-if="item.to === '/services'"
            class="header__link header__services-trigger"
            :class="{ 'Link-active': isActive(item.to) || servicesMenuOpen }"
            :aria-expanded="servicesMenuOpen"
            aria-controls="services-menu"
            @click="toggleServicesMenu"
          >
            {{ localized('Services', 'الخدمات') }}
            <AppIcon name="chevron-down" :size="16" />
          </button>
          <button
            v-else-if="item.to === '/engineers'"
            class="header__link header__services-trigger"
            :class="{ 'Link-active': isActive(item.to) || engineersMenuOpen }"
            :aria-expanded="engineersMenuOpen"
            aria-controls="engineers-menu"
            @click="toggleEngineersMenu"
          >
            {{ localized('Engineers', 'المهندسون') }}
            <AppIcon name="chevron-down" :size="16" />
          </button>
          <Link
            v-else
            :href="item.to"
            class="header__link"
            :class="{ 'Link-active': isActive(item.to), 'header__link--secondary': ['/about', '/academy', '/blog', '/careers', '/contact'].includes(item.to) }"
          >
            {{ navLabel(item) }}
          </Link>
        </template>
      </nav>

      <div class="header__actions">
        <Link href="/contact" class="btn btn--primary btn--sm header__cta">
          {{ localized('Start a Project', 'ابدأ مشروعًا') }}
        </Link>
        <label class="header__language-wrap">
          <span class="sr-only">{{ localized('Choose language', 'اختر اللغة') }}</span>
          <select class="header__language" :value="preferences.locale" @change="setLocale($event.target.value)">
            <option value="en">English</option>
            <option value="ar">العربية</option>
          </select>
        </label>
        <button
          class="header__theme"
          type="button"
          :aria-label="preferences.theme === 'dark' ? localized('Switch to light mode', 'التبديل إلى الوضع الفاتح') : localized('Switch to dark mode', 'التبديل إلى الوضع الداكن')"
          :title="preferences.theme === 'dark' ? localized('Switch to light mode', 'التبديل إلى الوضع الفاتح') : localized('Switch to dark mode', 'التبديل إلى الوضع الداكن')"
          @click="toggleTheme"
        >
          <AppIcon :name="preferences.theme === 'dark' ? 'sun' : 'moon'" :size="19" />
        </button>
        <button
          class="header__burger"
          :aria-expanded="menuOpen"
          aria-controls="mobile-menu"
          :aria-label="localized('Toggle menu', 'فتح القائمة')"
          @click="toggleMobileMenu"
        >
          <AppIcon :name="menuOpen ? 'x' : 'menu'" :size="26" />
        </button>
      </div>
    </div>

    <transition name="menu-drop">
      <section v-if="servicesMenuOpen" id="services-menu" class="services-menu" :aria-label="localized('Services menu', 'قائمة الخدمات')">
        <div class="container container--wide services-menu__grid">
          <aside class="services-menu__feature">
            <span class="services-menu__eyebrow">{{ localized('AI innovation for every need', 'ابتكار الذكاء الاصطناعي لكل احتياج') }}</span>
            <h2>{{ localized('AI & Automation', 'الذكاء الاصطناعي والأتمتة') }}</h2>
            <Link v-for="link in aiLinks" :key="link.en" :href="link.to" class="services-menu__feature-link" @click="closeServicesMenu">
              {{ localized(link.en, link.ar) }}
              <AppIcon name="arrow-up-right" :size="16" />
            </Link>
          </aside>

          <div v-for="column in serviceColumns" :key="column[0].en" class="services-menu__column">
            <div v-for="group in column" :key="group.en" class="services-menu__group">
              <h3>{{ localized(group.en, group.ar) }}</h3>
              <Link v-for="link in group.links" :key="link.en" :href="link.to" class="services-menu__link" @click="closeServicesMenu">
                {{ localized(link.en, link.ar) }}
                <AppIcon name="arrow-right" :size="15" />
              </Link>
            </div>
          </div>

          <aside class="services-menu__all">
            <span>{{ localized('Solutions', 'الحلول') }}</span>
            <Link href="/services" @click="closeServicesMenu">
              {{ localized('See all services', 'عرض جميع الخدمات') }}
              <AppIcon name="arrow-right" :size="17" />
            </Link>
          </aside>
        </div>
      </section>
    </transition>

    <transition name="menu-drop">
      <section v-if="engineersMenuOpen" id="engineers-menu" class="services-menu engineers-menu" :aria-label="localized('Engineers menu', 'قائمة المهندسين')">
        <div class="container container--wide services-menu__grid engineers-menu__grid">
          <aside class="services-menu__feature">
            <span class="services-menu__eyebrow">{{ localized('AI & Data Engineers', 'مهندسو الذكاء الاصطناعي والبيانات') }}</span>
            <h2>{{ localized('Engineer Hiring', 'توظيف المهندسين') }}</h2>
            <Link href="/engineers/machine-learning-engineers" class="services-menu__feature-link" @click="closeEngineersMenu">
              {{ localized('Hire Machine Learning Engineers', 'توظيف مهندسي تعلم الآلة') }}
              <AppIcon name="arrow-up-right" :size="16" />
            </Link>
            <Link href="/engineers/data-scientist-engineers" class="services-menu__feature-link" @click="closeEngineersMenu">
              {{ localized('Hire Data Scientists', 'توظيف علماء البيانات') }}
              <AppIcon name="arrow-up-right" :size="16" />
            </Link>
          </aside>

          <div v-for="group in engineerGroups" :key="group.en" class="services-menu__column">
            <div class="services-menu__group">
              <h3>{{ localized(group.en, group.ar) }}</h3>
              <Link v-for="link in group.links" :key="link.slug" :href="`/engineers/${link.slug}`" class="services-menu__link" @click="closeEngineersMenu">
                {{ localized(link.en, link.ar) }}
                <AppIcon name="arrow-right" :size="15" />
              </Link>
            </div>
          </div>
        </div>
      </section>
    </transition>

    <!-- Mobile menu -->
    <transition name="fade">
      <div v-if="menuOpen" class="header__overlay" @click="closeMobileMenu" />
    </transition>
    <transition name="slide">
      <nav v-if="menuOpen" id="mobile-menu" class="header__panel section--dark" aria-label="Mobile">
        <Link
          v-for="item in nav"
          :key="item.to"
          :href="item.to"
          class="header__panel-link"
          :class="{ 'Link-active': isActive(item.to) }"
          @click="closeMobileMenu"
        >
          {{ navLabel(item) }}
          <AppIcon name="arrow-up-right" :size="18" />
        </Link>
        <Link href="/contact" class="btn btn--primary btn--block header__panel-cta" @click="closeMobileMenu">
          {{ localized('Start a Project', 'ابدأ مشروعًا') }}
        </Link>
      </nav>
    </transition>
  </header>
</template>

<script setup>
import { ref, computed, inject, onMounted, onBeforeUnmount, watch } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'
import SiteLogo from '../ui/SiteLogo.vue'
import AppIcon from '../ui/AppIcon.vue'
import { engineerGroups } from '@/engineerContent'

const page = usePage()
const nav = computed(() => page.props.site?.nav ?? [])
const { preferences, setLocale, setTheme } = inject('sitePreferences')

const scrolled = ref(false)
const menuOpen = ref(false)
const servicesMenuOpen = ref(false)
const engineersMenuOpen = ref(false)
const headerElement = ref(null)

const aiLinks = [
  { en: 'AI & Machine Learning', ar: 'الذكاء الاصطناعي وتعلم الآلة', to: '/services/ai-integration' },
  { en: 'Automation & AI Agents', ar: 'الأتمتة ووكلاء الذكاء الاصطناعي', to: '/services/ai-integration' },
  { en: 'Business Intelligent Automation', ar: 'أتمتة ذكاء الأعمال', to: '/services/digital-transformation' },
  { en: 'Generative AI', ar: 'الذكاء الاصطناعي التوليدي', to: '/services/ai-integration' },
  { en: 'Computer Vision', ar: 'الرؤية الحاسوبية', to: '/services/ai-integration' },
  { en: 'AI Chatbot Development', ar: 'تطوير روبوتات المحادثة', to: '/services/ai-integration' },
]

const serviceGroups = [
  {
    en: 'Emerging Technologies', ar: 'التقنيات الناشئة', links: [
      { en: 'AI & Machine Learning', ar: 'الذكاء الاصطناعي وتعلم الآلة', to: '/services/ai-integration' },
      { en: 'E-commerce Platforms', ar: 'منصات التجارة الإلكترونية', to: '/services/ecommerce-development' },
      { en: 'Business Intelligent Automation', ar: 'أتمتة ذكاء الأعمال', to: '/services/digital-transformation' },
      { en: 'AI Chatbot Development', ar: 'تطوير روبوتات المحادثة', to: '/services/ai-integration' },
    ],
  },
  {
    en: 'Software Development', ar: 'تطوير البرمجيات', links: [
      { en: 'Web Application Development', ar: 'تطوير تطبيقات الويب', to: '/services/web-development' },
      { en: 'Custom Software Development', ar: 'تطوير برمجيات مخصصة', to: '/services/digital-transformation' },
      { en: 'Mobile App Development', ar: 'تطوير تطبيقات الجوال', to: '/services/mobile-development' },
      { en: 'DevOps Services', ar: 'خدمات ديف أوبس', to: '/services/devops-cloud' },
    ],
  },
  {
    en: 'Engagement Models', ar: 'نماذج التعاون', links: [
      { en: 'Flexible Teams', ar: 'فرق مرنة', to: '/services#engagement-models' },
      { en: 'Dedicated Teams', ar: 'فرق مخصصة', to: '/services#engagement-models' },
      { en: 'End-to-End Delivery', ar: 'التنفيذ من البداية إلى النهاية', to: '/services#engagement-models' },
    ],
  },
  {
    en: 'Industries', ar: 'القطاعات', links: [
      { en: 'Healthcare', ar: 'الرعاية الصحية', to: '/services#industries' },
      { en: 'Software as a Service (SaaS)', ar: 'البرمجيات كخدمة', to: '/services#industries' },
      { en: 'E-commerce & Retail', ar: 'التجارة الإلكترونية والتجزئة', to: '/services#industries' },
      { en: 'Logistics & Distribution', ar: 'الخدمات اللوجستية والتوزيع', to: '/services#industries' },
    ],
  },
]
const serviceColumns = [
  [serviceGroups[0], serviceGroups[2]],
  [serviceGroups[1], serviceGroups[3]],
]

function localized(english, arabic) {
  return preferences.locale === 'ar' ? arabic : english
}

function navLabel(item) {
  const labels = {
    '/': ['Home', 'الرئيسية'],
    '/services': ['Services', 'الخدمات'],
    '/engineers': ['Engineers', 'المهندسون'],
    '/work': ['Our Work', 'أعمالنا'],
    '/about': ['About', 'من نحن'],
    '/academy': ['Academy', 'الأكاديمية'],
    '/blog': ['Blog', 'المدونة'],
    '/careers': ['Careers', 'الوظائف'],
    '/contact': ['Contact', 'اتصل بنا'],
  }
  const [english, arabic] = labels[item.to] ?? [item.label, item.label]
  return localized(english, arabic)
}

function isActive(to) {
  const path = page.url.split(/[?#]/)[0]
  const target = String(to).split(/[?#]/)[0]
  if (target === '/') return path === '/'
  return path === target || path.startsWith(target + '/')
}

function onScroll() {
  scrolled.value = window.scrollY > 24
}
function toggleMobileMenu() {
  menuOpen.value = !menuOpen.value
  servicesMenuOpen.value = false
  engineersMenuOpen.value = false
}
function closeMobileMenu() {
  menuOpen.value = false
}
function toggleServicesMenu() {
  servicesMenuOpen.value = !servicesMenuOpen.value
  engineersMenuOpen.value = false
  menuOpen.value = false
}
function toggleEngineersMenu() {
  engineersMenuOpen.value = !engineersMenuOpen.value
  servicesMenuOpen.value = false
  menuOpen.value = false
}
function closeServicesMenu() {
  servicesMenuOpen.value = false
}
function closeEngineersMenu() {
  engineersMenuOpen.value = false
}
function toggleTheme() {
  setTheme(preferences.theme === 'dark' ? 'light' : 'dark')
}
function onKey(event) {
  if (event.key === 'Escape') {
    closeMobileMenu()
    closeServicesMenu()
    closeEngineersMenu()
  }
}
function onDocumentClick(event) {
  if (headerElement.value && !headerElement.value.contains(event.target)) {
    closeServicesMenu()
    closeEngineersMenu()
  }
}

watch(menuOpen, (open) => {
  document.body.style.overflow = open ? 'hidden' : ''
})
watch(() => page.url, () => {
  closeMobileMenu()
  closeServicesMenu()
  closeEngineersMenu()
})

onMounted(() => {
  onScroll()
  window.addEventListener('scroll', onScroll, { passive: true })
  window.addEventListener('keydown', onKey)
  document.addEventListener('click', onDocumentClick)
})
onBeforeUnmount(() => {
  window.removeEventListener('scroll', onScroll)
  window.removeEventListener('keydown', onKey)
  document.removeEventListener('click', onDocumentClick)
  document.body.style.overflow = ''
})
</script>

<style scoped>
.header {
  background-color: rgba(6, 17, 44, 0.97);
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: var(--z-header);
  height: var(--header-h);
  display: flex;
  align-items: center;
  transition: background var(--dur) var(--ease), border-color var(--dur) var(--ease), backdrop-filter var(--dur) var(--ease);
  border-bottom: 1px solid transparent;
}
.header--solid {
  background: rgba(6, 17, 44, 0.9);
  backdrop-filter: blur(14px) saturate(150%);
  border-bottom-color: rgba(21, 216, 255, 0.18);
}
.header__inner {
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
  gap: var(--space-5);
}
.header__nav {
  display: flex;
  align-items: center;
  gap: clamp(1rem, 2vw, 2rem);
}
.header__services-trigger {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  background: transparent;
  border: 0;
}
.header__services-trigger :deep(.icon) {
  transition: transform var(--dur-fast) var(--ease);
}
.header__services-trigger[aria-expanded='true'] :deep(.icon) {
  transform: rotate(180deg);
}
.header__link {
  position: relative;
  font-size: var(--fs-sm);
  font-weight: 500;
  color: rgba(255, 255, 255, 0.78);
  padding: 6px 0;
  white-space: nowrap;
}
.header__link::after {
  content: '';
  position: absolute;
  left: 0;
  bottom: 0;
  width: 100%;
  height: 2px;
  background: var(--cyan);
  transform: scaleX(0);
  transform-origin: left;
  transition: transform var(--dur-fast) var(--ease);
}
.header__link:hover {
  color: #fff;
}
.header__link:hover::after,
.header__link.Link-active::after {
  transform: scaleX(1);
}
.header__link.Link-active {
  color: #fff;
}
.header__actions {
  display: flex;
  align-items: center;
  gap: var(--space-4);
}
.header__language-wrap { display: inline-flex; }
.header__language {
  min-height: 38px;
  padding: 0 10px;
  background: rgba(255, 255, 255, 0.08);
  color: #fff;
  border: 1px solid rgba(255, 255, 255, 0.18);
  border-radius: 8px;
  font: inherit;
  font-size: var(--fs-xs);
  cursor: pointer;
}
.header__language option { color: #071632; }
.header__theme {
  display: inline-grid;
  place-items: center;
  width: 40px;
  height: 40px;
  color: #fff;
  border: 1px solid rgba(255, 255, 255, 0.18);
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.08);
  transition: color var(--dur-fast) var(--ease), background var(--dur-fast) var(--ease), transform var(--dur-fast) var(--ease);
}
.header__theme:hover { color: var(--cyan); transform: rotate(-10deg); }
.services-menu {
  position: absolute;
  top: 100%;
  left: 0;
  right: 0;
  z-index: var(--z-modal);
  background: var(--bg-light);
  color: var(--text-body);
  border-top: 1px solid var(--border);
  box-shadow: var(--shadow-lg);
  max-height: calc(100vh - var(--header-h));
  overflow-y: auto;
}
.services-menu__grid {
  display: grid;
  grid-template-columns: minmax(220px, 1.1fr) repeat(2, minmax(190px, 1fr)) minmax(190px, 0.9fr);
  gap: clamp(1rem, 3vw, 2.5rem);
  padding-block: clamp(1.5rem, 3vw, 2.5rem);
  align-items: start;
}
.engineers-menu__grid {
  grid-template-columns: minmax(220px, 1.1fr) repeat(3, minmax(170px, 1fr));
}
.services-menu__column { display: flex; flex-direction: column; gap: 30px; }
.services-menu__group h3 { margin-top: 3px; }
.services-menu__feature {
  padding: 22px 20px;
  border-radius: var(--radius-lg);
  background: linear-gradient(145deg, #087bff, #075de0 68%, #10234a);
  color: #fff;
  box-shadow: var(--shadow-md);
}
.services-menu__eyebrow,
.services-menu__all > span {
  display: block;
  margin-bottom: 12px;
  font-size: 0.68rem;
  line-height: 1.4;
  font-weight: 700;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: var(--cyan);
}
.services-menu__feature h2 {
  margin-bottom: 14px;
  color: #fff;
  font-size: 1.2rem;
}
.services-menu__feature-link {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 8px;
  padding: 7px 0;
  color: rgba(255, 255, 255, 0.94);
  font-size: var(--fs-xs);
  font-weight: 600;
  line-height: 1.45;
}
.services-menu__feature-link:hover { color: var(--cyan); }
.services-menu__feature-link :deep(.icon) { flex: 0 0 auto; }
.services-menu__group h3 {
  margin: 3px 0 12px;
  color: var(--yellow-strong);
  font-size: 0.72rem;
  line-height: 1.4;
  letter-spacing: 0.07em;
  text-transform: uppercase;
}
.services-menu__link {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 8px;
  padding: 7px 0;
  color: var(--text-body);
  font-size: var(--fs-sm);
  line-height: 1.45;
}
.services-menu__link:hover { color: var(--yellow); }
.services-menu__link :deep(.icon) { flex: 0 0 auto; }
.services-menu__all {
  min-height: 112px;
  padding: 22px;
  border-radius: var(--radius-lg);
  background: var(--black);
  color: #fff;
  box-shadow: var(--shadow-md);
}
.services-menu__all > span { color: var(--text-muted); }
.services-menu__all a {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  color: #fff;
  font-size: var(--fs-sm);
  font-weight: 700;
  text-transform: uppercase;
}
.services-menu__all a:hover { color: var(--cyan); }
.menu-drop-enter-active,
.menu-drop-leave-active { transition: opacity 0.18s ease, transform 0.18s ease; }
.menu-drop-enter-from,
.menu-drop-leave-to { opacity: 0; transform: translateY(-8px); }
.header__burger {
  display: none;
  color: #fff;
  padding: 4px;
}

/* Mobile menu */
.header__overlay {
  position: fixed;
  inset: 0;
  top: var(--header-h);
  background: rgba(0, 0, 0, 0.6);
  z-index: var(--z-overlay);
}
.header__panel {
  position: fixed;
  top: var(--header-h);
  right: 0;
  width: min(360px, 88vw);
  height: calc(100vh - var(--header-h));
  background: var(--bg-elev);
  border-left: 1px solid rgba(21, 216, 255, 0.18);
  z-index: var(--z-modal);
  padding: var(--space-6) var(--gutter);
  display: flex;
  flex-direction: column;
  gap: 6px;
  overflow-y: auto;
}
.header__panel-link {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 16px 4px;
  font-family: var(--font-display);
  font-size: 1.25rem;
  color: #fff;
  border-bottom: 1px solid var(--border);
}
.header__panel-link :deep(.icon) {
  color: var(--text-faint);
  transition: color var(--dur-fast) var(--ease), transform var(--dur-fast) var(--ease);
}
.header__panel-link:hover {
  color: var(--cyan);
}
.header__panel-link:hover :deep(.icon) {
  color: var(--cyan);
  transform: translate(3px, -3px);
}
.header__panel-link.Link-active {
  color: var(--cyan);
}
.header__panel-cta {
  margin-top: var(--space-5);
}

/* Transitions */
.fade-enter-active,
.fade-leave-active {
  transition: opacity var(--dur) var(--ease);
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
.slide-enter-active,
.slide-leave-active {
  transition: transform var(--dur) var(--ease);
}
.slide-enter-from,
.slide-leave-to {
  transform: translateX(100%);
}

@media (max-width: 992px) {
  .header__nav,
  .header__cta {
    display: none;
  }
  .services-menu { display: none; }
  .header__burger {
    display: inline-flex;
  }
}
@media (min-width: 993px) and (max-width: 1400px) {
  .header__nav { gap: clamp(0.65rem, 1.3vw, 1.1rem); }
  .header__link--secondary { display: none; }
}
@media (max-width: 1100px) {
  .services-menu__grid { grid-template-columns: minmax(210px, 1fr) repeat(2, minmax(150px, 1fr)); }
  .services-menu__feature { grid-row: span 2; }
  .services-menu__all { grid-column: 2 / 4; }
  .engineers-menu__grid { grid-template-columns: minmax(210px, 1fr) repeat(2, minmax(150px, 1fr)); }
  .engineers-menu__grid .services-menu__feature { grid-row: span 2; }
}
@media (max-width: 480px) {
  .header__cta {
    display: none;
  }
}
@media (max-width: 520px) {
  .header__inner { gap: 10px; }
  .header__actions { gap: 8px; }
  .header__language { max-width: 98px; padding-inline: 6px; }
  .header__theme { width: 36px; height: 36px; }
  .header__language { width: 78px; }
  .header__inner :deep(.logo__img) { width: 40px; height: 40px; }
  .header__inner :deep(.logo__name) { font-size: 0.82rem; letter-spacing: 0.1em; }
  .header__inner :deep(.logo__sub) { font-size: 0.48rem; letter-spacing: 0.2em; }
}
</style>

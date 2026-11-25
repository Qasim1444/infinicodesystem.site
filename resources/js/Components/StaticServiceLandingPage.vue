<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import PageWorkflowGraphic from './PageWorkflowGraphic.vue';

const props = defineProps({
    page: { type: Object, required: true },
});

const canonicalUrl = computed(() => `https://infinicodesystem.site/services/${props.page.slug}`);
const schema = computed(() => ({
    '@context': 'https://schema.org',
    '@type': 'Service',
    name: props.page.title,
    description: props.page.metaDescription,
    url: canonicalUrl.value,
    provider: {
        '@type': 'Organization',
        name: 'Infinicode System',
        url: 'https://infinicodesystem.site',
    },
    areaServed: ['United States', 'United Kingdom', 'United Arab Emirates', 'Qatar'],
}));
</script>

<template>
    <Head :title="page.metaTitle">
        <meta head-key="description" name="description" :content="page.metaDescription" />
        <link head-key="canonical" rel="canonical" :href="canonicalUrl" />
        <meta head-key="og:title" property="og:title" :content="page.title" />
        <meta head-key="og:description" property="og:description" :content="page.metaDescription" />
        <meta head-key="og:type" property="og:type" content="website" />
        <meta head-key="og:url" property="og:url" :content="canonicalUrl" />
        <meta head-key="twitter:card" name="twitter:card" content="summary_large_image" />
        <component :is="'script'" head-key="service-schema" type="application/ld+json">
            {{ JSON.stringify(schema) }}
        </component>
    </Head>

    <main class="landing-page">
        <header class="landing-hero landing-service-hero">
            <div class="landing-shell landing-hero__grid">
                <div>
                    <nav class="landing-breadcrumbs" aria-label="Breadcrumb">
                        <Link href="/">Home</Link>
                        <span aria-hidden="true">/</span>
                        <Link href="/services">Services</Link>
                        <span aria-hidden="true">/</span>
                        <span aria-current="page">{{ page.shortTitle }}</span>
                    </nav>
                    <div class="landing-kicker">{{ page.keyword }}</div>
                    <h1>{{ page.title }}</h1>
                    <p class="landing-hero__copy">{{ page.metaDescription }}</p>
                    <div class="landing-hero__actions">
                        <Link class="landing-button" href="/consultation">Plan your project <span aria-hidden="true">→</span></Link>
                        <Link class="landing-button landing-button--outline" href="/work">Explore our work</Link>
                    </div>
                    <div class="landing-region-note" aria-label="Markets served">
                        <span>USA</span>
                        <span>UK</span>
                        <span>UAE</span>
                        <span>Qatar</span>
                    </div>
                </div>
                <PageWorkflowGraphic :title="page.visualTitle" :steps="page.visualSteps" :footer="page.visualFooter" />
            </div>
        </header>

        <section class="landing-section landing-section--white">
            <div class="landing-shell landing-lead-grid">
                <div class="landing-lead">
                    <div class="landing-kicker">Designed around your operation</div>
                    <h2>{{ page.leadTitle }}</h2>
                    <p>{{ page.intro }}</p>
                </div>
                <div class="landing-takeaways">
                    <article v-for="(item, index) in page.outcomes" :key="item.title" class="landing-takeaway">
                        <span class="landing-takeaway__mark" aria-hidden="true">{{ index + 1 }}</span>
                        <div>
                            <strong>{{ item.title }}</strong>
                            <p>{{ item.text }}</p>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <section class="landing-section">
            <div class="landing-shell">
                <div class="landing-section__heading">
                    <div class="landing-kicker">What we build</div>
                    <h2>{{ page.capabilitiesTitle }}</h2>
                    <p>{{ page.capabilitiesIntro }}</p>
                </div>
                <div class="landing-service-grid">
                    <article v-for="(item, index) in page.capabilities" :key="item.title" class="landing-card landing-service-card">
                        <span class="landing-card__index">0{{ index + 1 }}</span>
                        <h3>{{ item.title }}</h3>
                        <p>{{ item.text }}</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="landing-section landing-section--white">
            <div class="landing-shell">
                <div class="landing-section__heading">
                    <div class="landing-kicker">A clear delivery path</div>
                    <h2>{{ page.processTitle }}</h2>
                </div>
                <div class="landing-process-grid">
                    <article v-for="(item, index) in page.process" :key="item.title" class="landing-card">
                        <span class="landing-card__index">0{{ index + 1 }}</span>
                        <h3>{{ item.title }}</h3>
                        <p>{{ item.text }}</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="landing-section">
            <div class="landing-shell landing-lead-grid">
                <div class="landing-section__heading">
                    <div class="landing-kicker">Built for real teams</div>
                    <h2>{{ page.fitTitle }}</h2>
                    <p>{{ page.fitIntro }}</p>
                </div>
                <div class="landing-faqs">
                    <article v-for="faq in page.faqs" :key="faq.question" class="landing-faq">
                        <h3>{{ faq.question }}</h3>
                        <p>{{ faq.answer }}</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="landing-section landing-section--white">
            <div class="landing-shell">
                <div class="landing-cta">
                    <div class="landing-kicker">Serving teams across four markets</div>
                    <h2>{{ page.ctaTitle }}</h2>
                    <p>{{ page.ctaText }}</p>
                    <Link class="landing-button" href="/consultation">Talk through your workflow <span aria-hidden="true">→</span></Link>
                </div>
            </div>
        </section>
    </main>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import PageWorkflowGraphic from './PageWorkflowGraphic.vue';

const props = defineProps({
    article: { type: Object, required: true },
});

const canonicalUrl = computed(() => `https://infinicodesystem.site/blog/${props.article.slug}`);
const schema = computed(() => ({
    '@context': 'https://schema.org',
    '@graph': [
        {
            '@type': 'Article',
            headline: props.article.title,
            description: props.article.metaDescription,
            datePublished: props.article.publishedAt,
            dateModified: props.article.publishedAt,
            mainEntityOfPage: canonicalUrl.value,
            author: { '@type': 'Organization', name: 'Infinicode System' },
            publisher: { '@type': 'Organization', name: 'Infinicode System' },
        },
        {
            '@type': 'FAQPage',
            mainEntity: props.article.faqs.map((faq) => ({
                '@type': 'Question',
                name: faq.question,
                acceptedAnswer: { '@type': 'Answer', text: faq.answer },
            })),
        },
    ],
}));
</script>

<template>
    <Head :title="article.metaTitle">
        <meta head-key="description" name="description" :content="article.metaDescription" />
        <link head-key="canonical" rel="canonical" :href="canonicalUrl" />
        <meta head-key="og:title" property="og:title" :content="article.title" />
        <meta head-key="og:description" property="og:description" :content="article.metaDescription" />
        <meta head-key="og:type" property="og:type" content="article" />
        <meta head-key="og:url" property="og:url" :content="canonicalUrl" />
        <meta head-key="twitter:card" name="twitter:card" content="summary_large_image" />
        <component :is="'script'" head-key="article-schema" type="application/ld+json">
            {{ JSON.stringify(schema) }}
        </component>
    </Head>

    <main class="landing-page">
        <header class="landing-hero">
            <div class="landing-shell landing-hero__grid">
                <div>
                    <nav class="landing-breadcrumbs" aria-label="Breadcrumb">
                        <Link href="/">Home</Link>
                        <span aria-hidden="true">/</span>
                        <Link href="/blog">Insights</Link>
                        <span aria-hidden="true">/</span>
                        <span aria-current="page">{{ article.category }}</span>
                    </nav>
                    <div class="landing-kicker">{{ article.category }}</div>
                    <h1>{{ article.title }}</h1>
                    <p class="landing-hero__copy">{{ article.excerpt }}</p>
                    <div class="landing-hero__meta">
                        <span>{{ article.publishedLabel }}</span>
                        <span>{{ article.readTime }} minute read</span>
                        <span>By Infinicode System</span>
                    </div>
                    <div class="landing-hero__actions">
                        <a class="landing-button" href="#article-content">Explore the guide <span aria-hidden="true">↓</span></a>
                        <Link class="landing-button landing-button--outline" href="/consultation">Discuss your project</Link>
                    </div>
                </div>

                <PageWorkflowGraphic :title="article.visualTitle" :steps="article.visualSteps" />
            </div>
        </header>

        <section class="landing-section landing-section--white">
            <div class="landing-shell landing-lead-grid">
                <div class="landing-lead">
                    <div class="landing-kicker">The short answer</div>
                    <h2>{{ article.leadTitle }}</h2>
                    <p>{{ article.intro }}</p>
                </div>
                <div class="landing-takeaways" aria-label="Key takeaways">
                    <article v-for="(item, index) in article.takeaways" :key="item.title" class="landing-takeaway">
                        <span class="landing-takeaway__mark" aria-hidden="true">{{ index + 1 }}</span>
                        <div>
                            <strong>{{ item.title }}</strong>
                            <p>{{ item.text }}</p>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <section id="article-content" class="landing-section">
            <div class="landing-shell landing-article-layout">
                <article class="landing-article-main">
                    <section v-for="(section, index) in article.sections" :key="section.heading" class="landing-article-block">
                        <div class="landing-kicker">Part {{ String(index + 1).padStart(2, '0') }}</div>
                        <h2>{{ section.heading }}</h2>
                        <p>{{ section.body }}</p>
                        <p v-if="section.detail">{{ section.detail }}</p>
                        <ul v-if="section.points?.length" class="landing-points">
                            <li v-for="point in section.points" :key="point">{{ point }}</li>
                        </ul>
                    </section>
                </article>

                <aside class="landing-article-aside" aria-label="Article details">
                    <div class="landing-aside-card">
                        <strong>In this guide</strong>
                        <span>{{ article.sections.length }} practical sections</span>
                        <span>{{ article.readTime }} minute read</span>
                    </div>
                    <div class="landing-aside-card">
                        <strong>Related service</strong>
                        <Link :href="article.service.href">{{ article.service.label }}</Link>
                    </div>
                    <div class="landing-aside-card">
                        <strong>Need a project partner?</strong>
                        <span>Get a clear first step for your team, scope, and delivery risks.</span>
                        <Link href="/consultation">Book a consultation →</Link>
                    </div>
                </aside>
            </div>
        </section>

        <section class="landing-section landing-section--white">
            <div class="landing-shell">
                <div class="landing-section__heading">
                    <div class="landing-kicker">Make it actionable</div>
                    <h2>{{ article.actionTitle }}</h2>
                    <p>{{ article.actionIntro }}</p>
                </div>
                <div class="landing-checklist">
                    <article v-for="(item, index) in article.actions" :key="item.title" class="landing-card">
                        <span class="landing-card__index">0{{ index + 1 }}</span>
                        <h3>{{ item.title }}</h3>
                        <p>{{ item.text }}</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="landing-section">
            <div class="landing-shell">
                <div class="landing-section__heading">
                    <div class="landing-kicker">Common questions</div>
                    <h2>Questions teams ask before they start</h2>
                </div>
                <div class="landing-faqs">
                    <article v-for="faq in article.faqs" :key="faq.question" class="landing-faq">
                        <h3>{{ faq.question }}</h3>
                        <p>{{ faq.answer }}</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="landing-section landing-section--white">
            <div class="landing-shell">
                <div class="landing-cta">
                    <div class="landing-kicker">A practical next step</div>
                    <h2>{{ article.ctaTitle }}</h2>
                    <p>{{ article.ctaText }}</p>
                    <Link class="landing-button" href="/consultation">Plan a conversation <span aria-hidden="true">→</span></Link>
                    <div class="landing-region-note" aria-label="Markets served">
                        <span>United States</span>
                        <span>United Kingdom</span>
                        <span>United Arab Emirates</span>
                        <span>Qatar</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="landing-section">
            <div class="landing-shell">
                <div class="landing-section__heading">
                    <div class="landing-kicker">Keep exploring</div>
                    <h2>Related guides</h2>
                </div>
                <div class="landing-related-grid">
                    <Link v-for="item in article.related" :key="item.href" :href="item.href" class="landing-related-card">
                        <span>{{ item.category }}</span>
                        <strong>{{ item.title }}</strong>
                    </Link>
                    <Link href="/blog" class="landing-related-card">
                        <span>All topics</span>
                        <strong>Browse every engineering insight →</strong>
                    </Link>
                </div>
            </div>
        </section>
    </main>
</template>

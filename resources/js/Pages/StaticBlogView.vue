<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import PageWorkflowGraphic from '../Components/PageWorkflowGraphic.vue';

const query = ref('');
const activeCategory = ref('All topics');

const posts = [
    { slug: 'choose-laravel-development-company', title: 'How to Choose a Laravel Development Company for a Business Platform', category: 'Laravel development', excerpt: 'A practical framework for comparing Laravel partners before a business platform project begins.' },
    { slug: 'laravel-saas-development-features', title: 'Laravel SaaS Development: Features That Affect Cost and Timeline', category: 'Laravel development', excerpt: 'Understand how tenancy, billing, roles, onboarding, integrations, and testing affect a Laravel SaaS build.' },
    { slug: 'when-to-build-a-custom-crm', title: 'When Should a Business Build a Custom CRM?', category: 'CRM and ERP', excerpt: 'A decision framework for teams that have outgrown spreadsheets or cannot fit their workflows into a packaged CRM.' },
    { slug: 'plan-secure-laravel-api-integration', title: 'How to Plan a Secure Laravel API Integration', category: 'Laravel development', excerpt: 'A practical API checklist for authentication, validation, retries, logging, monitoring, and documentation.' },
    { slug: 'laravel-codebase-handover-checklist', title: 'Taking Over an Existing Laravel Codebase: A Practical Checklist', category: 'Laravel development', excerpt: 'A safe handover checklist covering access, deployment, dependencies, tests, security, performance, and roadmap.' },
    { slug: 'prepare-before-hiring-react-native-team', title: 'What to Prepare Before Hiring a React Native Development Team', category: 'Mobile app development', excerpt: 'Prepare product scope, user flows, APIs, platform requirements, analytics, testing, and launch details before mobile development begins.' },
    { slug: 'react-native-app-development-cost-drivers', title: 'React Native App Development Cost Drivers', category: 'Mobile app development', excerpt: 'Learn which product, design, integration, testing, launch, and maintenance decisions influence a React Native project.' },
    { slug: 'react-native-vs-native-mobile-development', title: 'React Native vs Native iOS and Android for a Business Product', category: 'Mobile app development', excerpt: 'Compare React Native with native development using product, performance, device, team, and maintenance factors.' },
    { slug: 'react-native-app-qa-checklist', title: 'A QA Checklist for React Native Apps Before Launch', category: 'Mobile app development', excerpt: 'Check devices, accessibility, deep links, notifications, APIs, crash reporting, security, and store readiness.' },
    { slug: 'react-native-api-integration-guide', title: 'How to Connect a React Native App to Business APIs', category: 'Mobile app development', excerpt: 'Plan authentication, data contracts, offline states, errors, analytics, and monitoring for a reliable mobile application.' },
    { slug: 'custom-crm-vs-off-the-shelf-crm', title: 'Custom CRM vs Off-the-Shelf CRM for Growing Teams', category: 'CRM and ERP', excerpt: 'Compare workflow fit, integrations, ownership, reporting, rollout, and change control before choosing a CRM approach.' },
    { slug: 'crm-workflow-mapping-before-development', title: 'How to Map Business Workflows Before Building CRM Software', category: 'CRM and ERP', excerpt: 'Learn how to document actors, states, approvals, exceptions, data ownership, and reporting before CRM development.' },
    { slug: 'erp-software-development-where-to-start', title: 'ERP Software Development: Which Processes Should Be Automated First?', category: 'CRM and ERP', excerpt: 'Prioritize finance, inventory, purchasing, operations, approvals, and reporting before ERP development begins.' },
    { slug: 'role-based-business-dashboard-development', title: 'Building Role-Based Dashboards for Business Teams', category: 'CRM and ERP', excerpt: 'Design useful dashboards with clear roles, metrics, permissions, alerts, exports, and audit history.' },
    { slug: 'custom-crm-data-migration-checklist', title: 'How to Migrate Data into a Custom CRM Safely', category: 'CRM and ERP', excerpt: 'Plan inventory, mapping, cleansing, test migration, reconciliation, cutover, and rollback for a safer CRM migration.' },
    { slug: 'custom-pos-vs-packaged-pos', title: 'Custom POS Software vs Packaged POS Platforms', category: 'POS and inventory', excerpt: 'Compare product fit, integrations, inventory, reporting, rollout, and support before choosing a POS approach.' },
    { slug: 'multi-location-inventory-system-planning', title: 'How to Plan a Multi-Location Inventory System', category: 'POS and inventory', excerpt: 'Plan locations, stock movement, purchasing, reconciliation, permissions, and reporting for connected inventory operations.' },
    { slug: 'pos-and-inventory-integrations-guide', title: 'POS and Inventory Integrations Every Growing Operation Needs', category: 'POS and inventory', excerpt: 'Review payments, accounting, ecommerce, logistics, CRM, and analytics integrations for POS and inventory systems.' },
    { slug: 'replace-inventory-spreadsheets', title: 'How to Replace Spreadsheet-Based Stock Management', category: 'POS and inventory', excerpt: 'Plan a safer move from spreadsheet stock tracking to structured inventory workflows, permissions, alerts, and reporting.' },
    { slug: 'pos-software-discovery-checklist', title: 'A Practical POS Software Discovery Checklist', category: 'POS and inventory', excerpt: 'Use this checklist to define users, products, pricing, returns, locations, reports, offline needs, and integrations.' },
    { slug: 'ai-automation-use-cases-business-operations', title: 'AI Automation Use Cases for Business Operations', category: 'AI automation', excerpt: 'Explore practical AI automation use cases for support, documents, routing, reporting, approvals, and human review.' },
    { slug: 'workflow-automation-vs-ai-assistant', title: 'When to Use Workflow Automation Instead of a Custom AI Assistant', category: 'AI automation', excerpt: 'Compare deterministic workflow automation with AI assistants using risk, variability, cost, governance, and escalation.' },
    { slug: 'rag-implementation-internal-knowledge-base', title: 'RAG Implementation for an Internal Knowledge Base', category: 'AI automation', excerpt: 'Plan source quality, retrieval, permissions, evaluation, citations, updates, and human review for a RAG knowledge system.' },
    { slug: 'ai-document-processing-workflow', title: 'AI Document Processing: From Upload to Verified Result', category: 'AI automation', excerpt: 'Design document ingestion, extraction, validation, exceptions, audit history, and human review.' },
    { slug: 'add-ai-to-existing-laravel-application', title: 'How to Add AI to an Existing Laravel Application', category: 'AI automation', excerpt: 'Plan AI use cases, data boundaries, API design, privacy, fallback behavior, monitoring, and user review in Laravel.' },
    { slug: 'custom-software-discovery-workshop-guide', title: 'Custom Software Discovery: What Happens Before Development Begins?', category: 'Custom software', excerpt: 'Learn how discovery maps users, workflows, risks, scope, prototypes, priorities, and estimates.' },
    { slug: 'scalable-multi-tenant-saas-architecture', title: 'What Makes a Scalable Multi-Tenant SaaS Architecture?', category: 'SaaS and APIs', excerpt: 'Review tenant isolation, roles, billing, observability, performance, deployment, and support decisions.' },
    { slug: 'api-development-integration-planning', title: 'API Development and Integration Planning for Business Systems', category: 'SaaS and APIs', excerpt: 'Plan contracts, authentication, versioning, retries, webhooks, monitoring, documentation, and ownership.' },
    { slug: 'reduce-custom-software-project-risk', title: 'How to Reduce Risk in a Custom Software Project', category: 'Custom software', excerpt: 'Reduce custom software risk with discovery, milestones, demos, acceptance criteria, testing, change control, and launch planning.' },
    { slug: 'custom-software-launch-roadmap', title: 'From Prototype to Production: A Custom Software Launch Roadmap', category: 'Custom software', excerpt: 'Follow a practical roadmap from prototype to architecture, build, QA, pilot, rollout, monitoring, and support.' },
];

const categories = ['All topics', ...new Set(posts.map((post) => post.category))];
const visiblePosts = computed(() => {
    const searchTerm = query.value.toLowerCase();

    return posts.filter((post) => {
        const categoryMatches = activeCategory.value === 'All topics' || post.category === activeCategory.value;
        const searchMatches = !searchTerm || `${post.title} ${post.excerpt} ${post.category}`.toLowerCase().includes(searchTerm);

        return categoryMatches && searchMatches;
    });
});
</script>

<template>
    <Head title="Software Engineering Insights | Infinicode System">
        <meta head-key="description" name="description" content="Practical software engineering guides on Laravel, mobile apps, CRM, POS, AI, SaaS, APIs, and custom product delivery." />
        <link head-key="canonical" rel="canonical" href="https://infinicodesystem.site/blog" />
        <meta head-key="og:title" property="og:title" content="Software Engineering Insights | Infinicode System" />
        <meta head-key="og:description" property="og:description" content="Practical guides for teams building and improving business software." />
        <meta head-key="og:type" property="og:type" content="website" />
        <meta head-key="og:url" property="og:url" content="https://infinicodesystem.site/blog" />
    </Head>

    <main class="landing-page landing-blog-index">
        <header class="landing-hero">
            <div class="landing-shell landing-hero__grid">
                <div>
                    <nav class="landing-breadcrumbs" aria-label="Breadcrumb">
                        <Link href="/">Home</Link>
                        <span aria-hidden="true">/</span>
                        <span aria-current="page">Insights</span>
                    </nav>
                    <div class="landing-kicker">Engineering insights</div>
                    <h1>Better decisions for software that moves business forward.</h1>
                    <p class="landing-hero__copy">Field-tested guidance for planning, building, connecting, and improving the systems your teams depend on.</p>
                    <div class="landing-hero__meta">
                        <span>{{ posts.length }} practical guides</span>
                        <span>Laravel · Mobile · CRM · POS · AI · SaaS</span>
                    </div>
                    <div class="landing-hero__actions">
                        <a class="landing-button" href="#insights">Explore all guides <span aria-hidden="true">↓</span></a>
                        <Link class="landing-button landing-button--outline" href="/consultation">Talk through a project</Link>
                    </div>
                </div>
                <PageWorkflowGraphic
                    title="Ideas, grounded in delivery"
                    :steps="['Understand the real workflow', 'Make technical choices clear', 'Ship and learn with confidence']"
                    footer="Practical insight from product to production."
                />
            </div>
        </header>

        <section id="insights" class="landing-section">
            <div class="landing-shell">
                <div class="landing-section__heading">
                    <div class="landing-kicker">Browse the library</div>
                    <h2>Find a guide for your next decision</h2>
                    <p>Search by technology, workflow, or delivery challenge. Every article is written as a standalone guide with its own examples and practical checklist.</p>
                </div>

                <div class="landing-blog-controls">
                    <label class="landing-blog-search">
                        <span class="landing-blog-search__icon" aria-hidden="true">⌕</span>
                        <span class="visually-hidden">Search insights</span>
                        <input v-model.trim="query" type="search" placeholder="Search guides, topics, or workflows" />
                    </label>
                    <div class="landing-blog-filters" aria-label="Filter guides by topic">
                        <button
                            v-for="category in categories"
                            :key="category"
                            type="button"
                            :aria-pressed="activeCategory === category"
                            :class="{ 'is-active': activeCategory === category }"
                            @click="activeCategory = category"
                        >
                            {{ category }}
                        </button>
                    </div>
                </div>

                <p class="landing-blog-count" aria-live="polite">
                    Showing {{ visiblePosts.length }} {{ visiblePosts.length === 1 ? 'guide' : 'guides' }}
                </p>

                <div v-if="visiblePosts.length" class="landing-blog-grid">
                    <article v-for="(post, index) in visiblePosts" :key="post.slug" class="landing-blog-card">
                        <div class="landing-blog-card__art" :class="`landing-blog-card__art--${index % 4}`" aria-hidden="true">
                            <span class="landing-blog-card__art-number">{{ String(index + 1).padStart(2, '0') }}</span>
                            <span class="landing-blog-card__art-line"></span>
                            <span class="landing-blog-card__art-dot"></span>
                        </div>
                        <div class="landing-blog-card__body">
                            <span class="landing-blog-card__category">{{ post.category }}</span>
                            <h3>{{ post.title }}</h3>
                            <p>{{ post.excerpt }}</p>
                            <Link :href="`/blog/${post.slug}`" class="landing-blog-card__link">
                                Read the guide <span aria-hidden="true">↗</span>
                            </Link>
                        </div>
                    </article>
                </div>
                <div v-else class="landing-blog-empty">
                    <strong>No guides match that search.</strong>
                    <button type="button" @click="query = ''; activeCategory = 'All topics'">Clear filters</button>
                </div>
            </div>
        </section>

        <section class="landing-section landing-section--white">
            <div class="landing-shell">
                <div class="landing-cta">
                    <div class="landing-kicker">Building something important?</div>
                    <h2>Turn a complex workflow into a clear plan.</h2>
                    <p>Talk with our team about product discovery, software delivery, integrations, or a focused improvement to an existing platform.</p>
                    <Link class="landing-button" href="/consultation">Discuss your project <span aria-hidden="true">→</span></Link>
                    <div class="landing-region-note" aria-label="Markets served">
                        <span>United States</span>
                        <span>United Kingdom</span>
                        <span>United Arab Emirates</span>
                        <span>Qatar</span>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>

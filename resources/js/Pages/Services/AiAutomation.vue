<script setup>
import StaticServiceLandingPage from '../../Components/StaticServiceLandingPage.vue';

const page = {
    slug: 'ai-automation',
    shortTitle: 'AI automation',
    title: 'AI Automation and Integration for Real Business Workflows',
    metaTitle: 'AI Automation and Integration Services | Infinicode System',
    metaDescription: 'Connect AI to practical workflows with document processing, retrieval, automation, privacy controls, and human review.',
    keyword: 'AI automation development company',
    visualTitle: 'Put AI to work responsibly',
    visualSteps: ['Select a measurable task', 'Ground output in trusted data', 'Review and improve safely'],
    visualFooter: 'Useful AI with clear boundaries and human control.',
    leadTitle: 'Make AI useful by connecting it to a workflow people already need.',
    intro: 'We help organizations find a specific, measurable use for AI and integrate it with existing systems. That includes knowledge retrieval, document extraction, classification, drafting, and automation—with guardrails and human review where the impact requires it.',
    outcomes: [
        { title: 'Focused use case', text: 'Start with a bounded task and a baseline to compare against.' },
        { title: 'Trusted context', text: 'Respect data access, source quality, privacy, and retention.' },
        { title: 'Visible quality', text: 'Measure errors, review effort, latency, and cost as usage grows.' },
    ],
    capabilitiesTitle: 'AI capabilities connected to business systems',
    capabilitiesIntro: 'We use AI where it improves interpretation and keep explicit rules where predictable behavior matters.',
    capabilities: [
        { title: 'Document workflows', text: 'Classify, extract, validate, and route documents with traceable human review.' },
        { title: 'Knowledge assistants', text: 'Retrieve approved information with citations and access-aware answers.' },
        { title: 'Process automation', text: 'Use AI for suggestions and deterministic workflows for controlled actions.' },
    ],
    processTitle: 'A controlled path from use case to production',
    process: [
        { title: 'Select', text: 'Choose a task with measurable value, usable data, and a safe review path.' },
        { title: 'Evaluate', text: 'Test representative cases, quality limits, privacy, cost, and latency.' },
        { title: 'Integrate', text: 'Connect services with permission checks, validation, and fallbacks.' },
        { title: 'Monitor', text: 'Review output quality, user corrections, errors, and changing data.' },
    ],
    fitTitle: 'For teams seeking useful automation, not an AI demo',
    fitIntro: 'We work with product and operations teams across the USA, UK, UAE, and Qatar to scope responsible AI pilots.',
    faqs: [
        { question: 'Can AI be integrated into an existing application?', answer: 'Yes. We can connect AI capabilities to existing APIs and workflows while keeping access control and business rules in the application.' },
        { question: 'How do you prevent unreliable AI output?', answer: 'We test on representative cases, ground output in approved sources, validate structured results, and send uncertain or high-impact decisions to human review.' },
        { question: 'Do all automation projects need AI?', answer: 'No. Stable, deterministic rules are often simpler to test and operate. We use AI where interpretation adds value and explicit rules where consistency is essential.' },
    ],
    ctaTitle: 'Find the right task before investing in AI.',
    ctaText: 'Bring one repetitive process. We can assess its data, risk, and success measures, then shape a focused pilot with appropriate safeguards.',
};
</script>

<template>
    <StaticServiceLandingPage :page="page" />
</template>

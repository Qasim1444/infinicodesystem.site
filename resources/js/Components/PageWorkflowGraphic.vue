<script setup>
defineProps({
    title: { type: String, required: true },
    steps: { type: Array, required: true },
    footer: { type: String, default: 'Clear decisions. Measurable progress.' },
});
</script>

<template>
    <div class="workflow-graphic" role="img" :aria-label="title">
        <div class="workflow-graphic__top">
            <span class="workflow-graphic__orb" aria-hidden="true"></span>
            <span class="workflow-graphic__caption">THE DELIVERY MAP</span>
            <span class="workflow-graphic__menu" aria-hidden="true">•••</span>
        </div>
        <h2 class="workflow-graphic__title">{{ title }}</h2>
        <div class="workflow-graphic__steps">
            <div v-for="(step, index) in steps" :key="step" class="workflow-graphic__step">
                <span class="workflow-graphic__number">0{{ index + 1 }}</span>
                <strong>{{ step }}</strong>
                <span class="workflow-graphic__check" aria-hidden="true">✓</span>
            </div>
        </div>
        <div class="workflow-graphic__footer">
            <span class="workflow-graphic__pulse" aria-hidden="true"></span>
            {{ footer }}
        </div>
    </div>
</template>

import '../css/app.css';
import '../css/static-pages.css';
import '../css/landing-pages.css';
import './bootstrap-vendor.js';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import Layout from './Layouts/AppLayout.vue';
import reveal from './directives/reveal.js';
import { setupMetaPixel } from './meta-pixel.js';

// Registered before createInertiaApp so the initial Inertia navigate event
// (and therefore the first PageView) is captured.
setupMetaPixel();

const pages = import.meta.glob('./Pages/**/*.vue');

createInertiaApp({
    title: (title) => {
        if (!title) {
            return 'Infinicode System';
        }

        return title.endsWith(' | Infinicode System') ? title : `${title} | Infinicode System`;
    },
    resolve: (name) => {
        const loadPage = pages[`./Pages/${name}.vue`];
        if (!loadPage) {
            throw new Error(`Page not found: ${name}`);
        }
        return loadPage().then((page) => {
            if (page.default.layout === undefined) {
                page.default.layout = Layout;
            }
            return page;
        });
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .directive('reveal', reveal)
            .mount(el);
    },
});

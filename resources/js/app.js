
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress';
import Layout from "./src/layout/Layout.vue";


createInertiaApp({

    resolve: name =>   {
    const pages = import.meta.glob('./src/pages/**/*.vue', { eager: true })
    let page = pages[`./src/pages/${name}.vue`];
    page.default.layout =page.default.layout || Layout;
    return page;
},
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el)
    },
})
InertiaProgress.init();

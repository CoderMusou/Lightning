require('./bootstrap');

require('moment');

import Vue from 'vue';

import { InertiaApp } from '@inertiajs/inertia-vue';
import { InertiaForm } from 'laravel-jetstream';
import PortalVue from 'portal-vue';
import VueMeta from 'vue-meta';
import PurgeIconsVue from 'purge-icons-vue';
import { InertiaProgress } from '@inertiajs/progress';
import mavonEditor from 'mavon-editor'
import 'mavon-editor/dist/css/index.css'
import 'mavon-editor/dist/markdown/github-markdown.min.css'
import 'mavon-editor/dist/highlightjs/styles/atom-one-dark.min.css'


InertiaProgress.init({
    color: '#ac94fa'
});

Vue.mixin({ methods: { route } });
Vue.use(InertiaApp);
Vue.use(InertiaForm);
Vue.use(PortalVue);
Vue.use(VueMeta);
Vue.use(PurgeIconsVue);
Vue.use(mavonEditor);

const app = document.getElementById('app');
const appName = document.title;

new Vue({
    metaInfo: {
        titleTemplate: (title) => title ? `${title} - ${appName}` : appName
    },
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);

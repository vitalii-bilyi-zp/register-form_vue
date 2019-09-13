import Vue from 'vue';
import VueRouter from 'vue-router';

import Form from '@/js/views/members/Form';
import Index from '@/js/views/members/Index';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'members.form',
            component: Form
        },
        {
            path: '/members',
            name: 'members.index',
            component: Index
        },
    ]
});

export default router;

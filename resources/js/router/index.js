import {createRouter, createWebHistory} from 'vue-router';
import Layout from '../views/layouts'
import NotFound from '../views/public/not-found'

const routes = [
    {
        path: '',
        name: 'public',
        component: Layout,
        children: [
            {
                path: '',
                name: 'public-home',
                component: () => import("../views/public/home"),
            },
            {
                path: '/:pathMatch(.*)*',
                name: 'NotFound',
                component: NotFound
            },
        ],
        beforeEnter: ( to, from, next ) => {
            next();
        },
    },
];

const router = createRouter({
    history: createWebHistory( process.env.MIX_ROUTER_BASE || "/" ),
    routes,
})

export default router;

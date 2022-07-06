import { createRouter, createWebHistory } from 'vue-router';
import authService from "@/api/auth.service";

const routes = [
  {
    path: '/',
    name: 'Login',
    meta: { layout: 'empty' },
    component: () => import('@/views/Login.vue'),
  },
  {
    path: '/page',
    name: 'Page',
    meta: { layout: 'main', auth: true },
    component: () => import('@/views/Page.vue'),
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
});

router.beforeEach((to, from, next) => {
  const currentUser = authService.isLoggedIn();
  const reqAuth = to.matched.some(record => record.meta.auth);
  if (reqAuth && !currentUser) {
    next('/')
  } else {
    next()
  }
});

export default router

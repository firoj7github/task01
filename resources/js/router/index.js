import { createRouter, createWebHistory } from 'vue-router';
import Home from '../pages/Home.vue';
import Login from '../pages/Login.vue';
import Register from '../pages/Register.vue';
import Profile from '../pages/Profile.vue';
import Product from '../pages/product/Index.vue';
import ProductCreate from '../pages/product/Add.vue';
import ProductEdit from '../pages/product/Edit.vue';

const routes = [
  { path: '/', component: Home, name: 'Home' },
  { path: '/user/login', component: Login, name: 'Login' },
  { path: '/user/register', component: Register, name: 'Register' },
  { path: '/profile', component: Profile, name: 'Profile', meta: { requiresAuth: true } },
  { path: '/product', component: Product, name: 'ProductIndex', meta: { requiresAuth: true } },
  { path: '/product/create', component: ProductCreate, name: 'ProductCreate', meta: { requiresAuth: true } },
  { path: '/product/edit/:id', component: ProductEdit, name: 'ProductEdit', meta: { requiresAuth: true } },
];



const router = createRouter({
  history: createWebHistory(),
  routes
});

router.beforeEach((to, from, next) => {
  const isLoggedIn = !!localStorage.getItem('token');

  if (to.meta.requiresAuth && !isLoggedIn) {
    next({ path: '/user/login' });
  } else {
    next();
  }
});

export default router;

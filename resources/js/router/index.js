import { createRouter, createWebHistory } from "vue-router";
import Home from '../pages/Home.vue';
import Login from '../pages/Login.vue';
import Register from '../pages/Register.vue';
import Profile from '../pages/Profile.vue';
import Product from '../pages/Product.vue';


const routes = [
  {
  path: '/',
  component: Home,
 },
  {
  path: '/user/login',
  component: Login,
  name: 'Login',
},
  {
    path: '/user/register',component: Register,},
{
  path: '/profile',
  component: Profile,
  },
{
  path: '/product',
  component: Product,
  
},
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;

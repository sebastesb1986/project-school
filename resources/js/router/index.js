import { createRouter, createWebHistory } from 'vue-router';
import HomeView from '../views/HomeView.vue';
import Welcome from '../views/Welcome.vue';
import CategoryView from '../views/category/CategoryView.vue';
import CategoryCreate from '../views/category/CategoryCreate.vue';
import ProductView from '../views/products/ProductView.vue';
import ProductCreate from '../views/products/ProductCreate.vue';
import Signin from '../views/signin/Signin.vue';
import store from '@/store'

const routes = [
    {
        path: '/',
        name: 'home',
        component: HomeView
    },
    {
        path: '/admin',
        name: 'admin',
        component: Signin,
        beforeEnter: (to, from, next) =>{

          if(store.getters['auth/authenticated']){

            return next({
              name: 'welcome'
            });

          }

          next();

        }
    },
    {
        path: '/categoryList',
        name: 'categorylist',
        component: CategoryView,
        beforeEnter: (to, from, next) =>{

          if(!store.getters['auth/authenticated']){

            return next({
              name: 'admin'
            });

          }

          next();

        }
    },
    {
      path: '/categoryCreate',
      name: 'categorycreate',
      component: CategoryCreate,
      beforeEnter: (to, from, next) =>{

        if(!store.getters['auth/authenticated']){

          return next({
            name: 'admin'
          });

        }

        next();

      }
    },
    {
        path: '/productList',
        name: 'productlist',
        component: ProductView,
        beforeEnter: (to, from, next) =>{

          if(!store.getters['auth/authenticated']){

            return next({
              name: 'admin'
            });

          }

          next();

        }
    },
    {
      path: '/productCreate',
      name: 'productcreate',
      component: ProductCreate,
      beforeEnter: (to, from, next) =>{

        if(!store.getters['auth/authenticated']){

          return next({
            name: 'admin'
          });

        }

        next();

      }
    },
    {
        path: '/welcome',
        name: 'welcome',
        component: Welcome,
        beforeEnter: (to, from, next) =>{

          if(!store.getters['auth/authenticated']){

            return next({
              name: 'admin'
            });

          }

          next();

        }
    },
    {
        path: '/:catchAll(.*)',
        redirect: '/'
    }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;

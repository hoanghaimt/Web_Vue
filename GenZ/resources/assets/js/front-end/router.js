import Vue from 'vue'
import Router from 'vue-router'
// import component
import Index from './components/IndexCom'
import Category from './components/CategoryCom'
import Detail from './components/DetailCom'
import Order from './components/OrderCom'
import Checkout from './components/CheckoutCom'
import ListnewsCom from './components/ListnewsCom'
import DetailnewsCom from './components/DetailnewsCom'
// import Checkoutmethod from './components/CheckoutmethodCom'

Vue.use(Router)
export default new Router({
  mode: 'history', 
  routes: [
    {
      path: '/',
      name: 'home',
      component:Index      
    },
    {
      path: '/dat-hang',
      name: 'order',
      component:Order,
      beforeEnter: (to, from, next) => {
          $('body').removeClass('home');
          $('body').addClass('category-page');
          next();
      }
    },
    {
      path: '/checkout',
      name: 'checkout',
      component:Checkout,
      beforeEnter: (to, from, next) => {
          $('body').removeClass('home');
          $('body').addClass('category-page');
          next();
      }
    },
    // {
    //   path: '/checkoutmethod',
    //   name: 'checkoutmethod',
    //   component:Checkoutmethod,
    //   beforeEnter: (to, from, next) => {
    //       $('body').removeClass('home');
    //       $('body').addClass('category-page');
    //       next();
    //   }
    // },
    {
      path: '/san-pham/:mod_slug',
      name: 'modcategory',
      component:Category,
      beforeEnter: (to, from, next) => {
          $('body').removeClass('home');
          $('body').addClass('category-page');
          next();
      }
    },
    {
      path: '/san-pham/:mod_slug/:list_slug',
      name: 'category',
      component:Category,
      beforeEnter: (to, from, next) => {
          $('body').removeClass('home');
          $('body').addClass('category-page');         
          next();
      }
    },
    {
      path: '/chi-tiet/:pro_id-:pro_slug',
      name: 'detail',
      component:Detail,
      beforeEnter: (to, from, next) => {
          $('body').removeClass('home');
          $('body').addClass('category-page');          
          next();
      }
    },
    {
      path: '/tin-tuc',
      name: 'list_new',
      component:ListnewsCom,
      beforeEnter: (to, from, next) => {
          $('body').removeClass('home');
          $('body').addClass('category-page');          
          next();
      }
    },
    {
      path: '/tin-tuc/:news_id-:news_slug',
      name: 'newsdetail',
      component:DetailnewsCom,
      beforeEnter: (to, from, next) => {
          $('body').removeClass('home');
          $('body').addClass('category-page');          
          next();
      }
    }
  ]
})
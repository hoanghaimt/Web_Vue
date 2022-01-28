import Vue from 'vue'
import Router from 'vue-router'

// Containers
import Full from '@/containers/Full'

// Views
import Dashboard from '@/views/Dashboard'

// Views - Components

// Views - products
import Mods from '@/views/components/FormModProducts'
import Lists from '@/views/components/FormListProducts'
import ListProducts from '@/views/components/ProductsTable'
import AddProducts from '@/views/components/products_add'
import EditProducts from '@/views/components/products_edit'
// Views - news
import NMods from '@/views/components/FormModNews'
import NLists from '@/views/components/FormListNews'
import ListNews from '@/views/components/NewsTable'
import AddNews from '@/views/components/News_add'
import EditNews from '@/views/components/News_edit'
// Views - orders
import OrdersList from '@/views/components/OrdersTable'
import OrdersHis from '@/views/components/OrdersHis'
import OrdersAdd from '@/views/components/Orders_add'
import OrdersEdit from '@/views/components/Oders_edit'
// Views - Icons
import Changepass from '@/views/components/Changepass'
import Ads from '@/views/components/Ads'
import Slide from '@/views/components/Slide'
import Setting from '@/views/components/Setting'


Vue.use(Router)

export default new Router({
  mode: 'hash', // Demo is living in GitHub.io, so required!
  linkActiveClass: 'open active',
  scrollBehavior: () => ({ y: 0 }),
  routes: [
    {
      path: '/',
      redirect: '/dashboard',
      name: 'Home',
      component: Full,
      children: [
        {
          path: 'dashboard',
          name: 'Dashboard',
          component: Dashboard
        },        
        {
          path: 'product',
          redirect: '/product/productslist',
          name: 'Sản phẩm',
          component: {
            render (c) { return c('router-view') }
          },
          children: [
            {
              path: 'mod',
              name: 'Danh mục',
              component: Mods
            },
            {
              path: 'list',
              name: 'Loại danh mục',
              component: Lists
            },
            {
              path: 'productslist',
              name: 'Listproducts',
              component: ListProducts
            },
            {
              path: 'add',
              name: 'Thêm sản phẩm',
              component: AddProducts
            },
            {
              path: 'edit/:pro_id',
              name: 'UpdatePro',
              component: EditProducts
            }
          ]
        },        
        {
          path: 'news',
          redirect: '/news/newslist',
          name: 'news',
          component: {
            render (c) { return c('router-view') }
          },
          children: [
            {
              path: 'mod',
              name: 'NewsMod',
              component: NMods
            },
            {
              path: 'list',
              name: 'NewsList',
              component: NLists
            },
            {
              path: 'newslist',
              name: 'ListNews',
              component: ListNews
            },
            {
              path: 'add',
              name: 'addnews',
              component: AddNews
            },
            {
              path: 'edit/:news_id',
              name: 'UpdateNews',
              component: EditNews
            }
          ]
        },        
        {
          path: 'orders',
          redirect: '/orders/list',
          name: 'orders',
          component: {
            render (c) { return c('router-view') }
          },
          children: [
            {
              path: 'list',
              name: 'OrdersList',
              component: OrdersList
            },
            {
              path: 'his',
              name: 'OrdersHis',
              component: OrdersHis
            },
            {
              path: 'add',
              name: 'addorder',
              component: OrdersAdd
            },
            {
              path: 'edit/:o_id',
              name: 'editorder',
              component: OrdersEdit
            }
          ]
        },    
        {
          path: 'changepasswork',
          redirect: '/changepasswork/user',
          name: 'Đổi mật khẩu ',
          component: {
            render (c) { return c('router-view') }
          },
          children: [
            {
              path: 'user',
              name: 'Admin',
              component: Changepass
            }
          ]
        },
        ,    
        {
          path: 'ads',
          redirect: '/ads/list',
          name: 'ads',
          component: {
            render (c) { return c('router-view') }
          },
          children: [
            {
              path: 'list',
              name: 'listads',
              component: Ads
            }
          ]
        },
        ,    
        {
          path: 'slide',
          redirect: '/slide/list',
          name: 'Quản lý slide',
          component: {
            render (c) { return c('router-view') }
          },
          children: [
            {
              path: 'list',
              name: 'slide',
              component: Slide
            }
          ]
        },
        ,    
        {
          path: 'setting',
          redirect: '/setting/list',
          name: 'Setting',
          component: {
            render (c) { return c('router-view') }
          },
          children: [
            {
              path: 'list',
              name: 'setting',
              component: Setting
            }
          ]
        }
      ]
    }
  ]
})

export default {
  items: [
    {
      name: 'Tổng Quan',
      url: '/dashboard',
      icon: 'icon-speedometer'
    },
    {
      title: true,
      name: 'Quản Lý'
    },
    {
      name: 'QL Sản Phẩm',
      url: '/product',
      icon: 'icon-drawer',
      children: [
        {
          name: 'Danh mục',
          url: '/product/mod',
          icon: 'icon-star'
        },
        {
          name: 'Loại danh mục',
          url: '/product/list',
          icon: 'icon-star'
        },
        {
          name: 'Sản phẩm',
          url: '/product/productslist',
          icon: 'icon-star'
        }
      ]
    }, 
    {
      name: 'QL Tin tức',
      url: '/news',
      icon: 'icon-folder-alt',
      children: [
        {
          name: 'Danh mục tin',
          url: '/news/mod',
          icon: 'icon-star'
        },
        {
          name: 'Loại tin',
          url: '/news/list',
          icon: 'icon-star'
        },
        {
          name: 'Danh sách tin',
          url: '/news/newslist',
          icon: 'icon-star'
        }
      ]
    }, 
    {
      name: 'QL đơn hàng',
      url: '/orders',
      icon: 'icon-basket-loaded',
      children: [
        {
          name: 'Danh sách đơn hàng',
          url: '/orders/list',
          icon: 'icon-bag'
        },
        {
          name: 'Lịch sử đơn hàng',
          url: '/orders/his',
          icon: 'icon-action-undo'
        }
      ]
    },
    {
      name: 'Quảng cáo',
      url: '/ads',
      icon: 'icon-speedometer'
    },
    {
      name: 'QL Slide',
      url: '/slide',
      icon: 'icon-bag'
    },
    {
      name: 'Cấu hình thông tin',
      url: '/setting',
      icon: 'icon-settings'
    }
  ]
}

<template>
  <header class="app-header navbar">
    <button class="navbar-toggler mobile-sidebar-toggler d-lg-none" type="button" @click="mobileSidebarToggle">&#9776;</button>
    <b-link class="navbar-brand" to="#"></b-link>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" @click="sidebarMinimize">&#9776;</button>
    <b-nav is-nav-bar class="d-md-down-none">
      <b-nav-item class="px-3" @click="dashboard()">Dashboard</b-nav-item>
    </b-nav>
    <b-nav is-nav-bar class="ml-auto" style="margin-right:15px;">
      <b-nav-item-dropdown right>
        <template slot="button-content">
          <img src="/images/tqnshop.jpg" class="img-avatar" alt="admin@gmail.com">
          <span class="d-md-down-none">{{us.name}}</span>
        </template>
        <b-dropdown-header tag="div" class="text-center"><strong> Thông tin đơn hàng </strong></b-dropdown-header>
        <b-dropdown-item><i class="fa fa-tasks"></i> Tổng cộng<span class="badge badge-info">{{total}}</span></b-dropdown-item>
        <b-dropdown-item><i class="fa fa-tasks"></i> Đã đã hủy<span class="badge badge-danger">{{cancel}}</span></b-dropdown-item>
        <b-dropdown-item><i class="fa fa-tasks"></i> Đã hoàn thành<span class="badge badge-success">{{success}}</span></b-dropdown-item>
        <b-dropdown-item><i class="fa fa-tasks"></i> Đang thực hiện<span class="badge badge-warning">{{pending}}</span></b-dropdown-item>
        <b-dropdown-header tag="div" class="text-center"><strong>Cá nhân</strong></b-dropdown-header>
        <b-dropdown-item > <router-link to="/changepasswork"><i class="fa fa-wrench"> Đổi mật khẩu</i></router-link> </b-dropdown-item>
        <b-dropdown-item  @click="logout()"><i class="fa fa-lock"></i> Logout </b-dropdown-item>
      </b-nav-item-dropdown>
    </b-nav>
  </header>
</template>
<script>
export default {
  name: 'v_header',
  name: 'modals',
  data () {
    return {
      loading: false,
      modal_changepass:false,
      name:'',
      email:'',
      oldpass:'',
      newpass:'',
      renewpass:'',
      total:'',
      success:'',
      pending:'',
      cancel:'',
      receive:'',
      us:{

      },
      errors:{

      },    
    }
  },
  mounted(){
    this.getadmin_info();
    this.get_info_dborder();
    this.loading = false;
  },
  methods: {
    sidebarToggle (e) {
      e.preventDefault()
      document.body.classList.toggle('sidebar-hidden')
    },
    getadmin_info(){
      axios.get('/api/admins').then(response=> {

        this.us = response.data;       
      });
    },
    get_info_dborder(){
      axios.get('/api/admins/get_info_dborder').then(response=> {
        this.receive = response.data.receive;       
        this.total = response.data.total;       
        this.success = response.data.success;       
        this.pending = response.data.pending;       
        this.cancel = response.data.cancel;       
      });
    },
    sidebarMinimize (e) {
      e.preventDefault()
      document.body.classList.toggle('sidebar-minimized')
    },
    mobileSidebarToggle (e) {
      e.preventDefault()
      document.body.classList.toggle('sidebar-mobile-show')
    },
    asideToggle (e) {
      e.preventDefault()
      document.body.classList.toggle('aside-menu-hidden')
    },
    logout(){
        window.location.href = 'logout';
    },
    dashboard(){
        window.location.href = 'dashboard';
    }
  }
};
</script>

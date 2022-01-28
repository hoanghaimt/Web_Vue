<template>    
<div id="header" class="header">
    <div class="top-header">
        <div class="container">
            <div class="nav-top-links">
                <a class="first-item" :href="'tel:'+setting_phone"><img alt="phone" src="/assets/images/phone.png" />{{setting_phone}}</a>
                <a :href="'mailto:'+setting_mail"><img alt="email" src="/assets/images/email.png" />Liên hệ ngay!</a>
            </div>           
            <div class="support-link">
                <a href="#"></a>
                <a href="#"></a>
            </div>
        </div>
    </div>
    <div class="container main-header">
        <div class="row">
            <div class="col-xs-12 col-sm-3 logo">
                <a :href="'/'"><img alt="Kute Shop" :src="setting_logo" /></a>
            </div>
            <div class="col-xs-7 col-sm-7 header-search-box">
                <form class="form-inline">
                      <div class="form-group form-category">
                        <select class="select-category">
                            <option value="2">Tất cả</option>
                            <option 
                                 v-for="m in modpro" 
                                 v-bind:value="m.id"
                                >{{ m.mod_name }}
                            </option>
                        </select>
                      </div>
                      <div class="form-group input-serach">
                        <input type="text"  placeholder="Nhập từ khóa...">
                      </div>
                      <button type="submit" class="pull-right btn-search"></button>
                </form>
            </div>
            <div id="cart-block" class="col-xs-5 col-sm-2 shopping-cart-box">
                <a class="cart-link" href="#">
                    <span class="title">Giỏ hàng</span>
                    <span class="total">{{cart_sum_info.total_qty}}(SP) - {{formatPrice(cart_sum_info.total_pay)}}</span>
                    <span class="notify notify-left">{{cart_sum_info.total_qty}}</span>
                </a>
                <div class="cart-block">
                    <div class="cart-block-content">
                        <h5 class="cart-title">{{cart_sum_info.total_qty}} Sản phẩm</h5>
                        <div class="cart-block-list">
                            <a class="btn btn-md" title="Xóa giỏ hàng" style="float: right; position: absolute; right: 0;top: 4px;" @click="(cart_destroy())"><i class="glyphicon glyphicon-repeat"></i></a>
                            <ul v-for="cart in cart_info">
                                <li class="product-info">
                                    <div class="p-left">
                                        <a href="#" class="remove_link" @click="(cart_remove_item(cart.rowId))"></a>
                                        <a href="#">
                                        <img class="img-responsive" :src="cart.options.image" :alt="cart.name">
                                        </a>
                                    </div>
                                    <div class="p-right">
                                        <p class="p-name">{{cart.name}}</p>
                                        <p class="p-rice">{{formatPrice(cart.price)}}</p>
                                        <p>SLượng: {{cart.qty}}</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="toal-cart">
                            <span>Tổng</span>
                            <span class="toal-price pull-right">{{formatPrice(cart_sum_info.total_pay)}}</span>
                        </div>
                        <div class="cart-buttons">      
                            <router-link tag="a" class="btn-check-out" to="/dat-hang">Đặt ngay</router-link> 
                            <button type="button" class="btn hidden" id="update_cart" @click="update_cart()">x</button>                         
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
    <div id="nav-top-menu" class="nav-top-menu">
        <div class="container">
            <div class="row">
                <div class="col-sm-3" id="box-vertical-megamenus">
                    <div class="box-vertical-megamenus">
                        <h4 class="title">
                            <span class="title-menu">Danh Mục</span>
                            <span class="btn-open-mobile pull-right home-page" id="block_menu"><i class="fa fa-bars"></i></span>
                        </h4>
                    <div class="vertical-menu-content is-home">
                        <ul class="vertical-menu-list">
                            <li v-for="mod_cat in modpro">
                                <a class="parent" href="#"><img class="icon-menu" alt="No image" src="/assets/data/2.png"> {{mod_cat.mod_name}}</a>
                                <div class="vertical-dropdown-menu">
                                    <ul class="col-md-12" v-for="list in listpro" v-if="mod_cat.id == list.id_mod ">
                                        <router-link tag="li" :to="'/san-pham/'+mod_cat.mod_slug+'/'+list.list_slug"><a>{{list.list_name}}</a></router-link>
                                                                                                                            
                                    </ul>
                                </div>
                            </li>                             
                        </ul>
                        <div class="all-category"><span class="open-cate">Xem Thêm</span></div>
                    </div>
                </div>
                </div>
                <div id="main-menu" class="col-sm-9 main-menu">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <i class="fa fa-bars"></i>
                                </button>
                                <a class="navbar-brand" href="#">MENU</a>
                            </div>
                            <div id="navbar" class="navbar-collapse collapse">
                                <ul class="nav navbar-nav">
                                    <li class="active"><a href="/">Home</a></li>                                
                                    <li v-for="mod in modpro">
                                        <router-link :to="'/san-pham/' + mod.mod_slug">{{mod.mod_name}}</router-link>
                                    </li>
                                     <li>
                                        <router-link to='/tin-tuc'>Tin Tức</router-link>
                                    </li>
                                </ul>
                            </div><!--/.nav-collapse -->
                        </div>
                    </nav>
                </div>
            </div>
            <!-- userinfo on top-->
            <div id="form-search-opntop">
            </div>
            <!-- userinfo on top-->
            <div id="user-info-opntop">
            </div>
            <!-- CART ICON ON MMENU -->
            <div id="shopping-cart-box-ontop">
                <i class="fa fa-shopping-cart"></i>
                <div class="shopping-cart-box-ontop-content"></div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        data(){
            return {
                modpro:'',
                listpro:'',
                cart_info:'',
                cart_sum_info:'',
                setting_mail:'',
                setting_phone:'',
                setting_logo:'',
                setting_address:'',
                setting_fanpage:'',
                setting_nameco:'',
            }
        },
        mounted() {
            this.getmodlistinfo();
            this.get_cart_info();
            this.get_setting();
        },
        methods:{
            formatPrice(value) {
                let val = (value/1).toFixed(0).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")+'đ'
            },
            getmodlistinfo(){
                axios.get('/apiget_mod_list_info').then(response=> {
                    this.modpro = response.data.mod;    
                    this.listpro = response.data.list; 
                });
            },
            update_cart(){
                this.get_cart_info();
            },
            cart_destroy(){
                axios.get('/api_get_cart_destroy').then(response=> {
                    this.cart_info = "";
                    this.cart_sum_info = "";             
                });
            },
            cart_remove_item(rowId){
                axios.post('/api_post_removecart_item', { rowId:rowId}).then(response => {
                 if (true) {
                    this.get_cart_info();
                 }       
              }).catch(error=>{
                console.log(error.response);
              });
            },
            get_cart_info(){
                axios.get('/api_get_cart_info').then(response=> {
                    this.cart_info = response.data.carts;
                    this.cart_sum_info = response.data.cart_sum_info;             
                });
            },
            get_setting(){
                axios.get('/api_get_setting').then(response=> {
                    this.setting_mail = response.data.mail;
                    this.setting_phone = response.data.phone;             
                    this.setting_nameco = response.data.nameco;             
                    this.setting_address = response.data.address;             
                    this.setting_logo = response.data.logo;             
                });
            }
        }
    }
</script>

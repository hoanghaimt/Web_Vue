<template>   
<div>
    <IndexSliderCom></IndexSliderCom>
    <ServiceCom></ServiceCom>
    <div class="content-page" >
        <div v-if="loading">
          <div class="loader"></div>
        </div>
        <div class="container">
            <!-- featured category sports -->
            <div class="category-featured"  v-for=" (val, index) in index_pro.modpro_all">
                <nav class="navbar nav-menu nav-menu-green show-brand">
                  <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                      <div class="navbar-brand"><a href="#"><img alt="fashion" src="assets/data/sports.png" />{{val.mod_name}}</a></div>
                      <span class="toggle-menu"></span>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse">           
                      <ul class="nav navbar-nav">
                        <li class="active"><a data-toggle="tab" href="#tab-hot">{{val.mod_name}} nổi bật</a></li>
                      </ul>
                    </div><!-- /.navbar-collapse -->
                  </div><!-- /.container-fluid -->
                  <div :id="'elevator-'+ index" class="floor-elevator">
                        <a :href="'#elevator-'+parseInt(index -1)" class="btn-elevator up fa fa-angle-up"></a>
                        <a :href="'#elevator-'+parseInt(index +1)" class="btn-elevator down fa fa-angle-down"></a>
                  </div>
                </nav>
                <!-- <div class="category-banner">
                    <div class="col-sm-12 banner">
                        <a href="#"><img alt="ads2" class="img-responsive" src="assets/data/ads6.jpg" /></a>
                    </div>
                    <div class="col-sm-6 banner">
                        <a href="#"><img alt="ads2" class="img-responsive" src="assets/data/ads7.jpg" /></a>
                    </div>
                </div> -->
                <div class="product-featured clearfix">
                    <div class="product-featured-content">
                        <div class="product-featured-list">
                            <div class="tab-container autoheight">
                                <!-- tab product -->
                                <div class="tab-panel active">
                                    <ul class="product-list">
                                        <div v-for="pro in index_pro.pro">
                                            <div v-if="val.id == pro[0]">
                                               <div v-for="pro_item in pro[1]">
                                                    <li class="col-md-3">
                                                        <div class="left-block">
                                                            <router-link :to="'/chi-tiet/'+pro_item.id+'-'+pro_item.pro_slug">
                                                                <img class="img-responsive" alt="No image" :src="pro_item.pro_image" />
                                                            </router-link>
                                                            <div class="quick-view">
                                                                    <a title="Add to my wishlist" class="heart" href="#"></a>
                                                                    <a title="Add to compare" class="compare" href="#"></a>
                                                                    <a title="Quick view" class="search" href="#"></a>
                                                            </div>
                                                            <div class="add-to-cart" v-on:click="add_to_cart(pro_item.id)">
                                                                <a title="Add to Cart" href="#">Thêm vào giỏ</a>
                                                            </div>
                                                        </div>
                                                        <div class="right-block">
                                                            <h5 class="product-name">
                                                                <router-link :to="'/chi-tiet/'+pro_item.id+'-'+pro_item.pro_slug">
                                                                {{pro_item.pro_name}}
                                                                </router-link>                                                                
                                                            </h5>
                                                            <div class="content_price">
                                                                <span class="price product-price">{{formatPrice(pro_item.pro_price)}}</span>
                                                                <span class="price old-price">{{formatPrice(pro_item.pro_sale)}}</span>
                                                            </div>
                                                            <div class="product-star">
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-half-o"></i>
                                                            </div>
                                                        </div>
                                                    </li>                      
                                               </div>
                                            </div>
                                            
                                        </div>                                                                                
                                    </ul>
                                </div>                           
                            </div>
                        </div>
                    </div>
               </div>
            </div>        
            <!-- end featured category sports-->
        </div>
    </div>
</div>
</template>
<script>
    import IndexSliderCom   from '../components/Layouts/IndexSliderCom'
    import ServiceCom       from '../components/Layouts/ServiceCom'
    export default {
        components:{
            IndexSliderCom,
            ServiceCom
        },
        data(){
            return {
                modpro:'',
                listpro:'',
                modproducts:'',
                index_pro:'',
                cart_info:'',
                loading: true,
                cart_sum_info:''
            }
        },
        mounted() {
            this.getmodlistinfo();
            this.apiindex_product();
            this.scroll_top();
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
            apiindex_product(){
                this.loading = true;
                axios.get('/apiindex_product').then(response=> {
                    this.index_pro = response.data;    
                    this.loading = false;         
                });
            },
            add_to_cart(id){
                this.loading = true;
                axios.post('/api_post_addcart', { id_pro:id}).then(response => {
                 if (true) {
                    $('#update_cart').click();
                    this.loading = false;
                 }       
              }).catch(error=>{
                console.log(error);
              });
            },
            scroll_top(){
                window.scrollTo(0,0);
            },
            get_cart_info(){
                axios.get('/api_get_cart_info').then(response=> {
                    this.cart_info = response.data.carts;
                    this.cart_sum_info = response.data.cart_sum_info;             
                });
            }
        }
    };
</script>
<style type="text/css" media="screen">
a:hover{
        cursor: pointer;
    }
.error_msg{
  color: red;
}

@keyframes rotate {
  0% {
    transform: translate(-50%, -50%) rotate(0);
  }
  100% {
    transform: translate(-50%, -50%) rotate(360deg);
  }
}  
</style>
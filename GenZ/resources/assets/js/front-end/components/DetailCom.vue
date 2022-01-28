<template>
    <div class="columns-container">
        <div v-if="loading">
          <div class="loader"></div>
        </div>
        <div class="container" id="columns">
            <!-- breadcrumb -->
            <div class="breadcrumb clearfix">
                <a class="home" href="#" title="Return to Home" id="top_content">Home</a>
                <span class="navigation-pipe">&nbsp;</span>
                <span class="navigation_page">Chi tiết</span>
                <span class="navigation_page">{{products_detail.pro_name}}</span>
            </div>
            <!-- ./breadcrumb -->
            <!-- row -->
            <div class="row">
                <!-- Left colunm -->
                <div class="column col-xs-12 col-sm-3" id="left_column">
                    <!-- block best sellers -->
                    <div class="block left-module">
                        <p class="title_block">SẢN PHẨM MỚI</p>
                        <div class="block_content">
                            <ul class="products-block best-sell">
                                <li v-for="news in news_products">
                                    <div class="products-block-left">
                                        <router-link :to="'/chi-tiet/'+news.id+'-'+news.pro_slug">
                                            <img :src="news.pro_image" :alt="news.pro_name">
                                        </router-link>                                    
                                    </div>
                                    <div class="products-block-right">
                                        <p class="product-name">
                                            <router-link :to="'/chi-tiet/'+news.id+'-'+news.pro_slug">
                                                {{news.pro_name}}
                                            </router-link>
                                        </p>
                                        <p class="product-price">{{formatPrice(news.pro_sale)}}</p>
                                        <p class="product-star">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                        </p>
                                    </div>
                                </li>                                
                            </ul>
                        </div>
                    </div>
                    <!-- ./block best sellers  --> 
                    <!-- left silide -->
                    <div class="col-left-slide left-module">
                        <div class="banner-opacity">
                            <a href="#"><img src="/assets/data/ads-banner.jpg" alt="ads-banner"></a>
                        </div>
                    </div>
                    <!--./left silde-->
                </div>
                <!-- ./left colunm -->
                <!-- Center colunm-->
                <div class="center_column col-xs-12 col-sm-9" id="center_column">
                    <!-- Product -->
                        <div id="product">
                            <div class="primary-box row">
                                <div class="pb-left-column col-xs-12 col-sm-6">
                                    <!-- product-imge-->
                                    <div class="product-image">
                                        <div class="product-full">
                                            <img id="product-zoom" :src="products_detail.pro_image" :data-zoom-image="products_detail.pro_image">
                                        </div>                                  
                                    </div>
                                    <!-- product-imge-->
                                </div>
                                <div class="pb-right-column col-xs-12 col-sm-6">
                                    <h1 class="product-name">{{products_detail.pro_name}}</h1>
                                    <div class="product-comments">
                                        <div class="product-star">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                        </div>
                                        <div class="comments-advices">
                                            <a href="#">3 đánh giá</a>
                                            <a href="#"><i class="fa fa-pencil"></i> Để lại đánh giá</a>
                                        </div>
                                    </div>
                                    <div class="product-price-group">
                                        <span class="price">{{formatPrice(products_detail.pro_sale)}}</span>
                                        <span class="old-price">{{formatPrice(products_detail.pro_price)}}</span>
                                        <span class="discount">
                                        Giảm :{{  formatPrice(Math.floor(products_detail.pro_price-products_detail.pro_sale)) }}
                                        </span>
                                    </div>
                                    <div class="info-orther">
                                        <p>Mã sản phẩm: #SP{{products_detail.id}}</p>
                                        <p>Trạng thái: 
                                            <span class="label label-success" v-if="products_detail.pro_status ==0">Còn hàng</span>
                                            <span class="label label-warning" v-else>Tạm hết</span>
                                        </p>
                                        <p>Loại: <span class="label label-success">Mới</span></p>
                                    </div>
                                    <div class="product-desc" v-html="products_detail.pro_intro"></div>
                                    <div class="form-action">
                                        <div class="button-group">
                                            <a class="btn-add-cart" v-on:click="add_to_cart(products_detail.id)">Thêm vào giỏ</a>
                                        </div>

                                        <div class="button-group">
                                            <a class="wishlist" href="#"><i class="fa fa-heart-o"></i>
                                            <br>Thêm yêu thích</a>
                                            <a class="compare" href="#"><i class="fa fa-signal"></i>
                                            <br>        
                                            So sánh</a>
                                        </div>
                                    </div>
                                    <div class="form-share">
                                        <div class="sendtofriend-print">
                                            <a href="javascript:print();"><i class="fa fa-print"></i> In trang</a>
                                            <a href="#"><i class="fa fa-envelope-o fa-fw"></i>Chia sẻ</a>
                                        </div>
                                        <div class="network-share">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- tab product -->
                            <div class="product-tab">
                                <ul class="nav-tab">
                                    <li class="active">
                                        <a aria-expanded="false" data-toggle="tab" href="#product-detail">Thông tin sản phẩm</a>
                                    </li>
                                    <li>
                                        <a aria-expanded="true" data-toggle="tab" href="#information">Chi tiết sản phẩm</a>
                                    </li>
         
                                </ul>
                                <div class="tab-container">
                                    <div id="product-detail" class="tab-panel active" v-html="products_detail.pro_content">
                                        
                                    </div>
                                    <div id="information" class="tab-panel" v-html="products_detail.pro_specs">
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            <!-- ./tab product -->
                        </div>
                    <!-- Product -->
                </div>
                <!-- ./ Center colunm -->
            </div>
            <!-- ./row-->
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                modpro:'',
                listpro:'',
                products_detail:'',
                news_products:'',
                mod_name:'',
                loading: true,
                list_name:''
            }
        },
        mounted() {
            this.getmodlistinfo();
            this.getproduct_detail();
            this.scroll_top()
        },
        watch: {
            // call again the method if the route changes
            '$route'(to, from) {
                this.getproduct_detail()
                this.scroll_top()
            }
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
            add_to_cart(id){
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
            getproduct_detail(){
                this.loading = true;
                axios.get('/api_chi_tiet/'+this.$route.params.pro_id+'-'+this.$route.params.pro_slug).then(response => {
                    this.products_detail ='';
                    this.products_detail = response.data.pro; 
                    this.news_products = '';
                    this.news_products = response.data.new_pro; 
                    this.loading = false;
                  }).catch(error=>{
                    console.log(error);
                  });
            },
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

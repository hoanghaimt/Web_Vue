<template>   
    <div class="columns-container">
        <div v-if="loading">
          <div class="loader"></div>
        </div>
        <div class="container" id="columns">
            <!-- breadcrumb -->
            <div class="breadcrumb clearfix">
                <a class="home" href="#" title="Return to Home">Home</a>
                <span class="navigation-pipe">&nbsp;</span>
                <span class="navigation_page">{{modpro.mod_name}}</span>
                <span class="navigation-pipe" v-if="listpro !='all'">&nbsp;</span>
                <span class="navigation_page" v-if="listpro !='all'">{{listpro.list_name}}</span>
            </div>
            <!-- ./breadcrumb -->
            <!-- row -->
            <div class="row">                
                <!-- Center colunm-->
                <div class="center_column col-xs-12 col-sm-12" id="center_column">
                    <!-- category-slider -->
                    <div class="category-slider">
                        <ul class="owl-carousel owl-style2" data-dots="false" data-loop="true" data-nav = "true" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-items="1">
                            <li>
                                <img src="/assets/data/category-slide.jpg" alt="category-slider">
                            </li>
                            <li>
                                <img src="/assets/data/slide-cart2.jpg" alt="category-slider">
                            </li>
                        </ul>
                    </div>
                    <!-- ./category-slider -->
                    <!-- view-product-list-->
                    <div id="view-product-list" class="view-product-list">
                        <h2 class="page-heading">
                            <div v-if="listpro =='all'">
                                <span class="page-heading-title">{{modpro.mod_name}}</span>
                            </div>
                            <div v-else>
                                <span class="page-heading-title">{{listpro.list_name}}</span>
                            </div>
                            
                        </h2>
                        <ul class="display-product-option">
                            <li class="view-as-grid selected">
                                <span>grid</span>
                            </li>
                            <li class="view-as-list">
                                <span>list</span>
                            </li>
                        </ul>
                        <!-- PRODUCT LIST -->
                        <ul class="row product-list style2 grid" id="target"> 
                            <div v-if="products_in_list.length >0">
                            <li class="col-sx-12 col-sm-3" v-for="item in products_in_list">
                                <div class="product-container">
                                    <div class="left-block">
                                        <router-link :to="'/chi-tiet/'+item.id+'-'+item.pro_slug"><img class="img-responsive" alt="product" :src="item.pro_image" /></router-link>
                                        <div class="quick-view">
                                                <a title="Add to my wishlist" class="heart" href="#"></a>
                                                <a title="Add to compare" class="compare" href="#"></a>
                                                <a title="Quick view" class="search" href="#"></a>
                                        </div>
                                    </div>
                                    <div class="right-block">
                                        <h5 class="product-name">
                                            <router-link :to="'/chi-tiet/'+item.id+'-'+item.pro_slug">{{item.pro_name}}</router-link>
                                        </h5>
                                        <div class="product-star">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                        </div>
                                        <div class="content_price">
                                            <span class="price product-price">{{formatPrice(item.pro_sale)}}</span>
                                            <span class="price old-price">{{formatPrice(item.pro_price)}}</span>
                                        </div>
                                        <div class="info-orther">
                                            <p>Item Code: #SP{{item.id}}</p>
                                            <p class="availability">Trạng thái: <span v-if="item.pro_status ==0">Còn hàng</span> <span v-else>Tạm hết</span></p>
                                            <div class="product-desc" v-html="item.pro_intro">
                                            </div>
                                        </div>
                                        <div class="add-to-cart" v-on:click="add_to_cart(item.id)">
                                            <a title="Thêm sản phẩm">Thêm vào giỏ</a>
                                        </div>
                                    </div>
                                </div>
                            </li> 
                            </div>
                            <div v-else>
                                <li class="col-sx-12 col-sm-12">
                                    <div class="product-container" style="padding: 15px;">
                                        <h3> Hiện chưa có sản phẩm thuộc danh mục này !</h3>
                                     </div>
                                 </li>
                            </div>
                        </ul>
                        <!-- ./PRODUCT LIST -->
                    </div>
                    <!-- ./view-product-list-->
                    <div v-if="products_in_list.length >0">
                        <div class="sortPagiBar">
                            <div class="bottom-pagination">
                                 <nav>
                                  <ul class="pagination">
                                    <li>
                                      <a  aria-label="Next" v-on:click="FetchPaginateData(pagination.prev_page)" :disabled="!pagination.prev_page"> 
                                        <span aria-hidden="true">Sau</span>
                                      </a>
                                    </li>
                                    <li class="active" v-for="item in pagination.last_page" v-if="item == pagination.current_page">
                                        <a href="">{{item}}</a>
                                    </li>
                                    <li v-else>
                                        <a  v-on:click="FetchPaginateData(pagination.path_page+'?page='+item)">{{item}}</a>
                                    </li>
                                    <li>
                                      <a  aria-label="Next" v-on:click="FetchPaginateData(pagination.next_page)" :disabled="!pagination.next_page"> 
                                        <span aria-hidden="true">Tiếp</span>
                                      </a>
                                    </li>
                                  </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
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
                loading:true,
                products_in_list:'',
                url:'/apigetproduct_in_category/'+this.$route.params.mod_slug+'/'+this.$route.params.list_slug,
                pagination:[],
                mod_name:'',
                list_name:''
            }
        },
        mounted() {
            this.get_mod_list_by_slug();
            this.getproduct_in_category();
            this.scroll_top();
        },
        watch: {
            // call again the method if the route changes
            '$route'(to, from) {
                this.getproduct_in_category()
                this.get_mod_list_by_slug()
                this.scroll_top()
            }
        },
        methods:{
            formatPrice(value) {
                let val = (value/1).toFixed(0).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")+'đ'
            },
            get_mod_list_by_slug(){
                if (this.$route.params.list_slug !=undefined) {
                    this.url = this.url +'/'+this.$route.params.list_slug
                    axios.get('/apiget_mod_info_by_slug/'+this.$route.params.mod_slug+'/'+this.$route.params.list_slug).then(response => {
                        this.modpro = response.data.mod_info;    
                        this.listpro = response.data.list_info; 
                      }).catch(error=>{
                       console.log('error');
                    });
                }else {
                    axios.get('/apiget_mod_info_by_slug/'+this.$route.params.mod_slug+'/empty').then(response => {                        
                        this.modpro = response.data.mod_info;    
                        this.listpro = response.data.list_info; 
                      }).catch(error=>{
                       console.log('error');
                    });
                }
            },
            getmodlistinfo(){
                axios.get('/apiget_mod_list_info').then(response=> {
                    this.modpro = response.data.mod;    
                    this.listpro = response.data.list; 
                });
            },
            getproduct_in_category(){
                this.loading = true;
                let $this = this;
                if (this.$route.params.list_slug !=undefined) {
                    this.url = this.url +'/'+this.$route.params.list_slug
                    axios.get('/apigetproduct_in_category/'+this.$route.params.mod_slug+'/'+this.$route.params.list_slug).then(response => {
                        this.products_in_list = response.data.data;
                        $this.makepagenation(response.data); 
                        this.loading = false;
                      }).catch(error=>{
                       console.log('error');
                    });
                }else {
                    this.loading = true;
                    axios.get('/apigetproduct_in_category/'+this.$route.params.mod_slug).then(response => {
                        this.products_in_list = response.data.data;
                        $this.makepagenation(response.data);
                        this.loading = false;
                      }).catch(error=>{
                       console.log('error');
                    });
                }                
            },
            getproduct_in_category_nopage(){
                this.loading = true;
                let $this = this;
                axios.get(this.url).then(response => {
                    this.products_in_list = response.data.data;
                    $this.makepagenation(response.data);  
                    this.loading = false; 
                  }).catch(error=>{
                   console.log('error');
                });              
            },
            makepagenation (data){
                let pagination = {
                    current_page : data.current_page,
                    last_page : data.last_page,
                    next_page : data.next_page_url,
                    prev_page : data.prev_page_url,
                    path_page : data.path,
                }
                this.pagination = pagination;
            },
            FetchPaginateData(url){
              this.url = url;
              this.getproduct_in_category_nopage();
            },
            scroll_top(){
                window.scrollTo(0,0);
            },
            add_to_cart(id){
                this.loading = true;
                axios.post('/api_post_addcart', { id_pro:id}).then(response => {
                 if (true) {
                    $('#update_cart').click();
                    this.loading = false;
                 }else {
                    console.log('an error !');
                 }      
              }).catch(error=>{
                console.log(error);
              });
            },
        }
    }

</script>
<style type="text/css" media="screen">
</style>

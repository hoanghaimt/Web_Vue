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
                <!-- Popular Posts -->
                <div class="block left-module">
                    <p class="title_block">Các bản tin khác</p>
                    <div class="block_content">
                        <!-- layered -->
                        <div class="layered">
                            <div class="layered-content">
                                <ul class="blog-list-sidebar clearfix" v-for="n in news_products">
                                    <li>
                                        <div class="post-thumb">
                                            <a href="#"><img :src="n.news_image" alt="Blog"></a>
                                        </div>
                                        <div class="post-info">
                                            <h5 class="entry_title"><router-link :to="'/tin-tuc/'+n.id+'-'+n.news_slug">{{n.news_name}}</router-link></h5>
                                            <div class="post-meta">
                                                <span class="date"><i class="fa fa-calendar"></i> {{n.created_at}}</span>
                                                <span class="comment-count">
                                                    <i class="fa fa-comment-o"></i> 3
                                                </span>
                                            </div>
                                        </div>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                        <!-- ./layered -->
                    </div>
                </div>
                <!-- ./Popular Posts -->
                <!-- Banner -->
                <div class="block left-module">
                    <div class="banner-opacity">
                        <a href="#"><img src="/assets/data/slide-left.jpg" alt="ads-banner"></a>
                    </div>
                </div>
                <!-- ./Banner -->
                <!-- tags -->
                <div class="block left-module">
                    <p class="title_block">TAGS</p>
                    <div class="block_content">
                        <div class="tags">
                            <a href="#"><span class="level1">actual</span></a>
                            <a href="#"><span class="level2">adorable</span></a>
                            <a href="#"><span class="level3">change</span></a>
                            <a href="#"><span class="level4">consider</span></a>
                            <a href="#"><span class="level3">phenomenon</span></a>
                        </div>
                    </div>
                </div>
                <!-- ./tags -->
                <!-- Banner -->
                <div class="block left-module">
                    <div class="banner-opacity">
                        <a href="#"><img src="assets/data/slide-left2.jpg" alt="ads-banner"></a>
                    </div>
                </div>
                <!-- ./Banner -->
            </div>
            <!-- ./left colunm -->
                <!-- Center colunm-->
            <div class="center_column col-xs-12 col-sm-9" id="center_column">
                <h1 class="page-heading">
                    <span class="page-heading-title2">{{products_detail.news_name}}</span>
                </h1>
                <article class="entry-detail">
                    <div class="entry-meta-data">
                        <span class="author">
                        <i class="fa fa-user"></i> 
                        by: <a href="#">Admin</a></span>
                        <span class="cat">
                            <i class="fa fa-folder-o"></i>
                            <a href="#">{{products_detail.list_name}}</a>
                        </span>
                        <span class="comment-count">
                            <i class="fa fa-comment-o"></i> 3
                        </span>
                        <span class="date"><i class="fa fa-calendar"></i> {{products_detail.created_at}}</span>
                    </div>
                    <div class="entry-photo">
                        <img :src="products_detail.news_image" alt="Blog">
                    </div>
                    <div class="content-text clearfix" v-html="products_detail.news_content" style="overflow:hidden">
                        
                    </div>
                    <div class="entry-tags">
                        <span>Tags:</span>
                        <a href="#">beauty,</a>
                        <a href="#">medicine,</a>
                        <a href="#">health</a>
                    </div>
                </article>                               
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
                axios.get('/get_mod_listnews_info').then(response=> {
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
                axios.get('/api_detail_news/'+this.$route.params.news_id+'-'+this.$route.params.news_slug).then(response => {
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

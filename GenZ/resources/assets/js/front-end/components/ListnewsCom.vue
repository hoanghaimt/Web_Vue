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
            <span class="navigation_page">Blog</span>
        </div>
        <!-- ./breadcrumb -->
        <!-- row -->
        <div class="row">
            <!-- Left colunm -->
            <div class="column col-xs-12 col-sm-3" id="left_column">
                <!-- Banner -->
                <div class="block left-module">
                    <div class="banner-opacity">
                        <a href="#"><img src="assets/data/slide-left.jpg" alt="ads-banner"></a>
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
                            <a href="#"><span class="level4">span</span></a>
                            <a href="#"><span class="level1">spanegs</span></a>
                            <a href="#"><span class="level5">spanegs</span></a>
                            <a href="#"><span class="level1">actual</span></a>
                            <a href="#"><span class="level2">adorable</span></a>
                            <a href="#"><span class="level3">change</span></a>
                            <a href="#"><span class="level4">consider</span></a>
                            <a href="#"><span class="level2">gives</span></a>
                            <a href="#"><span class="level3">change</span></a>
                            <a href="#"><span class="level2">gives</span></a>
                            <a href="#"><span class="level1">good</span></a>
                            <a href="#"><span class="level3">phenomenon</span></a>
                            <a href="#"><span class="level4">span</span></a>
                            <a href="#"><span class="level1">spanegs</span></a>
                            <a href="#"><span class="level5">spanegs</span></a>
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
                <h2 class="page-heading">
                    <span class="page-heading-title2">Danh sách tin tức</span>
                </h2>
                <div class="sortPagiBar clearfix">
                
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
                <ul class="blog-posts" v-for="news in news_list">
                    <li class="post-item">
                        <article class="entry">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="entry-thumb image-hover2">
                                        <a href="#">
                                            <img :src="news.news_image" alt="Blog">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="entry-ci">
                                        <h3 class="entry-title">
                                            <router-link :to="'/tin-tuc/'+news.id+'-'+news.news_slug">{{news.news_name}}</router-link>
                                        </h3>
                                        <div class="entry-meta-data">
                                            <span class="author">
                                            <i class="fa fa-user"></i> 
                                            by: <a href="#">Admin</a></span>
                                            <span class="cat">
                                                <i class="fa fa-folder-o"></i>
                                                <a href="#">{{news.list_name}}</a>
                                            </span>
                                            <span class="comment-count">
                                                <i class="fa fa-comment-o"></i> 3
                                            </span>
                                            <span class="date"><i class="fa fa-calendar"></i> {{news.created_at}}</span>
                                        </div>
                                        <div class="entry-excerpt">
                                           <div v-html="news.news_intro"></div>
                                        </div>
                                        <div class="entry-more">
                                            <router-link :to="'/tin-tuc/'+news.id+'-'+news.news_slug">Đọc thêm</router-link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </li>                    
                </ul>
                <div class="sortPagiBar clearfix">
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
                news_list:'',
                url:'/api_tintuc',
                pagination:[],
                mod_name:'',
                list_name:''
            }
        },
        mounted() {
            this.getproduct_in_category();
            this.scroll_top();
        },
        watch: {
            // call again the method if the route changes
            '$route'(to, from) {
                this.getproduct_in_category()
                this.scroll_top()
            }
        },
        methods:{
            formatPrice(value) {
                let val = (value/1).toFixed(0).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")+'đ'
            },
            getproduct_in_category(){
                this.loading = true;
                let $this = this;
                axios.get('/api_tintuc').then(response => {
                    this.news_list = response.data.data;
                    $this.makepagenation(response.data); 
                    this.loading = false;
                  }).catch(error=>{
                   console.log('error');
                });                
            },
            getproduct_in_category_nopage(){
                this.loading = true;
                let $this = this;
                axios.get(this.url).then(response => {
                    this.news_list = response.data.data;
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

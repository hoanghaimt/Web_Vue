<template>
  <div class="wrapper">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-12">
              <b-button type="button" variant="primary"> <router-link tag="b" to="/news/add">Thêm bản tin</a></router-link> </b-button>
              <hr>
          </div>
        <div class="col-12">
          <b-card header="<i class='fa fa-align-justify'></i> Danh sách sản phẩm">
            <table class="table table-bordered table-striped table-sm table-responsive">
              <thead>
                <tr>
                  <th class="text-center">id</th>
                  <th class="text-center">Hình ảnh</th>
                  <th class="text-center title_table">Tiêu đề bản tin</th>
                  <th class="text-center">Loại</th>
                  <th class="text-center hiden_xs">Tóm tắt</th>
                  <th class="text-center action_btn">Thao tác</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="product in products">
                  <td class="text-center">{{product.id}}</td>
                  <td class="text-center">
                    <img :src="product.news_image" class="img-responsive" alt="No images" width="50" height="50">
                  </td>
                  <td class="text-center title_table">{{product.news_name}}</td>
                  <td class="text-center">{{product.list_name}}</td>
                  <td class="hiden_xs" v-html="product.news_intro"></td>
                  <td class="text-center action_btn">                     
                      <router-link variant="primary" :to="{ name: 'UpdateNews', params: { news_id: product.id }}"><b-button type="button" variant="primary">Sửa</b-button></router-link>                   
                    <b-button variant="danger" @click="remove(product.id)">Xóa</b-button>
                  </td>
                </tr>                
              </tbody>
            </table>
            <nav>
              <ul class="pagination">
                <span>Hiển thị {{pagination.current_page}}  trong tổng {{pagination.last_page}}</span> <hr>
                <li class="page-item">
                  <button class="page-link" v-on:click="FetchPaginateData(pagination.prev_page)" :disabled="!pagination.prev_page">Trang sau</button>
                </li>
                <div v-for="item in pagination.last_page">
                  <div v-if="item == pagination.current_page">
                    <li class="page-item active">
                      <a class="page-link">{{item}}</a>
                    </li>
                  </div> 
                  <div v-else>
                    <li class="page-item">
                      <button class="page-link" v-on:click="FetchPaginateData(pagination.path_page+'?page='+item)">{{item}}</button>
                    </li>
                  </div>                 
                </div>                                
                <li class="page-item">
                  <button class="page-link" v-on:click="FetchPaginateData(pagination.next_page)" :disabled="!pagination.next_page">
                    trang tiếp
                  </button>
                </li>
              </ul>
            </nav>
          </b-card>
        </div><!--/.col-->
      </div><!--/.row-->
    </div>
  </div>
</template>

<script>
export default {
  name: 'tables',
  name: 'modals',
  data () {
    return {
      url:'/api/news',
      loading: false,
      pro_name:'',
      pro_image:'',
      pro_price:'',
      pro_sale:'',
      pro_unit:'',
      list_name:'',
      pagination:[],
      products:[],
      product:{
        id:0,
        pro_name:'',
        pro_image:'',
        pro_price:'',
        pro_sale:'',
        pro_unit:'',
        pro_unit:''
      },
      errors:{

      },
      edit_item: {

      }     
    }
  },
  mounted(){
    this.getallproduct()
  },
  methods:{    
    getallproduct(){
      this.errors = [];
      this.loading = true;
      let $this = this;
      axios.get(this.url).then(response=> {
        this.products = response.data.data
        $this.makepagenation(response.data)
        this.loading = false;
      })
    },
    updatemod_btn(id){
      this.loading = true;
      var url = '/api/news/'+id;
      axios.get(url).then(response => {
          this.edit_item = response.data;
          this.oimage = response.data.mod_icon;
          this.eimage = '';
          $("#id_name").val(response.data.mod_name);
          $("#id_number").val(response.data.mod_number);
          $("#id_type").val(response.data.mod_type);        
          $("#id_description").val(response.data.mod_description);        
          this.edit_item.mod_description = response.data.mod_description;
          this.loading = false;
          this.updatemod = true;
        });
    },

    remove(id){
        this.loading = true;
        var url = '/api/news/remove/'+id;
        axios.post(url, { }).then(response => {
            this.getallproduct();
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
      this.loading = true
      this.url = url;
      this.getallproduct();
    },
    slect_file(){
      $('#file_id').click();
    }
  }  
};
</script>
<style type="text/css" media="screen">
@media (min-width:768px) { 
    .hiden_xs{
      max-width: 450px;
    }
    .action_btn{
      width: 120px;
    }
    .title_table{
      width: 150px;
    }
  }
  
  @media (max-width:768px) { 
    .hiden_xs {
      display: none;
    }
  }  
</style>

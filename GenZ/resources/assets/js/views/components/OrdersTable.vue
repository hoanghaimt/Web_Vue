<template>
  <div class="wrapper">
    <div class="animated fadeIn">
      <div v-if="loading">
        <div class="loader"></div>
      </div>
      <div class="row">
        
        <div class="col-12">
          <b-card header="<i class='fa fa-align-justify'></i> Danh sách đơn hàng">
            <table class="table table-bordered table-striped table-sm table-responsive">
              <thead>
                <tr>
                  <th class="text-center">id</th>
                  <th class="text-center">Tên khách hàng</th>
                  <th class="text-center">Điện thoại</th>
                  <th class="text-center">Địa chỉ</th>
                  <th class="text-center">Ghi chú</th>
                  <th class="text-center">Thành tiền</th>
                  <th class="text-center">Trạng thái</th>
                  <th class="text-center">Thao tác</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="product in products">
                  <td class="text-center">{{product.id}}</td>
                  <td class="text-center">{{product.name}}</td>
                  <td class="text-center">{{product.phone}}</td>
                  <td class="text-center">{{product.address}}</td>
                  <td class="text-center">{{product.order_comment}}</td>
                  <td class="text-center">{{product.order_total}}</td>
                  <td class="text-center">
                    <div v-if="product.order_status==0"> <span class="btn btn-danger">Đã Hủy</span> </div>
                    <div v-else-if="product.order_status==1"><span class="btn btn-warning">Đã nhận</span></div>
                    <div v-else-if="product.order_status==2"><span class="btn btn-info">Đang xử lý</span></div>
                    <div v-else><span class="btn btn-success">Đã hoàn thành</span></div>
                  </td>                                    
                  <td class="text-center">                     
                      <router-link variant="primary" :to="{ name: 'editorder', params: { o_id: product.id }}"><b-button type="button" variant="primary">Chi tiết</b-button></router-link>                    
                    <b-button variant="danger" @click="Print(product.id)">In</b-button>
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
        url:'/api/order',
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
        var url = '/api/products/'+id;
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
          var url = '/api/products/remove/'+id;
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
    body {
      background: #ececec;
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
<template>
  <div class="animated wrapper">
    <div v-if="loading">
      <div class="loader"></div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <b-card>
          <div slot="header">
            <i class="fa fa-edit"></i> Sửa đơn hàng
          </div>
          <div class="row">
            <div class="col-3">
              <b-form-fieldset label="Tên khách hàng" description="Tên khách hàng">
                <b-input-group>
                  <b-form-input type="text" id="add_name" v-model="name" :required="true"></b-form-input>
                </b-input-group>
                <span class="error_msg" v-if="errors.name">{{errors.name[0]}}</span>
              </b-form-fieldset>              
            </div>
            <div class="col-3">
              <b-form-fieldset label="Địa chỉ khách" description="Nhập địa chỉ khách">
                <b-input-group>
                  <b-form-input type="text" id="add_address" v-model="address"></b-form-input>
                </b-input-group>
              </b-form-fieldset> 
            </div>
            <div class="col-3">
              <b-form-fieldset label="Điện thoại" description="Điện thoại khách hàng">
                <b-input-group>
                  <b-form-input type="text" id="add_phone" v-model="phone" :required="true"></b-form-input>
                </b-input-group>
                <span class="error_msg" v-if="errors.phone">{{errors.phone[0]}}</span>
              </b-form-fieldset>
            </div>
            <div class="col-3">
              <b-form-fieldset label="Địa chỉ Email" description="Địa chỉ Email">
                <b-input-group>
                  <b-form-input type="text" id="add_email" v-model="email"></b-form-input>
                </b-input-group>
                <span class="error_msg" v-if="errors.email">{{errors.email[0]}}</span>
              </b-form-fieldset>
            </div>
          </div>
          <div class="row">
            <div class="col-4">
              <b-form-fieldset label="Tên khách nhận hàng" description="Tên khách nhận hàng">
                <b-input-group>
                  <b-form-input type="text" id="add_name_ship" v-model="name_ship" :required="true"></b-form-input>
                </b-input-group>
              </b-form-fieldset>              
            </div>
            <div class="col-4">
              <b-form-fieldset label="Địa chỉ khách" description="Nhập địa chỉ khách">
                <b-input-group>
                  <b-form-input type="text" id="add_address_ship" v-model="address_ship"></b-form-input>
                </b-input-group>
              </b-form-fieldset> 
            </div>
            <div class="col-4">
              <b-form-fieldset label="Điện thoại" description="Điện thoại khách hàng">
                <b-input-group>
                  <b-form-input type="text" id="add_phone_ship" v-model="phone_ship" :required="true"></b-form-input>
                </b-input-group>
              </b-form-fieldset>
            </div>
          </div>
          <div class="row">
            <div class="col-3">
              <b-form-fieldset label="Tiền hàng" description="Tiền hàng">
                <b-input-group>
                  <b-form-input type="text" id="add_total" readonly class="text-success" v-model="order_total" :required="true"></b-form-input>
                </b-input-group>
              </b-form-fieldset>
            </div>
            <div class="col-3">
              <b-form-fieldset label="Tiền ship và thuế" description="Tiền ship và thuế">
                <b-input-group>
                  <b-form-input type="text" id="add_ship_tax" readonly class="text-warning" v-model="order_ship_tax" :required="true"></b-form-input>
                </b-input-group>
              </b-form-fieldset>
            </div>
            <div class="col-3">
              <b-form-fieldset label="Thành tiền" description="Thành tiền">
                <b-input-group>
                  <b-form-input type="text" id="add_order_totalpay" class="text-danger" readonly v-model="order_totalpay"></b-form-input>
                </b-input-group>
              </b-form-fieldset>
            </div>
            <div class="col-3">
              <b-form-fieldset label="Đơn vị" description="Đơn vị">
                <b-input-group>
                  <b-form-input type="text" id="add_pay_unit" readonly v-model="pay_unit"></b-form-input>
                </b-input-group>
              </b-form-fieldset>
            </div>
            <div class="col-12">
              <b-card header="<i class='fa fa-align-justify'></i> chi tiết sản phẩm trong đơn hàng">  
              <div class="row">
                <div class="col-6">
                  <div v-if="order_status ==0">
                    <b-button type="button" disabled variant="success" @click="addnewpro_show()"> Thêm sản phẩm</b-button>
                  </div>
                  <div v-else-if="order_status ==3">
                    <b-button type="button" disabled variant="success" @click="addnewpro_show()"> Thêm sản phẩm</b-button>
                  </div>
                  <div v-else>
                    <b-button type="button" variant="success" @click="addnewpro_show()"> Thêm sản phẩm</b-button>
                  </div>                   
                </div>
              </div>    
              <hr>        
                <table class="table table-bordered table-striped table-sm table-responsive">
                  <thead>
                    <tr>
                      <th class="text-center">id</th>
                      <th class="text-center">Hình ảnh</th>
                      <th class="text-center">Tên SP</th>
                      <th class="text-center">Loại</th>
                      <th class="text-center">Giá bán</th>
                      <th class="text-center">SL</th>
                      <th class="text-center">Đơn vị</th>
                      <th class="text-center">Thao tác</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="product in products">
                      <td class="text-center">{{product.id}}</td>
                      <td class="text-center">
                        <img :src="product.pro_image" class="img-responsive" alt="hvietdev.com" width="50" height="50">
                      </td>
                      <td class="text-center">{{product.pro_name}}</td>
                      <td class="text-center">{{product.list_name}}</td>
                      <td class="text-center">{{product.pro_price}}</td>
                      <td class="text-center">{{product.order_pro_qty}}</td>
                      <td class="text-center">{{product.pro_unit}}</td>
                      <td class="text-center">                          
                        <b-button variant="danger" @click="pro_remove(product.id)">Xóa</b-button>
                      </td>
                    </tr>                
                  </tbody>
                </table>                
              </b-card>
            </div><!--/.col-->
          </div>
          <div class="form-actions">
            <div v-if="order_status ==0"><b-button type="button" class="pull-right" variant="primary" @click="back_pro()"> Quay lại</b-button></div>
            <div v-else-if="order_status ==3"><b-button type="button" class="pull-right" variant="primary" @click="back_pro()"> Quay lại</b-button></div>
            <div v-else>
              <b-button type="button" variant="warning" @click="postupdateorder(2)" >Đang xử lý</b-button>
              <b-button type="button" variant="success" @click="postupdateorder(3)" >Hoàn thành</b-button>
              <b-button type="button" variant="danger" @click="postupdateorder(0)" >Hủy đơn hàng</b-button>
              <b-button type="button" class="pull-right" variant="primary" @click="back_pro()"> Quay lại</b-button>
            </div>            
          </div>
        </b-card>
      </div><!--/.col-->
    </div><!--/.row-->  
    <!-- created new modal  -->
    <b-modal size="lg" title="Thêm sản phẩm" v-model="addnewpro">
      <div class="row">        
          <div class="col-12">  
            <div class="row">
              <div class="col-6">
                <b-form-fieldset label="Danh mục" description="Chọn danh mục">
                  <b-input-group>
                    <select class="form-control" id="add_id_mod" v-on:change="onChange(id_mod)" v-model="id_mod">
                      <option disabled value="">-Chọn danh mục cha-</option>
                      <option 
                       v-for="modproduct in modproducts" 
                       v-bind:value="modproduct.id" @click="getlistbymod(modproduct.id)"
                      >-{{ modproduct.mod_name }}</option>
                    </select>
                  </b-input-group>
                </b-form-fieldset>
              </div>
              <div class="col-6">
                 <b-form-fieldset label="Loại danh mục" description="Chọn loại danh mục">
                  <b-input-group>
                    <select class="form-control" id="add_id_list" v-on:change="getpro_list(id_list)" :required="true" v-model="id_list">
                      <option disabled value="">Chọn loại danh mục</option>
                    </select>
                  </b-input-group>
                  <span class="error_msg" v-if="errors.list_id">{{errors.list_id[0]}}</span>
                </b-form-fieldset>
              </div>
            </div> 
          </div><!--/.col-->
          <div class="col-12">
            <b-card header="<i class='fa fa-align-justify'></i> Danh sách sản phẩm">
              <table class="table table-bordered table-striped table-sm table-responsive">
                <thead>
                  <tr>
                    <th class="text-center">id</th>
                    <th class="text-center">Hình ảnh</th>
                    <th class="text-center">Tên SP</th>
                    <th class="text-center">Giá bán</th>
                    <th class="text-center">Giá sale</th>
                    <th class="text-center">Đơn vị</th>
                    <th class="text-center">SL</th>
                    <th class="text-center">Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="pro in pro_lists">
                    <td class="text-center">{{pro.id}}</td>
                    <td class="text-center">
                      <img :src="pro.pro_image" class="img-responsive" alt="no image" width="50" height="50">
                    </td>
                    <td class="text-center">{{pro.pro_name}}</td>
                    <td class="text-center">{{pro.pro_price}}</td>
                    <td class="text-center">{{pro.pro_sale}}</td>
                    <td class="text-center">{{pro.pro_unit}}</td>
                    <td class="text-center" style="width:50px;">
                      <b-form-input type="text" id="add_qty" class="text-danger" value="1" v-model="pro_qty"></b-form-input>
                    </td>
                    <td class="text-center">
                      <b-button variant="danger" @click="add_pro(pro.id)">Thêm</b-button>
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
    </b-modal>  
  </div>
</template>
<script>
import VueCkeditor from 'vue-ckeditor2';
export default {
  components: { VueCkeditor },
  name: 'tables',
  name: 'modals',
  name: 'forms',
  data () {
    return {
      config: {
        Default: {}
      },
     addnewpro: false,
      url:'/api/order',
      loading: false,
      image: '',
      eimage: '',
      oimage: '',
      id_mod:'',
      id_list:'',
      name:'',
      address:'',
      phone:'',
      email:'',
      name_ship:'',
      pro_qty:'1',
      address_ship:'',
      phone_ship:'',
      order_totalpay:'',
      order_total:'',
      order_status:'',
      order_ship_tax:'',
      pro_unit:'VND',
      pay_unit:'VND',
      products:[],
      pagination:[],
      modproducts:[],
      listproducts:[],
      pro_lists:[],
      edit_product:[],
      errors:{
      }     
    }
  },
  mounted(){
    this.getorder_detail();
    this.getlistproduct();
  },
  methods:{    
    getorder_detail(){
      this.loading = true;
      axios.get(this.url+'/edit/'+this.$route.params.o_id).then(response=> {      
        this.name = response.data.name;
        this.address = response.data.address;
        this.phone = response.data.phone;
        this.email = response.data.email;
        this.name_ship = response.data.shipping_name;
        this.address_ship = response.data.shipping_address;
        this.phone_ship = response.data.shipping_phone;
        this.order_totalpay = response.data.order_totalpay;
        this.pro_sale = response.data.pro_sale;
        this.order_total = response.data.order_total;
        this.pro_specs = response.data.pro_specs;
        this.pro_content = response.data.pro_content;
        this.order_status = response.data.order_status;
        this.order_ship_tax = response.data.ship_fee;
      });
      this.loading = false;
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
      this.getallmod();
    },
    addnewpro_show(){
      this.loading = true;
      axios.get(this.url+'/getmodlist').then(res=>{
        this.modproducts = res.data;
      });
      this.loading = false;
      this.addnewpro = true;
    },
    getlistproduct(){
      this.errors = [];
      this.loading = true;
      let $this = this;
      axios.get(this.url+'/getproductlist/'+this.$route.params.o_id).then(res=>{
        this.products = res.data;
        $this.makepagenation(res.data);
        this.loading = false;
      });
    },
    postupdateorder(stt){
      this.loading = true;
      let id = this.$route.params.o_id;
      axios.post('/api/order/update', { id:id, status:stt}).then(response => {   
      this.loading = false;     
        this.$router.push({ name: 'OrdersList'});
      }).catch(error=>{
        if (error.response.status == 422) {
          this.errors = error.response.data.errors; 
        }
      });      
    },
    add_pro(id){      
      let qty = this.pro_qty;
      let o_id = this.$route.params.o_id;
      console.log(id+' qty:'+qty);
      axios.post('/api/order/addpro_to_order', { id_pro:id,qty_pro:qty,o_id:o_id}).then(response => {
        this.getorder_detail();
        this.getlistproduct();
        console.log(response.data);
      }).catch(error=>{
        if (error.response.status == 422) {
          this.errors = error.response.data.errors; 
        }
      });
    },
    back_pro(){
      this.$router.push({ name: 'OrdersList'});
    },
    onChange(id_mod){
      this.loading = true;
      var id_url = '/api/products/getlistinmod/'+id_mod;
      axios.get(id_url).then(response => {
          $('#add_id_list').html(response.data);
        });
      this.loading = false;
    },
    getpro_list(list_id){
      this.loading = true;
      var id_url = '/api/order/getpro_inlist/'+list_id;
      axios.get(id_url).then(response => {
        this.pro_lists = response.data.data;        
      });
      this.loading = false;
    },
    pro_remove(id){
      this.loading = true;
      axios.post('/api/order/pro_remove/'+id, { }).then(response => {
        this.getlistproduct();
        this.getorder_detail();
      }).catch(error=>{
        console.log('Error');
      });
      this.loading = false;
    }
  }  
};
</script>

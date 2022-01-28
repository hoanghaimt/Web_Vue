<template>
  <div class="animated fadeIn">
    <div v-if="loading">
      <div class="loader"></div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <b-card>
          <div slot="header">
            <i class="fa fa-edit"></i> Thêm mới sản phẩm
          </div>
          <div class="row">
            <div class="col-9">
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
                      <select class="form-control" id="add_id_list" :required="true" v-model="id_list">
                        <option disabled value="">Chọn loại danh mục</option>
                      </select>
                    </b-input-group>
                    <span class="error_msg" v-if="errors.list_id">{{errors.list_id[0]}}</span>
                  </b-form-fieldset>
                </div>
              </div>
              <b-form-fieldset label="Tên sản phẩm" description="Nhập tên sản phẩm">
                <b-input-group>
                  <b-form-input type="text" id="add_name" v-model="pro_name" :required="true"></b-form-input>
                </b-input-group>
                <span class="error_msg" v-if="errors.name">{{errors.name[0]}}</span>
              </b-form-fieldset>
              <b-form-fieldset label="Video giới thiệu" description="Nhập link video youtube">
                <b-input-group>
                  <b-form-input type="text" id="add_video" v-model="pro_video"></b-form-input>
                </b-input-group>
              </b-form-fieldset>
              <div class="row">
                <div class="col-4">
                  <b-form-fieldset label="Giá bán" description="Nhập giá bán">
                    <b-input-group>
                      <b-form-input type="number" id="add_price" v-model="pro_price" :required="true"></b-form-input>
                    </b-input-group>
                    <span class="error_msg" v-if="errors.price">{{errors.price[0]}}</span>
                  </b-form-fieldset>
                </div>
                <div class="col-4">
                  <b-form-fieldset label="Giá sale" description="Nhập giá sale">
                    <b-input-group>
                      <b-form-input type="number" id="add_sale" v-model="pro_sale"></b-form-input>
                    </b-input-group>
                    <span class="error_msg" v-if="errors.sale">{{errors.sale[0]}}</span>
                  </b-form-fieldset>
                </div>
                <div class="col-4">
                  <b-form-fieldset label="Đơn vị" description="Nhập đơn vị">
                    <b-input-group>
                      <b-form-input type="text" id="add_unit" v-model="pro_unit" :required="true"></b-form-input>
                    </b-input-group>
                    <span class="error_msg" v-if="errors.unit">{{errors.unit[0]}}</span>
                  </b-form-fieldset>
                </div>
              </div>
            </div>
            <div class="col-3">
              <b-form-fieldset label="Hình ảnh cũ">
                <div>
                    <img :src="pro_image" class="img-responsive text-center text-justify" height="140" width="140">
                    <input type="file" id="file_id" accept="image/*"  v-on:change="onImageChange" hidden class="form-control">
                </div>
              </b-form-fieldset>
              <b-form-fieldset label="Click chọn ảnh mới">
                <div v-if="image">
                    <img :src="image" class="img-responsive text-center" height="140" width="140">
                 </div>
                <div>
                    <img src="/images/noimg.jpg" id="img_id" @click="slect_file()" class="img-responsive text-center text-justify" height="140" width="140">
                    <input type="file" id="file_id" accept="image/*"  v-on:change="onImageChange" hidden class="form-control">
                </div>
              </b-form-fieldset>              
            </div>
            <div class="col-12">
              <b-form-fieldset label="Tóm tắt thông tin sản phẩm" :horizontal="false">
                <vue-ckeditor v-model="pro_intro" :required="true" id="add_intro" name="pro_intro" :config="config" />
                <br><span class="error_msg" v-if="errors.intro">{{errors.intro[0]}}</span>
              </b-form-fieldset>
            </div>
            <div class="col-12">
              <b-form-fieldset label="Thông tin sản phẩm" :horizontal="false">
                <vue-ckeditor v-model="pro_content" :required="true" id="add_content" name="pro_content" :config="config" />
                <br><span class="error_msg" v-if="errors.content">{{errors.content[0]}}</span>
              </b-form-fieldset>
            </div>
            <div class="col-12">
              <b-form-fieldset label="Chi tiết sản phẩm" :horizontal="false">
                <vue-ckeditor v-model="pro_specs" :required="true" id="add_specs" name="pro_specs" :config="config" />
                <br><span class="error_msg" v-if="errors.specs">{{errors.specs[0]}}</span>
              </b-form-fieldset>
            </div>
          </div>
          <div class="form-actions">
            <b-button type="button" variant="success" @click="postupdateproduct()" >Lưu sản phẩm </b-button>
            <b-button type="button" variant="warning" @click="back_pro()"> 
              Quay lại
            </b-button>
          </div>
        </b-card>
      </div><!--/.col-->
    </div><!--/.row-->
  </div>
</template>
<script>
import VueCkeditor from 'vue-ckeditor2';
export default {
  // props: ['pro_id'],
  components: { VueCkeditor },
  name: 'tables',
  name: 'modals',
  name: 'forms',
  data () {
    return {
      config: {
        Default: {}
      },
      url:'/api/products',
      loading: false,
      image: '',
      eimage: '',
      oimage: '',
      id_mod:'',
      id_list:'',
      pro_name:'',
      pro_video:'',
      pro_image:'',
      pro_price:'',
      pro_sale:'',
      pro_unit:'',
      pro_content:'',
      pro_intro:'',
      pro_specs:'',
      modproducts:[],
      listproducts:[],
      edit_product:[],
      errors:{
      }     
    }
  },
  mounted(){
    axios.get(this.url+'/getmod').then(response=> {
        let $this = this;
        this.modproducts = response.data;
        this.loading = false;
      });
    axios.get(this.url+'/edit/'+this.$route.params.pro_id).then(response=> {
      var id_url = '/api/products/renderlistselect/'+response.data.list_id;
      axios.get(id_url).then(response => {
          $('#add_id_list').html(response.data);
        });
      this.pro_name = response.data.pro_name;
      this.pro_video = response.data.pro_video;
      this.pro_image = response.data.pro_image;
      this.pro_price = response.data.pro_price;
      this.pro_sale = response.data.pro_sale;
      this.pro_unit = response.data.pro_unit;
      this.pro_intro = response.data.pro_intro;
      this.pro_specs = response.data.pro_specs;
      this.pro_content = response.data.pro_content;
    });
    
  },
  methods:{    
    onImageChange(e) {
        let files = e.target.files || e.dataTransfer.files;
        if (!files.length)
            return;
        this.createImage(files[0],'add');
    },
    eonImageChange(e,type) {
        let files = e.target.files || e.dataTransfer.files;
        if (!files.length)
            return;
        this.createImage(files[0],'edit');
    },
    createImage(file,type) {
        let reader = new FileReader();
        let vm = this;
        reader.onload = (e) => {
          if (type=='add') {
            vm.image = e.target.result;
          } else {
            vm.eimage = e.target.result;
          }
        };
        reader.readAsDataURL(file);
        $('#img_id').css('display', 'none');
    },
    postupdateproduct(){
      let id = this.$route.params.pro_id;
      axios.post('/api/products/'+id, { name:this.pro_name,video:this.pro_video,list_id:this.id_list,price:this.pro_price,sale:this.pro_sale,image:this.image,unit:this.pro_unit,intro:this.pro_intro,content:this.pro_content,specs:this.pro_specs }).then(response => {
        
        this.$router.push({ name: 'Listproducts'});
      }).catch(error=>{
        if (error.response.status == 422) {
          this.errors = error.response.data.errors; 
        }
      });      
    },
    back_pro(){
      this.$router.push({ name: 'Listproducts'});
    },
    slect_file(){
      $('#file_id').click();
    },
    onChange(id_mod){
      var id_url = '/api/products/getlistinmod/'+id_mod;
      axios.get(id_url).then(response => {
          $('#add_id_list').html(response.data);
        });
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
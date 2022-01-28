<template>
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-lg-12">
        <b-card>
          <div slot="header">
            <i class="fa fa-edit"></i> Tạo đơn hàng mới 
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
              <b-form-fieldset label="Hình ảnh sản phẩm">
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
                <vue-ckeditor v-model="pro_intro" :required="true" id="add_intro" name="pro_intro" :config="config" @blur="onBlur($event)" @focus="onFocus($event)" />
                <br><span class="error_msg" v-if="errors.intro">{{errors.intro[0]}}</span>
              </b-form-fieldset>
            </div>
            <div class="col-12">
              <b-form-fieldset label="Thông tin sản phẩm" :horizontal="false">
                <vue-ckeditor v-model="pro_content" :required="true" id="add_content" name="pro_content" :config="config" @blur="onBlur($event)" @focus="onFocus($event)" />
                <br><span class="error_msg" v-if="errors.content">{{errors.content[0]}}</span>
              </b-form-fieldset>
            </div>
            <div class="col-12">
              <b-form-fieldset label="Chi tiết sản phẩm" :horizontal="false">
                <vue-ckeditor v-model="pro_specs" :required="true" id="add_specs" name="pro_specs" :config="config" @blur="onBlur($event)" @focus="onFocus($event)" />
                <br><span class="error_msg" v-if="errors.specs">{{errors.specs[0]}}</span>
              </b-form-fieldset>
            </div>
          </div>
          <div class="form-actions">
            <b-button type="button" variant="success" @click="postnewproduct()" >Lưu sản phẩm </b-button>
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
      pro_price:'',
      pro_sale:'',
      pro_unit:'',
      pro_content:'',
      pro_intro:'',
      pro_specs:'',
      addnewmod: false,
      updatemod: false,
      pagination:[],
      modproducts:[],
      listproducts:[],
      errors:{

      }     
    }
  },
  mounted(){
    axios.get(this.url+'/getmod').then(response=> {
        let $this = this;
        this.modproducts = response.data
        $this.makepagenation(response.data)
        this.loading = false;
        this.addnewmod = true;
      });
  },
  methods:{    
    onBlur(editor) {
      // console.log(editor);
    },
    onFocus(editor) {
      // console.log(editor);
    },
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
    getallmod(){
      this.errors = [];
      this.loading = true;
      let $this = this;
      axios.get(this.url).then(response=> {
        this.modproducts = response.data.data
        $this.makepagenation(response.data)
        this.loading = false;
      })
    },
    postnewproduct(){
      axios.post('/api/products', { name:this.pro_name,video:this.pro_video,list_id:this.id_list,price:this.pro_price,sale:this.pro_sale,image:this.image,unit:this.pro_unit,intro:this.pro_intro,content:this.pro_content,specs:this.pro_specs }).then(response => {
        
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
    updatemod_btn(id){
      this.loading = true;
      var url = '/api/modproducts/'+id;
      axios.get(url).then(response => {
          this.edit_item = response.data;
          this.oimage = response.data.mod_icon;
          this.eimage = '';
          $("#id_name").val(response.data.mod_name);
          $("#id_number").val(response.data.mod_number);
          $("#id_type").val(response.data.mod_type);        
          this.edit_item.mod_description = response.data.mod_description;
          this.loading = false;
          this.updatemod = true;
        });
    },
    updatenewmod(id){
      this.loading = true;
      var url = '/api/modproducts/'+id;
      axios.post(url, { name:this.edit_item.mod_name,number:this.edit_item.mod_number,type:this.edit_item.mod_type,description:this.edit_item.mod_description,image:this.eimage }).then(response => {
          $("#id_name").val('');
          $("#id_number").val('');
          $("#id_type").val('');
          $("#id_icon").val('');
          $("#id_description").val('');
          this.getallmod();
      }).catch(error=>{
        if (error.response.status == 422) {
          this.errors = error.response.data.errors; 
          this.loading = false;
          this.updatemod = true;
        }
      });
    },
    remove(id){
      const options = {title: 'Xác nhận?', cancelLabel: 'Không', size: 'sm'}
      this.$dialogs.confirm('Bạn có chắc xóa danh mục này !', options)
      .then(res => {
        if (res.ok) {
          this.loading = true;
          var url = '/api/modproducts/remove/'+id;
          axios.post(url, { }).then(response => {
              this.getallmod();
          });
        } 
      })      
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

<template>
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-lg-12">
        <b-card>
          <div slot="header">
            <i class="fa fa-edit"></i> Thêm mới bản tin
          </div>
          <div class="row">
            <div class="col-9">
              <div class="row">
                <div class="col-6">
                  <b-form-fieldset label="Danh mục tin" description="Chọn danh mục">
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
                   <b-form-fieldset label="Loại danh mục tin" description="Chọn loại danh mục">
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
                  <b-form-input type="text" id="add_name" v-model="news_name" :required="true"></b-form-input>
                </b-input-group>
                <span class="error_msg" v-if="errors.name">{{errors.name[0]}}</span>
              </b-form-fieldset>
              <b-form-fieldset label="Video" description="Nhập link video youtube">
                <b-input-group>
                  <b-form-input type="text" id="add_video" v-model="news_video"></b-form-input>
                </b-input-group>
              </b-form-fieldset>
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
              <b-form-fieldset label="Tóm tắt bản tin" :horizontal="false">
                <vue-ckeditor v-model="news_intro" :required="true" id="add_intro" name="news_intro" :config="config" @blur="onBlur($event)" @focus="onFocus($event)" />
                <br><span class="error_msg" v-if="errors.intro">{{errors.intro[0]}}</span>
              </b-form-fieldset>
            </div>
            <div class="col-12">
              <b-form-fieldset label="Nội dung bản tin" :horizontal="false">
                <vue-ckeditor v-model="news_content" :required="true" id="add_content" name="news_content" :config="config" @blur="onBlur($event)" @focus="onFocus($event)" />
                <br><span class="error_msg" v-if="errors.content">{{errors.content[0]}}</span>
              </b-form-fieldset>
            </div>
            <div class="col-12">
              <div class="row">
                <div class="col-6">
                  <b-form-fieldset label="Từ khóa" description="Nhập từ khóa cho bản tin">
                    <b-input-group>
                      <b-form-input type="text" id="add_keywords" v-model="news_keywords" :required="true"></b-form-input>
                    </b-input-group>
                    <span class="error_msg" v-if="errors.keywords">{{errors.keywords[0]}}</span>
                  </b-form-fieldset>
                </div>
                <div class="col-6">
                  <b-form-fieldset label="Tags" description="Nhập tags bản tin">
                    <b-input-group>
                      <b-form-input type="text" id="add_tags" v-model="news_tags"></b-form-input>
                    </b-input-group>
                    <span class="error_msg" v-if="errors.tags">{{errors.tags[0]}}</span>
                  </b-form-fieldset>
                </div>
              </div>
            </div>
          </div>
          <div class="form-actions">
            <b-button type="button" variant="success" @click="postnews()" >Lưu bản tin </b-button>
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
      url:'/api/news',
      loading: false,
      image: '',
      eimage: '',
      oimage: '',
      id_mod:'',
      id_list:'',
      news_name:'',
      news_video:'',
      news_keywords:'',
      news_tags:'',
      news_content:'',
      news_intro:'',     
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
        this.loading = false;
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
    postnews(){
      axios.post('/api/news', { name:this.news_name,video:this.news_video,list_id:this.id_list,keywords:this.news_keywords,tags:this.news_tags,image:this.image,intro:this.news_intro,content:this.news_content }).then(response => {        
        this.$router.push({ name: 'ListNews'});
      }).catch(error=>{
        if (error.response.status == 422) {
          this.errors = error.response.data.errors; 
        }
      });      
    },
    back_pro(){
      this.$router.push({ name: 'ListNews'});
    },
    slect_file(){
      $('#file_id').click();
    },
    onChange(id_mod){
      var id_url = '/api/news/getlistinmod/'+id_mod;
      axios.get(id_url).then(response => {
          $('#add_id_list').html(response.data);
        });
    }
  }  
};
</script>

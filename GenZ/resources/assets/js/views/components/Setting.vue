<template>
  <div class="animated fadeIn">
    <div v-if="loading">
      <div class="loader"></div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <b-card>
          <div slot="header">
            <i class="fa fa-edit"></i> Thông tin công ty
          </div>
          <div class="row">
            <div class="col-12">
              <b-form-fieldset label="Link Gmap" description="Link gmap">
                <b-input-group left="A-z">
                  <b-form-input type="text" id="id_map" v-model="map"></b-form-input>
                </b-input-group>
              </b-form-fieldset>
            </div>
            <div class="col-12">
              <b-form-fieldset label="nameco" description="Tên công ty">
                <b-input-group left="A-z">
                  <b-form-input type="text" id="id_nameco" v-model="nameco"></b-form-input>
                </b-input-group>
                <span class="error_msg" v-if="errors.nameco">{{errors.nameco[0]}}</span>
              </b-form-fieldset>
            </div>
            <div class="col-12">
              <b-form-fieldset label="address" description="address">
                <b-input-group left="A-z">
                  <b-form-input type="text" id="id_address" v-model="address"></b-form-input>
                </b-input-group>
              </b-form-fieldset>
            </div>
            <div class="col-12">
              <b-form-fieldset label="phone" description="phone">
                <b-input-group left="A-z">
                  <b-form-input type="text" id="id_phone  " v-model="phone  "></b-form-input>
                </b-input-group>
                <span class="error_msg" v-if="errors.phone  ">{{errors.phone  [0]}}</span>
              </b-form-fieldset>
            </div>
            <div class="col-12">
              <b-form-fieldset label="mail" description="mail">
                <b-input-group left="A-z">
                  <b-form-input type="text" id="id_mail" v-model="mail"></b-form-input>
                </b-input-group>
                <span class="error_msg" v-if="errors.mail">{{errors.mail[0]}}</span>
              </b-form-fieldset>
            </div>
            <div class="col-6">
              <b-form-fieldset label="Logo hiện tại">
                  <div class="col-3" >
                      <img :src="logo_old" class="img-responsive" height="70"">
                   </div>                  
              </b-form-fieldset>
            </div>
            <div class="col-6">
              <b-form-fieldset label="Click chọn Logo mới">
                  <div class="col-3" v-if="image">
                      <img :src="image" class="img-responsive" height="70">
                   </div>
                  <div class="col-9">
                      <img src="/images/noimg.jpg" id="img_id" @click="slect_file()" class="img-responsive" height="70" width="90">
                      <input type="file" id="file_id" accept="image/*"  v-on:change="onImageChange" hidden class="form-control">
                  </div>
              </b-form-fieldset>
            </div>
            <div class="col-12">
              <b-form-fieldset label="slogan" description="slogan">
                <b-input-group left="A-z">
                  <b-form-input type="text" id="idslogan" v-model="slogan"></b-form-input>
                </b-input-group>
              </b-form-fieldset>
            </div>
            <div class="col-12">
              <b-form-fieldset label="fanpage" description="fanpage">
                <b-input-group left="A-z">
                  <b-form-input type="text" id="id_fanpagep" v-model="fanpage"></b-form-input>
                </b-input-group>
              </b-form-fieldset>
            </div>
            <div class="col-12">
              <b-form-fieldset label="seo_title" description="seo_title">
                <b-input-group left="A-z">
                  <b-form-input type="text" id="id_seo_title" v-model="seo_title"></b-form-input>
                </b-input-group>
              </b-form-fieldset>
            </div>
            <div class="col-12">
              <b-form-fieldset label="seo_keyword" description="seo_keyword">
                <b-input-group left="A-z">
                  <b-form-input type="text" id="id_seo_keyword" v-model="seo_keyword"></b-form-input>
                </b-input-group>
              </b-form-fieldset>
            </div>
            <div class="col-12">
              <b-form-fieldset label="seo_description" description="seo_description">
                <b-input-group left="A-z">
                  <b-form-input type="text" id="id_seo_description" v-model="seo_description"></b-form-input>
                </b-input-group>
              </b-form-fieldset>
            </div>
            <div class="col-12">
              <b-form-fieldset label="fb_app_id" description="fb_app_id">
                <b-input-group left="A-z">
                  <b-form-input type="text" id="id_fb_app_id" v-model="fb_app_id"></b-form-input>
                </b-input-group>
              </b-form-fieldset>
            </div>
            <div class="col-12">
              <b-form-fieldset label="google_analyst" description="google_analyst">
                <b-input-group left="A-z">
                  <b-form-input type="text" id="id_google_analyst" v-model="google_analyst"></b-form-input>
                </b-input-group>
              </b-form-fieldset>
            </div>            
          </div>
          <div class="form-actions">
            <b-button type="button" variant="success" @click="submit_change()" >Lưu Lại </b-button>
          </div>
        </b-card>
      </div><!--/.col-->
    </div><!--/.row-->
  </div>
</template>
<script>
export default {
  name: 'tables',
  name: 'modals',
  name: 'forms',
  data () {
    return {
      config: {
        Default: {}
      },
      url:'/api/settings',
      loading: false,
      map:'',
      nameco:'',
      address:'',
      phone:'',
      image:'',
      logo_old:'',
      slogan:'',
      fanpage:'',
      seo_title:'',
      seo_keyword:'',
      seo_description:'',
      fb_app_id:'',
      google_analyst:'',
      mail:'',
      errors:{
      }     
    }
  },
  mounted(){
   this.get_setting_info();    
  },
  methods:{  
    onImageChange(e) {
        let files = e.target.files || e.dataTransfer.files;
        if (!files.length)
            return;
        this.createImage(files[0],'add');
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
    get_setting_info(){
      axios.get('/api/settings').then(response=> {
        this.map = response.data.map;
        this.nameco = response.data.nameco;
        this.address = response.data.address;
        this.phone = response.data.phone;
        this.logo_old = response.data.logo;
        this.slogan = response.data.slogan;
        this.fanpage = response.data.fanpage;
        this.seo_title = response.data.seo_title;
        this.seo_keyword = response.data.seo_keyword;
        this.seo_description = response.data.seo_description;
        this.fb_app_id = response.data.fb_app_id;
        this.google_analyst = response.data.google_analyst;
        this.mail = response.data.mail;
      });
    },
    submit_change(){
      axios.post('/api/settings/save', {
          map:this.map,
          mail:this.mail,
          nameco:this.nameco,
          address:this.address,
          phone:this.phone,
          logo:this.image,
          slogan:this.slogan,
          fanpage:this.fanpage,
          seo_title:this.seo_title,
          seo_keyword:this.seo_keyword,
          seo_description:this.seo_description,
          fb_app_id:this.fb_app_id,
          google_analyst:this.google_analyst
        }).then(response => { 
          location.reload(); 
      }).catch(error=>{
        if (error.response.status == 422) {
         console.log(error.response.data.errors);
        }
      });
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
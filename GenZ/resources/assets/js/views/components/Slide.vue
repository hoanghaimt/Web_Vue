<template>
  <div class="animated fadeIn">
    <div v-if="loading">
      <div class="loader"></div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <b-card>
          <div slot="header">
            <i class="fa fa-edit"></i> Đổi mật khẩu
          </div>
          <div class="row">
            <div class="col-12">
              <b-form-fieldset label="Email" description="Email tài khoản">
                <b-input-group left="A-z">
                  <b-form-input type="email" readonly id="id_email" v-model="email"></b-form-input>
                </b-input-group>
                <span class="error_msg" v-if="errors.email">{{errors.email[0]}}</span>
              </b-form-fieldset>
            </div>
            <div class="col-12">
              <b-form-fieldset label="Mật khẩu mới" description="Tối thiểu 6 ký tự">
                <b-input-group left="A-z">
                  <b-form-input type="password" id="id_newpass" v-model="newpass"></b-form-input>
                </b-input-group>
                <span class="error_msg" v-if="errors.newpass">{{errors.newpass[0]}}</span>
              </b-form-fieldset>
            </div>
            <div class="col-12">
              <b-form-fieldset label="Nhập lại mật khẩu mới" description="Giống mật khẩu ở trên">
                <b-input-group left="A-z">
                  <b-form-input type="password" id="id_renewpass" v-model="renewpass"></b-form-input>
                </b-input-group>
                <span class="error_msg" v-if="errors.renewpass">{{errors.renewpass[0]}}</span>
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
      url:'/api/products',
      loading: false,
      newpass:'',
      renewpass:'',
      email:'',
      errors:{
      }     
    }
  },
  mounted(){
   this.getadmin_info();    
  },
  methods:{    
    getadmin_info(){
      axios.get('/api/admins').then(response=> {
        this.email = response.data.email;       
      });
    },
    submit_change(){
      axios.post('/api/admins/postchange', { old:this.old,newpass:this.newpass,renewpass:this.renewpass}).then(response => {  
          this.$router.push({ name: 'Dashboard'});
          this.loading = false;  
        console.log(response);   
      }).catch(error=>{
        if (error.response.status == 422) {
          this.errors = error.response.data.errors; 
        }
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
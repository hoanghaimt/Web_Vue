<template>
  <div class="wrapper">    
    <div v-if="loading">
      <div class="loader"></div>
    </div>
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-12">
            <b-button type="button" variant="primary" @click="addnewmod = true"> Thêm mới</b-button>
            <hr>
        </div>
        <div class="col-12">
          <b-card header="<i class='fa fa-align-justify'></i> Danh mục">
            <table class="table table-bordered table-striped table-sm table-responsive">
              <thead>
                <tr>
                  <th class="text-center">id</th>
                  <th class="text-center">Icon/Image</th>
                  <th class="text-center">Tên danh mục</th>
                  <th class="text-center">Mô tả danh mục</th>
                  <th class="text-center">Thứ tự</th>
                  <th class="text-center">Trạng thái</th>
                  <th class="text-center">Thao tác</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="modproduct in modnews">
                  <td>{{modproduct.id}}</td>
                  <td class="text-center">
                    <img :src="modproduct.mod_icon" class="img-responsive" alt="no image" width="50" height="50">
                  </td>
                  <td>{{modproduct.mod_name}}</td>
                  <td v-html="modproduct.mod_description"></td>
                  <td>{{modproduct.mod_number}}</td>
                  <td v-if="modproduct.mod_type == 0" class="text-center">
                    <span class="badge badge-warning">Đang Ẩn</span>
                  </td>
                  <td v-else-if="modproduct.mod_type == 1" class="text-center">
                    <span class="badge badge-success">Đang Hiện</span>
                  </td>
                  <td v-else="modproduct.mod_type == 2" class="text-center">
                    <span class="badge badge-info">HOT</span>
                  </td>
                  <td class="text-center">
                    <b-button type="button" variant="primary" @click="updatemod_btn(modproduct.id)"> Sửa</b-button>
                    <b-button variant="danger" @click="remove(modproduct.id)">Xóa</b-button>
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
                    Trang tiếp
                  </button>
                </li>
              </ul>
            </nav>
          </b-card>
        </div><!--/.col-->
      </div><!--/.row-->
    </div>
    <!-- created new modal  -->
    <b-modal title="Thêm mới Loại" v-model="addnewmod" @ok="addnewmod_click()">
      <div class="row">
        <form action="#" method="post" id="addnewsmod_form">
          <div class="col-md-12">
            <b-form-fieldset label="Tên danh mục" description="Bao gồm các kỹ tự từ a-z">
              <b-input-group left="A-z">
                <b-form-input type="text" id="add_name" name="name" v-model="mod_name"></b-form-input>
              </b-input-group>
              <span class="error_msg" v-if="errors.name">{{errors.mod_name[0]}}</span>
            </b-form-fieldset>
            <b-form-fieldset label="Mô tả danh mục" :horizontal="false">
              <b-input-group>
                <b-form-input type="textarea" id="add_description" name="description" v-model="mod_description"></b-form-input>
              </b-input-group>
              <span class="error_msg" v-if="errors.description">{{errors.description[0]}}</span>
            </b-form-fieldset>
            <div class="row">
              <div class="col-6">
                <b-form-fieldset label="Thứ tự hiển thị" description="Chỉ nhập số">
                  <b-input-group left="0-9">
                    <b-form-input type="number" id="add_number" name="number" v-model="mod_number"></b-form-input>
                  </b-input-group>
                  <span class="error_msg" v-if="errors.number">{{errors.mod_number[0]}}</span>
                </b-form-fieldset>
              </div>
              <div class="col-6">
                <b-form-fieldset label="Trạng thái danh mục" description="Chỉ nhập số">
                  <b-input-group left="Chọn một">
                    <select name="" id="add_type" class="form-control" required="required" v-model="mod_type">
                      <option value="0">Tạm ẩn</option>
                      <option value="1">Hiển thị</option>
                      <option value="2">HOT</option>
                    </select>
                  </b-input-group>
                  <span class="error_msg" v-if="errors.type">{{errors.mod_type[0]}}</span>
                </b-form-fieldset>
              </div>
            </div>
            <b-form-fieldset label="Click chọn icon - Hình ảnh">
                <div class="col-3" v-if="image">
                    <img :src="image" class="img-responsive" height="70" width="90">
                 </div>
                <div class="col-9">
                    <img src="/images/noimg.jpg" id="img_id" @click="slect_file()" class="img-responsive" height="70" width="90">
                    <input type="file" id="file_id" accept="image/*"  v-on:change="onImageChange" hidden class="form-control">
                </div>
            </b-form-fieldset>      
        </div><!--/.col-->
        </form>
      </div><!--/.row-->   
    </b-modal>
    <!-- /created new modal  -->
    <!-- updated new modal  -->
    <b-modal title="Chỉnh sửa loại" id="update_id_modal" v-model="updatemod" @ok="updatenewmod(edit_item.id)">
      <div class="row">
        <div class="col-12">
            <b-form-fieldset label="Tên danh mục" description="Bao gồm các kỹ tự từ a-z">
              <b-input-group left="A-z">
                <b-form-input type="text" id="id_name" v-model="edit_item.mod_name"></b-form-input>
              </b-input-group>
              <span class="error_msg" v-if="errors.name">{{errors.name[0]}}</span>
            </b-form-fieldset>
            <b-form-fieldset label="Mô tả danh mục" :horizontal="false">
              <b-input-group>
                <b-form-input type="textarea" id="id_description" name="description" v-model="edit_item.mod_description"></b-form-input>
              </b-input-group>
              <span class="error_msg" v-if="errors.description">{{errors.description[0]}}</span>
            </b-form-fieldset>
            <div class="row">
              <div class="col-6">
                <b-form-fieldset label="Thứ tự hiển thị" description="Chỉ nhập số" >
                  <b-input-group left="0-9">
                    <b-form-input type="number" id="id_number" v-model="edit_item.mod_number"></b-form-input>
                  </b-input-group>
                  <br><span class="error_msg" v-if="errors.number">{{errors.number[0]}}</span>
                </b-form-fieldset>
              </div>
              <div class="col-6">
                <b-form-fieldset label="Trạng thái danh mục" description="Chỉ nhập số" >
                  <b-input-group left="Chọn một">
                     <select name="" id="id_type" class="form-control" required="required" v-model="edit_item.mod_type">
                       <option value="0">Tạm ẩn</option>
                       <option value="1">Hiển thị</option>
                       <option value="2">HOT</option>
                     </select>
                  </b-input-group>
                  <br><span class="error_msg" v-if="errors.type">{{errors.type[0]}}</span>
                </b-form-fieldset>
              </div>
            </div>
            <b-form-fieldset label="Icon - Hình ảnh" description="Hình ảnh cũ">
              <div class="col-3" v-if="oimage">
                <img :src="oimage" id="id_icon" class="img-responsive" height="70" width="90">
             </div>
            </b-form-fieldset>
            <b-form-fieldset label="Icon - Hình ảnh" description="Hình ảnh">
              <div class="row">
                <div class="col-3" v-if="eimage">
                    <img :src="eimage" class="img-responsive" height="70" width="90">
                 </div>
                <div class="col-9">
                    <input type="file" accept="image/*" v-on:change="eonImageChange" class="form-control">
                </div>
              </div>                
            </b-form-fieldset>      
        </div><!--/.col-->
      </div><!--/.row-->   
    </b-modal>
    <!-- /updated new modal  -->
  </div>
</template>

<script>

export default {
  name: 'tables',
  name: 'modals',
  data () {
    return {
      url:'/api/modnews',
      loading: false,
      image: '',
      eimage: '',
      oimage: '',
      mod_name:'',
      mod_number:'',
      mod_type:'',
      mod_icon:'',
      mod_description:'',
      addnewmod: false,
      updatemod: false,
      pagination:[],
      modnews:[],
      modproduct:{
        id:0,
        mod_name:'',
        mod_description:'',
        mod_number:'',
        mod_type:'',
        mod_icon:''
      },
      errors:{

      },
      edit_item: {

      }     
    }
  },
  mounted(){
    this.getallmod();
    this.loading = false;
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
    getallmod(){
      this.errors = [];
      this.loading = true;
      let $this = this;
      axios.get(this.url).then(response=> {
        this.modnews = response.data.data
        $this.makepagenation(response.data)
        this.loading = false;
      })
    },
    addnewmod_click(){
      this.loading = false;
      axios.post('/api/modnews', { name:this.mod_name,number:this.mod_number,type:this.mod_type,description:this.mod_description,image:this.image }).then(response => {
        this.getallmod();
        $("#add_name").val('');
        $("#add_number").val('');
        $("#add_type").val('');
        $("#add_icon").val('');
        $("#add_description").val('');
      }).catch(error=>{
        if (error.response.status == 422) {
          this.errors = error.response.data.errors; 
          this.addnewmod = true;
        }
      });
      
    },
    updatemod_btn(id){
      this.loading = true;
      var url = '/api/modnews/'+id;
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
    updatenewmod(id){
      this.loading = true;
      var url = '/api/modnews/'+id;
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
          var url = '/api/modnews/remove/'+id;
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
    }
  }  
};
</script>
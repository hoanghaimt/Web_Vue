<template>
  <div class="wrapper">
    <div v-if="loading">
      <div class="loader"></div>
    </div>
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-12">
            <b-button type="button" variant="primary" @click="getmod_add()"> Thêm mới</b-button>
            <hr>
        </div>
        <div class="col-12">
          <b-card header="<i class='fa fa-align-justify'></i> Loại danh mục">
            <table class="table table-bordered table-striped table-sm table-responsive">
              <thead>
                <tr>
                  <th class="text-center">id</th>
                  <th class="text-center">Icon/Image</th>
                  <th class="text-center">Tên danh mục</th>
                  <th class="text-center">Danh mục cha</th>
                  <th class="text-center">Mô tả danh mục</th>
                  <th class="text-center">Thứ tự</th>
                  <th class="text-center">Trạng thái</th>
                  <th class="text-center">Thao tác</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="listproduct in listproducts">
                  <td>{{listproduct.id}}</td>
                  <td class="text-center">
                    <img :src="listproduct.list_icon" class="img-responsive" alt="no image" width="50" height="50">
                  </td>
                  <td>{{listproduct.list_name}}</td>
                  <td>{{listproduct.mod_name}}</td>
                  <td>{{listproduct.list_description}}</td>
                  <td>{{listproduct.list_number}}</td>
                  <td v-if="listproduct.list_type == 0" class="text-center">
                    <span class="badge badge-warning">Đang Ẩn</span>
                  </td>
                  <td v-else-if="listproduct.list_type == 1" class="text-center">
                    <span class="badge badge-success">Đang Hiện</span>
                  </td>
                  <td v-else="listproduct.list_type == 2" class="text-center">
                    <span class="badge badge-info">HOT</span>
                  </td>
                  <td class="text-center">
                    <b-button type="button" variant="primary" @click="updatemod_btn(listproduct.id)"> Sửa</b-button>
                    <b-button variant="danger" @click="remove(listproduct.id)">Xóa</b-button>
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
                <b-form-input type="text" id="add_name" name="name" v-model="list_name"></b-form-input>
              </b-input-group>
              <span class="error_msg" v-if="errors.name">{{errors.name[0]}}</span>
            </b-form-fieldset>
            <b-form-fieldset label="Danh mục cha" description="Chọn danh mục cha">
              <b-input-group>                
                  <select class="form-control" id="add_mod" :required="true" v-model="id_mod">
                    <option 
                     v-for="modproduct in modproducts" 
                     v-bind:value="modproduct.id"
                    >{{ modproduct.mod_name }}</option>
                  </select>               
              </b-input-group>
              <span class="error_msg" v-if="errors.id_mod">{{errors.id_mod[0]}}</span>
            </b-form-fieldset>
            <b-form-fieldset label="Mô tả danh mục" :horizontal="false">
              <b-form-input :textarea="true" id="add_description" name="description" :rows="5" placeholder="Nhập mô tả.." v-model="list_description"></b-form-input>
              <br><span class="error_msg" v-if="errors.description">{{errors.description[0]}}</span>
            </b-form-fieldset>
            <div class="row">
              <div class="col-6">
                <b-form-fieldset label="Thứ tự hiển thị" description="Chỉ nhập số">
                  <b-input-group left="0-9">
                    <b-form-input type="number" id="add_number" name="number" v-model="list_number"></b-form-input>
                  </b-input-group>
                  <span class="error_msg" v-if="errors.number">{{errors.number[0]}}</span>
                </b-form-fieldset>
              </div>
              <div class="col-6">
                <b-form-fieldset label="Trạng thái danh mục" description="Chỉ nhập số">
                  <b-input-group left="Chọn một">
                    <select name="" id="add_type" class="form-control" required="required" v-model="list_type">
                      <option value="0">Tạm ẩn</option>
                      <option value="1">Hiển thị</option>
                      <option value="2">HOT</option>
                    </select>
                  </b-input-group>
                  <span class="error_msg" v-if="errors.type">{{errors.type[0]}}</span>
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
                <b-form-input type="text" id="id_name" v-model="edit_item.list_name"></b-form-input>
              </b-input-group>
              <span class="error_msg" v-if="errors.name">{{errors.name[0]}}</span>
            </b-form-fieldset>
            <b-form-fieldset label="Danh mục cha" description="Chọn danh mục cha">
              <b-input-group left="Chọn một">
                <select class="form-control" :required="true" v-model="edit_item.id_mod">
                    <option 
                     v-for="modproduct in modproducts" 
                     v-bind:value="modproduct.id"
                    >{{ modproduct.mod_name }}</option>
                </select>                
              </b-input-group>
              <span class="error_msg" v-if="errors.id_mod">{{errors.id_mod[0]}}</span>
            </b-form-fieldset>
            <b-form-fieldset label="Mô tả danh mục" description="Bao gồm các kỹ tự từ a-z">
              <b-input-group>
                <b-form-input :textarea="true" id="id_description" :rows="5" type="text" v-model="edit_item.list_description"></b-form-input>
              </b-input-group>
              <span class="error_msg" v-if="errors.description">{{errors.description[0]}}</span>
            </b-form-fieldset>
            <div class="row">
              <div class="col-6">
                <b-form-fieldset label="Thứ tự hiển thị" description="Chỉ nhập số" >
                  <b-input-group left="0-9">
                    <b-form-input type="number" id="id_number" v-model="edit_item.list_number"></b-form-input>
                  </b-input-group>
                  <br><span class="error_msg" v-if="errors.number">{{errors.number[0]}}</span>
                </b-form-fieldset>
              </div>
              <div class="col-6">
                <b-form-fieldset label="Trạng thái danh mục" description="Chỉ nhập số" >
                  <b-input-group left="Chọn một">
                     <select name="" id="id_type" class="form-control" required="required" v-model="edit_item.list_type">
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
      url:'/api/listproducts',
      loading: false,
      image: '',
      eimage: '',
      oimage: '',
      list_name:'',
      list_number:'',
      id_mod:'',
      list_type:'',
      list_icon:'',
      list_description:'',
      addnewmod: false,
      updatemod: false,
      pagination:[],
      modproducts:[],
      modproduct:{
        
      },
      listproducts:[],
      listproduct:{
        id:0,
        list_name:'',
        id_mod:'',
        list_description:'',
        list_number:'',
        list_type:'',
        list_icon:''
      },
      errors:{

      },
      edit_item: {

      }     
    }
  },
  mounted(){
    this.getallmod()
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
    getmod_add(){
      this.loading = true;
      let $this = this;
      axios.get(this.url+'/getmod').then(response=> {
        console.log( response.data);
        this.modproducts = response.data
        $this.makepagenation(response.data)
        this.loading = false;
        this.addnewmod = true;
      });    
    },
    getallmod(){
      this.errors = [];
      this.loading = true;
      let $this = this;
      axios.get(this.url).then(response=> {
        this.listproducts = response.data.data
        $this.makepagenation(response.data)
        this.loading = false;
      })
    },
    addnewmod_click(){
      console.log(this.id_mod);
      this.loading = false;
      axios.post('/api/listproducts', { name:this.list_name,id_mod:this.id_mod,number:this.list_number,type:this.list_type,description:this.list_description,image:this.image }).then(response => {
        $("#add_name").val('');
        $("#add_mod").val('');
        $("#add_number").val('');
        $("#add_type").val('');
        $("#add_icon").val('');
        $("#add_description").val('');
        this.getallmod();        
      }).catch(error=>{
        if (error.response.status == 422) {
          this.errors = error.response.data.errors; 
          this.addnewmod = true;
        }
      });
      
    },
    updatemod_btn(id){
      this.loading = true;
      var url = '/api/listproducts/'+id;
      let $this = this;
      axios.get(this.url+'/getmod').then(response=> {
        this.modproducts = response.data
        axios.get(url).then(response => {
          this.edit_item = response.data;
          this.oimage = response.data.list_icon;
          this.eimage = '';
          $("#id_name").val(response.data.list_name);
          $("#id_number").val(response.data.list_number);
          $("#id_type").val(response.data.list_type);
          $("#id_description").val(response.data.list_description);
          this.loading = false;
          this.updatemod = true;
        });        
      });      
    },
    updatenewmod(id){
      this.loading = true;
      var url = '/api/listproducts/'+id;
      axios.post(url, { name:this.edit_item.list_name,id_mod:this.edit_item.id_mod,number:this.edit_item.list_number,type:this.edit_item.list_type,description:this.edit_item.list_description,image:this.eimage }).then(response => {
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
          var url = '/api/listproducts/remove/'+id;
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
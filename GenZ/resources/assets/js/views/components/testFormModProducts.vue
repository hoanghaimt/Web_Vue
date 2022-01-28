<template>
  <div class="wrapper">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-12">
            <b-button type="button" variant="primary" @click="addnewmod = true"> Thêm mới</b-button>
            <hr>
        </div>
        <div class="col-12">
          <b-card header="<i class='fa fa-align-justify'></i> Danh mục">
            <table class="table table-bordered table-striped table-sm">
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
                <tr v-for="modproduct in modproducts">
                  <td>{{modproduct.id}}</td>
                  <td class="text-center"><img :src="modproduct.mod_icon" class="img-avatar" alt="admin@gmail.com" width="50" height="50"></td>
                  <td>{{modproduct.mod_name}}</td>
                  <td>{{modproduct.mod_description}}</td>
                  <td>{{modproduct.mod_number}}</td>
                  <td v-if="modproduct.mod_type == 1" class="text-center">
                    <span class="badge badge-success">Đang Hiện</span>
                  </td>
                  <td v-else="modproduct.mod_type !=== 1" class="text-center">
                    <span class="badge badge-danger">Đang Ẩn</span>
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
                <li class="page-item"><a class="page-link" href="#">Prev</a></li>
                <li class="page-item active">
                  <a class="page-link" href="#">1</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">4</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
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
                <b-form-input type="text" name="name" v-model="mod_name"></b-form-input>
              </b-input-group>
            </b-form-fieldset>
            <b-form-fieldset label="Mô tả danh mục" :label-cols="12" :horizontal="false">
              <b-form-input :textarea="true" name="description" :rows="5" placeholder="Nhập mô tả.." v-model="mod_description"></b-form-input>
            </b-form-fieldset>
            <b-form-fieldset label="Thứ tự hiển thị" description="Chỉ nhập số">
              <b-input-group left="0-9">
                <b-form-input type="number" name="number" v-model="mod_number"></b-form-input>
              </b-input-group>
            </b-form-fieldset>
            <b-form-fieldset label="Trạng thái danh mục" description="Chỉ nhập số">
              <b-input-group left="0-9">
                <b-form-input type="number" name="type" v-model="mod_type"></b-form-input>
              </b-input-group>
            </b-form-fieldset>
            <b-form-fieldset label="Icon - Hình ảnh" description="Hình ảnh">
              <b-input-group left="Image">
                <b-form-input type="file" name="icon" v-model="mod_icon"></b-form-input>
              </b-input-group>
            </b-form-fieldset>      
        </div><!--/.col-->
        </form>
      </div><!--/.row-->   
    </b-modal>
    <!-- /created new modal  -->
    <!-- updated new modal  -->
    <b-modal title="Chỉnh sửa loại" id="update_id_modal" v-model="updatemod" @ok="updatenewmod(edit_item.id)">
      <div class="row">
        <div class="col-md-12">
            <b-form-fieldset label="Tên danh mục" description="Bao gồm các kỹ tự từ a-z">
              <b-input-group left="A-z">
                <b-form-input type="text" v-model="edit_item.mod_name"></b-form-input>
              </b-input-group>
            </b-form-fieldset>
            <b-form-fieldset label="Mô tả danh mục" description="Bao gồm các kỹ tự từ a-z">
              <b-input-group>
                <b-form-input :textarea="true" :rows="5" type="text" v-model="edit_item.mod_description"></b-form-input>
              </b-input-group>
            </b-form-fieldset>
            <b-form-fieldset label="Thứ tự hiển thị" description="Chỉ nhập số">
              <b-input-group left="0-9">
                <b-form-input type="number" v-model="edit_item.mod_number"></b-form-input>
              </b-input-group>
            </b-form-fieldset>
            <b-form-fieldset label="Trạng thái danh mục" description="Chỉ nhập số">
              <b-input-group left="0-9">
                <b-form-input type="number" v-model="edit_item.mod_type"></b-form-input>
              </b-input-group>
            </b-form-fieldset>
            <b-form-fieldset label="Icon - Hình ảnh" description="Hình ảnh">
              <b-input-group left="Image">
                <b-form-input type="file" v-model="edit_item.mod_icon"></b-form-input>
              </b-input-group>
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
      mod_name:'',
      mod_number:'',
      mod_type:'',
      mod_icon:'',
      mod_description:'',
      addnewmod: false,
      updatemod: false,

      modproducts:[],
      modproduct:{
        id:0,
        mod_name:'',
        mod_description:'',
        mod_number:'',
        mod_type:'',
        mod_icon:''
      },
      edit_item: {

      }
    }
  },
  mounted(){
    this.getallmod()
  },
  methods:{
    getallmod(){
      axios.get('/api/modproducts').then(response=> {
        this.modproducts = response.data
      })
    },
    addnewmod_click(){
      axios.post('/api/modproducts', { name:this.mod_name,number:this.mod_number,type:this.mod_type,description:this.mod_description }).then(response => {
          this.getallmod();
      });
    },
    updatemod_btn(id){
      var url = '/api/modproducts/'+id;
      axios.get(url).then(response => {
          this.edit_item = '';
          this.edit_item = response.data;
          this.updatemod = true;
        });
    },
    updatenewmod(id){
      var url = '/api/modproducts/'+id;
      axios.post(url, { name:this.edit_item.mod_name,number:this.edit_item.mod_number,type:this.edit_item.mod_type,description:this.edit_item.mod_description }).then(response => {
          this.edit_item = '';
          this.getallmod();
      });
    },
    remove(id){
      var url = '/api/modproducts/remove/'+id;
      axios.post(url, { }).then(response => {
          this.getallmod();
      });
    }
  }  
}
</script>

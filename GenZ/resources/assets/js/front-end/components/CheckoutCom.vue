<template>   
    <div class="columns-container">
        <div v-if="loading">
          <div class="loader"></div>
        </div>
        <div class="container" id="columns">
            <!-- breadcrumb -->
            <div class="breadcrumb clearfix">
                <a class="home" href="#" title="Return to Home">Home</a>
                <span class="navigation-pipe">&nbsp;</span>
                <span class="navigation_page">Đặt hàng - Thanh toán</span>
            </div>
            <!-- ./breadcrumb -->
            <!-- page heading-->
            <h2 class="page-heading">
                <span class="page-heading-title2">THÔNG TIN ĐƠN HÀNG</span>
            </h2>
            <!-- ../page heading-->
            <div class="page-content page-order">
                <ul class="step">
                    <li ><span>01. Tóm tắt đơn hàng</span></li>
                    <li class="current-step"><span>02. Thanh toán - Đặt hàng</span></li>
                </ul>
            </div>
            <div class="page-content checkout-page">
                <div class="box-border">
                    <ul>                                        
                        <li class="row">                            
                            <div class="col-sm-6">                                
                                <label for="first_name_1" class="required">Họ lót</label>
                                <input class="input form-control" type="text" name="first_name" id="first_name_1" v-model="first_name">
                                <span class="error_msg" v-if="errors.name">{{errors.name[0]}}</span>
                            </div><!--/ [col] -->
                            <div class="col-sm-6">                                
                                <label for="last_name_1" class="required">Tên</label>
                                <input class="input form-control" type="text" name="last_name" id="last_name_1" v-model="last_name">
                                <span class="error_msg" v-if="errors.name">{{errors.name[0]}}</span>
                            </div><!--/ [col] -->
                        </li><!--/ .row -->
                        <li class="row">                            
                            <div class="col-sm-6">
                                <label for="telephone_1" class="required">Điện thại</label>
                                <input class="input form-control" type="text" name="phone" id="telephone_1" v-model="phone">
                                <span class="error_msg" v-if="errors.phone">{{errors.phone[0]}}</span>
                            </div><!--/ [col] -->
                            <div class="col-sm-6">                                
                                <label for="email_address_1" class="required">Email</label>
                                <input class="input form-control" type="text" name="email" id="email_address_1" v-model="email">
                                <span class="error_msg" v-if="errors.email">{{errors.email[0]}}</span>
                            </div><!--/ [col] -->
                        </li><!--/ .row -->                        
                        <li class="row">
                            <div class="col-sm-6">
                                <label class="required">Tỉnh/Thành</label>
                                <div class="custom_select">
                                    <select class="input form-control" id="id_citis"  @change="get_districts(id_citi)" v-model="id_citi" :required="true">
                                        <option v-for="city in cities" :value="city.id">
                                            {{ city.name }}
                                        </option>
                                    </select>
                                </div>
                                <span class="error_msg" v-if="errors.city">{{errors.city[0]}}</span>
                            </div><!--/ [col] -->
                            <div class="col-sm-6">
                                <label class="required">Quận/huyện</label>
                                <div class="custom_select">
                                    <select class="input form-control" id="id_district" name="id_district" v-model="id_district">
                                        <option disabled value="">Chọn tỉnh/thành</option>
                                    </select>
                                </div>
                                <span class="error_msg" v-if="errors.district">{{errors.district[0]}}</span>
                            </div><!--/ [col] -->
                        </li><!--/ .row -->
                        <li class="row">        
                            <div class="col-xs-12">
                                <label for="address_1" class="required">Địa chỉ( Xã/phường - số nhà - đường)</label>
                                <input class="input form-control" type="text" name="fulladdress" id="address_1" v-model="address">
                                <span class="error_msg" v-if="errors.address">{{errors.address[0]}}</span>
                            </div><!--/ [col] -->       
                        </li><!--/ .row -->
                        <li class="row">        
                            <div class="col-xs-12">
                                <label for="note_1" class="required">Ghi chú</label>
                                <textarea name="note" id="inputNone" class="form-control" rows="3" v-model="note"></textarea>
                            </div><!--/ [col] -->       
                        </li><!--/ .row -->
                    </ul>
                </div>
                <h3 class="checkout-sep">Phương thức thanh toán</h3>
                <div class="box-border">
                    <ul class="shipping_method">
                        <li>
                            <p class="subcaption bold">Thanh toán khi nhận hàng</p>
                            <label for="radio_button_3">
                                <input type="radio" checked name="radio_3" value="0" id="radio_button_3">Miễn phí
                            </label><br>
                            <label for="radio_button_3">
                                <input type="radio" value="100000" name="radio_3" id="radio_button_fee">
                                Tính phí <span v-if="ship_fee !=0"> ({{formatPrice(ship_fee)}}) </span>
                            </label>
                        </li>
                        <li class="disabled">
                            <p class="subcaption bold">Thanh toán Online</p>
                            <label for="radio_button_4">
                                <input type="radio" name="radio_3" disabled id="radio_button_4"> 
                                Thanh toán ATM Online(<span class="label label-danger">Đang phát triển</span>)
                            </label>
                        </li>
                    </ul>
                </div>
                <h3 class="checkout-sep">Chi tiết đơn hàng</h3>
                <div class="box-border">
                     <table class="table table-bordered table-responsive cart_summary">
                        <thead>
                           <tr>
                                <th class="cart_product">Sản phẩm</th>
                                <th>Thông tin</th>
                                <th>Trạng thái</th>
                                <th>Giá bán</th>
                                <th>S Lượng</th>
                                <th>Tổng cộng</th>
                                <th  class="action"><i class="fa fa-trash-o"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in cart_info">
                                <td class="cart_product">
                                    <a href="#"><img :src="item.options.image" alt="Product"></a>
                                </td>
                                <td class="cart_description">
                                    <p class="product-name"><a href="#">{{item.name}} </a></p>
                                    <small class="cart_ref">Mã sản phẩm: #SP{{item.id}}</small><br>
                                </td>
                                <td class="cart_avail text-center">
                                    <span class="label label-info" v-if="item.options.price_no_sale ==item.options.price_with_sale">Cong hàng</span>
                                    <span class="label label-success" v-else-if="item.options.price_no_sale >item.options.price_with_sale">Sale</span>
                                </td>
                                <td class="price"><span>{{formatPrice(item.price)}}</span></td>
                                <td class="qty">
                                    <span>{{item.qty}}</span>
                                </td>
                                <td class="price">
                                    <span>{{formatPrice(item.qty * item.price)}}</span>
                                </td>
                                <td class="action">
                                    <a @click="cart_remove_item(item.rowId)"></a>
                                </td>
                            </tr>                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" rowspan="2"></td>
                                <td colspan="3">Tổng tiền (bao gồm thuế)</td>
                                <td colspan="2">{{formatPrice(cart_sum_info.total_pay)}}</td>
                            </tr>
                            <tr>
                                <td colspan="3"><strong>Thành tiền</strong></td>
                                <td colspan="2"><strong>{{formatPrice(cart_sum_info.total_pay)}}</strong></td>
                            </tr>
                        </tfoot>    
                    </table>
                    <button v-if="cart_sum_info.total_qty ==0" disabled class="button pull-right" @click="submit_order()">Đặt hàng</button>
                    <button v-else class="button pull-right" @click="submit_order()">Đặt hàng</button>
                </div>
            </div>
        </div>
        <!-- Modal HTML -->
        <div id="myModal" class="modal fade">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="icon-box">
                            <i class="material-icons">&#xE876;</i>
                        </div>              
                        <h4 class="modal-title">Tuyệt vời!</h4>   
                    </div>
                    <div class="modal-body">
                        <p class="text-center">
                            Đơn hàng của bạn đã được gửi đi. Chúng tôi sẽ nhanh chóng kiểm tra và thực hiện đơn hàng của bạn. xin cảm ơn !
                        </p>
                    </div>
                    <div class="modal-footer">                         
                        <button class="btn btn-success btn-block" data-dismiss="modal">
                            OK
                        </button>
                    </div>
                </div>
            </div>
        </div>     
    </div>
</template>

<script>
    export default {
        data(){
            return {
                first_name:'',
                last_name:'',
                phone:'',
                email:'',
                address:'',
                note:'',
                cart_info:'',
                cart_sum_info:'',
                cities:'',
                id_citi:'',
                id_district:'',
                id_ward:'',
                loading:true,  
                user:'1',
                ship_fee:'0',
                errors:{

                }
            }
        },
        mounted() {
            this.get_cart_info();
            this.get_cities_info();
        },
        watch: {
            '$route'(to, from) {
                this.get_cart_info()
            }
        },
        methods:{
            formatPrice(value) {
                let val = (value/1).toFixed(0).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")+'đ'
            },
            get_cities_info(){
                 axios.get('/api_get_cities').then(response=> {
                    this.cities = response.data;        
                });
            },
            get_districts(id){
                axios.get('/get_districts_by_city/'+id).then(response => {
                    $('#id_district').empty();
                    $('#id_district').html(response.data);
                });
                axios.get('/get_shipping_fee/'+id).then(response => {
                    this.ship_fee = response.data;
                    if (this.ship_fee !=0) {
                        $('#radio_button_fee').val(this.ship_fee);
                        $("#radio_button_fee" ).prop( "checked", true );
                        $("#radio_button_fee" ).prop( "disabled", false );
                        $("#radio_button_3" ).prop( "checked", false );
                        $("#radio_button_3" ).prop( "disabled", true );
                    } else {
                        $('#radio_button_fee').val('0');
                        $("#radio_button_fee" ).prop( "checked", false );
                        $("#radio_button_fee" ).prop( "disabled", true );
                        $("#radio_button_3" ).prop( "checked", true );
                        $("#radio_button_3" ).prop( "disabled", false );
                    }
                });                
            },
            cart_remove_item(rowId){
                axios.post('/api_post_removecart_item', { rowId:rowId}).then(response => {
                 if (true) {
                    this.get_cart_info();
                 }       
              }).catch(error=>{
                console.log(error.response);
              });
            },
            submit_order(){
                this.loading = true;
                var url = 'api_submit_order';
                var full_name = this.first_name+' '+this.last_name;
                axios.post(url, { user:this.user, name:full_name,phone:this.phone,email:this.email,city:this.id_citi,district:this.id_district,address:this.address, note:this.note,carts:this.cart_info,carts_sum:this.cart_sum_info }).then(response => {
                    this.loading = false;
                    $('#myModal').modal('show');
                    this.get_cart_info();
                     $("#first_name_1").val('');
                     $("#last_name_1").val('');
                     $("#telephone_1").val('');
                     $("#email_address_1").val('');
                     $("#address_1").val('');
                     $("#inputNone").val('');

                }).catch(error=>{
                   if (error.response.status == 422) {
                      this.errors = error.response.data.errors; 
                      if (this.errors.name) {
                        $("#first_name_1").focus();
                      }                      
                      this.loading = false;
                    }
                });
            },
            get_cart_info(){
                this.loading = true;
                axios.get('/api_get_cart_info').then(response=> {
                    this.cart_info = response.data.carts;
                    this.cart_sum_info = response.data.cart_sum_info;    
                    this.loading = false;         
                });
            }
        }
    }

</script>
<style type="text/css" media="screen">

   /*modal*/
    .modal-confirm {        
        color: #636363;
        width: 325px;
    }
    .modal-confirm .modal-content {
        padding: 20px;
        border-radius: 5px;
        border: none;
    }
    .modal-confirm .modal-header {
        border-bottom: none;   
        position: relative;
    }
    .modal-confirm h4 {
        text-align: center;
        font-size: 26px;
        margin: 30px 0 -15px;
    }
    .modal-confirm .form-control, .modal-confirm .btn {
        min-height: 40px;
        border-radius: 3px; 
    }
    .modal-confirm .close {
        position: absolute;
        top: -5px;
        right: -5px;
    }   
    .modal-confirm .modal-footer {
        border: none;
        text-align: center;
        border-radius: 5px;
        font-size: 13px;
    }   
    .modal-confirm .icon-box {
        color: #fff;        
        position: absolute;
        margin: 0 auto;
        left: 0;
        right: 0;
        top: -70px;
        width: 95px;
        height: 95px;
        border-radius: 50%;
        z-index: 9;
        background: #82ce34;
        padding: 15px;
        text-align: center;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
    }
    .modal-confirm .icon-box i {
        font-size: 58px;
        position: relative;
        top: 3px;
    }
    .modal-confirm.modal-dialog {
        margin-top: 80px;
    }
    .modal-confirm .btn {
        color: #fff;
        border-radius: 4px;
        background: #82ce34;
        text-decoration: none;
        transition: all 0.4s;
        line-height: normal;
        border: none;
    }
    .modal-confirm .btn:hover, .modal-confirm .btn:focus {
        background: #6fb32b;
        outline: none;
    }
    .trigger-btn {
        display: inline-block;
        margin: 100px auto;
    }
/*modal */


@keyframes rotate {
  0% {
    transform: translate(-50%, -50%) rotate(0);
  }
  100% {
    transform: translate(-50%, -50%) rotate(360deg);
  }
}  
</style>

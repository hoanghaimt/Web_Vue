<template>   
    <div class="columns-container">
        <div class="container" id="columns">
            <!-- breadcrumb -->
            <div class="breadcrumb clearfix">
                <a class="home" href="#" title="Return to Home">Home</a>
                <span class="navigation-pipe">&nbsp;</span>
                <span class="navigation_page">Phương thức đặt hàng</span>
            </div>
            <!-- ./breadcrumb -->
            <!-- page heading-->
            <h2 class="page-heading">
                <span class="page-heading-title2">Phương thức đặt hàng</span>
            </h2>
            <!-- ../page heading-->
            <div class="page-content checkout-page">
                <h3 class="checkout-sep">CHỌN PHƯƠNG THỨC ĐẶT HÀNG</h3>
                <div class="box-border">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4>Thanh toán với tư cách Khách hoặc Đăng ký</h4>
                            <p>Đăng ký với chúng tôi để thuận tiện trong tương lai:</p>
                            <ul>
                                <li><label><input type="radio" name="radio1">Thanh toán không cần đăng ký</label></li>
                            </ul>
                            <br>
                            <h4>Đăng ký và tiết kiệm thời gian!</h4>
                            <p>Đăng ký với chúng tôi để thuận tiện trong tương lai:</p>
                            <p><i class="fa fa-check-circle text-primary"></i> FKiểm tra đơn hàng nhanh chóng và dễ dàng</p>
                            <p><i class="fa fa-check-circle text-primary"></i> Dễ dàng truy cập vào lịch sử đặt hàng và trạng thái của bạn.</p>
                        </div>
                        <div class="col-sm-6">
                            <h4>Đăng nhập</h4>
                            <p>Đã đăng ký? Vui lòng đăng nhập bên dưới:</p>
                            <div role="form" v-if="access_token ==''">
                                <label>Email address</label>
                                <input type="text" v-model="user" class="form-control input">
                                <label>Mật khẩu</label>
                                <input type="password" v-model="pass" class="form-control input">
                                <p><a href="#">FQuên mật khẩu?</a></p>
                                <button @click="api_login()" class="button">Submit</button>
                            </div>  
                            <div v-else>
                                kajshdk
                            </div>                          
                        </div>

                    </div>
                </div>
                <h3 class="checkout-sep">Thông tin đơn hàng</h3>
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
                                <td class="cart_avail">
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
                    <router-link to="/checkout" class="button pull-right">Đặt hàng</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                cart_info:'',
                loading:true,
                user:'',
                pass:'',
                access_token:'',
                cart_sum_info:''
            }
        },
        mounted() {
            this.get_cart_info();
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
            cart_remove_item(rowId){
                axios.post('/api_post_removecart_item', { rowId:rowId}).then(response => {
                 if (true) {
                    this.get_cart_info();
                 }       
              }).catch(error=>{
                console.log(error.response);
              });
            },
            get_cart_info(){
                this.loading = true;
                axios.get('/api_get_cart_info').then(response=> {
                    this.cart_info = response.data.carts;
                    this.cart_sum_info = response.data.cart_sum_info;    
                    this.loading = false;         
                });
            },
            api_login(){
                axios.post('/oauth/token', {grant_type:'password', client_id:4,client_secret:'NRtvnJhQK9lzbrKZRGOVXYJHfAVGnonCPdl0ZSmV',username:this.user,password:this.pass}).then(response => {
                 console.log(response.data);   
                this.access_token = response.data.access_token;    
              }).catch(error=>{
                console.log(error.response);
              });
            }
        }
    }

</script>
<style type="text/css" media="screen">
a:hover{
        cursor: pointer;
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

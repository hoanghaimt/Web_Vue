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
                <span class="navigation_page">Đặt hàng</span>
            </div>
            <!-- ./breadcrumb -->
            <!-- page heading-->
            <h2 class="page-heading no-line">
                <span class="page-heading-title2">TÓM TẮT GIỎ HÀNG</span>
            </h2>
            <!-- ../page heading-->
            <div class="page-content page-order">
                <ul class="step">
                    <li class="current-step"><span>01. Tóm tắt đơn hàng</span></li>
                    <li><span>02. Thanh toán - Đặt hàng</span></li>
                </ul>
                <div class="heading-counter warning">Giỏ hàng của bạn có:
                    <span class="text-danger">{{cart_sum_info.total_qty}} sản phẩm</span>
                </div>
                <div class="order-detail-content">
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
                    <div class="cart_navigation">
                        <a class="prev-btn" href="/">Tiếp tục mua sắm</a>                        
                        <router-link to="/checkout" class="next-btn">Tiến hành đặt hàng</router-link>
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
                cart_info:'',
                loading:true,
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

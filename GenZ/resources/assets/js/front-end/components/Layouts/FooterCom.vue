<template>    
    <footer id="footer">
        <div class="container">
            <div id="introduce-box" class="row">
                <div class="col-md-3">
                    <div id="address-box">
                        <a href="#"><img :src="setting_logo" alt="Logo" /></a>
                        <div id="address-list">
                            <div class="tit-name">Địa chỉ:</div>
                            <div class="tit-contain">{{setting_address}}</div>
                            <div class="tit-name">Phone:</div>
                            <div class="tit-contain">{{setting_phone}}</div>
                            <div class="tit-name">Email:</div>
                            <div class="tit-contain">{{setting_mail}}</div>
                        </div>
                    </div> 
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="introduce-title">Công Ty</div>
                            <ul id="introduce-company"  class="introduce-list">
                                <li><a href="#">Giới thiệu</a></li>
                                <li><a href="#">Chính sách</a></li>
                                <li><a href="#">Kiên hệ</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <div class="introduce-title">Hỗ trợ</div>
                            <ul id = "introduce-support"  class="introduce-list">
                                <li><a href="#">Thông tn</a></li>
                                <li><a href="#">Chinh sách đổi trả</a></li>
                                <li><a href="#">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div id="contact-box">
                        <div class="introduce-title">Nhận tin</div>
                        <div class="input-group" id="mail-box">
                          <input type="text" placeholder="Your Email Address"/>
                          <span class="input-group-btn">
                            <button class="btn btn-default" type="button">OK</button>
                          </span>
                        </div>
                        <div class="introduce-title">Let's Socialize</div>
                        <div class="social-link">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            <a href="#"><i class="fa fa-vk"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-google-plus"></i></a>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div id="footer-menu-box">
                
                <p class="text-center">Copyrights &#169; 2018 TQNPHONE. Designed by H&N Media</p>
            </div>
        </div> 
    </footer>
</template>

<script>
    export default {
        data(){
            return {
                cart_sum_info:'',
                setting_mail:'',
                setting_phone:'',
                setting_logo:'',
                setting_address:'',
                setting_fanpage:'',
                setting_nameco:'',
            }
        },
        mounted() {
            this.get_setting();
        },
        methods:{
            
            get_setting(){
                axios.get('/api_get_setting').then(response=> {
                    this.setting_mail = response.data.mail;
                    this.setting_phone = response.data.phone;             
                    this.setting_nameco = response.data.nameco;             
                    this.setting_address = response.data.address;             
                    this.setting_logo = response.data.logo;             
                });
            }
        }
    }
</script>

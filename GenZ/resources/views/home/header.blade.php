<!-- HEADER -->
<div id="header" class="header">
    <div class="top-header">
        <div class="container">
            <div class="nav-top-links">
                <a class="first-item" href="{{url('')}}"><img alt="phone" src="{{url('assets/images/phone.png')}}" />01649.573.828</a>
                <a href="#"><img alt="email" src="{{url('assets/images/email.png')}}" />Liên hệ ngay!</a>
            </div>           
            <div class="support-link">
                <a href="#"></a>
                <a href="#"></a>
            </div>

            <div id="user-info-top" class="user-info pull-right">
                <div class="dropdown">
                    <a class="current-open" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"><span>Tài khoản</span></a>
                    <ul class="dropdown-menu mega_dropdown" role="menu">
                        <li><a href="login.html">Đăng nhập</a></li>
                        <li><a href="#">Yêu thích</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--/.top-header -->
    <!-- MAIN HEADER -->
    <div class="container main-header">
        <div class="row">
            <div class="col-xs-12 col-sm-3 logo">
                <a href="{{url('')}}"><img alt="Kute Shop" src="{{url('assets/images/logo.png')}}" /></a>
            </div>
            <div class="col-xs-7 col-sm-7 header-search-box">
                <form class="form-inline">
                      <div class="form-group form-category">
                        <select class="select-category">
                            <option value="2">Tất cả</option>
                            <option value="1">Men</option>
                            <option value="2">Women</option>
                        </select>
                      </div>
                      <div class="form-group input-serach">
                        <input type="text"  placeholder="Nhập từ khóa...">
                      </div>
                      <button type="submit" class="pull-right btn-search"></button>
                </form>
            </div>
            <div id="cart-block" class="col-xs-5 col-sm-2 shopping-cart-box">
                <a class="cart-link" href="order.html">
                    <span class="title">Giỏ hàng</span>
                    <span class="total">2(SP) - 300.000VND</span>
                    <span class="notify notify-left">2</span>
                </a>
                <div class="cart-block">
                    <div class="cart-block-content">
                        <h5 class="cart-title">2 Sản phẩm</h5>
                        <div class="cart-block-list">
                            <ul>
                                <li class="product-info">
                                    <div class="p-left">
                                        <a href="#" class="remove_link"></a>
                                        <a href="#">
                                        <img class="img-responsive" src="{{url('assets/data/product-100x122.jpg')}}" alt="p10">
                                        </a>
                                    </div>
                                    <div class="p-right">
                                        <p class="p-name">Donec Ac Tempus</p>
                                        <p class="p-rice">61,19 €</p>
                                        <p>Qty: 1</p>
                                    </div>
                                </li>
                                <li class="product-info">
                                    <div class="p-left">
                                        <a href="#" class="remove_link"></a>
                                        <a href="#">
                                        <img class="img-responsive" src="{{url('assets/data/product-s5-100x122.jpg')}}" alt="p10">
                                        </a>
                                    </div>
                                    <div class="p-right">
                                        <p class="p-name">Donec Ac Tempus</p>
                                        <p class="p-rice">61,19 €</p>
                                        <p>Qty: 1</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="toal-cart">
                            <span>Total</span>
                            <span class="toal-price pull-right">122.38 €</span>
                        </div>
                        <div class="cart-buttons">
                            <a href="order.html" class="btn-check-out">Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <!-- END MANIN HEADER -->
    <div id="nav-top-menu" class="nav-top-menu">
        <div class="container">
            <div class="row">
                <div class="col-sm-3" id="box-vertical-megamenus">
                    <div class="box-vertical-megamenus">
                        <h4 class="title">
                            <span class="title-menu">Danh Mục</span>
                            <span class="btn-open-mobile pull-right home-page"><i class="fa fa-bars"></i></span>
                        </h4>
                    <div class="vertical-menu-content is-home">
                        <ul class="vertical-menu-list">
                            <li>
                                <a class="parent" href="#"><img class="icon-menu" alt="Funky roots" src="{{url('assets/data/2.png')}}">Điện Thoại - Phụ Kiện</a>
                                <div class="vertical-dropdown-menu">
                                    <div class="vertical-groups col-sm-12">
                                        <div class="mega-group col-sm-4">
                                            <h4 class="mega-group-header"><span>Điện Thoại</span></h4>
                                            <ul class="group-link-default">
                                                <li><a href="{{url('/dien-thoai-phu-kien/samsung')}}">Samsung</a></li>
                                                <li><a href="#">OPPO</a></li>
                                                <li><a href="#">Sony</a></li>
                                                <li><a href="#">Asus</a></li>
                                                <li><a href="#">Nokia</a></li>
                                                <li><a href="#">Hãng Khác</a></li>
                                            </ul>
                                        </div>
                                        <div class="mega-group col-sm-4">
                                            <h4 class="mega-group-header"><span>Máy Tính Bảng</span></h4>
                                            <ul class="group-link-default">
                                                <li><a href="#">Dresses</a></li>
                                                <li><a href="#">Coats &amp; Jackets</a></li>
                                                <li><a href="#">Blouses &amp; Shirts</a></li>
                                                <li><a href="#">Tops &amp; Tees</a></li>
                                                <li><a href="#">Hoodies &amp; Sweatshirts</a></li>
                                                <li><a href="#">Intimates</a></li>
                                            </ul>
                                        </div>
                                        <div class="mega-group col-sm-4">
                                            <h4 class="mega-group-header"><span>Phụ Kiện</span></h4>
                                            <ul class="group-link-default">
                                                <li><a href="#">Dresses</a></li>
                                                <li><a href="#">Coats &amp; Jackets</a></li>
                                                <li><a href="#">Blouses &amp; Shirts</a></li>
                                                <li><a href="#">Tops &amp; Tees</a></li>
                                                <li><a href="#">Hoodies &amp; Sweatshirts</a></li>
                                                <li><a href="#">Intimates</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li> 
                            <li>
                                <a class="parent" href="#"><img class="icon-menu" alt="Funky roots" src="{{url('assets/data/2.png')}}">Máy Tính - Linh Kiện</a>
                                <div class="vertical-dropdown-menu">
                                    <div class="vertical-groups col-sm-12">
                                        <div class="mega-group col-sm-4">
                                            <h4 class="mega-group-header"><span>Điện Thoại</span></h4>
                                            <ul class="group-link-default">
                                                <li><a href="#">Samsung</a></li>
                                                <li><a href="#">OPPO</a></li>
                                                <li><a href="#">Sony</a></li>
                                                <li><a href="#">Asus</a></li>
                                                <li><a href="#">Nokia</a></li>
                                                <li><a href="#">Hãng Khác</a></li>
                                            </ul>
                                        </div>
                                        <div class="mega-group col-sm-4">
                                            <h4 class="mega-group-header"><span>Máy Tính Bảng</span></h4>
                                            <ul class="group-link-default">
                                                <li><a href="#">Dresses</a></li>
                                                <li><a href="#">Coats &amp; Jackets</a></li>
                                                <li><a href="#">Blouses &amp; Shirts</a></li>
                                                <li><a href="#">Tops &amp; Tees</a></li>
                                                <li><a href="#">Hoodies &amp; Sweatshirts</a></li>
                                                <li><a href="#">Intimates</a></li>
                                            </ul>
                                        </div>
                                        <div class="mega-group col-sm-4">
                                            <h4 class="mega-group-header"><span>Phụ Kiện</span></h4>
                                            <ul class="group-link-default">
                                                <li><a href="#">Dresses</a></li>
                                                <li><a href="#">Coats &amp; Jackets</a></li>
                                                <li><a href="#">Blouses &amp; Shirts</a></li>
                                                <li><a href="#">Tops &amp; Tees</a></li>
                                                <li><a href="#">Hoodies &amp; Sweatshirts</a></li>
                                                <li><a href="#">Intimates</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li> 
                            <li>
                                <a class="parent" href="#"><img class="icon-menu" alt="Funky roots" src="{{url('assets/data/2.png')}}">Thời Trang</a>
                                <div class="vertical-dropdown-menu">
                                    <div class="vertical-groups col-sm-12">
                                        <div class="mega-group col-sm-4">
                                            <h4 class="mega-group-header"><span>Điện Thoại</span></h4>
                                            <ul class="group-link-default">
                                                <li><a href="#">Samsung</a></li>
                                                <li><a href="#">OPPO</a></li>
                                                <li><a href="#">Sony</a></li>
                                                <li><a href="#">Asus</a></li>
                                                <li><a href="#">Nokia</a></li>
                                                <li><a href="#">Hãng Khác</a></li>
                                            </ul>
                                        </div>
                                        <div class="mega-group col-sm-4">
                                            <h4 class="mega-group-header"><span>Máy Tính Bảng</span></h4>
                                            <ul class="group-link-default">
                                                <li><a href="#">Dresses</a></li>
                                                <li><a href="#">Coats &amp; Jackets</a></li>
                                                <li><a href="#">Blouses &amp; Shirts</a></li>
                                                <li><a href="#">Tops &amp; Tees</a></li>
                                                <li><a href="#">Hoodies &amp; Sweatshirts</a></li>
                                                <li><a href="#">Intimates</a></li>
                                            </ul>
                                        </div>
                                        <div class="mega-group col-sm-4">
                                            <h4 class="mega-group-header"><span>Phụ Kiện</span></h4>
                                            <ul class="group-link-default">
                                                <li><a href="#">Dresses</a></li>
                                                <li><a href="#">Coats &amp; Jackets</a></li>
                                                <li><a href="#">Blouses &amp; Shirts</a></li>
                                                <li><a href="#">Tops &amp; Tees</a></li>
                                                <li><a href="#">Hoodies &amp; Sweatshirts</a></li>
                                                <li><a href="#">Intimates</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li> 
                            
                            <li>
                                <a href="#">
                                    <img class="icon-menu" alt="Funky roots" src="{{url('assets/data/5.png')}}">
                                    Television
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img class="icon-menu" alt="Funky roots" src="{{url('assets/data/7.png')}}">Computers &amp; Networking
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img class="icon-menu" alt="Funky roots" src="{{url('assets/data/6.png')}}">
                                    Toys &amp; Hobbies
                                </a>
                            </li>
                            <li class="cat-link-orther">
                            <a href="#"><img class="icon-menu" alt="Funky roots" src="{{url('assets/data/9.png')}}">Jewelry &amp; Watches</a></li>
                        </ul>
                        <div class="all-category"><span class="open-cate">Xem Thêm</span></div>
                    </div>
                </div>
                </div>
                <div id="main-menu" class="col-sm-9 main-menu">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <i class="fa fa-bars"></i>
                                </button>
                                <a class="navbar-brand" href="#">MENU</a>
                            </div>
                            <div id="navbar" class="navbar-collapse collapse">
                                <ul class="nav navbar-nav">
                                    <li class="active"><a href="#">Home</a></li>
                                    <li class="dropdown">
                                        <a href="category.html" class="dropdown-toggle" data-toggle="dropdown">Fashion</a>
                                        <ul class="dropdown-menu mega_dropdown" role="menu" style="width: 830px;">
                                            <li class="block-container col-sm-3">
                                                <ul class="block">
                                                    <li class="img_container">
                                                        <a href="#">
                                                            <img class="img-responsive" src="{{url('assets/data/men.png')}}" alt="sport">
                                                        </a>
                                                    </li>
                                                    <li class="link_container group_header">
                                                        <a href="#">MEN'S</a>
                                                    </li>
                                                    <li class="link_container"><a href="#">Skirts</a></li>
                                                    <li class="link_container"><a href="#">Jackets</a></li>
                                                    <li class="link_container"><a href="#">Tops</a></li>
                                                    <li class="link_container"><a href="#">Scarves</a></li>
                                                    <li class="link_container"><a href="#">Pants</a></li>
                                                </ul>
                                            </li>
                                             <li class="block-container col-sm-3">
                                                <ul class="block">
                                                    <li class="img_container">
                                                        <a href="#">
                                                            <img class="img-responsive" src="{{url('assets/data/women.png')}}" alt="sport">
                                                        </a>
                                                    </li>
                                                    <li class="link_container group_header">
                                                        <a href="#">WOMEN'S</a>
                                                    </li>
                                                    <li class="link_container"><a href="#">Skirts</a></li>
                                                    <li class="link_container"><a href="#">Jackets</a></li>
                                                    <li class="link_container"><a href="#">Tops</a></li>
                                                    <li class="link_container"><a href="#">Scarves</a></li>
                                                    <li class="link_container"><a href="#">Pants</a></li>
                                                </ul>
                                            </li>
                                             <li class="block-container col-sm-3">
                                                <ul class="block">
                                                    <li class="img_container">
                                                        <a href="#">
                                                            <img class="img-responsive" src="{{url('assets/data/kid.png')}}" alt="sport">
                                                        </a>
                                                    </li>
                                                    <li class="link_container group_header">
                                                        <a href="#">Kids</a>
                                                    </li>
                                                    <li class="link_container"><a href="#">Shoes</a></li>
                                                    <li class="link_container"><a href="#">Clothing</a></li>
                                                    <li class="link_container"><a href="#">Tops</a></li>
                                                    <li class="link_container"><a href="#">Scarves</a></li>
                                                    <li class="link_container"><a href="#">Accessories</a></li>
                                                </ul>
                                            </li>
                                             <li class="block-container col-sm-3">
                                                <ul class="block">
                                                    <li class="img_container">
                                                        <a href="#">
                                                            <img class="img-responsive" src="{{url('assets/data/trending.png')}}" alt="sport">
                                                        </a>
                                                    </li>
                                                    <li class="link_container group_header">
                                                        <a href="#">TRENDING</a>
                                                    </li>
                                                    <li class="link_container"><a href="#">Men's Clothing</a></li>
                                                    <li class="link_container"><a href="#">Kid's Clothing</a></li>
                                                    <li class="link_container"><a href="#">Women's Clothing</a></li>
                                                    <li class="link_container"><a href="#">Accessories</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a href="category.html" class="dropdown-toggle" data-toggle="dropdown">Sports</a></li>
                                    <li class="dropdown">
                                        <a href="category.html" class="dropdown-toggle" data-toggle="dropdown">Foods</a>
                                            <ul class="mega_dropdown dropdown-menu" style="width: 830px;">
                                            <li class="block-container col-sm-3">
                                                <ul class="block">
                                                    <li class="link_container group_header">
                                                        <a href="#">Asian</a>
                                                    </li>
                                                    <li class="link_container">
                                                        <a href="#">Vietnamese Pho</a>
                                                    </li>
                                                    <li class="link_container">
                                                        <a href="#">Noodles</a>
                                                    </li>
                                                    <li class="link_container">
                                                        <a href="#">Seafood</a>
                                                    </li>
                                                    <li class="link_container group_header">
                                                        <a href="#">Sausages</a>
                                                    </li>
                                                    <li class="link_container">
                                                        <a href="#">Meat Dishes</a>
                                                    </li>
                                                    <li class="link_container">
                                                        <a href="#">Desserts</a>
                                                    </li>
                                                    <li class="link_container">
                                                        <a href="#">Tops</a>
                                                    </li>
                                                    <li class="link_container">
                                                        <a href="#">Tops</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="block-container col-sm-3">
                                                <ul class="block">
                                                    <li class="link_container group_header">
                                                        <a href="#">European</a>
                                                    </li>
                                                    <li class="link_container">
                                                        <a href="#">Greek Potatoes</a>
                                                    </li>
                                                    <li class="link_container">
                                                        <a href="#">Famous Spaghetti</a>
                                                    </li>
                                                    <li class="link_container">
                                                        <a href="#">Famous Spaghetti</a>
                                                    </li>
                                                    <li class="link_container group_header">
                                                        <a href="#">Chicken</a>
                                                    </li>
                                                    <li class="link_container">
                                                        <a href="#">Italian Pizza</a>
                                                    </li>
                                                    <li class="link_container">
                                                        <a href="#">French Cakes</a>
                                                    </li>
                                                    <li class="link_container">
                                                        <a href="#">Tops</a>
                                                    </li>
                                                    <li class="link_container">
                                                        <a href="#">Tops</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="block-container col-sm-3">
                                                <ul class="block">
                                                    <li class="link_container group_header">
                                                        <a href="#">FAST</a>
                                                    </li>
                                                    <li class="link_container">
                                                        <a href="#">Hamberger</a>
                                                    </li>
                                                    <li class="link_container">
                                                        <a href="#">Pizza</a>
                                                    </li>
                                                    <li class="link_container">
                                                        <a href="#">Noodles</a>
                                                    </li>
                                                    <li class="link_container group_header">
                                                        <a href="#">Sandwich</a>
                                                    </li>
                                                    <li class="link_container">
                                                        <a href="#">Salad</a>
                                                    </li>
                                                    <li class="link_container">
                                                        <a href="#">Paste</a>
                                                    </li>
                                                    <li class="link_container">
                                                        <a href="#">Tops</a>
                                                    </li>
                                                    <li class="link_container">
                                                        <a href="#">Tops</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="block-container col-sm-3">
                                                <ul class="block">
                                                    <li class="img_container">
                                                        <img src="{{url('assets/data/banner-topmenu.jpg')}}" alt="Banner">
                                                    </li>
                                                </ul>
                                            </li>

                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="category.html" class="dropdown-toggle" data-toggle="dropdown">Digital</a>
                                        <ul class="dropdown-menu container-fluid">
                                            <li class="block-container">
                                                <ul class="block">
                                                    <li class="link_container"><a href="#">Mobile</a></li>
                                                    <li class="link_container"><a href="#">Tablets</a></li>
                                                    <li class="link_container"><a href="#">Laptop</a></li>
                                                    <li class="link_container"><a href="#">Memory Cards</a></li>
                                                    <li class="link_container"><a href="#">Accessories</a></li>
                                                </ul>
                                            </li>
                                        </ul> 
                                    </li>
                                    <li><a href="category.html">Furniture</a></li>
                                    <li><a href="category.html">Jewelry</a></li>
                                    <li><a href="category.html">Blog</a></li>
                                </ul>
                            </div><!--/.nav-collapse -->
                        </div>
                    </nav>
                </div>
            </div>
            <!-- userinfo on top-->
            <div id="form-search-opntop">
            </div>
            <!-- userinfo on top-->
            <div id="user-info-opntop">
            </div>
            <!-- CART ICON ON MMENU -->
            <div id="shopping-cart-box-ontop">
                <i class="fa fa-shopping-cart"></i>
                <div class="shopping-cart-box-ontop-content"></div>
            </div>
        </div>
    </div>
</div>
<!-- end header -->
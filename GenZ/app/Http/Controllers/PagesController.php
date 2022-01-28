<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModNews;
use App\ModProduct;
use App\ListNews;
use App\ListProduct;
use App\News;
use App\Product;
use App\Cities;
use App\Districts;
use App\Wards;
use App\Dborder;
use App\DborderProduct;
use App\Slide;
use App\Setting;

use DB,Cart;

class PagesController extends Controller
{
	public function public_var(){ 
        $slide    = Slide::orderBy('created_at', 'desc')->get();
        $setting    = Setting::find(1);       
        
        $result = array(
            "slide"=>$slide ,
            "setting"=>$setting,            
            );
        return $result;
    }
// =========getdata to return ====================================
    public function api_get_setting($value='')
    {
        $data = Setting::find(1);
        return response()->json($data);
    }
    public function get_mod_list_info()
    {
        $mod = ModProduct::orderBy('mod_number','DESC')->get();
        $list = ListProduct::orderBy('list_number','DESC')->get();
        $rs = array_merge([ 'mod'=>$mod ,
                            'list'=>$list
                            ]);
        return response()->json((object)$rs);
    }
    public function get_mod_listnews_info()
    {
        $mod = ModNews::orderBy('mod_number','DESC')->get();
        $list = ListNews::orderBy('list_number','DESC')->get();
        $rs = array_merge([ 'mod'=>$mod ,
                            'list'=>$list
                            ]);
        return response()->json((object)$rs);
    }
    public function get_cities()
    {
        $data = Cities::all();
        return response()->json((object)$data);

    }
    public function get_districts_by_city($id)
    {
        $list = Districts::where('idcity',$id)->orderBy('name','ASC')->get();
        $html = "<option value='' disabled selected> -Hãy chọn tỉnh/thành-</option>";
        foreach ($list as $key) {
            $html.="<option value=".$key->id.">".$key->name."</option>";
        }
        return response()->json($html);
    } 
    public function get_shipping_fee($id)
    {
        $ct = Cities::where('id',$id)->first();
        return response()->json($ct->areashipping);
    } 
    public function api_submit_order(Request $rq)
    {
        $check = $this->validate($rq,[
            'city' =>'required',
            'district' =>'required',
            'name' =>'required',
            'phone' =>'required',
            'email' =>'required|email',
            'address' =>'required',
        ],[
            'city.required'=>'Hãy chọn tỉnh/thành',
            'district.required'=>'Hãy chọn quận/huyện',
            'name.required'=>'Vui lòng nhập đầy đủ tên.',
            'phone.required'=>'Hãy nhập số điện thoại',
            'email.required'=>'Hãy nhập Email',
            'email.email'=>'Hãy nhập đúng Email',
            'address.required'=>'Vui lòng nhập địa chỉ',
        ]);

        $city = Cities::where('id',$rq->city)->first();       
        $district = Districts::where('id',$rq->district)->first();
        $full_address =  $city->name.' - '.$district->name.' - '.$rq->address;
        $order = new Dborder();
        $order->name = $rq->name;
        $order->address = $full_address;
        $order->shipping_address = $full_address;
        $order->phone = $rq->phone;
        $order->email = $rq->email;
        $order->order_total = $rq->carts_sum['total_pay'];
        $order->ship_fee = $city->areashipping;
        $order->order_totalpay = $rq->carts_sum['total_pay'] + $city->areashipping;
        $order->order_comment = $rq->note;
        $order->shipping_name = $rq->name;
        $order->shipping_phone = $rq->phone;
        $order->id_user = $rq->user;
        $order->save();
        $id= $order->id;
        foreach ($rq->carts as $item) {            
            $o_pro = new DborderProduct();            
            $o_pro->order_pro_name = $item['name'];
            $o_pro->order_pro_qty = $item['qty'];
            $o_pro->order_pro_price = $item['options']['price_with_sale'];
            $o_pro->order_pro_total = $item['qty'] * $item['options']['price_with_sale'];
            $o_pro->id_product = $item['id'];
            $o_pro->id_dborder = $id;
            $o_pro->save();
        }

        //  #tao noi dung email
        // $content = view('mail.orders', [
        //                                 'name'              => $order->name,
        //                                 'created_at'        => $order->created_at,
        //                                 'address'           => $order->address,
        //                                 'phone'             => $order->phone,
        //                                 'total_payment'     => $order->order_totalpay,
        //                                 'qty'               => $rq->carts_sum['total_qty'],
        //                                 'status'            => $order->order_status,
        //                                 'comment'           => $order->order_comment,
        //                                 ])->render();
        // $title = "Đơn hàng - TQNPHONEs"; 
        // $sub_title = "Thông báo order tại TQNPHONEs, ";
        // // send mail C3 
        // sendMail($order->email, $title, $sub_title, $content);
        Cart::destroy();       
    }
    public function apiget_mod_info_by_slug($mod_slug,$list_slug)
    {
        if ($list_slug != 'empty') {
            $mod = ModProduct::where('mod_slug',$mod_slug)->first();
            $list = ListProduct::where('list_slug',$list_slug)->where('id_mod',$mod->id)->first();
            
        }else {
            $mod = ModProduct::where('mod_slug',$mod_slug)->first();
            $list = 'all';
        }
        $rs = array_merge([ 'mod_info'=>$mod ,
                            'list_info'=>$list
                            ]);
        return response()->json((object)$rs);      
    }
    // product in category 
    public function getproduct_in_category($mod_slug,$list_slug =null)
    {
        if ($list_slug != null) {
            $mod = ModProduct::where('mod_slug',$mod_slug)->first();
            $list = ListProduct::where('list_slug',$list_slug)->where('id_mod',$mod->id)->first();
            $data = Product::where('list_id',$list->id)->orderBy('pro_view','DESC')->paginate(12);
        }else {
            $mod = ModProduct::where('mod_slug',$mod_slug)->first();
            $list = ListProduct::where('id_mod',$mod->id)->pluck('id');
            $data = Product::whereIn('list_id',$list)->orderBy('pro_view','DESC')->paginate(12);
        }
        return response()->json($data);        
    }
    public function index_product()
    {
        
        $pro_arr = array( );

        $mod = ModProduct::get();
        foreach ($mod as $key) {
            $list_arr = ListProduct::where('id_mod',$key->id)->pluck('id');
            $pro[0] = $key->id;
            $pro[1] = Product::whereIn('list_id',$list_arr)->orderBy('pro_view','DESC')->take(8)->get();
            array_push($pro_arr, (object)$pro);
        }
        $rs = array_merge([ 'modpro_all'=>$mod ,
                            'pro'=>$pro_arr
                            ]);
        return response()->json((object)$rs);
    }
// =========================cart=========================
    public function api_get_cart()
    {
        $carts = Cart::content(); 
        $cart_sum_info['total_pay'] = clear_format_curency(Cart::total(),'USD');
        $cart_sum_info['total_qty'] = Cart::count();
        $cart_sum_info = (object)$cart_sum_info;
        $rs = array_merge([ 'carts'=>$carts ,
                            'cart_sum_info'=>$cart_sum_info
                            ]);
        return response()->json((object)$rs);
    }

    public function api_post_addcart(Request $request){
        $idproduct = $request->id_pro;
        $product = Product::where('id',$idproduct)->first();

        if(!empty($product->pro_price) && $product->pro_price != 0){                            
            if(!empty($product->pro_sale) || $product->pro_sale != 0){                            
                $price_with_sale = $product->pro_sale;
                $price_no_sale = $product->pro_price;
                $price_show = $product->pro_sale;
            }else{                          
                $price_with_sale = 0;
                $price_no_sale = $product->pro_price;
                $price_show = $product->pro_price;
            }            

            Cart::add(['id' => $idproduct, 
                        'name' => $product->pro_name, 
                        'qty' => 1, 
                        'price' => $price_with_sale, 
                        'options' => ['image' => $product->pro_image, 
                                        'unit' => $product->pro_unit, 
                                        'currency' => 'VND', 
                                        'price_show' => $price_show,
                                        'price' => $product->pro_price,
                                        'price_with_sale' => $price_with_sale, 
                                        'price_no_sale' => $price_no_sale]]);           
            $cart      = Cart::content();
            foreach ($cart as $item) {
                $price      = $item->options->price_with_sale;
                $price_show = $item->options->price;                
                Cart::update( $item->rowId, ['id' => $item->id, 
                'name' => $item->name, 
                'qty' => $item->qty, 
                'price' => $price, 
                'options' => ['image' => $item->options->image, 
                                'unit' => $item->options->unit, 
                                'currency' => $item->options->currency, 
                                'price_show' => $price_show,
                                'price' => $item->options->price,
                                'price_with_sale' => $item->options->price_with_sale, 
                                'price_no_sale' => $item->options->price_no_sale]]);
            }            
            return response()->json(1);
        }else{
            $carts = Cart::content();
            return response()->json(0);
        }
    }
    public function api_post_removecart_item(Request $request){
        $data = Cart::remove($request->rowId);
        return response()->json($data);
    }   
    public function api_destroy_cart()
    {
        Cart::destroy();
        return response()->json(1);
    }
// =========================end cart=========================
    public function api_detail_pro($pro_id,$pro_slug)
    {
        $pro = Product::where('id',$pro_id)->where('pro_slug',$pro_slug)->first();
        $list = ListProduct::find($pro->list_id);
        $list_arr = ListProduct::where('id_mod',$list->id_mod)->pluck('id');
        $new_pro = Product::wherein('list_id',$list_arr)->where('id','<>',$pro->id)->orderBy('created_at','DESC')->take(10)->get();
        $rs = array_merge([ 'pro'=>$pro ,
                            'new_pro'=>$new_pro
                            ]);
        return response()->json((object)$rs);
    }
    public function api_tintuc()
    {
        $new = News::orderBy('created_at','DESC')->paginate(12);
        return response()->json($new);
    }
    public function api_detail_news($news_id,$news_slug)
    {
        $pro = News::where('id',$news_id)->where('news_slug',$news_slug)->first();
        $list = ListNews::find($pro->id_listnews);

        $list_arr = ListNews::where('id_modnews',$list->id_modnews)->pluck('id');
        $new_pro = News::wherein('id_listnews',$list_arr)->where('id','<>',$pro->id)->orderBy('created_at','DESC')->take(10)->get();
        $rs = array_merge([ 'pro'=>$pro ,
                            'new_pro'=>$new_pro
                            ]);
        return response()->json((object)$rs);
    }
// =========getdata to return ============================
// ==========return view blade laravel ==============================
    public function index()
    {
        $public_var = $this->public_var();
        return view('home.index', $public_var);
    }
    public function list_new()
    {
    	$public_var = $this->public_var();
        return view('home.index', $public_var);
    }
   
// ============= view blade laravel ==========================
}

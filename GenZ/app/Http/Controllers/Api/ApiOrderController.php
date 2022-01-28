<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModProduct;
use App\ListProduct;
use App\Product;
use App\Dborder;
use App\DborderProduct;
use DB;
use DateTime;

class ApiOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function getorderlist(){
        $listorder = Dborder::orderBy('id','DESC')->paginate(12);
	    return response()->json($listorder);
    }
    public function AddNew(Request $request){

		$this->validate($request,[
			'name' =>'required',
			'number' =>'required',
			'type' =>'required',
			'id_modnews' =>'required',
			'description' =>'required',
		],[
			'name.required'=>'Tên không được để trống',
			'number.required'=>'Thứ tự không được để trống',
			'type.required'=>'Phải chọn một trạng thái.',
			'id_modnews.required'=>'Hãy chọn danh mục cha',
			'description.required'=>'Hãy nhập mô tả',
		]);

		$mod = ModNews::find($request->id_modnews);
		if($request->get('image'))
       	{
          $image = $request->get('image');
          $name = upload_image_vue($image,'ListNews');

          $config = [
	            'list_name' => $request->name,
	            'list_slug' => str_slug($request->name,'-'),
	            'list_number' => $request->number,
	            'list_type' => $request->type,
	            'id_modnews' => $request->id_modnews,
	            'mod_name' => $mod->mod_name,
	            'list_icon' => $name,
	            'list_description' => $request->description,
	        ];
        }else {
        	$config = [
	            'list_name' => $request->name,
	            'list_slug' => str_slug($request->name,'-'),
	            'list_number' => $request->number,
	            'list_type' => $request->type,
	            'id_modnews' => $request->id_modnews,
	            'mod_name' => $mod->mod_name,
	            'list_description' => $request->description,
	        ];
        }
        
        DB::table('listnews')->insert($config);
	}
	public function getbyid($id){
	    $item = Dborder::find($id);
	    return response()->json($item);
	}
	public function Deleteorder($id){
	    $listNews = ListNews::find($id);

		if($listNews->list_icon !="/images/noimg.jpg"){
            while(file_exists(public_path($listNews->list_icon)))
            {
                unlink(public_path($listNews->list_icon));
            }
        }
	    $listNews->delete();
	    return response()->json($listNews);
	}
	public function getproductlist($o_id)
	{
		$pro = DB::table('products')->join('dbordersproduct', 'products.id', '=', 'dbordersproduct.id_product')
		->select('dbordersproduct.id as id','dbordersproduct.order_pro_qty','dbordersproduct.order_pro_price','products.id as pro_id','products.pro_name','products.pro_name','products.pro_slug','products.pro_image','products.pro_price','products.pro_sale','products.pro_unit','products.pro_status','products.pro_name')
		->where('dbordersproduct.id_dborder',$o_id)->get();
		return response()->json($pro);
	}
	public function remove_product($id)
	{
		$pro = DborderProduct::find($id);		
		$order = Dborder::where('id',$pro->id_dborder)->first();
		$order->order_total = $order->order_total - $pro->order_pro_total;
		$order->order_totalpay = $order->order_totalpay - $pro->order_pro_total;
		$order->updated_at = new DateTime();
		$order->save();
		$pro->delete();
		return response()->json($pro);
	}
	public function postupdatestatus(Request $request)
	{
		$orde = Dborder::find($request->id);
		$orde->order_status = $request->status;
		$orde->save();
		return response()->json($orde);
	}
	public function getpro_inlist($list_id)
	{
		$pro = Product::where('list_id',$list_id)->orderBy('id','DESC')->paginate(10);
		return response()->json($pro);
	}
	public function getmodlist()
	{
		$mod = ModProduct::get();
		return response()->json($mod);
	}
	public function addpro_to_order(Request $request)
	{
		$pro_item = Product::where('id',$request->id_pro)->first();
		$o_pro =  new DborderProduct();
		$o_pro->order_pro_name = $pro_item->pro_name;
		$o_pro->order_pro_price = $pro_item->pro_price;
		$o_pro->order_pro_qty  = $request->qty_pro;
		$o_pro->order_pro_total = $pro_item->pro_price * $request->qty_pro;
		$o_pro->id_product = $pro_item->id;
		$o_pro->id_dborder = $request->o_id;
		$o_pro->updated_at = new DateTime();
		$o_pro->save();
		$order = Dborder::find($request->o_id);
		$order->order_total = $order->order_total + $o_pro->order_pro_total;
		$order->order_totalpay = $order->order_totalpay + $o_pro->order_pro_total;
		$order->updated_at = new DateTime();
		$order->save();
		return response()->json($o_pro);
	}
	public function order_his()
	{
		$order = Dborder::join('dbordersproduct','dborders.id','=','dbordersproduct.id_dborder')
		->select('*')
		->selectRaw('count(DAY(dborders.created_at)) as sl')
		
		->get();
		return response()->json($order);
	}
}

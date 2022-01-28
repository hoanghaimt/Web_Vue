<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModProduct;
use App\ListProduct;
use App\Product;
use DB;

class ApiProduct extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
	public function GetAllProduct(){
	    $product = Product::orderBy('id','DESC')->paginate(12);
	    return response()->json($product);
	}
	public function AddNewProduct(Request $request){

		$this->validate($request,[
			'name' =>'required',
			'price' =>'required',
			'list_id' =>'required',
			'intro' =>'required',
			'content' =>'required',
			'unit' =>'required',
		],[
			'name.required'=>'Tên không được để trống',
			'price.required'=>'Hãy nhập giá bán',
			'list_id.required'=>'Hãy chọn loại danh mục.',
			'intro.required'=>'Hãy nhập mô tả',
			'content.required'=>'Vui lòng nhập thông tin sản phẩm'
		]);
		if($request->get('image'))
       	{
          $image = $request->get('image');
          $img_name = upload_image_vue($image,'Product');
          $list = ListProduct::find($request->list_id);
          $config = [
	            'pro_name' => $request->name,
	            'pro_slug' => str_slug($request->name,'-'),
	            'pro_video' => $request->video,
	            'pro_image' => $img_name,
	            'pro_price' => $request->price,
	            'pro_sale' => $request->sale,
	            'pro_unit' => $request->unit,
	            'pro_intro' => $request->intro,
	            'pro_content' => $request->content,
	            'pro_specs' => $request->specs,
	            'list_id' => $request->list_id,
	            'list_name' => $list->list_name
	        ];
        }else {
        	$config = [
	            'pro_name' => $request->name,
	            'pro_slug' => str_slug($request->name,'-'),
	            'pro_video' => $request->video,
	            'pro_price' => $request->price,
	            'pro_sale' => $request->sale,
	            'pro_unit' => $request->unit,
	            'pro_intro' => $request->intro,
	            'pro_content' => $request->content,
	            'pro_specs' => $request->specs,
	            'list_id' => $request->list_id
	        ];
        }
        $pro = DB::table('products')->insert($config);
	}
	public function getproductbyid($pro_id){
	    $item = Product::find($pro_id);
	    return response()->json($item);
	}
	public function UpdateProduct($id,Request $request){

		$this->validate($request,[
			'name' =>'required',
			'price' =>'required',
			'list_id' =>'required',
			'intro' =>'required',
			'content' =>'required',
			'unit' =>'required',
		],[
			'name.required'=>'Tên không được để trống',
			'price.required'=>'Hãy nhập giá bán',
			'list_id.required'=>'Hãy chọn loại danh mục.',
			'intro.required'=>'Hãy nhập mô tả',
			'content.required'=>'Vui lòng nhập thông tin sản phẩm',
			'unit.required'=>'Vui lòng nhập đơn vị'
		]);		

		if($request->get('image'))
       	{
       		$pro = Product::find($id);
			if($pro->pro_image !="/images/noimg.jpg"){
	            while(file_exists(public_path($pro->pro_image)))
	            {
	                unlink(public_path($pro->pro_image));
	            }
	        }
	        $image = $request->get('image');
	        $img_name = upload_image_vue($image,'Product');
	        $list = ListProduct::find($request->list_id);
	        $config = [
	            'pro_name' => $request->name,
	            'pro_slug' => str_slug($request->name,'-'),
	            'pro_video' => $request->video,
	            'pro_image' => $img_name,
	            'pro_price' => $request->price,
	            'pro_sale' => $request->sale,
	            'pro_unit' => $request->unit,
	            'pro_intro' => $request->intro,
	            'pro_content' => $request->content,
	            'pro_specs' => $request->specs,
	            'list_id' => $request->list_id,
	            'list_name' => $list->list_name
		        ];
	        }else {
	        	$config = [
		            'pro_name' => $request->name,
		            'pro_slug' => str_slug($request->name,'-'),
		            'pro_video' => $request->video,
		            'pro_price' => $request->price,
		            'pro_sale' => $request->sale,
		            'pro_unit' => $request->unit,
		            'pro_intro' => $request->intro,
		            'pro_content' => $request->content,
		            'pro_specs' => $request->specs,
		            'list_id' => $request->list_id
		        ];
		    }
	    
        DB::table('products')->where('id', $id)->update($config);
	}
	public function DeleteProduct($id){
	    $product = Product::find($id);

		if($product->pro_image !="/images/noimg.jpg"){
            while(file_exists(public_path($product->pro_image)))
            {
                unlink(public_path($product->pro_image));
            }
        }
	    $product->delete();
	    return response()->json($product);
	}
	public function getmod()
    {
    	$mod = ModProduct::orderBy('id','DESC')->get();
	    return response()->json($mod);
    }
    public function getlistinmod($id_mod)
    {
    	$list = ListProduct::where('id_mod',$id_mod)->orderBy('id','DESC')->get();
    	$html = "<option value='' disabled selected> -Hãy chọn loại danh mục-</option>";
    	foreach ($list as $key) {
    		$html.="<option value=".$key->id.">-- ".$key->list_name."</option>";
    	}
	    return response()->json($html);
    }
    public function renderlistselect($id_list)
    {
    	$list = ListProduct::find($id_list);
    	$mod = ListProduct::where('id_mod',$list->id_mod)->get();
    	if ($mod->count() == 0) {
    		$html = "<option value='' disabled selected> -Hãy chọn loại danh mục-</option>";
    	} else {
    		$html = "<option value='' > -Hãy chọn loại danh mục-</option>";
    		foreach ($mod as $key) {
	    		if ($key->id == $id_list) {
	    			$html.="<option value=".$key->id." selected ='selected'>-- ".$key->list_name."</option>";
	    		} else {
	    			$html.="<option value=".$key->id.">-- ".$key->list_name."</option>";
	    		}
	    		
	    	}
    	}    	
	    return response()->json($html);
    }
}

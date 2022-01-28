<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModProduct;
use App\ListProduct;
use DB;

class ApiListProduct extends Controller
{
    
	public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function GetAllList(){
        $listproducts = ListProduct::orderBy('id','DESC')->paginate(12);
	    return response()->json($listproducts);
    }
    public function getmod()
    {
    	$mod = ModProduct::orderBy('id','DESC')->get();
	    return response()->json($mod);
    }
    public function AddNewList(Request $request){

		$this->validate($request,[
			'name' =>'required',
			'number' =>'required',
			'type' =>'required',
			'id_mod' =>'required',
			'description' =>'required',
		],[
			'name.required'=>'Tên không được để trống',
			'number.required'=>'Thứ tự không được để trống',
			'type.required'=>'Phải chọn một trạng thái.',
			'id_mod.required'=>'Hãy chọn danh mục cha',
			'description.required'=>'Hãy nhập mô tả',
		]);

		$mod = ModProduct::find($request->id_mod);
		if($request->get('image'))
       	{
          $image = $request->get('image');
          $name = upload_image_vue($image,'ListProduct');

          $config = [
	            'list_name' => $request->name,
	            'list_slug' => str_slug($request->name,'-'),
	            'list_number' => $request->number,
	            'list_type' => $request->type,
	            'id_mod' => $request->id_mod,
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
	            'id_mod' => $request->id_mod,
	            'mod_name' => $mod->mod_name,
	            'list_description' => $request->description,
	        ];
        }
        
        DB::table('listproducts')->insert($config);
	}
	public function getlistbyid($id){
	    $item = ListProduct::find($id);
	    return response()->json($item);
	}
	public function UpdateList($id,Request $request){
		$mod = ModProduct::find($request->id_mod);
		$this->validate($request,[
			'name' =>'required',
			'number' =>'required',
			'type' =>'required',
			'id_mod' =>'required',
			'description' =>'required',
		],[
			'name.required'=>'Tên không được để trống',
			'number.required'=>'Thứ tự không được để trống',
			'type.required'=>'Phải chọn một trạng thái.',
			'id_mod.required'=>'Hãy chọn danh mục cha',
			'description.required'=>'Hãy nhập mô tả',
		]);

		if($request->get('image')){
			$list = ListProduct::find($id);
			if($list->list_icon !="/images/noimg.jpg"){
	            while(file_exists(public_path($list->list_icon)))
	            {
	                unlink(public_path($list->list_icon));
	            }
	        }
          	$image = $request->get('image');
          	$name = upload_image_vue($image,'ListProduct');
          	$config = [
	            'list_name' => $request->name,
	            'list_slug' => str_slug($request->name,'-'),
	            'list_number' => $request->number,
	            'list_type' => $request->type,
	            'id_mod' => $request->id_mod,
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
	            'id_mod' => $request->id_mod,
	            'mod_name' => $mod->mod_name,
	            'list_description' => $request->description,
	        ];
        }
	    
        DB::table('listproducts')->where('id', $id)->update($config);
	}
	public function DeleteList($id){
	    $listproduct = ListProduct::find($id);

		if($listproduct->list_icon !="/images/noimg.jpg"){
            while(file_exists(public_path($listproduct->list_icon)))
            {
                unlink(public_path($listproduct->list_icon));
            }
        }
	    $listproduct->delete();
	    return response()->json($listproduct);
	}
}

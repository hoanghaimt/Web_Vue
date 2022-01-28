<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModProduct;
use App\ListProduct;
use DB;
class ApiModProduct extends Controller
{	
	public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
	public function GetAllMod(){
	    $modproduct = ModProduct::orderBy('id','DESC')->paginate(12);
	    return response()->json($modproduct);
	}
	public function AddNewMod(Request $request){

		$this->validate($request,[
			'name' =>'required',
			'number' =>'required',
			'type' =>'required',
			'description' =>'required',
		],[
			'name.required'=>'Tên không được để trống',
			'number.required'=>'Thứ tự không được để trống',
			'type.required'=>'Phải chọn một trạng thái.',
			'description.required'=>'Hãy nhập mô tả',
		]);
		if($request->get('image'))
       	{
          $image = $request->get('image');
          $name = upload_image_vue($image,'ModProduct');

          $config = [
	            'mod_name' => $request->name,
	            'mod_slug' => str_slug($request->name,'-'),
	            'mod_number' => $request->number,
	            'mod_type' => $request->type,
	            'mod_icon' => $name,
	            'mod_description' => $request->description,
	        ];
        }else {
        	$config = [
	            'mod_name' => $request->name,
	            'mod_slug' => str_slug($request->name,'-'),
	            'mod_number' => $request->number,
	            'mod_type' => $request->type,
	            'mod_description' => $request->description,
	        ];
        }
        
        DB::table('modproducts')->insert($config);
	}
	public function getmodbyid($id){
	    $item = ModProduct::find($id);
	    return response()->json($item);
	}
	public function UpdateMod($id,Request $request){

		$this->validate($request,[
			'name' =>'required',
			'number' =>'required',
			'type' =>'required',
			'description' =>'required',
		],[
			'name.required'=>'Tên không được để trống',
			'number.required'=>'Thứ tự không được để trống',
			'type.required'=>'Phải chọn một trạng thái.',
			'description.required'=>'Hãy nhập mô tả',
		]);

		if($request->get('image')){

			$mod = ModProduct::find($id);
			if($mod->mod_icon !="/images/noimg.jpg"){
	            while(file_exists(public_path($mod->mod_icon)))
	            {
	                unlink(public_path($mod->mod_icon));
	            }
	        }
          	$image = $request->get('image');
          	$name = upload_image_vue($image,'ModProduct');
          	$config = [
	            'mod_name' => $request->name,
	            'mod_slug' => str_slug($request->name,'-'),
	            'mod_number' => $request->number,
	            'mod_type' => $request->type,
	            'mod_icon' => $name,
	            'mod_description' => $request->description,
        	];
        } else {
        	$config = [
	            'mod_name' => $request->name,
	            'mod_slug' => str_slug($request->name,'-'),
	            'mod_number' => $request->number,
	            'mod_type' => $request->type,
	            'mod_description' => $request->description,
	        ];
        }
	    
        DB::table('modproducts')->where('id', $id)->update($config);
	}
	public function DeleteMod($id){
	    $modproduct = ModProduct::find($id);

		if($modproduct->mod_icon !="/images/noimg.jpg"){
            while(file_exists(public_path($modproduct->mod_icon)))
            {
                unlink(public_path($modproduct->mod_icon));
            }
        }

	    $modproduct->delete();
	    return response()->json($modproduct);
	}
}

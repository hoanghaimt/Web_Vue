<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModNews;
use App\ListNews;
use DB;

class ApiListNews extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function GetAllList(){
        $listNews = ListNews::orderBy('id','DESC')->paginate(12);
	    return response()->json($listNews);
    }
    public function getmod()
    {
    	$mod = ModNews::orderBy('id','DESC')->get();
	    return response()->json($mod);
    }
    public function AddNewList(Request $request){

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
	public function getlistbyid($id){
	    $item = ListNews::find($id);
	    return response()->json($item);
	}
	public function UpdateList($id,Request $request){
		$mod = ModNews::find($request->id_modnews);
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

		if($request->get('image')){
			$list = ListNews::find($id);
			if($list->list_icon !="/images/noimg.jpg"){
	            while(file_exists(public_path($list->list_icon)))
	            {
	                unlink(public_path($list->list_icon));
	            }
	        }
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
	    
        DB::table('listnews')->where('id', $id)->update($config);
	}
	public function DeleteList($id){
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
}

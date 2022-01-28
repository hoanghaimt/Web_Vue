<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModNews;
use App\ListNews;
use App\News;
use DB;

class ApiNews extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
	public function GetAllProduct(){
	    $product = News::orderBy('id','DESC')->paginate(12);
	    return response()->json($product);
	}
	public function AddNewProduct(Request $request){

		$this->validate($request,[
			'name' =>'required',
			'list_id' =>'required',
			'intro' =>'required',
			'content' =>'required',
		],[
			'name.required'=>'Tên không được để trống',
			'list_id.required'=>'Hãy chọn loại danh mục.',
			'intro.required'=>'Hãy mô tả nhanh bản tin',
			'content.required'=>'Vui lòng soạn nội dung'
		]);
		if($request->get('image'))
       	{
          $image = $request->get('image');
          $img_name = upload_image_vue($image,'News');
          $list = ListNews::find($request->list_id);
          $config = [
	            'news_name' => $request->name,
	            'news_slug' => str_slug($request->name,'-'),
	            'news_video' => $request->video,
	            'news_image' => $img_name,	            
	            'news_intro' => $request->intro,
	            'news_content' => $request->content,	            
	            'news_keywords' => $request->keywords,	            
	            'news_tags' => $request->tags,	            
	            'id_listnews' => $request->list_id,
	            'list_name' => $list->list_name
	        ];
        }else {
        	$config = [
	            'news_name' => $request->name,
	            'news_slug' => str_slug($request->name,'-'),
	            'news_video' => $request->video,	            
	            'news_intro' => $request->intro,
	            'news_content' => $request->content,	            
	            'news_keywords' => $request->keywords,	            
	            'news_tags' => $request->tags,	            
	            'id_listnews' => $request->list_id,
	            'list_name' => $list->list_name
	        ];
        }
        $pro = DB::table('news')->insert($config);
	}
	public function getproductbyid($pro_id){
	    $item = News::find($pro_id);
	    return response()->json($item);
	}
	public function UpdateProduct($id,Request $request){

		$this->validate($request,[
			'name' =>'required',
			'list_id' =>'required',
			'intro' =>'required',
			'content' =>'required',
		],[
			'name.required'=>'Tên không được để trống',
			'list_id.required'=>'Hãy chọn loại danh mục.',
			'intro.required'=>'Hãy mô tả nhanh bản tin',
			'content.required'=>'Vui lòng soạn nội dung'
		]);		
		$pro = News::find($id);
		$list = ListNews::find($request->list_id);
		if($request->get('image'))
       	{
			if($pro->news_image !="/images/noimg.jpg"){
	            while(file_exists(public_path($pro->news_image)))
	            {
	                unlink(public_path($pro->news_image));
	            }
	        }
	        $image = $request->get('image');
	        $img_name = upload_image_vue($image,'News');	        
	        $config = [
	            'news_name' => $request->name,
	            'news_slug' => str_slug($request->name,'-'),
	            'news_video' => $request->video,
	            'news_image' => $img_name,	            
	            'news_intro' => $request->intro,
	            'news_content' => $request->content,	            
	            'news_keywords' => $request->keywords,	            
	            'news_tags' => $request->tags,	            
	            'id_listnews' => $request->list_id,
	            'list_name' => $list->list_name
		        ];
	        }else {
	        	$config = [
		            'news_name' => $request->name,
		            'news_slug' => str_slug($request->name,'-'),
		            'news_video' => $request->video,		                       
		            'news_intro' => $request->intro,
		            'news_content' => $request->content,	            
		            'news_keywords' => $request->keywords,	            
		            'news_tags' => $request->tags,	            
		            'id_listnews' => $request->list_id,
		            'list_name' => $list->list_name
		        ];
		    }
	    
        DB::table('news')->where('id', $id)->update($config);
	}
	public function DeleteProduct($id){
	    $product = News::find($id);

		if($product->news_image !="/images/noimg.jpg"){
            while(file_exists(public_path($product->news_image)))
            {
                unlink(public_path($product->news_image));
            }
        }
	    $product->delete();
	    return response()->json($product);
	}
	public function getmod()
    {
    	$mod = ModNews::orderBy('id','DESC')->get();
	    return response()->json($mod);
    }
    public function getlistinmod($id_mod)
    {
    	$list = ListNews::where('id_modnews',$id_mod)->orderBy('id','DESC')->get();
    	$html = "<option value='' disabled selected> -Hãy chọn loại danh mục-</option>";
    	foreach ($list as $key) {
    		$html.="<option value=".$key->id.">-- ".$key->list_name."</option>";
    	}
	    return response()->json($html);
    }
    public function renderlistselect($id_list)
    {
    	$list = ListNews::find($id_list);
    	$mod = ListNews::where('id_modnews',$list->id_modnews)->get();
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

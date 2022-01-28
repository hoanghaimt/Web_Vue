<?php

// Mở composer.json
// Thêm vào trong "autoload" chuỗi sau
// "files": [
//         "app/function/function.php"
// ] 
// Chạy cmd : composer  dumpautoload

 
use Intervention\Image\ImageManagerStatic as Image;
// use \Mail;


function changeTitle($str,$strSymbol='-',$case=MB_CASE_LOWER){// MB_CASE_UPPER / MB_CASE_TITLE / MB_CASE_LOWER
	$str=trim($str);
	if ($str=="") return "";
	$str =str_replace('"','',$str);
	$str =str_replace("'",'',$str);
	$str = stripUnicode($str);
	$str = mb_convert_case($str,$case,'utf-8');
	$str = preg_replace('/[\W|_]+/',$strSymbol,$str);
	return $str;
}

function stripUnicode($str){
	if(!$str) return '';
	//$str = str_replace($a, $b, $str);
	$unicode = array(
		'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ|å|ä|æ|ā|ą|ǻ|ǎ',
		'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ|Å|Ä|Æ|Ā|Ą|Ǻ|Ǎ',
		'ae'=>'ǽ',
		'AE'=>'Ǽ',
		'c'=>'ć|ç|ĉ|ċ|č',
		'C'=>'Ć|Ĉ|Ĉ|Ċ|Č',
		'd'=>'đ|ď',
		'D'=>'Đ|Ď',
		'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|ë|ē|ĕ|ę|ė',
		'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ|Ë|Ē|Ĕ|Ę|Ė',
		'f'=>'ƒ',
		'F'=>'',
		'g'=>'ĝ|ğ|ġ|ģ',
		'G'=>'Ĝ|Ğ|Ġ|Ģ',
		'h'=>'ĥ|ħ',
		'H'=>'Ĥ|Ħ',
		'i'=>'í|ì|ỉ|ĩ|ị|î|ï|ī|ĭ|ǐ|į|ı',	  
		'I'=>'Í|Ì|Ỉ|Ĩ|Ị|Î|Ï|Ī|Ĭ|Ǐ|Į|İ',
		'ij'=>'ĳ',	  
		'IJ'=>'Ĳ',
		'j'=>'ĵ',	  
		'J'=>'Ĵ',
		'k'=>'ķ',	  
		'K'=>'Ķ',
		'l'=>'ĺ|ļ|ľ|ŀ|ł',	  
		'L'=>'Ĺ|Ļ|Ľ|Ŀ|Ł',
		'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|ö|ø|ǿ|ǒ|ō|ŏ|ő',
		'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ|Ö|Ø|Ǿ|Ǒ|Ō|Ŏ|Ő',
		'Oe'=>'œ',
		'OE'=>'Œ',
		'n'=>'ñ|ń|ņ|ň|ŉ',
		'N'=>'Ñ|Ń|Ņ|Ň',
		'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|û|ū|ŭ|ü|ů|ű|ų|ǔ|ǖ|ǘ|ǚ|ǜ',
		'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự|Û|Ū|Ŭ|Ü|Ů|Ű|Ų|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ',
		's'=>'ŕ|ŗ|ř',
		'R'=>'Ŕ|Ŗ|Ř',
		's'=>'ß|ſ|ś|ŝ|ş|š',
		'S'=>'Ś|Ŝ|Ş|Š',
		't'=>'ţ|ť|ŧ',
		'T'=>'Ţ|Ť|Ŧ',
		'w'=>'ŵ',
		'W'=>'Ŵ',
		'y'=>'ý|ỳ|ỷ|ỹ|ỵ|ÿ|ŷ',
		'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ|Ÿ|Ŷ',
		'z'=>'ź|ż|ž',
		'Z'=>'Ź|Ż|Ž',
		'-'=>'–'
	);
	foreach($unicode as $khongdau=>$codau) {
		$arr=explode("|",$codau);
		$str = str_replace($arr,$khongdau,$str);
	}
	return $str;
}

function format_curency($val,$type){
	$curency_code =$type;
	$result = "";
	if($curency_code == "VND"){
		$result = number_format((float)$val, 0, ".", ".");
	}else if($curency_code == "USD"){
		$result = number_format((float)$val, 2, ",", ".");
	}else{
		$result = $val;
	}
	return $result;
}
function clear_format_curency($val,$type){
	$curency_code =$type;
	$result = "";
	if($curency_code == "VND"){
		$result = str_replace(".","",$val);
	}else if($curency_code == "USD"){
		$result = str_replace(",","",$val);
	}else{
		$result = str_replace(".","",$val);
	}
	return $result;
}
  
function waterMarkImage($value){
    $img = Image::make(public_path($value)); //your image I assume you have in public directory
    $img->insert(public_path('images/hvietdev_watermark.png'), 'bottom-right', 10, 10); //insert watermark in (also from public_directory)
    $img->save(public_path($value)); //save created image (will override old image)
    return $value; //return value
}

function render_qr($data_image,$path,$name_img){

		
		$data_image = str_replace("data:image/png;base64,", "", $data_image);
		$data_image = str_replace("data:image/jpeg;base64,", "", $data_image);
		$data = base64_decode($data_image);

		// $im = imagecreatefromstring($data);
		// imagepng($im, "./uploads/".$type."/abc.jpg");

		$link_image = $path."/".$name_img.".png"; 
		file_put_contents("./".$link_image, $data);

		echo json_encode(array(
			'success' => true, 
			'link_image' => $link_image, 
			));

}

function upload_image_vue($image,$foder,$size =null)
{
	$name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];          	
    // Image::make($image)->save(public_path('images/'.$foder.'/').$name);

    // resize logo-icon 200
    if ($size==null) {
    	$image_resize = Image::make($image);              
	    $image_resize->resize(200, null, function($constraint) {
	        $constraint->aspectRatio();
	    });  
	    $image_resize->save(public_path('images/'.$foder.'/').$name);
    } else {
    	// custome size
    	$image_resize = Image::make($image);              
	    $image_resize->resize($size, null, function($constraint) {
	        $constraint->aspectRatio();
	    });  
	    $image_resize->save(public_path('images/'.$foder.'/').$name);
    }
    
    $path_name = '/images/'.$foder.'/'.$name;
    return $path_name;
}

function upload_image_post($file, $path ){
        $ext = $file->getClientOriginalExtension();
        $ext = strtolower($ext);
        if($ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif"){
			$filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $hinh = changeTitle($filename).'-'.generateRandomString(5).'.'.$ext;  
            	if($path == "logo_icon"){ 
				    $image_resize = Image::make($file->getRealPath());              
				    $image_resize->resize(100, null, function($constraint) {
				        $constraint->aspectRatio();
				    });  
				    $image_resize->save(public_path('images/'.$path.'/100x100/'.$hinh));
				    $image_original = Image::make($file->getRealPath());           
				    $image_original->resize(300, null, function($constraint) {
				        $constraint->aspectRatio();
				    });  
				    $image_original->save(public_path('images/'.$path.'/300x300/'.$hinh));
	            }else if($path == "product"){ 
				    $image_resize = Image::make($file->getRealPath());              
				    $image_resize->resize(null, 300, function($constraint) {
				        $constraint->aspectRatio();
				    });  
				    $image_resize->save(public_path('images/'.$path.'/300x300/'.$hinh));
				    $image_original = Image::make($file->getRealPath());           
				    $image_original->resize(800, null, function($constraint) {
				        $constraint->aspectRatio();
				    });  
				    $image_original->save(public_path('images/'.$path.'/800x800/'.$hinh));
	            }else{
				    $image_resize = Image::make($file->getRealPath());              
				    $image_resize->resize(150, null, function($constraint) {
				        $constraint->aspectRatio();
				    });  
				    $image_resize->save(public_path('images/'.$path.'/100x100/'.$hinh));
				    $image_resize = Image::make($file->getRealPath());              
				    $image_resize->resize(300, null, function($constraint) {
				        $constraint->aspectRatio();
				    });  
				    $image_resize->save(public_path('images/'.$path.'/300x300/'.$hinh));
				    $image_original = Image::make($file->getRealPath());           
				    $image_original->resize(800, null, function($constraint) {
				        $constraint->aspectRatio();
				    }); 
					// $image_original->insert(public_path('images/wartermark_1.png'));
				    $image_original->save(public_path('images/'.$path.'/800x800/'.$hinh));
				}

            return $hinh;
        }else{
            return "";
        }
	}

function sendmail($mail, $title, $sub_title, $content)
{
	// ===========SEND MAIL===========
    Mail::send(array(),array('body' =>$content), function($message) use ($mail,$title,$sub_title,$content)
    {
        $message->from(env("MAIL_USERNAME",""), $title);
        $message->to($mail)->subject($sub_title)->setBody($content, 'text/html');
    }); 
	// ===========SEND MAIL===========
}
	
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
# renderNodeOptionListStatus
// if(!function_exists('renderNodeOptionListStatus')){
// 	function renderNodeOptionListStatus($node,$prefix = '----|&nbsp;',$selected = null){
// 		if(!empty($node)){
// 			$html = '';
// 			foreach ($node as $item) {
// 				if($selected == $item->getKey()){
// 					$html.= '<option value="'.$item->getKey().'" selected="selected">'.$prefix.$item->name.'</option>';
// 				}else{
// 					$html.= '<option value="'.$item->getKey().'">'.$prefix.$item->name.'</option>';
// 				}
				
// 				$html.= renderNodeOptionListStatus($item->children,$prefix.'----|&nbsp;',$selected);
// 			}
// 			return $html;
// 		}
// 	}
// }

?>
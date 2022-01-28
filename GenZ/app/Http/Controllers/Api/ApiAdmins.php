<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;
use App\Dborder;
use DB,Auth;

class ApiAdmins extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function getadmin_info(){
       	$admin = Admin::find(Auth::user()->id);
	   	return response()->json($admin);
    }
    public function postchange(Request $rq)
    {
    	$this->validate($rq,[
			'newpass' => 'min:6|required_with:renewpass|same:renewpass',
			'renewpass' =>'required:min:6',
		],[
			'newpass.required'=>'Vui lòng nhập mật khẩu mới',
			'renewpass.required'=>'Vui lòng nhập lại mật khẩu mới.',
			'old.min'=>'Mậ khẩu tối thiểu 6 ký tự',
			'newpass.min'=>'Mậ khẩu tối thiểu 6 ký tự',
			'newpass.same'=>'Mật khẩu mới không giống nhau.',
			'renewpass.min'=>'Mậ khẩu tối thiểu 6 ký tự',
		]);   	

		$admin = Admin::find(Auth::user()->id);
		$admin->password = bcrypt($rq->newpass);
		$admin->save();
    	
    }
    public function get_info_dborder()
    {
    	$total 		= Dborder::all()->count();
    	$success 	= Dborder::where('order_status',3)->count();
    	$pending 	= Dborder::where('order_status',2)->count();
    	$receive 	= Dborder::where('order_status',1)->count();
    	$cancel 	= Dborder::where('order_status',0)->count();

    	$rs = array_merge([ 'total'=>$total ,
                            'success'=>$success,
                            'pending'=>$pending,
                            'receive'=>$receive,
                            'cancel'=>$cancel
                            ]);
        return response()->json((object)$rs);
    }
    
}

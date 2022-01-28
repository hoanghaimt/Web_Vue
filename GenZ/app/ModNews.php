<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModNews extends Model
{
    protected $table = "modnews";
    public function list_in_mod($mod_id)
    {
    	$list = ListNews::where('id_modnews',$mod_id)->orderBy('list_number','DESC')->get();
    	return $list;
    }
}

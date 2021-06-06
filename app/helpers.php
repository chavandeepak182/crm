<?php 


use Illuminate\Database\Eloquent\Model;
use App\Admin_setting;

 if (!function_exists('getSetting')) {
   	function getSetting(){
   		// echo 'nitin';
    $setting = Admin_setting::where('id', 1)->first();
       return $setting;
}
   }


 ?>
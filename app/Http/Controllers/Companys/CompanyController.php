<?php 
/**
 * 企业
 * 
 * @author Administrator
 *
 */
namespace App\Http\Controllers\Companys;

//use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

use Illuminate\Http\Request;
use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\Response as IlluminateResponse;

use App\Http\Controllers\Controller;

class CompanyController extends Controller {


	public static function showTemp()
	{
		return 'company';
	}


    

}
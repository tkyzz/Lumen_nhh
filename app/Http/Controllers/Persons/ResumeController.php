<?php 
/**
 * 个人简历
 * 
 * @author Administrator
 *
 */
namespace App\Http\Controllers\Persons;

//use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

use Illuminate\Http\Request;
use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\Response as IlluminateResponse;

use App\Http\Controllers\Controller;


class ResumeController extends Controller {


	public static function showTemp()
	{
		return 'resume';
	}

    

}
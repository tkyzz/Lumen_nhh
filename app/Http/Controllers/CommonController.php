<?php 
/**
 * 公共服务包括字典，一些常用方法
 * 
 * @author lock
 *
 */
namespace App\Http\Controllers;

//use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

use Illuminate\Http\Request;
use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\Response as IlluminateResponse;

use App\Http\Controllers\Controller;

class CommonController extends Controller {

	
	public function __construct(Request $request)
	{
		
	}
	
	/**
	 * 检测手机是否存在
	 * 
	 * @param Request $request
	 * @return array
	 * @author lock
	 */
	public static function checkPhone(Request $request)
	{
		$phone = $request->input('phone');
		if (empty($phone)) {
			return parent::_jsonMsg(1000, Config::get('codes.1000'));
		}		
		if (strlen($phone) < 11) {
			return parent::_jsonMsg(1001, Config::get('codes.1001'));
		}
		
		$result = self::_checkPhone($phone);
		if ($result) {
			return parent::_jsonMsg(1004, Config::get('codes.1004'));
		}
		return parent::_jsonMsg(200, '手号可以使用');
	}
	
	/**
	 * 检测手机发送CODE是否正确
	 *
	 * @param Request $request
	 * @return array
	 * @author lock
	 */
	public static function checkPhoneCode(Request $request)
	{
		$phone  = $request->input('phone');
		if (empty($phone)) {
			return parent::_jsonMsg(1000, Config::get('codes.1000'));
		}
	
		if (strlen($phone) < 11) {
			return parent::_jsonMsg(1001, Config::get('codes.1001'));
		}
	
		$code = $request->input('code');
		if (empty($code)) {
			return parent::_jsonMsg(1002, Config::get('codes.1002'));
		}
	
		$result = self::_checkPhoneCode($phone, $code);
		if (empty($result)) {
			return parent::_jsonMsg(1003, Config::get('codes.1003'));
		}
		return parent::_jsonMsg(200, '验证码检测正确');
	}
	
	/**
	 * 检测手机号是否使用
	 * 
	 * @param string $phone
	 * @return boolean
	 * @author lock
	 */
	public static function _checkPhone($phone)
	{
		if (empty($phone)) {
			return false;
		}		
		$uid = DB::table('ut_member')
								->where('phone', $phone)
								->select('uid')
								->first();
		if ($uid) {
			return true;
		}
		return false;
	}	
	
	/**
	 * 检测手机发送Code
	 * 
	 * @param string phone
	 * @param strint code
	 * @return boolean
	 * @author lock 
	 */
	public static function _checkPhoneCode($phone, $code)
	{
		if (empty($phone) || empty($code)) {
			return false;
		}
		$id = DB::table('ut_phonecode')
							->where('phone', $phone)
							->where('code', $code)
							->where('status', 0)
							->select('id')
							->first();
		if (empty($id)) {
			return false;
		}
		return true;
	}

    

}
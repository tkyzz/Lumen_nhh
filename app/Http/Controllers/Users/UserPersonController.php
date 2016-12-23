<?php 
/**
 * 个人用户管理中心(职位申请管理等)
 * 
 * @author Administrator
 *
 */
namespace App\Http\Controllers\Users;

//use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

use Illuminate\Http\Request;
use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\Response as IlluminateResponse;

use App\Http\Controllers\Controller;


class UserPersonController extends Controller {

	//来源设置
	public $device = 'app';
	
	public function __construct(Request $request)
	{
		$this->device = $request->input('device') ? $request->input('device') : 'app';
	}
	
	/**
	 * 测试方法 
	 * 
	 * @param Request $request
	 * @return array
	 * @author lock
	 */
	public function getProfile(Request $request)
	{
		$tmp = '';
		switch ($this->device) {
			case 'wap':
				$tmp = UserDeviceController::wapRegister();
				break;
			case 'app':
				$tmp = UserDeviceController::appRegister();
				break;
			case 'pc':
				$tmp = UserDeviceController::pcRegister();
				break;
		}
		$tmp .= ' ' . ProjectController::showTemp();
		$tmp .= ' ' . Config::get('codes.1001');
		return response()->json([
				'message'     => '测试数据',
				'data'	=> $tmp,
				'code' => IlluminateResponse::HTTP_OK
				]
		);
	}
    

}
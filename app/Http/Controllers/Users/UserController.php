<?php 
namespace App\Http\Controllers\Users;

//use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
//use Illuminate\Support\Facades\SESSION;
//use Illuminate\Support\Facades\Cookie;
//use Illuminate\Support\Facades\Crypt;


use Illuminate\Http\Request;
use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\Response as IlluminateResponse;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Projects\ProjectController;
//use Illuminate\Auth\Authenticatable;


class UserController extends Controller {

	//来源设置
	public $device = 'app';
	
	public function __construct(Request $request)
	{
		$this->device = $request->input('device') ? $request->input('device') : 'app';
	}
	
	/**
	 * 用户注册
	 * 
	 * @return array
	 * @author lock
	 */
	public function register()
	{
		try
		{
			$this->validate($request, [
					'username' => 'required|min:2',
					'email' => 'unique:users,email|required',
					'password' => 'required',
					]);
		}
		catch (HttpResponseException $e)
		{
			return response()->json([
					'message'     => '传递参数出错',
					'code' => IlluminateResponse::HTTP_BAD_REQUEST
					]
			);
		}
		$username = $request->input('username');
		$password = $request->input('password');
		$email = $request->input('email');
		
		$user = app()->make('App\Auth\User');
		$hasher = app()->make('hash');
		 
		$user->fill([
				'name' => $username,
				'email' => $email,
				'password' => $hasher->make($password)
				]);
		$user->save();
		
		return response()->json([
				'message'     => '注册成功',
				'code' => IlluminateResponse::HTTP_OK
				]
		);
	}
	
	/**
	 * 忘记密码
	 * 
	 * @return array
	 * @author lock
	 */
	public function forgotPassword()
	{
		$tmp = 	UserDeviceController::showTemp();
		echo $tmp;
		echo 	ProjectController::showTemp();
		echo '<br/>';
		//$results = DB::table('users')->where('id', $id)->first();
		//$results = User::where('id', '=', 1)->firstOrFail();
		//print_r($results);
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
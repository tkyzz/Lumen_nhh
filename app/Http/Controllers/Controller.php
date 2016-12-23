<?php namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    //
    
	/**
	 * 返回数据封装
	 *
	 * @param int $code
	 * @param string $message
	 * @param string $data
	 * @return Illuminate\Http\JsonResponse
	 * @author lock
	 */
	public static function _jsonMsg($code, $message, $data=false)
	{
		$array = array(
				'message'     => $message,
				'code' => $code
		);
		$data ? $array['data'] = $data : $array;
		return response()->json($array);
	}
	
}

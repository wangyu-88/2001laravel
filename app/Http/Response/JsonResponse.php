<?php
 //命名空间主要解决 函数,类,常量是同名的问题 
namespace App\Http\Response;

trait JsonResponse{
	// 错误
	public function error($msg="",$data=[]){
		return $this->JsonResponse('-1',$msg,$data);
	}
	// 正确
	public function success($msg="",$data=[]){
		return $this->JsonResponse('0',$msg,$data);
	}

	public function JsonResponse($code,$msg,$data=[]){
		$data=[
			'code'=>$code,
			'msg'=>$msg,
			'data'=>$data,
		];
		return response()->json($data);
	}

}



?>
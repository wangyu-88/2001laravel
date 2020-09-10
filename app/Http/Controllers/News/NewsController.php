<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Users;
use App\News;
use App\Type;
use Illuminate\Support\Facades\Redis;
class NewsController extends Controller
{
	//登录页面
    public function login(){
    	return view('news.login');
    }
    //执行登录
    public function logindo(){
    	$u_name=request()->u_name;
    	$u_pwd=request()->u_pwd;

    	$user=Users::where('u_name',$u_name)->first();
    	// dd($user);
    	if(!$user){
    		return redirect('news/login')->with('msg','用户名有误');die;
    	}
    	if(decrypt($user->u_pwd)!=$u_pwd){
    		return redirect('news/login')->with('msg','密码有误');die;
    	}
    	//存session
    	session(['user'=>$user]);
    	return redirect('news/newslist');
    } 
    //添加
    public function newsadd(){
    	$type=Type::all();
    	// dd($type);
    	return view('news.newsadd',['type'=>$type]);
    }
    //执行添加
    public function newsaddDo(Request $request){
    	$post=$request->except('_token');
    	$post['new_time']=time();
    	//文件上传
    	if($request->hasFile('new_img')) {
    		$post['new_img']=upload('new_img');
		}
		// dd($post);
		$res=News::insert($post);
		// dd($res);
		if($res){
			return redirect('news/newslist');
		}

    }
    //展示
    public function newslist(){
    	$news=News::orderBy('n_id','desc')->join('type','news.type_id','=','type.type_id')->paginate(2);
    	if(request()->ajax()){
            return view('news/ajaxnewspage',['news'=>$news]);
        }
    	return view('news.newslist',['news'=>$news]);
    }
    //详情页
    public function details($id){
    	$news=News::where('n_id',$id)->first();
    	//获取登录用户名
    	$user=request()->session()->get('user.u_name');
    	// dd($user);

    	//访问量
        $count=Redis::setnx('visit_'.$id,1)?:Redis::incr('visit_'.$id);
        // dd($count);


    	return view('news/details',['news'=>$news,'user'=>$user,'count'=>$count]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Http\Requests\StoreBrandPost;
use Validator;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand_name=request()->brand_name;
        $brand_url=request()->brand_url;
        $where=[];
        if($brand_name){
            $where[]=['brand_name','like',"%$brand_name%"];
        }
        if($brand_url){
            $where[]=['brand_url','like',"%$brand_url%"];
        }


        $brand=Brand::where($where)->orderBy('brand_id','desc')->paginate(2);
        if(request()->ajax()){
            return view('admin.brand.ajaxpage',['brand'=>$brand,'query'=>request()->all()]);
        }
        return view('admin.brand.index',['brand'=>$brand,'query'=>request()->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    // 文件上传
    public function upload(Request $request){

        // dd($file);

        if($request->hasFile('file') && $request->file('file')->isValid()){
                $photo=$request->file;
                $store_result = $photo->store('photo');
                return json_encode(['code'=>0,'msg'=>'上传成功','data'=>env('IMG_URL').$store_result]);
            }
            return json_encode(['code'=>2,'msg'=>'上传失败']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    // 表单验证第二种
    // public function store(StoreBrandPost $request)
    {
        // 表单验证第一种
        // $validatedData = $request->validate([
        //     'brand_name' => 'required|unique:brand',
        //     'brand_url' => 'required',
        //     'brand_desc' => 'required',
        // ],[
        //     'brand_name.required' => '品牌名称不能为空',
        //     'brand_name.unique' => '品牌名称已存在',
        //     'brand_url.required' => '品牌网址不能为空',
        //     'brand_desc.required' => '品牌简介不能为空',
        // ]);

        // 表单验证第三种
        $validator = Validator::make($request->all(),
        [
            'brand_name' => 'required|unique:brand',
            'brand_url' => 'required',
            'brand_desc' => 'required',
        ],[
            'brand_name.required' => '品牌名称不能为空',
            'brand_name.unique' => '品牌名称已存在',
            'brand_url.required' => '品牌网址不能为空',
            'brand_desc.required' => '品牌简介不能为空',
        ]);

        if ($validator->fails()) {
            return redirect('brand/create')
            ->withErrors($validator)
            ->withInput();
        }


        $post=$request->except('_token');
        // dd($post);
        $res=Brand::insert($post);
        // dd($res);
        return redirect('/brand');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        $brand=Brand::find($id);
        return view('admin.brand.edit',['brand'=>$brand]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBrandPost $request, $id)
    {
        $post=$request->except('_token');

        // dd($post);
        $res=Brand::where('brand_id',$id)->update($post);
        if($res!==false){
            return redirect('/brand');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id=0)
    {
        $id=request()->id?:$id;
        if(!$id){
            return;
        }


        $res=Brand::destroy($id);
        if(request()->ajax()){
            return response()->json(['code'=>0,'msg'=>'删除成功!']);
        }

        if($res){
            return redirect('/brand');
        }
    }


    //即点即改
    public function brand_name(){
        $_value=request('_value');
        $_field=request('_field');
        $_brand_id=request('_brand_id');

        $res=Brand::where('brand_id',$_brand_id)->update([$_field=>$_value]);
        // dd($res);
        if($res){
            return $this->success('修改成功');
            // return response()->json(['code'=>0,'msg'=>'修改成功']);
            // echo 'ok';
        }else{
            echo 'no';
        }
    }
}

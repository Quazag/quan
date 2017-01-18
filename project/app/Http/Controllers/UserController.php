<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function getAdd(){

    	return view('admin.user.add');
    }
    public function postInsert(Request $request){
    	$this->validate($request,[
    			'name'=>'required',
    			'pass'=>'required',
    			'username'=>'required|unique:user',
    			'phone'=>'required',
    			'email'=>'required|email',
    			'repass'=>'required|same:pass',
    			'phone'=>'digits:11'
    			    		],[
    			   'name.required'=>'姓名必须填写',
    			   'pass.required'=>'密码必须填写',
    			   'email.required'=>'邮箱必须填写',
    			   'phone.required'=>'电话必须填写',
    			   'repass.same'=>'两次密码不同',
    			   'repass.required'=>'密码必须填写',
    			   'username.required'=>'账号必须填写',
    			   'username.unique'=>'账号存在',
    			   'email.email'=>'邮箱格式不正确',
    			   'phone.digits'=>'手机格式不正确'

    			    		]);
    	$data=$request->except(['_token','repass']);
    	$data['pass']=Hash::make($data['pass']);
    	$data['token']=str_random(50);
    	$data['status']=0;
    	// dd($data);
    	$res=DB::table('user')->insert($data);
    	if($res){
    		// echo 'aa';
    		return redirect('/admin/user/index')->with('success','添加成功');
    	}else{

    		return back()->with('error','添加失败');
    	}
    }
    public function getIndex(Request $request){
    	// var_dump($request->all());
    	$data=DB::table('user')->where(//user模型
    		function($query) use($request){
    			if($request->input('keyword')){
    				//echo 'aa';
    				 $query->where('username','like','%'.$request->input('keyword').'%')
    				->orwhere('email','like','%'.$request->input('keyword').'%')
    				->orwhere('id',$request->input('keyword'));
    				
    				
    			}
    			
    		}

    		)->where('status','<',3)->paginate($request->input('num',5));
    	// dd($data->render());
    	return view('admin.user.index',['data'=>$data,'request'=>$request->all()]);
    }
    public function getDel($id){
    	$res=DB::table('user')->where('id',$id)->update(['status'=>3]);
    	if($res){
    		return redirect('/admin/user/index')->with('success','删除成功');
    	}else{
    		return back()->with('error','删除失败');
    	}
    }
    public function getEdit($id){
    	$data=DB::table('user')->where('id',$id)->first();
    	// dd($res);
    	return view('admin.user.edit',['vo'=>$data]);
    }
    public function postUpdate(Request $request){
    	$data=$request->only(['status','email','username']);
    	// dd($data);
    	$this->validate($request,[
    			'email'=>'required|email',
    			'status'=>'required',
    			'username'=>'required'
    		],[
    			'email.required'=>'邮箱不能为空',
    			'email.email'=>'邮箱格式不正确',
    			'status.required'=>'状态不能为空',
    			'username.required'=>'用户名不能为空',

    		]);
    	 $res=DB::table('user')->where('id',$request->input('id'))->update($data);
    	 if($res){
    	 	return redirect('/admin/user/index')->with('success','修改成功');
    	 }else{
    	 	return back()->with('error','修改失败');
    	 }
    }
}

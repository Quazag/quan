<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DropController extends Controller
{
    //回收站用户
    public function getUindex(Request $request){
    	$data=DB::table('user')->where(//user模型
    		function($query) use($request){
    			if($request->input('keyword')){
    				//echo 'aa';
    				 $query->where('username','like','%'.$request->input('keyword').'%')
    				->orwhere('email','like','%'.$request->input('keyword').'%')
    				->orwhere('id',$request->input('keyword'));
    				
    				
    			}
    			
    		}

    		)->where('status',3)->paginate($request->input('num',5));
    	// dd($data->render());
    	return view('admin.drop.uindex',['data'=>$data,'request'=>$request->all()]);
    }
    public function getDel($id,$table){
    	$res=DB::table($table)->where('id',$id)->delete();
    	if($res){
    		return redirect('/admin/drop/uindex')->with('success','删除成功');
    	}else{
    		return back()->with('error','删除失败');
    	}
    	
    }
    public function getEdit($id,$table){
    	$res=DB::table($table)->where('id',$id)->update(['status'=>1]);
    	if($res){
    		return redirect('/admin/drop/uindex')->with('success','还原成功');
    	}else{
    		return back()->with('error','还原失败');
    	}
    }
}

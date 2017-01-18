<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CateController extends Controller
{
  //分类
    public function getAdd($id=''){
    	$data=self::getCate();
    	return view('admin.cate.add',['data'=>$data,'id'=>$id]);
    }

   public static function getCate(){
   	//select *,concat(path,id) as paths from cate order by paths
   	$data=DB::table('cate')->select('*',DB::raw('concat(path,id) as paths'))->orderby('paths')->get();
   foreach ($data as $k=>$v){
    $count=substr_count($v['path'],',')-1;
   	$data[$k]['cate']=str_repeat('☆',$count).$v['cate'];
   }
   // $data=$data->paginate(5);
    // dd($data);


   	return $data;

   }
   //首页
   public function getIndex(Request $request){
	$data=self::getCate();
	// $data =DB::table('cate')->paginate(5);
	// dd($data->render());

   	return view('admin.cate.index',['data'=>$data]);
   }

   public function postInsert(Request $request){
   	$this->validate($request,[
   		'cate'=>'required|unique:cate'
   		],[
   		'cate.required'=>'必须填写',
   		'cate.unique'=>'类名已经存在'

   		]);
   	if($request->input('id')==0){
   		$data['cate']=$request->input('cate');
   		$data['pid']=0;
   		$data['path']='0,';
   	}else{
   		$data['cate']=$request->input('cate');
   		$data['pid']=$request->input('id');
   		$data['path']=DB::table('cate')->where('id',$request->input('id'))->first()['path'].$request->input('id').',';
   		
   		
   	}
   	$res=DB::table('cate')->insert($data);
   	if($res){
   		return redirect('/admin/cate/index')->with('success','添加成功'); 
   	}else{
   		return back()->with('error','添加失败');
   	}
   } 

   public static function getFuname($pid){
   	$pid=DB::table('cate')->where('id',$pid)->first()['cate'];

   	echo empty($pid)?'顶级分类':$pid;

   
   }

   public function getDel($id){
   		$res=DB::table('cate')->where('pid',$id)->get();
   	if(!$res){
   		DB::table('cate')->where('id',$id)->delete();
   		return redirect('/admin/cate/index')->with('success','删除成功');
   	}else{
   		return back()->with('error','儿子咋办');
   	}
   }

   public function getEdit($id){
   		$res=DB::table('cate')->where('pid',$id)->get();
   		if($res){
   			return back()->with('error','你呀有子类啊');
   		}
   	$data=DB::table('cate')->where('id',$id)->first();
   	//select c2.cate from cate as c1,cate as c2 where c1.pid=c2.id and ci.id=$id;
   	 $vo=DB::table('cate as c1')->join('cate as c2','c1.pid','=','c2.id')->select('c2.cate as vo')->where('c1.id',$id)->first()['vo'];
   	 // dd($vo);
   	 $vo=empty($vo)?'顶级分类':$vo;
   	 return view('admin.cate.edit',['data'=>$data,'vo'=>$vo]);
   }

   public function postUpdate(Request $request){
   
   $res=DB::table('cate')->where('id',$request->input('id'))->update($request->only(['cate']));
   if($res){
   	return redirect('/admin/cate/index')->with('success','修改成功');
   }else{
   	return back()->with('error','修改失败');
   }
  
   }

 public  function getCates(){
      $res=self::getArr();

     
         $cates=self::getAa($res,0);
         \Cache::put('key',$cates,1);
    }
   public static function getArr(){
      //
      // dd($cate);
      return DB::table('cate')->get();
   }

   
    public static function getAa($cate,$pid){
      $data=[];
      foreach($cate as $k=>$v){
         if($v['pid']==$pid){
            $v['sub']=self::getAa($cate,$v['id']);
            $data[]=$v;
            // var_dump($data);
            

          }
         
      }
      return $data;

    }
  

}

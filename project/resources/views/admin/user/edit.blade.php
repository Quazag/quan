

@extends ('layout.adminindex');
@section('con')

<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>用户修改</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    	<form class="mws-form" action="/admin/user/update" method="post">
                    	{{csrf_field()}}
                         <input type="hidden" name='id' value="{{$vo['id']}}">

                    		<div class="mws-form-inline">
                    			 <div class="mws-form-row">
                                        <label class="mws-form-label">用户名</label>
                                        <div class="mws-form-item">
                                             <input class="small" type="text" name="username" value="{{$vo['username']}}">
                                        </div>
                                   </div>
                    			<div class="mws-form-row">
                                        <label class="mws-form-label">邮箱</label>
                                        <div class="mws-form-item">
                                             <input class="small" type="text" name="email" value="{{$vo['email']}}">
                                        </div>
                                   </div>
                                   
                                   <div class="mws-form-row">
                                        <label class="mws-form-label">状态</label>
                                        <div class="mws-form-item">
                                             <input type="radio" name="status" value="1" 
                                             @if($vo['status']=='1')
                                             checked
                                             @endif> <label>启用</label>
                                             <input type="radio" name="status" value="0" 
                                             @if($vo['status']=='0')
                                             checked
                                             @endif> <label>禁用</label>
                                        </div>
                                   </div>
                                  
                    			
                    			
                    			
                    			
                    			
                    		
                    		</div>
                    		<div class="mws-button-row">
                    			<input value="修改" class="btn btn-danger" type="submit">
                    			<input value="重置" class="btn " type="reset">
                    		</div>
                    	</form>
                    </div>    	
                </div>

@endsection
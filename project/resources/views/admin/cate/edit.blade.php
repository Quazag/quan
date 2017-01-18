
@extends ('layout.adminindex')
@section('con')

<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>分类添加</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    	<form class="mws-form" action="/admin/cate/update" method="post">
                    	{{csrf_field()}}
                        <input type="hidden" value="{{$data['id']}}" name="id">
                    	<div class="mws-form-inline">
                              <div class="mws-form-row bordered">
                                    <label class="mws-form-label">父类名</label>
                                    <div class="mws-form-item">
                                        <input class="small" type="text" name="cate" value="{{$vo}}" readonly>
                                    </div> 
                                </div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">子类名</label>
                    				<div class="mws-form-item">
                    					<input class="small" type="text" name="cate" value="{{$data['cate']}}">
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
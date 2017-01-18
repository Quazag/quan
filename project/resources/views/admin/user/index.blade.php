@extends('layout.adminindex');
@section('con')

<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span><i class="icon-users"></i> 用户首页</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
							<form action="/admin/user/index" method="get">
                        <div id="DataTables_Table_1_length" class="dataTables_length">
	                        <label>Show 
	                 
	                        <select size="1" name="num" aria-controls="DataTables_Table_1">
	                        <option value="5" 
								@if(!empty($request['num']) && $request['num']==5)
								selected
									@endif
	                        >5</option>
	                        <option value="25" 
								@if(!empty($request['num']) && $request['num']==25)
								selected
								@endif
	                        >25</option>
	                        <option value="10" 
								@if(!empty($request['num']) && $request['num']==10)
								selected
								@endif
	                        >10</option>
	                        <option value="20" 
								@if(!empty($request['num']) && $request['num']==20)
								selected
								@endif
	                        >20</option>
	                        </select> entries</label>
                        </div>
                        <div class="dataTables_filter" id="DataTables_Table_1_filter">
                        	<label>Search: <input aria-controls="DataTables_Table_1" type="text" 
                        	value='@if(!empty($request['keyword'])) {{$request['keyword']}} @endif'
                        	name="keyword">

                        	 <input type="submit" value="搜索" class='btn btn-primary'>
                        </label>
                        </div>

						</form>
                        <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                            <thead>
                                <tr role="row">
                                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 255px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">id</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 338px;" aria-label="Browser: activate to sort column ascending">用户名</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 316px;" aria-label="Platform(s): activate to sort column ascending">状态</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 221px;" aria-label="Engine version: activate to sort column ascending">电话</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 166px;" aria-label="CSS grade: activate to sort column ascending">邮箱</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 166px;" aria-label="CSS grade: activate to sort column ascending">操作</th>
                                </tr>
                            </thead>
                            
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                        @foreach($data as $k=>$v)
                        @if($k%2==0)
                        <tr class="odd">
                        @else
                        <tr class="even">
                        @endif
                        		
                                    <td class="  sorting_1"align="center">{{$v['id']}} </td>
                                    <td class=" "align="center">{{$v['username']}}</td>
                                    
                                    @if($v['status']==0)
                                    <td class=" "align="center" style="color:red">
                                    <b>禁用</b>
                                    </td>
                                    @else
                                    <td class=" "align="center">
                                    启用
                                    </td>
                                    @endif
                                    
                                    <td class=" "align="center">{{$v['phone']}}</td>
                                    <td class=" "align="center">{{$v['email']}}</td>
                                    <td class=" "align="center">
                                    	<a href="/admin/user/del/{{$v['id']}}" class="icon-trash" style="font-size:30px"></a> &nbsp &nbsp &nbsp &nbsp
                                    	<a href="/admin/user/edit/{{$v['id']}}" class="icon-pencil" style="font-size:25px"></a>
                                    </td>
                                </tr>
                         @endforeach
                        </tbody>
                               </table>
                               
                               <div class="dataTables_paginate paging_full_numbers" id="page">
	                               <!--参数注入 num=10-->
	                               {!!$data->appends($request)->render()!!}
                               </div>
                               </div>
                    </div>
                </div>


@endsection
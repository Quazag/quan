@extends('layout.adminindex');
@section('con')

<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span><i class="icon-table"></i> 分类页</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
							

						
                        <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                            <thead>
                                <tr role="row">
                                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 255px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">id</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 338px;" aria-label="Browser: activate to sort column ascending">类别名</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 316px;" aria-label="Platform(s): activate to sort column ascending">pid</th>
                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 221px;" aria-label="Engine version: activate to sort column ascending">path</th>
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
                                    <td class=" "align="center">{{$v['cate']}}</td>
                                    
                                    <td class=" "align="center">{{App\Http\Controllers\CateController::getFuname($v['pid'])}}</td>
                                    <td class=" "align="center">{{$v['path']}}</td>
                                    <td class=" " align="center">
                                        <a href="/admin/cate/del/{{$v['id']}}" class="icon-trash" style="font-size:30px"></a> &nbsp &nbsp &nbsp &nbsp
                                    	<a href="/admin/cate/add/{{$v['id']}}" class="icon-plus" style="font-size:30px"></a> &nbsp &nbsp &nbsp &nbsp
                                    	<a href="/admin/cate/edit/{{$v['id']}}" class="icon-pencil" style="font-size:25px"></a>
                                    </td>
                                </tr>
                         @endforeach
                        </tbody>
                               </table>
                               
                               <div class="dataTables_paginate paging_full_numbers" id="page">
	                               <!--参数注入 num=10-->
	                             
                               </div>
                               </div>
                    </div>
                </div>


@endsection
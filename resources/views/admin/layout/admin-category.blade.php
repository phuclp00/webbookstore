@extends('admin.index')
@section('admin_section')
<!-- Page Content  -->
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="iq-card">
               <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title">Category Lists</h4>
                  </div>
                  <div class="iq-card-header-toolbar d-flex align-items-center">
                     <a href="{{route('admin.category.add.view')}}" class="btn btn-primary">Add New Category</a>
                  </div>
               </div>
               <div class="iq-card-body">
                  <div class="table-responsive">
                     <table class="data-tables table table-striped table-bordered" style="width:100%">
                        <thead>
                           <tr>
                              <th width="5%">Category ID</th>
                              <th width="10%">Category Name</th>
                              <th width="50%">Category Description</th>
                              <th width="5%">Total</th>
                              <th width="10%">Created</th>
                              <th width="10%">Modiffer</th>
                              <th width="6%">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($cat_list as $data=>$value)
                           <tr>
                              <td>{{$value->cat_id}}</td>
                              <td>{{$value->cat_name}}</td>
                              <td>
                                 <p class="mb-0">{!! $value->description !!}</p>
                              </td>
                              <td>{{$value->total}}</td>
                              <td>{{$value->created}}</td>
                           @if($value->modiffed_by==null)
                              <td>{{$value->created_by}}</td>
                           @else
                              <td>{{$value->modiffed_by}}</td>
                           @endif
                              <td>
                                 <div class="flex align-items-center list-user-action">
                                    <a class="bg-primary option" data-toggle="tooltip" data-placement="top" title=""
                                       data-original-title="Edit" href="{{route('admin.category.edit.view',['cat_id'=>$value->cat_id,'page'=>$cat_list->currentPage(),'route'=>Request::route()->getName()])}}"><i
                                          class="ri-pencil-line"></i></a>
                                    <a class="bg-primary option" data-toggle="tooltip" data-placement="top" title=""
                                       data-original-title="Delete" href="{{route('admin.category.delete',$value->cat_id)}}"><i class="ri-delete-bin-line"></i></a>
                                 </div>
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                     
                  </div>
               </div>
            </div>
            {{ $cat_list->links('admin.pagination.simple'),["paginator"=>$cat_list]}}
         </div>
      </div>
   </div>
</div>
@endsection
<!-- Wrapper END -->
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
                     <h4 class="card-title">Publisher Lists</h4>
                  </div>
                  <div class="iq-card-header-toolbar d-flex align-items-center">
                     <a href="{{route('admin.publisher.add.view')}}" class="btn btn-primary">Add New Publisher</a>
                  </div>
               </div>
               <div class="iq-card-body">
                  <div class="table-responsive">
                     <table class="data-tables table table-striped table-bordered" style="width:100%">
                        <thead>
                           <tr>
                              <th style="width: 8%;">Publisher ID</th>
                              <th style="width: 15%;">Publisher Name</th>
                              <th style="width: 5%;">Image</th>
                              <th style="width: 40%;">Publisher Description</th>
                              <th style="width: 2%;">Total</th>
                              <th style="width: 10%;">Date Create</th>
                              <th style="width: 9%;">Modiffer</th>
                              <th style="width: 6%;">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($pub_list as $data =>$value)
                           <tr>
                              <td>{{$value->pub_id}}</td>
                              <td> {{$value->pub_name}}</td>
                              @if($value->pub_img==null)
                              <td>
                                 <img src="{{asset('asset/images/user/01.jpg')}}" class="img-fluid avatar-50 rounded"
                                    alt="author-profile">
                              </td>
                              @else
                              <td>
                                 <img src="{{asset('images/publisher/'.$value->pub_img)}}"
                                    class="img-fluid avatar-50 rounded" alt="author-profile">
                              </td>
                              @endif
                              <td>
                                 <p class="mb-0">{!!$value->description!!}</p>
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
                                       data-original-title="Edit"
                                       href="{{route('admin.publisher.edit.view',['pub_id'=>$value->pub_id,'page'=>$pub_list->currentPage(),'route'=>Request::route()->getName()])}}"><i
                                          class="ri-pencil-line"></i></a>
                                    <a class="bg-primary option" data-toggle="tooltip" data-placement="top" title=""
                                       data-original-title="Delete" href="{{route('admin.publisher.delete',[$value->pub_id])}}"><i
                                          class="ri-delete-bin-line"></i></a>
                                 </div>
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
            {{ $pub_list->links('admin.pagination.simple'),["paginator"=>$pub_list]}}
         </div>
      </div>
   </div>
</div>
<!-- Wrapper END -->
@endsection
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
                     <h4 class="card-title">Supplier List</h4>
                  </div>
                  <div class="iq-card-header-toolbar d-flex align-items-center">
                     <a href="{{route('admin.supplier.add.view')}}" class="btn btn-primary">Add New Supplier</a>
                  </div>
               </div>

               <div class="iq-card-body">
                  <div class="table-responsive">
                     <supplier :data="{{$sub_list}}" :route="'{{Request::route()->getName()}}'"></supplier>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Wrapper END -->
@endsection
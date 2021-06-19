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
                     <h4 class="card-title">Tags Lists</h4>
                  </div>
                  <div class="iq-card-header-toolbar d-flex align-items-center">
                     <a href="{{route('admin.tags.add.view')}}" class="btn btn-primary">Add New Tags</a>
                  </div>
               </div>
               <div class="iq-card-body">
                  <div class="table-responsive">
                     <tags :data="{{$cat_list}}"></tags>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
<!-- Wrapper END -->
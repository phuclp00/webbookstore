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
                     <h4 class="card-title">Publisher Restore List</h4>
                  </div>
                  <div class="iq-card-header-toolbar d-flex align-items-center">
                     <a href="{{route('admin.publisher.add.view')}}" class="btn btn-primary">Add New Publisher</a>
                  </div>
               </div>
               <div class="iq-card-body">
                  <div class="table-responsive">
                     <publisher :data="{{$pub_list}}" :delete="{{true}}"></publisher>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Wrapper END -->
@endsection
@extends('admin.index')
@section('admin_section')
<!-- Page Content  -->
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">

            @include('post.create')
            <div class="iq-card-body">
               <datatable-userlist :users="{{$users}}" :guest="{{$guest}}" user_type="'User Account List'">
               </datatable-userlist>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
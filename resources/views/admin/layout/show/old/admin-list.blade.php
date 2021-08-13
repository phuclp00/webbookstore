@extends('admin.index')
@section('admin_section')
<!-- Page Content  -->
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">

            @include('post.create')
            <div class="iq-card-body">
               <datatable-userlist :users="{{$users}}" :guest="null" user_type="Admin Account List Restore">
               </datatable-userlist>
            </div>
            {{-- {{ $result->links('admin.pagination.simple'),["paginator"=>$result]}} --}}

         </div>
      </div>
   </div>
</div>
@endsection
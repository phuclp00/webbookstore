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
                     <h4 class="card-title">The Books Are On Sale</h4>
                  </div>
                  <div class="iq-card-header-toolbar d-flex align-items-center">
                     <a href="{{route('admin.books.add.view')}}" class="btn btn-primary">Add New book
                     </a>
                  </div>
               </div>
               <booklist-selling :books="{{$book}}" :router=" '{{Request::route()->getName()}}' ">
               </booklist-selling>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@push('script')
@endpush
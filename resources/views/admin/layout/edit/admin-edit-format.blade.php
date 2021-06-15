@extends('admin.index')
@section('admin_section')
<!-- Page Content  -->
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="iq-card">
               <a href="{{route('admin.format')}}"> <button type="button" class="btn btn-info btn-fixed"> Return
                     back</button></a>
               <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title">Edit Book Format: {{$data->name}}</h4>
                  </div>
               </div>
               @include('post.create')
               <div class="iq-card-body">
                  <form id="edit_form" action="{{route('admin.format.edit',[$data->id])}}" method="post"
                     enctype="multipart/form-data">
                     {{ csrf_field() }}
                     <div class="form-group">
                        <label>Book Format ID:</label>
                        <input type="text" class="form-control" value="{{$data->id}}" disabled>
                        <input type="hidden" name="id" value="{{$data->id}}">
                     </div>
                     <div class="form-group">
                        <label>Book Format Name:</label>
                        <input name="name" type="text" class="form-control" value="{{$data->name}}">
                     </div>
                     <div class="form-group">
                        <label>Book Format Description:</label>
                        <textarea class="form-control" rows="4" name="content"
                           id="content">{{$data->description}}</textarea>
                     </div>
                     <button type="submit" class="btn btn-primary">Submit</button>
                     <button type="reset" class="btn btn-danger"
                        onclick="document.getElementById('edit_form').reset(); return false;">Reset</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
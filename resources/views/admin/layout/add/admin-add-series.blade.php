@extends('admin.index')
@section('admin_section')
<!-- Page Content  -->
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="iq-card">
               <a href="{{route('admin.series')}}"> <button type="button" class="btn btn-info btn-fixed"> Return
                     back</button></a>
               <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title">Add Series</h4>
                  </div>
               </div>
               @include('post.create')
               <div class="iq-card-body">
                  <form id="edit_form" action="{{route('admin.series.add')}}" method="post"
                     enctype="multipart/form-data">
                     {{ csrf_field() }}
                     <div class="form-group">
                        <label>Series ID:</label>
                        <input type="text" name="id" class="form-control" value="">
                     </div>
                     <div class="form-group">
                        <label>Series Name:</label>
                        <input type="text" name="name" class="form-control" value="">
                     </div>
                     <div class="form-group">
                        <label>Series Picture:</label>
                        <div class="custom-file">
                           <input type="file" id="img" name="img" class="custom-file-input" id="customFile">
                           <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Series Description:</label>
                        <textarea class="form-control" rows="4" name="content" id="content"></textarea>
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
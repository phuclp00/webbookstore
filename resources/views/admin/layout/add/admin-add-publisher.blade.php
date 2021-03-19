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
                     <h4 class="card-title">Add Publisher</h4>
                  </div>
               </div>
               @include('post.create')
               <div class="iq-card-body">
                  <form id="edit_form" action="{{route('admin.publisher.add')}}" method="POST"
                     enctype="multipart/form-data">
                     {{ csrf_field() }}
                     <div class="form-group">
                        <label>Publisher ID:</label>
                        <input type="text" name="pub_id" class="form-control" value="">
                     </div>
                     <div class="form-group">
                        <label>Publisher Name:</label>
                        <input type="text" name="pub_name" class="form-control" value="">
                     </div>
                     <div class="form-group">
                        <label>Publisher Picture:</label>
                        <div class="custom-file">
                           <input type="file" id="img" name="img" class="custom-file-input" id="customFile">
                           <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Publisher Description:</label>
                        <textarea class="form-control" rows="4" name="content" id="editor"></textarea>
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
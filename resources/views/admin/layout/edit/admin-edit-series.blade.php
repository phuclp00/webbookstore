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
               <div>
                  <img class="img-thumbnail rounded"
                     src="{{asset($data->image==null?"/images/books/default.jpg":$data->image)}}" alt="Series Image"
                     style="margin-top: 20px;padding: 20px">
               </div>
               <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title">Edit Series: {{$data->name}}</h4>
                  </div>
               </div>
               @include('post.create')
               <div class="iq-card-body">
                  <form id="edit_form" action="{{route('admin.series.edit',[$data->id])}}" method="post"
                     enctype="multipart/form-data">
                     {{ csrf_field() }}
                     <div class="form-group">
                        <label>Series ID:</label>
                        <input type="text" class="form-control" value="{{$data->id}}" disabled>
                        <input type="hidden" name="id" value="{{$data->id}}">
                     </div>
                     <div class="form-group">
                        <label>Series Name:</label>
                        <input name="name" type="text" class="form-control" value="{{$data->name}}">
                     </div>
                     <div class="form-group">
                        <label>Series Picture:</label>
                        <div class="custom-file">
                           <input id="picture" name="img" type="file" class="custom-file-input"
                              onchange="javascript:showname_file()" accept="image/png, image/jpeg">
                           <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <div id="file_name" class="btn-outline-danger"></div>
                     </div>
                     <div class="form-group">
                        <label>Series Description:</label>
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
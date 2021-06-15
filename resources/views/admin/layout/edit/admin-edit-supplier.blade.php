@extends('admin.index')
@section('admin_section')
<!-- Page Content  -->
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="iq-card">
               <a href="{{route('admin.supplier')}}"> <button type="button" class="btn btn-info btn-fixed"> Return
                     back</button></a>
               <div>
                  <img class="img-thumbnail rounded"
                     src="{{asset($supplier->image==null?"images/books/supplier/book-na-1.jpg":$supplier->i)}}"
                     alt="Supplier Image" style="margin-top: 20px;padding: 20px;">
               </div>
               <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title">Edit Supplier: {{$supplier->name}}</h4>
                  </div>
               </div>
               @include('post.create')
               <div class="iq-card-body">
                  <form id="edit_form" action="{{route('admin.supplier.edit',[$supplier->id])}}" method="post"
                     enctype="multipart/form-data">
                     {{ csrf_field() }}
                     <div class="form-group">
                        <label>Supplier ID:</label>
                        <input type="text" class="form-control" value="{{$supplier->id}}" disabled>
                        <input type="hidden" name="id" value="{{$supplier->id}}">
                     </div>
                     <div class="form-group">
                        <label>Supplier Name:</label>
                        <input name="name" type="text" class="form-control" value="{{$supplier->name}}">
                     </div>
                     <div class="form-group">
                        <label>Supplier Picture:</label>
                        <div class="custom-file">
                           <input id="picture" name="img" type="file" class="custom-file-input"
                              onchange="javascript:showname_file()" accept="image/png, image/jpeg">
                           <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <div id="file_name" class="btn-outline-danger"></div>
                     </div>
                     <div class="form-group">
                        <label>Supplier Description:</label>
                        <textarea class="form-control" rows="4" name="content"
                           id="content">{{$supplier->description}}</textarea>
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
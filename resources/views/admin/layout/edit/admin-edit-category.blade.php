@extends('admin.index')
@section('admin_section')
<!-- Page Content  -->
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="iq-card">
               <form action="{{route('back',['page'=>$page,'route'=>$route])}}" method="get">
                  <button type="submit" class="btn btn-info btn-fixed">Return back</button>
               </form>
               <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title">Edit Categories: {{$category->cat_id}}</h4>
                  </div>
               </div>
               @include('post.create')
               <div class="iq-card-body">
                  <form action="{{route('admin.category.edit',[$category->cat_id])}}" method="post">
                     <div class="form-group">
                        <label>Category Name:</label>
                        <input type="text"  class="form-control" value="{{$category->cat_id}}" disabled>
                        <input type="hidden" name="cat_id" value="{{$category->cat_id}}">
                     </div>
                     <div class="form-group">
                        <label>Category Name:</label>
                        <input type="text" name="cat_name" class="form-control" value="{{$category->cat_name}}">
                     </div>
                     <div class="form-group">
                        <label>Category Description:</label>
                        <textarea class="form-control" rows="4" name="content"
                           id="editor">{{$category->description}}</textarea>
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
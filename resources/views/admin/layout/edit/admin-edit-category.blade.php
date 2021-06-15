@extends('admin.index')
@section('admin_section')
<!-- Page Content  -->
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="iq-card">
               <a href="{{route('admin.category')}}"> <button type="button" class="btn btn-info btn-fixed">
                     Return
                     back</button></a>
               <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title">Edit Categories: {{$category->cat_name}}</h4>
                  </div>
               </div>
               @include('post.create')
               <div class="iq-card-body">
                  <form action="{{route('admin.category.edit',[$category->cat_id])}}" method="post">
                     @csrf
                     <div class="form-group">
                        <label>Category Name:</label>
                        <input type="text" class="form-control" value="{{$category->cat_id}}" disabled>
                        <input type="hidden" name="cat_id" value="{{$category->cat_id}}">
                     </div>
                     <div class="form-group">
                        <label>Category Name:</label>
                        <input type="text" name="cat_name" class="form-control" value="{{$category->cat_name}}">
                     </div>
                     <div class="form-group">
                        <label>Book Type:</label>
                        <select id="type" name="type" class="form-control">
                           <option selected="" disabled="">Book Type</option>
                           @isset($type)
                           @foreach($type as $data =>$item)
                           @if($category->type_id==$item->id)
                           <option value="{{$item->id}}" selected>{{$item->name}}</option>
                           @else
                           <option value="{{$item->id}}">{{$item->name}}</option>
                           @endif
                           @endforeach
                           @endisset
                        </select>
                        <label for="new_type" style="font-style: italic"> Add new type :</label>
                        <input type="text" class="form-control" name="new_type" id="new_type"
                           value="{{ old('new_type') }}" readonly>
                     </div>
                     <div class="form-group">
                        <label>Category Description:</label>
                        <textarea class="form-control" rows="4" name="content"
                           id="content">{{$category->description}}</textarea>
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
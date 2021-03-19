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
                     <h4 class="card-title">Add New Book</h4>
                  </div>
               </div>
               @include('post.create')
               <div class="iq-card-body">
                  <form action="{{route('admin.books.add')}}" method="post" enctype="multipart/form-data">
                     @csrf
                     <div class="form-group">
                        <label>Book ID:</label>
                        <input name="book_id" type="text" class="form-control" value="{{ old('book_id') }}">
                     </div>
                     <div class="form-group">
                        <label>Book Name:</label>
                        <input name="book_name" type="text" class="form-control" value="{{ old('book_name') }}">
                     </div>
                     <div class="form-group">
                        <label>Book Category:</label>
                        <select name="cat_id" class="form-control" id="exampleFormControlSelect1">
                           <option selected="" disabled="">Book Category</option>
                           @foreach($cat as $data=>$item)
                           @if(old('cat_id')==$item->cat_id)
                           <option value="{{$item->cat_id}}" selected>{{$item->cat_name}}</option>
                           @else
                           <option value="{{$item->cat_id}}">{{$item->cat_name}}</option>
                           @endif
                           @endforeach
                        </select>
                     </div>
                     <div class="form-group">
                        <label>Book Publisher:</label>
                        <select name="pub_id" class="form-control" id="exampleFormControlSelect2">
                           <option selected="" disabled="">Book Publisher</option>
                           @foreach($pub as $data =>$item)
                           @if(old('pub_id')==$item->pub_id)
                           <option value="{{$item->pub_id}}" selected>{{$item->pub_name}}</option>
                           @else
                           <option value="{{$item->pub_id}}">{{$item->pub_name}}</option>
                           @endif
                           @endforeach
                        </select>
                     </div>
                     <div class="form-group">
                        <label>Book Image:</label>
                        <div class="custom-file">
                           <input id="picture" name="img" type="file" class="custom-file-input"
                              onchange="javascript:showname_file()" accept="image/png, image/jpeg">
                           <label class="custom-file-label">Choose file</label>
                        </div>
                        <div id="file_name" class="btn-outline-danger"></div>
                     </div>
                     <div class="form-group">
                        <label>Book Thumbnail List:</label>
                        <div class="custom-file">
                           <input id="thump" type="file" name="thumb[]" class="custom-file-input"
                              onchange="javascript:showlist_thumb()" accept="image/png, image/jpeg" multiple>
                           <label class="custom-file-label">Choose file</label>
                        </div>
                        <div id="fileList" class="btn-outline-danger"></div>
                     </div>
                     <div class="form-group">
                        <label>Price:</label>
                        <input name="price" type="text" class="form-control" value="{{ old('price') }}">
                     </div>
                     <div class="form-group">
                        <label>Promotion Price:</label>
                        <input name="promotion" type="text" class="form-control" value="{{ old('promotion') }}">
                     </div>
                     <div class="form-group">
                        <label>Book Description:</label>
                        <textarea class="form-control" rows="4" name="content"
                           id="editor">{{ old('content') }}</textarea>
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
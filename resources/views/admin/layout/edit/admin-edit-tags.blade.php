@extends('admin.index')
@section('admin_section')
<!-- Page Content  -->
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="iq-card">
               <a href="{{route('admin.tags')}}"> <button type="button" class="btn btn-info btn-fixed">
                     Return
                     back</button></a>
               <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title">Edit Tags: {{$tags->name}}</h4>
                  </div>
               </div>
               @include('post.create')
               <div class="iq-card-body">
                  <form action="{{route('admin.tags.edit',[$tags->id])}}" method="post">
                     @csrf
                     <div class="form-group">
                        <label>Tags Name:</label>
                        <input type="text" class="form-control" value="{{$tags->id}}" disabled>
                        <input type="hidden" name="id" value="{{$tags->id}}">
                     </div>
                     <div class="form-group">
                        <label>Tags Name:</label>
                        <input type="text" name="name" class="form-control" value="{{$tags->name}}">
                     </div>
                     <div class="form-group">
                        <label>Group Tags:</label>
                        <select id="type" name="cat_group" class="form-control">
                           <option selected="" disabled="">Group Tags</option>
                           @isset($group)
                           @foreach($group as $data =>$item)
                           @if($tags->parent_id==$item->id)
                           <option value="{{$item->id}}" selected>{{$item->name}}</option>
                           @else
                           <option value="{{$item->id}}">{{$item->name}}</option>
                           @endif
                           @endforeach
                           @endisset
                        </select>
                     </div>
                     <div class="form-group">
                        <label>Tags Description:</label>
                        <textarea class="form-control" rows="4" name="content"
                           id="content">{{$tags->description}}</textarea>
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
@extends('admin.index')
@section('admin_section')
<!-- Page Content  -->
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="iq-card">
               <a href="{{route('admin.promotions')}}"> <button type="button" class="btn btn-info btn-fixed"> Return
                     back</button></a>
               <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title">Add Promotions</h4>
                  </div>
               </div>
               @include('post.create')
               <div class="iq-card-body">
                  <form id="edit_form" action="{{route('admin.promotions.add')}}" method="post"
                     enctype="multipart/form-data">
                     {{ csrf_field() }}
                     <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                           placeholder="Title of Promions : Summer 2021 Sale, Moon Ceremorny 2022 ,..."
                           value="{{old('name')}}" aria-describedby="help_name">
                     </div>
                     <div class="form-group">
                        <label for="percent">Percentage Discount</label>
                        <input type="number" name="percent" id="percent" class="form-control small-box" min="5" max="99"
                           value="{{old('percent')}}" placeholder="Enter percentage discount at leats 5, maximum 99 ">
                     </div>
                     <div class="form-group">
                        <label for="percent">Date Started</label>
                        <input type="datetime-local" name="date_started" id="date_started"
                           class="form-control small-box" value="{{old('date_started')}}"
                           placeholder="Choose when the promotion period starts....">
                     </div>
                     <div class="form-group">
                        <label for="date_expired">Date Expired</label>
                        <input type="datetime-local" name="date_expired" id="date_expired"
                           class="form-control small-box" value="{{old('date_expired')}}"
                           placeholder="Choose a discount expiration date from now">
                     </div>
                     <div class="form-group">
                        <label>Description:</label>
                        <textarea class="form-control" rows="4" name="content"
                           id="content">{{old('content')}}</textarea>
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
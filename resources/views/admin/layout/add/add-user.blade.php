@extends('admin.index')
@section('admin_section')
<!-- Page Content  -->
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-3">
            <div class="iq-card">
               <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title">Add New User</h4>
                  </div>
               </div>
               @include('post.create')
               <div class="iq-card-body">
                  <form>
                     <div class="form-group">
                        <div class="add-img-user profile-img-edit">
                           <img class="profile-pic img-fluid" src="{{asset('asset/images/user/11.png')}}"
                              alt="profile-pic">
                           <div class="p-image">
                              <a href="javascript:void();" class="upload-button btn iq-bg-primary">File Upload</a>
                              <input class="file-upload" type="file" accept="image/*">
                           </div>
                        </div>
                        <div class="img-extension mt-3">
                           <div class="d-inline-block align-items-center">
                              <span>Only</span>
                              <a href="javascript:void();">.jpg</a>
                              <a href="javascript:void();">.png</a>
                              <a href="javascript:void();">.jpeg</a>
                              <span>allowed</span>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>User Role:</label>
                        <select class="form-control" id="selectuserrole">
                           <option>Select</option>
                           <option>Web Designer</option>
                           <option>Web Developer</option>
                           <option>Tester</option>
                           <option>Php Developer</option>
                           <option>Ios Developer </option>
                        </select>
                     </div>
                     <div class="form-group">
                        <label for="furl">Facebook Url:</label>
                        <input type="text" class="form-control" id="furl" placeholder="Facebook Url">
                     </div>
                     <div class="form-group">
                        <label for="turl">Twitter Url:</label>
                        <input type="text" class="form-control" id="turl" placeholder="Twitter Url">
                     </div>
                     <div class="form-group">
                        <label for="instaurl">Instagram Url:</label>
                        <input type="text" class="form-control" id="instaurl" placeholder="Instagram Url">
                     </div>
                     <div class="form-group">
                        <label for="lurl">Linkedin Url:</label>
                        <input type="text" class="form-control" id="lurl" placeholder="Linkedin Url">
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="col-lg-9">
            <div class="iq-card">
               <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title">New User Information</h4>
                  </div>
               </div>
               <div class="iq-card-body">
                  <div class="new-user-info">
                     <form>
                        <h5 class="mb-3">Security</h5>
                        <div class="row">
                           <div class="form-group col-md-12">
                              <label for="uname">User Name:</label>
                              <input type="text" class="form-control" id="uname" placeholder="User Name">
                           </div>
                           <div class="form-group col-md-6">
                              <label for="pass">Password:</label>
                              <input type="password" class="form-control" id="pass" placeholder="Password">
                           </div>
                           <div class="form-group col-md-6">
                              <label for="rpass">Repeat Password:</label>
                              <input type="password" class="form-control" id="rpass" placeholder="Repeat Password ">
                           </div>
                        </div>
                        <div class="checkbox">
                           <label><input class="mr-2" type="checkbox">Enable Two-Factor-Authentication</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Add New User</button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
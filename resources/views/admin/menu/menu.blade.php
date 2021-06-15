<!-- Sidebar  -->

<div class="iq-sidebar">
   <div class="iq-sidebar-logo d-flex justify-content-between">
      <a href="{{route('admin.dashboard')}}" class="header-logo">
         <img src="{{asset('asset/backend/images/logo.png')}}" class="img-fluid rounded-normal" alt="">
         <div class="logo-title">
            <span class="text-primary text-uppercase">Bookstore</span>
         </div>
      </a>
      <div class="iq-menu-bt-sidebar">
         <div class="iq-menu-bt align-self-center">
            <div class="wrapper-menu">
               <div class="main-circle"><i class="las la-bars"></i></div>
            </div>
         </div>
      </div>
   </div>
   @include('admin.menu.side-bard')
</div>
<!-- TOP Nav Bar -->
<div class="iq-top-navbar">
   <div class="iq-navbar-custom">
      <nav class="navbar navbar-expand-lg navbar-light p-0">
         <div class="iq-menu-bt d-flex align-items-center">
            <div class="wrapper-menu">
               <div class="main-circle"><i class="las la-bars"></i></div>
            </div>
            <div class="iq-navbar-logo d-flex justify-content-between">
               <a href="{{route('admin.dashboard')}}" class="header-logo">
                  <img src="{{asset('asset/backend/images/logo.png')}}" class="img-fluid rounded-normal" alt="">
                  <div class="logo-title">
                     <span class="text-primary text-uppercase">Bookstore</span>
                  </div>
               </a>
            </div>
         </div>
         <div class="navbar-breadcrumb">
            <h5 class="mb-0 primary-text">Admin Panel</h5>
            <nav aria-label="breadcrumb">
               <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Admin</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{Route::currentRouteName()}}</li>
               </ul>
            </nav>
         </div>
         {{-- <div class="iq-search-bar">
            <form action="#" class="searchbox">
               <input type="text" class="text search-input" placeholder="Search Here...">
               <a class="search-link" href="#"><i class="ri-search-line"></i></a>
            </form>
         </div> --}}
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
            <i class="ri-menu-3-line"></i>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto navbar-list">
               {{-- <li class="nav-item nav-icon search-content">
                  <a href="#" class="search-toggle iq-waves-effect text-gray rounded">
                     <i class="ri-search-line"></i>
                  </a>
                  <form action="#" class="search-box p-0">
                     <input type="text" class="text search-input" placeholder="Type here to search...">
                     <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                  </form>
               </li> --}}
               {{-- Notification --}}
               <notification-user :user="{{ Auth::user()->load('notifications')}}"
                  :unreads="{{auth()->user()->unreadNotifications}}"></notification-user>
               <alert-info :user="{{ Auth::user()->user_id}}"></alert-info>
               <li class="nav-item nav-icon dropdown">
                  <a href="#" class="search-toggle iq-waves-effect text-gray rounded">
                     <i class="ri-mail-line"></i>
                     <span class="bg-primary dots"></span>
                  </a>
                  <div class="iq-sub-dropdown">
                     <div class="iq-card shadow-none m-0">
                        <div class="iq-card-body p-0 ">
                           <div class="bg-primary p-3">
                              <h5 class="mb-0 text-white">All Messages<small
                                    class="badge  badge-light float-right pt-1">5</small></h5>
                           </div>
                           <a href="#" class="iq-sub-card">
                              <div class="media align-items-center">
                                 <div class="">
                                    <img class="avatar-40 rounded" src="{{asset('images/user/1.jpg')}}" alt="">
                                 </div>
                                 <div class="media-body ml-3">
                                    <h6 class="mb-0 ">Barry Emma Watson</h6>
                                    <small class="float-left font-size-12">13 Jun</small>
                                 </div>
                              </div>
                           </a>
                           <a href="#" class="iq-sub-card">
                              <div class="media align-items-center">
                                 <div class="">
                                    <img class="avatar-40 rounded" src="{{asset('images/user/02.jpg')}}" alt="">
                                 </div>
                                 <div class="media-body ml-3">
                                    <h6 class="mb-0 ">Lorem Ipsum Watson</h6>
                                    <small class="float-left font-size-12">20 Apr</small>
                                 </div>
                              </div>
                           </a>
                           <a href="#" class="iq-sub-card">
                              <div class="media align-items-center">
                                 <div class="">
                                    <img class="avatar-40 rounded" src="{{asset('images/user/03.jpg')}}" alt="">
                                 </div>
                                 <div class="media-body ml-3">
                                    <h6 class="mb-0 ">Why do we use it?</h6>
                                    <small class="float-left font-size-12">30 Jun</small>
                                 </div>
                              </div>
                           </a>
                           <a href="#" class="iq-sub-card">
                              <div class="media align-items-center">
                                 <div class="">
                                    <img class="avatar-40 rounded" src="{{asset('images/user/04.jpg')}}" alt="">
                                 </div>
                                 <div class="media-body ml-3">
                                    <h6 class="mb-0 ">Variations Passages</h6>
                                    <small class="float-left font-size-12">12 Sep</small>
                                 </div>
                              </div>
                           </a>
                           <a href="#" class="iq-sub-card">
                              <div class="media align-items-center">
                                 <div class="">
                                    <img class="avatar-40 rounded" src="{{asset('images/user/05.jpg')}}" alt="">
                                 </div>
                                 <div class="media-body ml-3">
                                    <h6 class="mb-0 ">Lorem Ipsum generators</h6>
                                    <small class="float-left font-size-12">5 Dec</small>
                                 </div>
                              </div>
                           </a>
                        </div>
                     </div>
                  </div>
               </li>
               <li class="line-height pt-3">
                  @if(Auth::user()->image != null)
                  <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                     <img src="{{asset('/'.Auth::user()->image)}}" class="img-fluid rounded-circle mr-3" alt="user">
                     <div class="caption">
                        <h6 class="mb-1 line-height">{{Auth::user()->user_name}}</h6>
                     </div>
                  </a>
                  @else
                  <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                     <img src="{{asset('/images/users/user_default.svg')}}" class="img-fluid rounded-circle mr-3"
                        alt="user">
                     <div class="caption">
                        <h6 class="mb-1 line-height">{{Auth::user()->user_name}}</h6>
                     </div>
                  </a>
                  @endif
                  <div class="iq-sub-dropdown iq-user-dropdown">
                     <div class="iq-card shadow-none m-0">
                        <div class="iq-card-body p-0 ">
                           <div class="bg-primary p-3">
                              <h5 class="mb-0 text-white line-height">Hello {{Auth::user()->user_name}} </h5>
                              <span class="text-white font-size-12">{{Auth::user()->level}}</span>
                           </div>
                           <a href="profile.html" class="iq-sub-card iq-bg-primary-hover">
                              <div class="media align-items-center">
                                 <div class="rounded iq-card-icon iq-bg-primary">
                                    <i class="ri-file-user-line"></i>
                                 </div>
                                 <div class="media-body ml-3">
                                    <h6 class="mb-0 ">My Profile</h6>
                                    <p class="mb-0 font-size-12">View personal profile details.</p>
                                 </div>
                              </div>
                           </a>
                           <a href="profile-edit.html" class="iq-sub-card iq-bg-primary-hover">
                              <div class="media align-items-center">
                                 <div class="rounded iq-card-icon iq-bg-primary">
                                    <i class="ri-profile-line"></i>
                                 </div>
                                 <div class="media-body ml-3">
                                    <h6 class="mb-0 ">Edit Profile</h6>
                                    <p class="mb-0 font-size-12">Modify your personal details.</p>
                                 </div>
                              </div>
                           </a>
                           <a href="account-setting.html" class="iq-sub-card iq-bg-primary-hover">
                              <div class="media align-items-center">
                                 <div class="rounded iq-card-icon iq-bg-primary">
                                    <i class="ri-account-box-line"></i>
                                 </div>
                                 <div class="media-body ml-3">
                                    <h6 class="mb-0 ">Account settings</h6>
                                    <p class="mb-0 font-size-12">Manage your account parameters.</p>
                                 </div>
                              </div>
                           </a>
                           <a href="privacy-setting.html" class="iq-sub-card iq-bg-primary-hover">
                              <div class="media align-items-center">
                                 <div class="rounded iq-card-icon iq-bg-primary">
                                    <i class="ri-lock-line"></i>
                                 </div>
                                 <div class="media-body ml-3">
                                    <h6 class="mb-0 ">Privacy Settings</h6>
                                    <p class="mb-0 font-size-12">Control your privacy parameters.</p>
                                 </div>
                              </div>
                           </a>
                           <div class="d-inline-block w-100 text-center p-3">
                              <a class="bg-primary iq-sign-btn" href="{{route('admin.logout')}}" role="button">Sign out
                                 <i class="ri-login-box-line ml-2"></i></a>
                           </div>
                        </div>
                     </div>
                  </div>
               </li>
            </ul>
         </div>
      </nav>
   </div>
</div>
<!-- TOP Nav Bar END -->
<!-- Page Content  -->
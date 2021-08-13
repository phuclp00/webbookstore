<div id="sidebar-scrollbar">
   <nav class="iq-sidebar-menu">
      <ul id="iq-sidebar-toggle" class="iq-menu">
         <li><a href="{{route('admin.dashboard')}}"><i class="ri-dashboard-line"></i>Dashboard</a></li>
         <li>
            <a href="#book" class="iq-waves-effect" data-toggle="collapse" aria-expanded="false"><span
                  class="ripple rippleEffect"></span><i class="fa fa-book"></i><span>Book</span><i
                  class="ri-arrow-right-s-line iq-arrow-right"></i>
            </a>
            <ul id="book" class="iq-submenu collapse " data-parent="#iq-sidebar-toggle">
               <li><a href="{{route('admin.books')}}"><i class="ri-book-2-line"></i>Book List</a></li>
               <li><a href="{{route('admin.category')}}"><i class="ri-list-check-2"></i>Category</a></li>
               <li><a href="{{route('admin.tags')}}"><i class="ri-price-tag-3-line"></i>Tags</a></li>
               <li><a href="{{route('admin.promotions')}}"><i class="fa fa-gift" aria-hidden="true"></i>Promotions</a>
               </li>
               <li><a href="{{route('admin.publisher')}}"><i class="ri-file-user-line"></i>Publisher</a></li>
               <li><a href="{{route('admin.supplier')}}"><i class="ri-file-user-line"></i>Supplier</a></li>
               <li><a href="{{route('admin.author')}}"><i class="ri-file-user-line"></i>Author</a></li>
               <li><a href="{{route('admin.series')}}"><i class="ri-list-check-2"></i>Series</a></li>
               <li><a href="{{route('admin.format')}}"><i class="ri-book-2-line"></i>Format</a></li>
               <li><a href="{{route('admin.translator')}}"><i class="ri-file-user-line"></i>Translator</a></li>
            </ul>
         </li>
         <li>
            <a href="#userinfo" class="iq-waves-effect" data-toggle="collapse" aria-expanded="false"><span
                  class="ripple rippleEffect"></span><i class="las la-user-tie iq-arrow-left"></i><span>User</span><i
                  class="ri-arrow-right-s-line iq-arrow-right"></i></a>
            <ul id="userinfo" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle" style="">
               <li><a href="{{route('admin.users')}}"><i class="las la-th-list"></i>Manage User</a></li>
               <li><a href="{{route('admin.users.admin')}}"><i class="las la-th-list"></i>Admin Account</a></li>
               <li><a href="{{route('admin.users.rating')}}"><i class="las la-th-list"></i>Manage Rating</a></li>
            </ul>
         </li>
         <li>
            <a href="#order" class="iq-waves-effect" data-toggle="collapse" aria-expanded="false"><span
                  class="ripple rippleEffect"></span><i class="las la-receipt"></i><span>Orders</span><i
                  class="ri-arrow-right-s-line iq-arrow-right"></i></a>
            <ul id="order" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle" style="">
               <li><a href="{{route('admin.orders.ongoing.show')}}"><i class="las la-th-list"></i>OnGoing</a></li>
               <li><a href="{{route('admin.orders.complete.show')}}"><i class="las la-th-list"></i>Complete</a></li>
            </ul>
         </li>
         <li>
            <a href="#menu-level" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i
                  class="ri-record-circle-line iq-arrow-left"></i><span>Restore List</span><i
                  class="ri-arrow-right-s-line iq-arrow-right"></i></a>
            <ul id="menu-level" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
               <li class="menu-level">
                  <a href="#sub-menus" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i
                        class="ri-play-circle-line"></i><span>Book</span><i
                        class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                  <ul id="sub-menus" class="iq-submenu iq-submenu-data collapse">
                     <li><a href="{{route('admin.books.out_of_business')}}"><i class="ri-book-2-line"></i>Book List</a>
                     <li><a href="{{route('admin.publisher.old')}}"><i class="ri-record-circle-line"></i>Publisher</a>
                     </li>
                     <li><a href="{{route('admin.supplier.old')}}"><i class="ri-record-circle-line"></i>Supplier</a>
                     </li>
                     <li><a href="{{route('admin.category.old')}}"><i class="ri-record-circle-line"></i>Category</a>
                     </li>
                     <li><a href="{{route('admin.tags.old')}}"><i class="ri-price-tag-3-line"></i></i>Tags</a>
                     </li>
                     <li><a href="{{route('admin.promotions.old')}}">
                           <i class="fa fa-gift" aria-hidden="true">
                           </i>Promotions</a>
                     </li>
                     <li><a href="{{route('admin.author.old')}}"><i class="ri-record-circle-line"></i>Author</a></li>
                     <li><a href="{{route('admin.translator.old')}}"><i class="ri-record-circle-line"></i>Translator</a>
                     </li>
                     <li><a href="{{route('admin.series.old')}}"><i class="ri-record-circle-line"></i>Series</a></li>
                     <li><a href="{{route('admin.format.old')}}"><i class="ri-record-circle-line"></i>Book Format</a>
                     </li>
                     <li><a href="{{route('admin.type.old')}}"><i class="ri-record-circle-line"></i>Book Type</a>
                     </li>
                  </ul>
               </li>
               <li><a href="{{route('admin.orders.old')}}"><i class="ri-record-circle-line"></i>Order</a></li>
               <li><a href="{{route('admin.users.account.old')}}"><i class="ri-record-circle-line"></i>User List</a>
               </li>
               <li><a href="{{route('admin.users.admin.old')}}"><i class="ri-record-circle-line"></i>Admin Account</a>
               </li>
            </ul>
         </li>
         <li><a href="{{route('folder')}}"><i class="fa fa-folder"></i>Folder Manager</a></li>
      </ul>
   </nav>
   <div id="sidebar-bottom" class="p-3 position-relative">
      <div class="iq-card">
         <div class="iq-card-body">
            <div class="sidebarbottom-content">
               <div class="image"><img src="{{asset('asset/backend/images/page-img/side-bkg.png')}}" alt=""></div>
               <button type="submit" class="btn w-100 btn-primary mt-4 view-more">Become Membership</button>
            </div>
         </div>
      </div>
   </div>
</div>
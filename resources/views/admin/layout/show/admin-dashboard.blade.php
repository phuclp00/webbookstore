@extends('admin.index')
@section('admin_section')
<!-- Page Content  -->
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-6 col-lg-3">
            <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
               <div class="iq-card-body">
                  <div class="d-flex align-items-center">
                     <div class="rounded-circle iq-card-icon bg-primary"><i class="ri-user-line"></i></div>
                     <div class="text-left ml-3">
                        <h2 class="mb-0"><span class="counter">{{$users}}</span></h2>
                        <h5 class="">Users</h5>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-6 col-lg-3">
            <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
               <div class="iq-card-body">
                  <div class="d-flex align-items-center">
                     <div class="rounded-circle iq-card-icon bg-danger"><i class="ri-book-line"></i></div>
                     <div class="text-left ml-3">
                        <h2 class="mb-0"><span class="counter">{{$book_total}}</span></h2>
                        <h5 class="">Books</h5>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-6 col-lg-3">
            <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
               <div class="iq-card-body">
                  <div class="d-flex align-items-center">
                     <div class="rounded-circle iq-card-icon bg-warning"><i class="ri-shopping-cart-2-line"></i></div>
                     <div class="text-left ml-3">
                        <h2 class="mb-0"><span class="counter">{{$sales}}</span></h2>
                        <h5 class="">Sale</h5>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-6 col-lg-3">
            <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
               <div class="iq-card-body">
                  <div class="d-flex align-items-center">
                     <div class="rounded-circle iq-card-icon bg-info"><i class="ri-radar-line"></i></div>
                     <div class="text-left ml-3">
                        <h2 class="mb-0"><span class="counter">{{$orders}}</span></h2>
                        <h5 class="">Orders</h5>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-12">
            <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
               <div class="iq-card-header d-flex justify-content-between align-items-center">
                  <div class="iq-header-title">
                     <h4 class="card-title mb-0">Sales Revenue For The Month</h4>
                  </div>
               </div>
               <div class="iq-card-body">
                  <chart></chart>
               </div>
            </div>
         </div>
         <toplist-table type="view"></toplist-table>
         <toplist-table type="sales"></toplist-table>
      </div>
   </div>
</div>
@endsection
<!-- Wrapper END -->
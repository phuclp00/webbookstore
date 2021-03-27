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
                     <h4 class="card-title">Book Lists</h4>
                  </div>
                  <div class="iq-card-header-toolbar d-flex align-items-center">
                     <a href="{{route('admin.books.add.view')}}" class="btn btn-primary">Add New book</a>
                  </div>
               </div>
               <div class="iq-card-body">
                  <div class="table-responsive">
                     <table class="data-tables table table-striped table-bordered" style="width:100%">
                        <thead>
                           <tr>
                              <th style="width: 6%;">STT</th>
                              <th style="width: 12%;">Book Image</th>
                              <th style="width: 20%;">Book Name</th>
                              <th style="width: 7%;">Category</th>
                              <th style="width: 7%;">Publisher</th>
                              <th style="width: 10%;">Promotion Price</th>
                              <th style="width: 7%;">Book Price</th>
                              <th style="width: 7%;">Total</th>
                              <th style="width: 7%;">Total Sell</th>
                              <th style="width: 6%;">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($book as $data => $item)
                           <tr>
                              <td id="book_id">{{$item->book_id}}</td>
                              @if($item->img!=null)
                              <td><img class="img-fluid rounded" style="width: 170px;  height: 170px;"
                                    src="{{asset('images/books/'.$item->book_id.'/'.$item->img)}}" alt=""></td>
                              @else
                              <td><img class="img-fluid rounded" style="width: 250px;height: 250px;"
                                    src="{{asset('images/books/8k.jpg')}}" alt=""></td>
                              @endif
                              <td>{{$item->book_name}}</td>
                              <td>{{$item->category->cat_name}}</td>
                              <td>{{$item ->publisher->pub_name}}</td>
                              <td style="color:red">{{number_format($item->promotion_price,2)."$"}}</td>
                              <td>{{number_format($item->price,2)."$"}}</td>
                              <td>{{$item->total}}</td>
                              <td>{{$item->total_sell}}</td>
                              <td>
                                 <div class="flex align-items-center list-user-action">
                                    <a class="bg-primary option" data-toggle="tooltip" data-placement="top" title=""
                                       data-original-title="Edit" data-value="{{$item->book_id}}"
                                       href="{{route('admin.books.edit.view',['book_id'=>$item->book_id,'page'=>$book->currentPage(),'route'=>Request::route()->getName()])}}"><i
                                          class="ri-pencil-line"></i></a>
                                    <a class="bg-primary option" data-toggle="tooltip" data-text="{{$item->book_id}}"
                                       data-placement="top" title="" data-original-title="Delete"
                                       href="{{route('admin.books.delete',['book_id'=>$item->book_id])}}"><i
                                          class="ri-delete-bin-line"></i></a>
                                 </div>
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
            {{ $book->links('admin.pagination.simple'),["paginator"=>$book]}}
         </div>
      </div>
   </div>
</div>
@endsection
@push('script')

@endpush
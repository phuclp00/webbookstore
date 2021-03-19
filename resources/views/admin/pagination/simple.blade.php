@if(!empty($paginator) && $paginator->count())
<div id="paginate"class="row justify-content-between mt-3">
   <div id="user-list-page-info" class="col-md-6">
      <span>Showing {{$paginator->firstItem()}} to {{$paginator->lastItem()}} of {{$paginator->total()}}
         results</span>
   </div>
   <div class="col-md-6">
      <nav aria-label="Page navigation example">
         <ul class="pagination justify-content-end mb-0">
            @if($paginator->currentPage()==1)
            <li class="page-item disabled">
               <a class="page-link" href="{{$paginator->url(1)}}" aria-disabled="true">First</a>
            </li>
            @else
            <li class="page-item ">
               <a class="page-link" href="{{$paginator->url(1)}}">First</a>
            </li>
            @endif
            {!!$paginator->links() !!}
            @if($paginator->currentPage()==$paginator->lastPage())
            <li class="page-item disabled">
               <a class="page-link" href="{{$paginator->lastPage()}}" aria-disabled="true">Last</a>
            </li>
            @else
            <li>
               <a class="page-link" href="{{$paginator->lastPage()}}">Last</a>
            </li>
            @endif
         </ul>
      </nav>
   </div>
</div>
@else
<tr>
   <td colspan="10">There are no data.</td>
</tr>
@endif
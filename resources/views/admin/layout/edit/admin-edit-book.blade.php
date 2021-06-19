@extends('admin.index')
@section('admin_section')
<!-- Page Content  -->
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="iq-card">
               <a href="{{route('admin.books')}}"> <button type="button" class="btn btn-info btn-fixed"> Return
                     back</button></a>
               <div class="iq-card-img-top">
                  @if($book->img==null)
                  <img class="img-thumbnail rounded" src="{{asset('images/books/default.jpg')}}" alt="Book Image"
                     style="width: 350px;height: 300px;padding: 20px;">
                  @else
                  <img class="img-thumbnail rounded" src="{{asset($book->img)}}" alt="Book Image"
                     style="width: 350px;height: 300px;padding: 20px;">
                  @endif
               </div>
               <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title">Edit Books: {{$book->book_name}}</h4>
                  </div>
               </div>
               @include('post.create')
               <div class="iq-card-body">
                  <form action="{{route('admin.books.edit')}}" method="post" enctype="multipart/form-data">
                     @csrf
                     <div class="form-group">
                        <label>Book ID:</label>
                        <input name="id_block" type="text" class="form-control" value="{{$book->book_id}}" disabled>
                        <input name="book_id" type="hidden" class="form-control" value="{{$book->book_id}}">
                     </div>
                     <div class="form-group">
                        <label>Book Name:</label>
                        <input name="book_name" type="text" class="form-control" value="{{$book->book_name}}">
                     </div>
                     <div class="form-group">
                        <label>Barcode:</label>
                        <input name="code" type="text" class="form-control" value="{{$book->serialNumber}}">
                     </div>
                     <div class="form-group">
                        <label>Book Category:</label>
                        <select name="cat_id" class="form-control" id="exampleFormControlSelect1">
                           <option selected="" disabled="">Group Category</option>
                           @foreach($cat as $data=>$item)
                           @if($book->cat_id==$item->id)
                           <option value="{{$item->id}}" selected>{{$item->name}}</option>
                           @else
                           <option value="{{$item->id}}">{{$item->name}}</option>
                           @endif
                           @endforeach
                        </select>
                     </div>
                     <div class="form-group">
                        <label>Book Publisher:</label>
                        <select name="pub_id" class="form-control" id="exampleFormControlSelect2">
                           @foreach($pub as $data =>$item)
                           @if($book->pub_id==$item->id)
                           <option value="{{$item->id}}" selected>{{$item->name}}</option>
                           @else
                           <option value="{{$item->id}}">{{$item->name}}</option>
                           @endif
                           @endforeach
                        </select>
                     </div>
                     <div class="form-group">
                        <label>Book Supplier:</label>
                        <select name="sup_id" class="form-control" id="exampleFormControlSelect2">
                           @foreach($sup as $data =>$item)
                           @if($book->sup_id==$item->id)
                           <option value="{{$item->id}}" selected>{{$item->name}}</option>
                           @else
                           <option value="{{$item->id}}">{{$item->name}}</option>
                           @endif
                           @endforeach
                        </select>
                     </div>
                     <input-tags type="author" old_value="{{$book->book_id}}"></input-tags>
                     <div class="form-group">
                        <label>Book Series:</label>
                        @if ($book->series !=null)
                        <div class="input-group">
                           <select id="series" name="series" class="form-control">
                              <option selected="" disabled="">Book Series</option>
                              @isset($series)
                              @foreach($series as $data =>$item)
                              @if($book->series==$item->id)
                              <option value="{{$item->id}}" selected>{{$item->name}}</option>
                              @else
                              <option value="{{$item->id}}">{{$item->name}}</option>
                              @endif
                              @endforeach
                              @endisset
                           </select>
                           <div class="input-group-append">
                              <button class="btn btn-primary" type="button" id="series-button">Not In
                                 Series</button>
                           </div>
                        </div>
                        <label for="new_series" style="font-style: italic"> Add new series :</label>
                        <input type="text" class="form-control" name="new_series" id="new_series"
                           value="{{ old('new_series') }}" readonly>
                        <label for="episode"> Number of episode: </label>
                        <input type="number" name="episode" id="episode" class="form-control small-box"
                           value="{{$book->episode}}">
                        @else
                        <div class="input-group">
                           <select id="series" name="series" class="form-control" disabled>
                              <option selected="" disabled="">Book Series</option>
                              @isset($series)
                              @foreach($series as $data =>$item)
                              @if($book->series==$item->id)
                              <option value="{{ old('series')}}" selected>{{$item->name}}</option>
                              @else
                              <option value="{{$item->id}}">{{$item->name}}</option>
                              @endif
                              @endforeach
                              @endisset
                           </select>
                           <div class="input-group-append">
                              <button class="btn btn-danger" type="button" id="series-button">Enable Series</button>
                           </div>
                        </div>
                        <label for="new_series" style="font-style: italic"> Add new series :</label>
                        <input type="text" class="form-control" name="new_series" id="new_series"
                           value="{{ old('new_series') }}" disabled>
                        <label for="episode"> Number of episode: </label>
                        <input type="number" name="episode" id="episode" class="form-control small-box"
                           value="{{old('episode')}}" disabled>
                        @endif
                     </div>
                     <div class="form-group">
                        <label for="format">Book Format:</label>
                        <select id="format" name="format" class="form-control">
                           <option selected="" disabled="">Book Format</option>
                           @isset($format)
                           @foreach($format as $data =>$item)
                           @if($book->bookFormat==$item->id)
                           <option value="{{$item->id}}" selected>{{$item->name}}</option>
                           @else
                           <option value="{{$item->id}}">{{$item->name}}</option>
                           @endif
                           @endforeach
                           @endisset
                        </select>
                        <label for="new_format" style="font-style: italic"> Add new book format :</label>
                        <input type="text" class="form-control" name="new_format" id="new_format"
                           value="{{old('new_format')}}" readonly>
                     </div>
                     <div class="form-group">
                        <label>Number Of Pages:</label>
                        <input name="page_number" type="text" class="form-control" value="{{ $book->numberOfPages}}">
                     </div>
                     <div class="form-group">
                        <label>Weight Of Book:</label>
                        <div class="input-group mb-3">
                           <input name="weight" type="text" class="form-control" value="{{$book->weight}}">
                           <div class="input-group-append">
                              <span class="input-group-text" id="basic-addon2">gram</span>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Size Of Book:</label>
                        <div class="input-group mb-3">
                           <input name="size_height" type="text" class="form-control"
                              placeholder="The height of book ..... " value="{{ $height }}">
                           <input name="size_width" type="text" class="form-control"
                              placeholder="The width of book ......." value="{{ $width }}">
                           <div class="input-group-append">
                              <span class="input-group-text" id="basic-addon2">AA x AA cm</span>
                           </div>
                        </div>
                     </div>
                     <date-picker :date_published="'{{$book->datePublished}}'">
                     </date-picker>
                     <div class="form-group">
                        <label>Copyright Year:</label>
                        <input name="copyright" type="text" class="form-control" value="{{ $book->copyrightYear }}">
                     </div>
                     <div class="form-group">
                        <label>Language:</label>
                        <select name="language" class="form-control">
                           <option selected="" disabled="">Language</option>
                           @foreach($language as $key =>$value)
                           @if($book->language==$key)
                           <option value="{{$key}}" selected>{{$value}}</option>
                           @else
                           <option value="{{$key}}">{{$value}}</option>
                           @endif
                           @endforeach
                        </select>
                     </div>
                     <div class="form-group">
                        <label>Translator:</label>
                        @if ($book->translator !=null)
                        <div class="input-group">
                           <select id="translator" name="translator" class="form-control">
                              <option selected="" disabled="">Translator</option>
                              @isset($translator)
                              @foreach($translator as $data =>$item)
                              @if($book->translator==$item->id)
                              <option value="{{$item->id}}" selected>{{$item->name}}</option>
                              @else
                              <option value="{{$item->id}}">{{$item->name}}</option>
                              @endif
                              @endforeach
                              @endisset
                           </select>
                           <div class="input-group-append">
                              <button class="btn btn-primary" type="button" id="trans-button">Disable
                                 Translator</button>
                           </div>
                        </div>
                        <label for="new_translator" style="font-style: italic"> Add New Translator :</label>
                        <input type="text" class="form-control" id="new_translator" name="new_translator"
                           value="{{old('new_translator')}}" readonly>
                        @else
                        <div class="input-group">
                           <select id="translator" name="translator" class="form-control" disabled>
                              <option selected="" disabled="">Translator</option>
                              @isset($translator)
                              @foreach($translator as $data =>$item)
                              @if(old('translator')==$item->id)
                              <option value="{{$item->id}}" selected>{{$item->name}}</option>
                              @else
                              <option value="{{$item->id}}">{{$item->name}}</option>
                              @endif
                              @endforeach
                              @endisset
                           </select>
                           <div class="input-group-append">
                              <button class="btn btn-danger" type="button" id="trans-button">Enable
                                 Translator</button>
                           </div>
                        </div>
                        <label for="new_translator" style="font-style: italic"> Add New Translator :</label>
                        <input type="text" class="form-control" id="new_translator" name="new_translator"
                           value="{{old('new_translator')}}" disabled>
                        @endif


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
                     @if($book->thumb !=null)
                     <div class="form-group">
                        <label class="custom-file text-bold">List Thumbnail Available:</label>
                        {{-- <div>
                           @foreach ($book->thumb as $key=>$item)
                           <img src="{{asset("$item")}}" alt="{{$item->description}}"
                        style="width: 350px;height: 275px;padding: 10px">
                        @endforeach
                     </div> --}}
                     <thumbnail-list :thumbnail="{{$book->thumb}}"></thumbnail-list>
               </div>
               @endif
               <div class="form-group">
                  <label>Price:</label>
                  <input name="price" type="text" class="form-control" value="{{$book->price}}">
               </div>
               @if ($book->promotion_price!=null)
               <div class="form-group">
                  <label>Promotion Price:</label>
                  <div class="input-group">
                     <input id="promotion" name="promotion" type="text" class="form-control"
                        value="{{ $book->promotion_price }}">
                     <div class="input-group-append">
                        <button class="btn btn-primary" type="button" id="promo-button">Disable
                           Promotion</button>
                     </div>
                  </div>
               </div>
               @else
               <div class="form-group">
                  <label>Promotion Price:</label>
                  <div class="input-group">
                     <input id="promotion" name="promotion" type="text" class="form-control" value="" disabled>
                     <div class="input-group-append">
                        <button class="btn btn-danger" type="button" id="promo-button">Enable
                           Promotion</button>
                     </div>
                  </div>
               </div>
               @endif

               <div class="form-group">
                  <label>Total Number of Books:</label>
                  <input id="total" name="total" type="text" class="form-control" value="{{ $book->total }}">
               </div>
               <div class="form-group">
                  <label>Book Description:</label>
                  <textarea class="form-control" rows="4" name="content" id="editor">{!!$book->description !!}
                        </textarea>
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
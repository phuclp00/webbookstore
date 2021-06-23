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
               <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title">Add New Book</h4>
                  </div>
               </div>
               @include('post.create')
               <div class="iq-card-body">
                  <form action="{{route('admin.books.add')}}" method="post" enctype="multipart/form-data"
                     autocomplete="on">
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
                        <label>Barcode:</label>
                        <input name="code" type="number" class="form-control" value="{{ old('code') }}">
                     </div>
                     <div class="form-group">
                        <label>Book Category:</label>
                        <select name="cat_id" class="form-control">
                           <option selected="" disabled="">Book Category</option>
                           @foreach($cat as $data=>$item)
                           @if(old('cat_id')==$item->id)
                           <option value="{{$item->id}}" selected>{{$item->name}}</option>
                           @else
                           <option value="{{$item->id}}">{{$item->name}}</option>
                           @endif
                           @endforeach
                        </select>
                     </div>
                     <div class="form-group">
                        <label>Book Publisher:</label>
                        <select name="pub_id" class="form-control">
                           <option selected="" disabled="">Book Publisher</option>
                           @foreach($pub as $data =>$item)
                           @if(old('pub_id')==$item->id)
                           <option value="{{$item->id}}" selected>{{$item->name}}</option>
                           @else
                           <option value="{{$item->id}}">{{$item->name}}</option>
                           @endif
                           @endforeach
                        </select>
                     </div>
                     <div class="form-group">
                        <label>Book Supplier:</label>
                        <select name="sup_id" class="form-control">
                           <option selected="" disabled="">Book Supplier</option>
                           @foreach($sup as $data =>$item)
                           @if(old('sup_id')==$item->id)
                           <option value="{{$item->id}}" selected>{{$item->name}}</option>
                           @else
                           <option value="{{$item->id}}">{{$item->name}}</option>
                           @endif
                           @endforeach
                        </select>
                     </div>
                     {{-- <div class="form-group">
                        <label>Book Author:</label>
                        <select id="author" name="author" class="form-control">
                           <option selected="" disabled="">Book Author</option>
                           @isset($auth)
                           @foreach($auth as $data =>$item)
                           @if(old("author")==$item->id)
                           <option value="{{$item->id}}" selected>{{$item->name}}</option>
                     @else
                     <option value="{{$item->id}}">{{$item->name}}</option>
                     @endif
                     @endforeach
                     @endisset
                     </select>
                     <label for="new_author" style="font-style: italic"> Add new author :</label>
                     <input type="text" class="form-control" name="new_author" id="new_author"
                        value="{{ old('new_author') }}" readonly>
               </div> --}}
               <input-tags type="author" old_value="{{old('author')}}"></input-tags>
               <div class="form-group">
                  <label>Book Series:</label>
                  <div class="input-group">
                     <select id="series" name="series" class="form-control">
                        <option selected="" disabled="">Book Series</option>
                        @isset($series)
                        @foreach($series as $data =>$item)
                        @if(old("series")==$item->id)
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
                     value="{{old('episode')}}">
               </div>
               <div class="form-group">
                  <label for="format">Book Format:</label>
                  <select id="format" name="format" class="form-control">
                     <option selected="" disabled="">Book Format</option>
                     @isset($format)
                     @foreach($format as $data =>$item)
                     @if(old('format')==$item->id)
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
                  <input type="number" min="0" name="page_number" type="text" class="form-control"
                     value="{{ old('page_number') }}">
               </div>
               <div class="form-group">
                  <label>Weight Of Book:</label>
                  <div class="input-group mb-3">
                     <input type="number" name="weight" type="text" class="form-control" min="0"
                        value="{{ old('weight') }}">
                     <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">gram</span>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <label>Size Of Book:</label>
                  <div class="input-group mb-3">
                     <input name="size_height" type="text" class="form-control" placeholder="The height of book ..... "
                        value="{{ old('size_height') }}">
                     <input name="size_width" type="text" class="form-control" placeholder="The width of book ......."
                        value="{{ old('size_width') }}">
                     <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">AA x AA cm</span>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <label>Date Published:</label>
                  <input type="date" name="date_published" type="text" class="form-control"
                     value="{{ old('date_published') }}">
               </div>
               <div class="form-group">
                  <label>Copyright Year:</label>
                  <input type="number" name="copyright" min="0" max="{{date('Y')}}" type="text" class="form-control"
                     value="{{ old('copyright') }}">
               </div>
               <div class="form-group">
                  <label>Language:</label>
                  <select name="language" class="form-control">
                     <option selected="" disabled="">Language</option>
                     @foreach($language as $key =>$value)
                     @if(old('language')==$key)
                     <option value="{{$key}}" selected>{{$value}}</option>
                     @else
                     <option value="{{$key}}">{{$value}}</option>
                     @endif
                     @endforeach
                  </select>
               </div>
               {{-- <div class="form-group">
                  <label>Translator:</label>
                  <div class="input-group">
                     <select id="translator" name="translator" class="form-control">
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
                  <button class="btn btn-primary" type="button" id="trans-button">Disable
                     Translator</button>
               </div>
            </div>
            <label for="new_translator" style="font-style: italic"> Add New Translator :</label>
            <input type="text" class="form-control" id="new_translator" name="new_translator"
               value="{{old('new_translator')}}" readonly>
         </div> --}}
         <input-tags type="translator" old_value="{{old('translator')}}"
            status="{{old('translator')!=null?true:false}}"></input-tags>
         <div class="form-group">
            <label>Book Image:</label>
            <div class="custom-file">
               <input id="picture" name="img" type="file" class="custom-file-input"
                  onchange="javascript:showname_file()" accept="image/png, image/jpeg" value="{{old('img')}}">
               <label class="custom-file-label">Choose file</label>
            </div>
            <div id="file_name" class="btn-outline-danger"></div>
         </div>
         <div class="form-group">
            <label>Book Thumbnail List:</label>
            <div class="custom-file">
               <input id="thump" type="file" name="thumb[]" class="custom-file-input"
                  onchange="javascript:showlist_thumb()" accept="image/png, image/jpeg" value="{{ old('thumb[]') }}"
                  multiple>
               <label class="custom-file-label">Choose file</label>
            </div>
            <div id="fileList" class="btn-outline-danger"></div>
         </div>
         <div class="form-group">
            <label>Price:</label>
            <input type="number" name="price" type="text" class="form-control" value="{{ old('price') }}">
         </div>
         <div class="form-group">
            <label>Promotions:</label>
            <div class="input-group">
               <select id="promotion" name="promotion" class="form-control">
                  <option selected="" disabled="">Promotions</option>
                  @isset($promotion)
                  @foreach($promotion as $data =>$item)
                  @if(old('promotion')==$item->id)
                  <option value="{{$item->id}}" selected>{{$item->name}}</option>
                  @else
                  <option value="{{$item->id}}">{{$item->name}}</option>
                  @endif
                  @endforeach
                  @endisset
               </select>
               <div class="input-group-append">
                  <button class="btn btn-primary" type="button" id="promo-button">Disable
                     Promotion</button>
               </div>
            </div>
         </div>
         <div class="form-group">
            <label>Total Number of Books:</label>
            <input id="total" name="total" type="number" class="form-control" min="0" value="{{ old('total') }}">
         </div>
         <div class="form-group">
            <label for="editor">Book Description:</label>
            <textarea class="form-control" rows="4" name="content" id="editor">{{ old('content') }}
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
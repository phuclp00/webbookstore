<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Image;

class ImagesController extends Controller
{
    private $width;
    private $height;
    private $folder;
    private $time;
    public function __construct($width, $height, $folder)
    {
        $this->width = $width;
        $this->height = $height;
        $this->folder = $folder;
    }
    public function show($url)
    {
        $exists = Storage::exists($url);
        if ($exists != null) {
            $contents = Storage::url($url);
            return $contents;
        }
    }
    public function restore($url)
    {
        Storage::move($url);
    }
    public function trash($url)
    {
        if ((Storage::exists("trash/$url"))) {
            Storage::move("trash/$url", "trash/$url" . "_" . Carbon::now()->timestamp);
        }
        Storage::move($url, "trash/$url");
        return true;
    }
    public function store($request, $option = null)
    {

        $folder = $option == null ? "books" : $option;
        //File extension
        $ext = $request->getClientOriginalExtension();
        //Rename file 
        $path = "images/$folder/$this->folder/" . md5($request->getClientOriginalName()) . "." . $ext;
        // Resize file
        $img_resize = (string) Image::make($request)->resize($this->width, $this->height)->encode($ext);
        //Upload
        Storage::put($path, $img_resize);
        //Return path
        return $path;
    }
    public function update($file_new, $file_old, $option = null)
    {
        $folder = $option == null ? "books" : $option;
        //Check file exist 
        if (Storage::exists($file_old)) {
            //delete if exist
            $this->trash($file_old);
        };
        //File extension
        $ext = $file_new->getClientOriginalExtension();
        //Rename file 
        $path = "images/$folder/$this->folder/" . md5($file_new->getClientOriginalName()) . "." . $ext;
        // Resize file
        $img_resize = (string) Image::make($file_new)->resize($this->width, $this->height)->encode($ext);
        //Upload
        Storage::put($path, $img_resize);
        //Return path
        return $path;
    }
    public function destroy($option = null)
    {
        $folder = $option == null ? "books" : $option;
        $url = "images/$folder/" . $this->folder;
        $check = Storage::exists($url);
        if ($check) {
            $this->trash($url);
            return true;
        };
        return false;
    }
}

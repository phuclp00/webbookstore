<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

class FileuploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($request, $folder, $name, $type)
    {
        $width = 0;
        $height = 0;
        try {
            if ($type == "thumb") {
                $width = 450;
                $height = 565;
            } elseif ($type == "avt") {
                $width = 170;
                $height = 170;
            } elseif ($type == "banner") {
                $width = 1920;
                $height = 1285;
            } else 
            {
                $width = 50;
                $height = 50;
            }
            //File name
            $file_name = $request->getClientOriginalName();
            //File extension
            $ext = $request->getClientOriginalExtension();
            // Resize file
            $img_resize = Image::make($request)->fit($width, $height)->encode($ext);
            if ($name == null) {
                //$path = (string)$img_resize->storeAs($folder, $file_name, 'images');
                Storage::put($folder . "/" . $file_name, (string)$img_resize);
                $path = Storage::url($file_name);
                return $path;
            } else {
                $path = (string)$img_resize->storeAs($folder, $name . "." . $ext, 'images');
                return true;
            }
            //Update lai thong tin nguoi dung 
        } catch (Exception $e) {
            return \false;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fileupload  $fileupload
     * @return \Illuminate\Http\Response
     */
    public function show(Fileupload $fileupload)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fileupload  $fileupload
     * @return \Illuminate\Http\Response
     */
    public function edit(Fileupload $fileupload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fileupload  $fileupload
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fileupload $fileupload)
    {
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fileupload  $fileupload
     * @return \Illuminate\Http\Response
     */
    public function destroy($folder, $public_path, $option = null)
    {
        try {
            if ($option == null) {
                if (Storage::has($folder . "/" . $public_path)) {
                    Storage::deleteDirectory($folder . "/" . $public_path);
                    return true;
                } else
                    return false;
            } else {
                if (Storage::has($option)) {
                    Storage::delete($option);
                    return true;
                } else
                    return false;
            }
            return false;
        } catch (\Throwable $th) {
            throw new Exception("Error Processing Request", $th->__toString());
        }
    }
}

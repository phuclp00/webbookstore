<?php

namespace App\Http\Controllers;

use App\Models\Fileupload;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    public function store($request, $folder, $name = null)
    {
        try {
            $ext = $request->clientExtension();
            if ($name == null) {
                $path = $request->storeAs($folder, $request->getClientOriginalName(), 'images');
                return true;
            } else {
                $path = $request->storeAs($folder, $name . "." . $ext, 'images');
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
        //
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
                Storage::deleteDirectory($public_path."/".$folder);
            } else {
                Storage::delete([$option]);
            }
        } catch (\Throwable $th) {
            throw new Exception("Error Processing Request", $th->__toString());
        }
    }
}

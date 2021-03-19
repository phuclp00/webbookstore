<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublisherRequest;
use Illuminate\Http\Request;
use App\Models\PublisherModel as MainModel;
use App\Models\ProductModel;
use App\Models\PublisherModel;
use Exception;

class PublisherController extends Controller
{
    private $subpatchViewController = '.page';
    private $pathViewController = 'public.';

    public function __construct()
    {
    }
    public function list_category()
    {
        $mainModel =  new MainModel();
        $items = $mainModel->listItems(null, ['task' => "frontend-list-items"]);

        view()->share('list_category', $items);
    }
    public function top_list_category()
    {
        $mainModel =  new MainModel();
        $top_items = $mainModel->listItems(null, ['task' => "top-list-items"], null, 5);

        view()->share('top_list_category', $top_items);
    }

    public function edit_publisher(PublisherRequest $request)
    {
        try {
            $data = PublisherModel::find($request->pub_id);
            $file = new FileuploadController();

            $data->pub_name = $request->pub_name;
            $temp_file = $request->img == null ? null : $request->img;
            if ($temp_file != null) {

                //Delete old image
                if ($data->pub_img != null) {
                    $file->destroy(null, null, "publisher/$data->pub_img");
                }
                //update new image
                $data->pub_img =  $data->pub_id . "_" . $data->pub_name . "." . $temp_file->clientExtension();
            }
            $data->description = $request->content;
            $result = $data->save();
            //Store image after update
            if ($result == true && $temp_file != null) {
                $file->store($request->img, "publisher", $data->pub_id . "_" . $data->pub_name);
            }
            $request->session()->flash('info_warning', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> Add ' . $request->pub_name . ' Successfully !! </div>');
            return \redirect()->route('admin.publisher');
        } catch (\Throwable $th) {
            $request->session()->flash('info_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Add ' . $request->pub_name . 'Fail,Try Again !! </div>');
            return \redirect()->back();
        }
    }
    public function add_publisher(PublisherRequest $request)
    {

        try {
            $data = new PublisherModel();
            $data_file = new FileuploadController();
            $data->pub_id = $request->pub_id;
            $data->pub_name = $request->pub_name;
            $temp_file = $request->img;
            $data->pub_img = $temp_file->getClientOriginalName();
            $data->description = $request->content;
            $data_file->store($request->img, 'publisher');
            $data->save();
            $request->session()->flash('info_warning', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> Edit ' . $request->pub_name . ' Successfully !! </div>');

            return \redirect()->route('admin.publisher');
        } catch (\Throwable $th) {
            $request->session()->flash('info_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Edit ' . $request->pub_name . 'Fail,Try Again !! </div>');

            return \redirect()->back();
        }
    }
    public function delete_publisher(Request $request)
    {
        try {
            MainModel::destroy($request->pub_id);
            $request->session()->flash('info_warning', '<div class="alert alert-success" style="text-align: center;font-size: x-large;font-family: fangsong;"> Delete ' . $request->pub_name . ' Successfully !! </div>');
        } catch (Exception $e) {
            $request->session()->flash('info_warning', '<div class="alert alert-danger" style="text-align: center;font-size: x-large;font-family: fangsong;"> Delete ' . $request->pub_name . 'Failed, Cannot Be Deleted If It Has Been Used By A Book !! </div>');
        } finally {
            return \redirect()->route("admin.publisher");
        }
    }
}

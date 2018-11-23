<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\service;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use Validator;
class serviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $service = new service;
        return response()->json($service->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {

        $validator = Validator::make($req->all(), [
        'image' => 'required|image64:jpeg,jpg,png'
         ]);
         if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()],401);
        } else {
        $service = new service;
        $image = $req->get('image');
        $fileNameimage = Carbon::now()->timestamp . uniqid() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        $destinationPath = public_path('/img/service/');
        Image::make($req->get('image'))->save(public_path('img/service/').$fileNameimage);
        $service->title = $req->service['title'];
        $service->image = 'img/service/'.$fileNameimage;
        $service->save();
        return response()->json(200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        service::where('id',$id)->update(['title' => $req->title]);
    }

    public function updateImage(Request $req, $id)
    {
       $validator = Validator::make($req->all(), [
        'image' => 'required|image64:jpeg,jpg,png'
         ]);
         if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()],401);
        } else {
        $service = new service;
        $image = $req->get('image');
        $fileNameimage = Carbon::now()->timestamp . uniqid() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        $destinationPath = public_path('/img/service/');
        Image::make($req->get('image'))->save(public_path('img/service/').$fileNameimage);
        service::where('id',$id)->update([
            'image' => 'img/service/'.$fileNameimage
        ]);
        return response()->json(200);
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = new service;
        $service::where('id',$id)->delete();
        return response()->json(200);
    }
}

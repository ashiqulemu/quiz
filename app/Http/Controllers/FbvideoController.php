<?php

namespace App\Http\Controllers;

use App\fbvideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;


class FbvideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (auth()->user()->role === "admin" || auth()->user()->role === "sub-admin") {
            return view('admin.pages..quiz.fbvideo.index');

        }
        else {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'You are not Admin'
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


//        if($request->hasFile('video')) {

//            $filenameWithExt = $request->file('video')->getClientOriginalName();
//            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
//            $extension = $request->file('video')->getClientOriginalExtension();
//            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
//            $destination = '/public/video';
//            $request->file( 'video' )->move( base_path() . $destination, $fileNameToStore );
            $vstore = new fbvideo();
            $vstore->name = $request->name;
            $vstore->video = 'abc.mp4';
            $vstore->status = "Unpublish";
            $vstore->save();
            return redirect()->back()->with([
                'type' => 'success',
                'message' => 'Youtube Url has been added Successfully'
            ]);
//        }
//        else{
//            return redirect()->back()->with([
//                'type' => 'error',
//                'message' => 'Something wrong. please check video format'
//            ]);
//        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\fbvideo  $fbvideo
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if (auth()->user()->role === "admin" || auth()->user()->role === "sub-admin") {

            $video=DB::table('fbvideos')
                        ->select('*')
                        ->get();

            return view('admin.pages.quiz.fbvideo.show',['videos'=>$video]);

        }
        else {
            return redirect()->back()->with([
                'type' => 'error',
                'message' => 'You are not Admin'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\fbvideo  $fbvideo
     * @return \Illuminate\Http\Response
     */
    public function edit(fbvideo $fbvideo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\fbvideo  $fbvideo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, fbvideo $fbvideo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\fbvideo  $fbvideo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = fbvideo::findOrFail($id);
//        $image_path = app_path("images/news/".$video->video);

//        if(file_exists($image_path)){
//            //File::delete($image_path);
//            File::delete( $image_path);
//        }
        $video->delete();
        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Youtubr Url deleted Successfully!!'
        ]);
    }

    public function publish($id)
    {
            $id=(int)$id;
           $clean=DB::table('fbvideos')
               ->select('id')
               ->where('status','=','Publish')
               ->get();
           if(sizeof($clean)>0)
           {
               $erase=fbvideo::findorfail($clean[0]->id);
               $erase->status="Unpublish";
               $erase->save();

               $publish=fbvideo::findorfail($id);
               $publish->status="Publish";
               $publish->save();
               return redirect()->back()->with([
                   'type' => 'success',
                   'message' => 'Publish Successfully!!'
               ]);

           }
           else{
               $publish=fbvideo::findorfail($id);
               $publish->status="Publish";
               $publish->save();
               return redirect()->back()->with([
                   'type' => 'success',
                   'message' => 'Publish Successfully!!'
               ]);
           }

    }
    public function promo(){

        $video= DB::table('fbvideos')
            ->select('*')
             ->where('status','=','Publish')
              ->get();


        return view('galaxy.video',['video'=>$video]);


    }
}

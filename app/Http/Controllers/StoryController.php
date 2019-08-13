<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Story;
use App\Http\Requests\StoryRequest;

// イメージアップロードのためのクラス
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;

class StoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except( ['index', 'show'] );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
      $stories = Story::latest()->paginate(12);
      return view('stories.index', ['stories' => $stories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('stories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoryRequest $request)
    {
      // 画像の処理
      $fileName = $this->imageUpload($request);
      $story = new Story();
      $story->user_id = Auth::user()->id;
      $story->title = $request->title;
      $story->body = $request->body;
      $story->price = $request->price;
      $story->image = $fileName;

      // $user = Auth::user();
      $story->save();

      return redirect('/stories');
    }

        protected function imageUpload($request)
        {
          $user_dir = 'user_' . sprintf('%07d', Auth::user()->id);
          $path = public_path() . '/img/uploaded/' . $user_dir;
          if( !file_exists($path) ){
            $result = \File::makeDirectory($path);
          }

          if($request->hasFile('image')){
            $image = Input::file('image');
            $fileName = $user_dir . '/' . $image->getClientOriginalName();
            $path .= '/' . $image->getClientOriginalName();
            Image::make($image)->resize(300, 200)->save($path);
          }else{
            $fileName = 'noimage.jpg';
          }

          return $fileName;
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $story
     * @return \Illuminate\Http\Response
     */
    public function show($story)
    {
      return view( 'stories.show', ['story' => $story] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $story
     * @return \Illuminate\Http\Response
     */
    public function edit($story)
    {
        return view('stories.edit', ['story' => $story]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $story
     * @return \Illuminate\Http\Response
     */
    public function update(StoryRequest $request, $story)
    {
      if( $request->hasFile('image') ){
        if($story->image !== 'noimage.jpg'){
          unlink(public_path() . '/img/uploaded/' . $story->image);
        }
        $fileName = $this->imageUpload($request);
      }elseif(isset($request->del_image)){
        if($story->image !== 'noimage.jpg'){
          unlink(public_path() . '/img/uploaded/' . $story->image);
        }
        $fileName = 'noimage.jpg';
       }else{
          $fileName = $story->image;
        }

      $story->title = $request->title;
      $story->body = $request->body;
      $story->price = $request->price;
      $story->image = $fileName;
      $story->save();

      return redirect('/stories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $story
     * @return \Illuminate\Http\Response
     */
    public function destroy($story)
    {
      if($story->image !== 'noimage.jpg'){
        unlink(public_path() . '/img/uploaded/' . $story->image);
      }
      $story->delete();
      return redirect('/stories');
    }
}

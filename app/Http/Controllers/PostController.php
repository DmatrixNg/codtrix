<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Parsedown;
use Mni\FrontYAML\Parser;
use KzykHys\FrontMatter\FrontMatter;
use Symfony\Component\Finder\Finder;
use KzykHys\FrontMatter\Document as Doc;
use Storage;
use Auth;
use DB;

use App\tutorial;

class PostController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
    {
      $username = Auth::user()->id;

             $app  = new \App\Core\Document($username);
             $posts=$app->fetchAllRss();


return view('home',compact('user','posts'));

     }

public function activate($id, $request)
{
  $user =   DB::table('users')->where('id', $request)

  ->update(
    [
      'pay_status' => 'Paid'
    ]
  );
  //dd($user);
if ($user) {
 return redirect('/admin/users')->with('message', 'done');
}
return redirect('/admin/users')->with('message', 'done');
}
public function deactivate($request, $id)
{
  $user =   DB::table('users')->where('id', $id)->update(
    [
      'pay_status' => null
    ]
  );
if ($user) {
 return redirect('/admin/users')->with('message', 'done');
}
return redirect('/admin/users')->with('message', 'done');
}
     public function publish(Request $request) {
       $title = isset($request->title) ? $request->title : '';
       $content = $request->postVal;
       $tags = $request->tags;


     $initial_images = array_filter($request->all(), function ($key) {
       return preg_match('/^img-\w*$/', $key);
   }, ARRAY_FILTER_USE_KEY);

   $images = [];
   foreach ($initial_images as $key => $value) {
       $newKey = preg_replace('/_/', '.', $key);
       $images[$newKey] = $value;
       // Log::debug($value);

   }
        $post = new \App\Core\Document("admin");
        $createPost = $post->createPost($title, $content, $tags, $images,"admin");

      //  dd(  $createPost);
        if($createPost){
          return response()->json(["error" => false, "action"=>"publish", "message" => "Post published successfully"],200);
        }else{
          return response()->json(["error" => true, "action"=>"publish", "message" => "Fail while publishing, please try again"]);
        }
    }
    public function deletePost(Request $request, $username){
           $post = DB::table('posts')->where('id',$request->post_id)->first();
           $parsedown  = new Parsedown();
           $postContent = $parsedown->text($post->content);
           preg_match_all('/<img[^>]+src="((\/|\w|-)+\.[a-z]+)"[^>]*\>/i', $postContent, $matches);
           foreach($matches[1] as $found_img) {
             $image_name_array = explode('/',$found_img);
             $img_name = end($image_name_array);
             $imagePath = storage_path('app/public/'.$post->user_id.'/images/'.$img_name);
             if(file_exists($imagePath)) {
               unlink($imagePath);
             }
           }
           DB::table('notifications')->where('post_id',$post->id)->delete();
            DB::table('extfeeds')->where('title',$post->title)->delete();
          $deletePost = DB::table('posts')->where('id',$post->id)->delete();
          if($deletePost) {
            return response()->json(['success'=>"Post Successfully Deleted"],200);
          }else{
            return response()->json(['error'=>"Something not right"],500);
          }

        }
        public function singlePostPage($username,$postSlug){
        // return $postSlug;


          $app  = new \App\Core\Document($username);
        //  $id = base64_decode($id);

          $post=$app->getPost($username,$postSlug);

          if(!$post){
              return redirect('/'.$username.'/home');
          }


          return view('post',compact('post','user'));
      }



      public function publicpost($postSlug){
      // return $postSlug;


        $app  = new \App\Core\Document(Auth::user()->id);
      //  $id = base64_decode($id);

        $post=$app->getPost(Auth::user()->id, $postSlug);

        if(!$post){
            return redirect('/'.$username.'/home');
        }


        return view('post',compact('post','user'));
    }

 public function save($title,$body,$desc,$category,$type)
 {

 }


 public function posts($username){


       $app  = new \App\Core\Document($username);
       $posts=$app->fetchAllRss();

       //dd($posts);
       return view('addtutorial',compact('user','posts'));


}

    public function verify(Request $request)
    {

     return Redirect::back()->withErrors("invalid verification code");

    }
}

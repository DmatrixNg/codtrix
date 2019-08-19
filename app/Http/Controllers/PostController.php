<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Parsedown;
use Mni\FrontYAML\Parser;
use KzykHys\FrontMatter\FrontMatter;
use Symfony\Component\Finder\Finder;
use KzykHys\FrontMatter\Document as Doc;
use Storage;

use App\tutorial;

class PostController extends Controller
{
  public function index()
    {
$posts=$this->get('posts');
dd($posts);
return view('home',['post' => $posts ]);

     }



    public function add(Request $request)
    {
//dd($request);
$title = isset($request->title) ? $request->title : '';
$body = $request->postVal;
  $tags = $request->tags;


        $initial_images = array_filter($request->all(), function ($key) {
          return preg_match('/^img-\w*$/', $key);
      }, ARRAY_FILTER_USE_KEY);

      $images = [];
      foreach ($initial_images as $key => $value) {
          $newKey = preg_replace('/_/', '.', $key);
          $images[$newKey] = $value;
      }

      $extra = "";

      $result = $this->create($title, $body, $tags, $images, $extra, $postType="full-blog");
      return json_encode($result);



      //  return redirect('home')->with('msg', 'Ph successfully');

    }
 public function save($title,$body,$desc,$category,$type)
 {
   tutorial::insert([
              'title'            => $request->title,
              'body'            => $request->body,
              'desc'          => $request->desc,
              'category'      => $request->category,
              'user_type'              => $request->user_type,

          ]);

 }
    public function verify(Request $request)
    {

     return Redirect::back()->withErrors("invalid verification code");

    }

    public function create($title, $content, $tag="", $image, $extra, $postType="")
        {

            date_default_timezone_set("Africa/Lagos");
            $time = date(DATE_RSS, time());
            $unix = strtotime($time);

            // Write md file
            $document = FrontMatter::parse($content);
            $md = new Parser();

            $markdown = $md->parse($document);

            $yaml = $markdown->getYAML();
            $html = $markdown->getContent();


            $yamlfile = new Doc();
            if ($title != "") {
                $yamlfile['title'] = $title;
            }
Storage::makeDirectory("admin");
            if (!empty($image)) {
                $url = "admin"."/images/";
                if(is_array($image)) {
                    foreach ($image as $key => $value) {

                        $decoded = base64_decode($image[$key]);

                        $img_path = 'public/'."admin"."/images/".$key;
                        Storage::disk('local')->put( $img_path, $decoded);
                        $yamlfile['image'] = $url.$key;
                    }
                } else {

                  $path =  Storage::disk('public')->put($url, $image);
                  $yamlfile['image'] = $path;
                }


            }

            if (!$extra) {
                $yamlfile['post_dir'] ="admin"."/contents/{$unix}";
            } else {
                $yamlfile['post_dir'] = "admin"."/drafts/{$unix}";

            }

            // create slug by first removing spaces
            $striped = str_replace(' ', '-', $title);

            $striped = preg_replace("/(&#[0-9]+;)/", "", $striped);

            $yamlfile['slug'] = $unix;
            $yamlfile['timestamp'] = $time;
            $yamlfile->setContent($content);
            $yaml = FrontMatter::dump($yamlfile);
            $file = "admin";
            $dir = '';
            if($postType == "full-blog"){
                $dir = $file .'/content/posts/'. $unix . ".md";
            }elseif($postType == "micro-blog") {
                $dir = $file .'/content/micro-blog-posts/'. $unix . ".md";
            }


            //return $dir; die();
            $doc = Storage::put($dir, $yaml);
            if (!$extra) {
                if ($doc) {
                    $result = array("error" => false, "action"=>"publish", "message" => "Post published successfully");
                  //  $this->store();
                } else {
                    $result = array("error" => true, "action"=>"publish", "message" => "Fail while publishing, please try again");
                }
            } else {
                if ($doc) {
                    $result = array("error" => false, "action"=>"savedToDrafts", "message" => "Draft saved successfully");
                } else {
                    $result = array("error" => true,"action"=>"savedToDrafts", "message" => "Fail while publishing, please try again");
                }
            }

            return $result;
        }

        public function get($postTypeSubDir)
    {
        $finder = new Finder();
        // $finder->sortByModifiedTime();
        // $finder->reverseSorting();

        // find all files in the current directory

        if(file_exists(storage_path('app/admin/content/'.$postTypeSubDir.'/'))){

            $finder->files()->in(storage_path('app/admin/content/'.$postTypeSubDir.'/'));

        $posts = [];
        if ($finder->hasResults()) {
            foreach ($finder as $file) {
                $document = $file->getContents();
                $parser = new Parser();
                $document = $parser->parse($document);
                $yaml = $document->getYAML();
                $body = $document->getContent();
                //$document = FileSystem::read($this->file);
                $parsedown  = new Parsedown();
                $tags = isset($yaml['tags']) ? $yaml['tags'] : '';
                $title = isset($yaml['title']) ? $parsedown->text($yaml['title']) : '';
                $slug = $parsedown->text($yaml['slug']);
                $image = isset($yaml['image']) ? $parsedown->text($yaml['image']) : '';
                $slug = preg_replace("/<[^>]+>/", '', $slug);
                $image = preg_replace("/<[^>]+>/", '', $image);
                $bd = $parsedown->text($body);
                ////
                preg_match('/<img[^>]+src="((\/|\w|-)+\.[a-z]+)"[^>]*\>/i', $bd, $matches);
                $first_img = false;
                if (isset($matches[1])) {
                    // there are images
                    $first_img = $matches[1];
                    // strip all images from the text
                    $bd = preg_replace("/<img[^>]+\>/i", " ", $bd);
                }
                $time = $parsedown->text($yaml['timestamp']);
                $url = $parsedown->text($yaml['post_dir']);
                $content['title'] = $title;
                $content['body'] = $this->trim_words($bd, 200);
                $content['url'] = $url;
                $content['timestamp'] = $time;
                $content['tags'] = $tags;
                $content['slug'] = $this->clean($slug);
                $content['preview_img'] = $first_img;
                //content['slug'] = $slug;
                $file = explode("-", $slug);
                $filename = $file[count($file) - 1];
                $content['filename'] = $filename;
                //content['timestamp'] = $time;
                $SlugArray = explode('-',$this->clean($slug));
                $content['post_id']=end($SlugArray);
                array_pop($SlugArray);
                $content['post_title']=implode('-',array_filter(array_map('trim', $SlugArray)));
                $content['image'] = $image;
                $content['date'] = date('d M Y ', $filename);
                $content['created_at'] = date('F j, Y, g:i a',$filename);
                array_push($posts, $content);
            }
            $this->array_sort_by_column($posts,'created_at');
            return $posts;
        } else {
            return [];
        }

        }else{
            return [];
        }


    }
    //trim_words used in triming strings by words
 public function trim_words($string,$limit,$break=".",$pad="...")
  {
      if (strlen($string) <= $limit) return $string;

      if (false !== ($breakpoint = strpos($string, $break, $limit))) {
          if ($breakpoint < strlen($string) - 1) {
              $string = substr($string, 0, $breakpoint) . $pad;
          }
      }

      return $string;
  }
  public function clean($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

  public function array_sort_by_column(&$arr,$col,$sortMethod =SORT_DESC )
   {
       $sort_col = array();

       foreach ($arr as $key=>$row)
       {
           $sort_col[$key] = strtotime($row[$col]);
       }

       array_multisort($sort_col,$sortMethod,$arr);
   }

}

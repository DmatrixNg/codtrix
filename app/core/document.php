<?php
namespace App\Core;

use Parsedown;
use Mni\FrontYAML\Parser;
use KzykHys\FrontMatter\FrontMatter;
use Symfony\Component\Finder\Finder;
use Illuminate\Support\Str;
use KzykHys\FrontMatter\Document as Doc;
use Auth;
use DB;
use Storage;

/**
 *	The Document class holds all properties and methods of a single page document.
 *
 */

class Document
{
    //define an instance of the symfony clss
    //define an instance of the frontMatter class

    protected $user;

    public function __construct($user)
    {
        //FileSystem::makeDir($file);
        $this->user   = $user;
    }

    public function file()
    {
        return $this->user;
    }


    public function createPost($title,$content, $tags, $image,$username){

        if (!empty($image)) {
          $url = "admin/images/";
          if(is_array($image)) {
              foreach ($image as $key => $value) {
                $image = $value;
               $decoded = base64_decode($image);
               $img_path = "public/admin/images/".$key;
               $image = Storage::disk('local')->put( $img_path, $decoded);
               $image = "storage/admin/images/".$key;


              }
          }
      }else {
        $image = null;
      }


      $slug = Str::slug($title);
      $slug = $slug ."-".substr(md5(uniqid(mt_rand(), true)), 0, 3);
      $insertPosts = DB::table('posts')->insert([
        'user_id'=>Auth::user()->id,
        'title'=>$title,
        'content'=>$content,
        'tags'=> $tags,
        'image'=> $image,
        'slug'=> $slug
      ]);

      if ($insertPosts) {
        $result = array("error" => false, "action"=>"publish", "message" => "Post published successfully");
        return true;
    } else {
        $result = array("error" => true, "action"=>"publish", "message" => "Fail while publishing, please try again");
        return false;
    }

    }

    public function saveUpdatedPost($title,$content, $tags, $image,$username,$post_id) {

        if (!empty($image)) {
            $url = Auth::user()->id."/images/";
            if(is_array($image)) {
                foreach ($image as $key => $value) {

                    $decoded = base64_decode($image[$key]);

                    $img_path = "public/admin/images/".$key;
                  $image = Storage::disk('local')->put( $img_path, $decoded);

                }
            }
        }else {
          $image = null;
        }

        $slug = Str::slug($title);
        $slug = $slug ."-".substr(md5(uniqid(mt_rand(), true)), 0, 3);
        //$slug = preg_replace("/(&#[0-9]+;)/", "", $slug);
        $oldpost = DB::table('posts')->where('id',$post_id)->first('title');
      //  dd($oldpost->title);
        $updateFeeds = DB::table('extfeeds')->where('title',$oldpost->title)
        ->update([
          'title'=>$title,
          'des'=>$content,
          'tags'=>$tags,
          'image'=> $image,
          'links'=> $slug

        ]);
        $updatePosts = DB::table('posts')->where('id',$post_id)->update([
          'user_id'=>Auth::user()->id,
          'title'=>$title,
          'content'=>$content,
          'tags'=>$tags,
          'image'=> $image,
          'slug'=> $slug
        ]);

        //dd($updateFeeds);
        if ($updatePosts) {

          return true;
      } else {

          return false;
      }

    }


    //kjarts code for getting and creating markdown files end here

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
/// sort post method added by problemSolved (@porh)
   public function array_sort_by_column(&$arr,$col,$sortMethod =SORT_DESC )
    {
        $sort_col = array();

        foreach ($arr as $key=>$row)
        {
            $sort_col[$key] = strtotime($row[$col]);
        }

        array_multisort($sort_col,$sortMethod,$arr);
    }

    ///use to clean slug special chars by problemSolved
   public function clean($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

 static function build_sorter($key) {
    // dd($key);
    return function ($a, $b) use ($key) {
        return strnatcmp($a[$key], $b[$key]);
    };
}

public function Feeds()
{
  $user = Auth::user();
  $data= DB::table('following')->where('my_id', $user['id'])->get();
  //$data=[];
  $urlArray = json_decode($data, true);

  $feed = [];
foreach ($urlArray as $id) {
  $user= DB::table('users')->where('id', $id['follower_id'])->first('name');

  $feeds = DB::table('extfeeds')
  ->join('users','extfeeds.site','=','users.name')
  ->select('extfeeds.*','users.username','users.email','users.image')
  ->where('site', $user->name)->get();
//  dd($feeds );
    $feeds = json_decode($feeds, true);
  array_push($feed, $feeds);
}
  $ex =[];
  for ($i=0; $i < count($feed) ; $i++) {
    for ($j=0; $j <count($feed[$i]) ; $j++) {
       $rv=$feed[$i][$j];
    //   krsort($rv);
      array_push($ex, $rv);
      //dd($ex);
    }
  }
  //dd($ex);
  usort($ex, $this->build_sorter('id'));

    //arsort($ex);
  krsort($ex);
  //dd($ex);
  //$feed = json_decode($feed, true);

return $ex;


}


    public function fetchAllRss()
    {

            $feed = $this->getPosts();
          //  $this->postFixer("posts");

                //  print_r($feed);
              //  $user = DB::table('users')->where('username', $this->user)->first();

                //  dd($feed);
                krsort($feed);
                return $feed;

              //}
          }


    public function getEach($id)
    {
        $finder = new Finder();
        // find all files in the current directory
        $finder->files()->in($this->user);
        $posts = [];
        if ($finder->hasResults()) {
            foreach ($finder as $file) {
                $document = $file->getContents();
                $parser = new Parser();
                $document = $parser->parse($document);
                $yaml = $document->getYAML();
                $body = $document->getContent();
                //$document = FileSystem::read($this->user);
                $parsedown  = new Parsedown();
                $slug = $parsedown->text($yaml['slug']);
                $slug = preg_replace("/<[^>]+>/", '', $slug);
                if ($slug == $id) {
                    $title = isset($yaml['title']) ? $parsedown->text($yaml['title']) : '';;
                    $bd = $parsedown->text($body);
                    $time = $parsedown->text($yaml['timestamp']);
                    $url = $parsedown->text($yaml['post_dir']);
                    $content['title'] = $title;
                    $content['body'] = $bd;
                    $content['url'] = $url;
                    $content['timestamp'] = $time;
                    array_push($posts, $content);
                }
            }
            return $posts;
        }
    }
    //end of get a post function

    // post
    public function tagPosts($id)
    {
        $finder = new Finder();
        // find all files in the current directory
        $finder->files()->in($this->user);
        $posts = [];
        if ($finder->hasResults()) {
            foreach ($finder as $file) {
                $document = $file->getContents();
                $parser = new Parser();
                $document = $parser->parse($document);
                $yaml = $document->getYAML();
                $body = $document->getContent();
                //$document = FileSystem::read($this->user);
                $parsedown  = new Parsedown();
                // skip this document if it has no tags
                if (!isset($yaml['tags'])) {
                    continue;
                }
                $tags = $yaml['tags'];
                for ($i = 0; $i < count($tags); $i++) {
                    // strip away the leading "#" of the tag name
                    if (substr($tags[$i], 1) == $id) {
                        $slug = $parsedown->text($yaml['slug']);
                        $bd = $parsedown->text($body);

                        // get the first image in the post body
                        // it will serve as the preview image
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
                        if (isset($yaml['title'])) {
                            $title = $parsedown->text($yaml['title']);
                            $content['title'] = $title;
                        }
                        $content['body'] = $bd;
                        $content['url'] = $url;
                        $content['timestamp'] = $time;
                        $content['tags'] = $tags;
                        $content['slug'] = $yaml['slug'];
                        $content['preview_img'] = $first_img;
                        array_push($posts, $content);
                    }
                }
            }
        }
        return $posts;
    }

    //kjarts code for deleting post
    public function delete($id, $extra)
    {
        $finder = new Finder();
        // find all files in the current directory
        $finder->files()->in($this->user);
        if ($finder->hasResults()) {
            foreach ($finder as $file) {
                $document = $file->getContents();
                $parser = new Parser();
                $document = $parser->parse($document);
                $yaml = $document->getYAML();
                $body = $document->getContent();
                $parsedown  = new Parsedown();
                $slug = $parsedown->text($yaml['slug']);
                $slug = preg_replace("/<[^>]+>/", '', $slug);
                if ($slug == $id) {
                    unlink($file);
                    $delete = "File deleted successfully";
                }
            }
            if (!$extra) {
                $this->createRSS();
            }
            return $delete;
        }
    }

    //deleteapOST by ProblemSolved;
    public function deletePost($post)
    {
        $finder = new Finder();
        // find post in the current directory
        $finder->files()->in($this->user)->name($post . '.md');
        if (!$finder->hasResults()) {
            return $this->redirect('/404');
        } else {
            ///coming back for some modifications
            unlink($this->user.$post.'.md');
            $this->createRSS();
        }
    }

    //get single post

    public function getPost($username,$postSlug){
    //  $user = $this->user($username);
    //  $user =   DB::table('users')->where('id', $username)->first();
    //   echo $postSlug;
      $post = DB::table('posts')->where(['slug'=>$postSlug,'user_id'=>1])->first();
    //  dd($post);
      if(!empty($post)) {

        $parsedown  = new Parsedown();
        $createdAt = $post->created_at;
        $content['tags'] = $post->tags;
        $content['title'] =$post->title;
        $content['body'] = $parsedown->text($post->content);
        $content['date'] = $createdAt;
        $content['slug'] = $post->slug;
        $content['image'] = $post->image;
        $content['id'] = $post->id;
        return $content;

      }


    }



        public function getPosts(){
        //  $user =  $this->user($username);
        //  $user =   DB::table('users')->where('username', $this->user)->first();

          $posts = DB::table('posts')->where('user_id',1)->orderBy('id','DESC')->get();
          if(!empty($posts)){

            $allPost = [];
          foreach($posts as $post){
            $parsedown  = new Parsedown();
            $postContent = $parsedown->text($post->content);
            preg_match('/<img[^>]+src="((\/|\w|-)+\.[a-z]+)"[^>]*\>/i', $postContent, $matches);
            $first_img = "";
            if (isset($matches[1])) {
                // there are images
                $first_img = $matches[1];
                // strip all images from the text
                $postContent = preg_replace("/<img[^>]+\>/i", " ", $postContent);
            }
            $createdAt = $post->created_at;
            $content['title'] = $post->title;
            $content['body']  = $this->trim_words($postContent, 200);
            $content['tags']  = $post->tags;
            $content['slug']  = $post->slug;
            $content['image'] = $first_img;
            $content['date']  = $createdAt;
            $content['id'] = $post->id;
            array_push($allPost,$content);
          }
          return $allPost;

          }

        }

 /*  public function getPost($post)
    {
        $finder = new Finder();
        // find post in the current directory
        $finder->files()->in(storage_path().'/app/'.$this->user.'/content')->name($post . '.md');
        $content = [];
        if (!$finder->hasResults()) {
            return false;
        } else {
            foreach ($finder as $file) {
                $document = $file->getContents();
                $parser = new Parser();
                $document = $parser->parse($document);
                $yaml = $document->getYAML();
                $body = $document->getContent();
                $parsedown  = new Parsedown();
                //$yamlTag = isset($yaml['tags']) ? $yaml['tags'] : [];
              //  $tags = [];
              //  foreach ($yamlTag as $tag) {
                //    $removeHashTag = explode('#', $tag);
                //    $tags[] = trim(end($removeHashTag));
                //}

                $slug = $parsedown->text($yaml['slug']);
                $slug = preg_replace("/<[^>]+>/", '', $slug);
                $title = isset($yaml['title']) ? $parsedown->text($yaml['title']) : '';
                $bd = $parsedown->text($body);
                //preg_match('/<img[^>]+src="((\/|\w|-)+\.[a-z]+)"[^>]*\>/i', $bd, $matches);
                //$first_img = '';
              //  if (isset($matches[1])) {
                //    $first_img = $matches[1];
                //}
                $image= isset($yaml['image']) ? $parsedown->text($yaml['image']) : "";
                $time = $parsedown->text($yaml['timestamp']);
                $url = $parsedown->text($yaml['post_dir']);
              //  $content['tags'] = $tags;
                $content['title'] = strip_tags($title);
                $content['body'] = $bd;
                $content['url'] = $url;
                $content['timestamp'] = $time;
                $content['date'] = date('d M Y ', $post);
                $content['crawlerImage'] = strip_tags($image);
                $content['slug'] = $this->clean($slug);
                $SlugArray = explode('-',$this->clean($slug));
                $content['post_id']=end($SlugArray);
                array_pop($SlugArray);
                $content['post_title']=implode('-',array_filter(array_map('trim', $SlugArray)));
            }
            return $content;
        }
    }*/

    public function update_Post($title, $content, $tags, $image, $extra,$post_id)
    {
        $time = date(DATE_RSS, time());
        $unix = strtotime($time);
        // Write md file
        $document = FrontMatter::parse($content);
        $md = new Parser();
        $markdown = $md->parse($document);

        $yaml = $markdown->getYAML();
        $html = $markdown->getContent();
        //$doc = Storage::put($this->user, $yaml . "\n" . $html);

        $yamlfile = new Doc();
        if($title != ""){
        $yamlfile['title'] = $title;
        }
        if ($tags != "") {
            $tag = explode(",", $tags);
            $put = [];
            foreach ($tag as $value) {
                array_push($put, $value);
            }
            $yamlfile['tags'] = $put;
        }
        if (!empty($image)) {
            foreach ($image as $key => $value) {
                $decoded = base64_decode($image[$key]);
                $url = "./storage/images/" . $key;
                Storage::put($url, $decoded);
            }
        }

        if (!$extra) {
            $yamlfile['post_dir'] = SITE_URL . "/storage/contents/{$post_id}";
        } else {
            $yamlfile['post_dir'] = SITE_URL . "/storage/drafts/{$post_id}";
            $yamlfile['image'] = "./storage/images/" . $key;
        }

        // create slug by first removing spaces
        $striped = str_replace(' ', '-', $title);
        // then removing encoded html chars
        $striped = preg_replace("/(&#[0-9]+;)/", "", $striped);
        $yamlfile['slug'] = $striped . "-{$post_id}";
        $yamlfile['timestamp'] = $time;
        $yamlfile->setContent($content);
        $yaml = FrontMatter::dump($yamlfile);
        $dir = $this->user.$post_id.'.md';
        $explodeSChars = explode('&#10;',$yaml);
        $fopen = fopen($dir,'w');
        foreach($explodeSChars as $yamlTextContent )
        {
            $doc = fwrite($fopen, $yamlTextContent.PHP_EOL);
        }

        if (!$extra) {
            if ($doc) {
                $result =  array("error" => false, "action"=>"update", "message" => "Post Updated successfully");
                $this->createRSS();
            } else {
                $result = array("error" => true,"action"=>"update", "message" => "Fail while Updating, please try again");
            }
        } else {
            if ($doc) {
                $result = array("error" => false, "action"=>"save_draft", "message" => "Draft saved successfully");
            } else {
                $result = array("error" => true, "action"=>"save_draft", "message" => "Fail while updating, please try again");
            }
        }

        return $result;


    }


    public function redirect($location)
    {
        header('Location:' . $location);
    }

    public function getRelatedPost($limit = 4, $tags, $skip_post)
    {

        $finder = new Finder();
        // find post in the current directory
        $finder->files()->in($this->user)->notName($skip_post . '.md')->contains($tags);
        $posts = [];
        if ($finder->hasResults()) {
            foreach ($finder as $file) {
                $document = $file->getContents();
                $parser = new Parser();
                $document = $parser->parse($document);
                $yaml = $document->getYAML();
                $body = $document->getContent();
                //$document = FileSystem::read($this->user);
                $parsedown  = new Parsedown();
                if (!isset($yaml['tags'])) {
                    continue;
                }
                $tags = $yaml['tags'];

                $slug = $parsedown->text($yaml['slug']);
                $image = isset($yaml['image']) ? $parsedown->text($yaml['image']) : '';
                $slug = preg_replace("/<[^>]+>/", '', $slug);
                $image = preg_replace("/<[^>]+>/", '', $image);
                $bd = $parsedown->text($body);
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
                if (isset($yaml['title'])) {
                    $title = $parsedown->text($yaml['title']);
                    $content['title'] = $title;
                }
                $content['url'] = $url;
                $content['timestamp'] = $time;
                $content['tags'] = str_replace('#', '', implode(',', $tags));
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
            $countPosts = count($posts);
            if ($countPosts > $limit)
                array_shift($posts);
            return $posts;
        } else {
            return false;
        }
    }
    //stupid code by problemSolved ends here

    /**
     * updates a post stored in an md file
     * and echos a json object;
     *
     * @param [type] $mdfile
     * @param [type] $title
     * @param [type] $content
     * @param [type] $tags
     * @param [type] $image
     * @return void
     */
    public function updatePost($mdfile, $title, $content, $tags, $image)
    {
        $text = file_get_contents($mdfile);
        $document = FrontMatter::parse($text);
        $date = date("F j, Y, g:i a");
        // var_dump($document);
        // var_dump($document->getConfig());
        // var_dump($document->getContent());
        // var_dump($document['tags']);
        $document = new Doc();
        $tmp_title = explode(' ', $title);
        $slug = implode('-', $tmp_title);
        $document['title'] = $title;
        $document['slug'] = $slug;
        $document['timestamp'] = $date;
        $document['tags'] = explode(',', $tags);
        $hashedTags = [];
        // adding hash to the tags before storage
        foreach ($document['tags'] as $tag) {
            $hashedTags[] = '#' . $tag;
        }
        $document['tags'] = $hashedTags;
        $document['image'] = $image;
        $document->setContent($content);
        $yamlText = FrontMatter::dump($document);
        // var_dump($yamlText);
        $doc = Storage::put($mdfile, $yamlText);
        if ($doc) {
            $result = array("error" => false, "message" => "Post published successfully");
        } else {
            $result = array("error" => true, "message" => "Fail while publishing, please try again");
        }
        echo json_encode($result);
    }

    public function getSinglePost($id)
    {
        $directory = "./storage/contents/${id}.md";
        // var_dump($directory);
        $document = FrontMatter::parse(file_get_contents($directory));
        // var_dump($document);
        $content['title'] = $document['title'];
        $content['body'] = $document->getContent();
        // $content['url'] = $url;
        $content['timestamp'] = $document['timestamp'];

        return $content;
    }

    public function addVideo($url, $title, $content)
    {
        $time = date("F j, Y, g:i a");
        $unix = strtotime($time);
        // Write md file
        $document = FrontMatter::parse($content);
        $md = new Parser();
        $markdown = $md->parse($document);

        $yaml = $markdown->getYAML();
        $html = $markdown->getContent();
        //$doc = Storage::put($this->user, $yaml . "\n" . $html);

        $yamlfile = new Doc();
        $yamlfile['title'] = $title;
        $yamlfile['url'] = $url;

        $striped = str_replace(' ', '-', $title);
        $yamlfile['slug'] = $striped . "-{$unix}";
        $yamlfile['timestamp'] = $time;
        $yamlfile->setContent($content);
        $yaml = FrontMatter::dump($yamlfile);
        $file = $this->user;
        $dir = $file . $unix . ".md";
        //return $dir; die();
        $doc = Storage::put($dir, $yaml);
        if ($doc) {
            return true;
        }
        return false;
    }

    //get video
    public function getVideo()
    {
        $finder = new Finder();

        // find all files in the current directory
        $finder->files()->in($this->user);
        $videos = [];
        if ($finder->hasResults()) {
            foreach ($finder as $file) {
                $document = $file->getContents();
                $parser = new Parser();
                $document = $parser->parse($document);
                $yaml = $document->getYAML();
                $body = $document->getContent();
                //$document = FileSystem::read($this->user);
                $parsedown  = new Parsedown();
                $title = $parsedown->text($yaml['title']);
                $bd = $parsedown->text($body);
                $time = $parsedown->text($yaml['timestamp']);
                $url = $parsedown->text($yaml['url']);
                $content['title'] = $title;
                $content['description'] = $bd;
                $content['domain'] = $url;
                $content['timestamp'] = $time;
                array_push($videos, $content);
            }
            return $videos;
        } else {
            return $videos;
        }
    }
}

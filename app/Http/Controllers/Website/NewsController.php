<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\NewsComment;
use App\Services\MatchesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    private $matchesService;
    public function __construct(MatchesService $matchesService)
    {
        $this->matchesService = $matchesService;
    }

    public function index(){
        try {
            $recordPerPage = 5;
            $query = $this->getNewQuery();
            $recent_news = $this->getNewQuery()->orderByDesc('id')->take(5)->get();
            $recent_news2 = $this->getNewQuery()->orderByDesc('id')->skip(5)->take(5)->get();
            $recent_news3 = $this->getNewQuery()->orderByDesc('id')->skip(10)->take(5)->get();
            $cat = request()->input('cat');
            $title = request()->input('title');
            if(!empty($cat)){
                $query->where('categories.slug', $cat);
            }
            if(!empty($title)){
                $query->where('news.title', 'LIKE', "%{$title}%");
            }
            $news = $query->orderByDesc('id')->simplePaginate($recordPerPage)->appends(['cat' => $cat, 'title' => $title]);
            $categories = DB::table('categories')->orderBy('category_name')->get();
            foreach ($categories as $cat){
                $cat->total = DB::table('news')->where('category_id', $cat->id)->count();
            }
            return view('projects.website.news.index', [
                'news'=> $news,
                'recent_news' => $recent_news,
                'recent_news2' => $recent_news2,
                'recent_news3' => $recent_news3,
                'categories' => $categories
            ])->with('i', (request()->input('page', '1') - 1) * $recordPerPage);
        }
        catch (\Exception $ex) {
            return view('templates.exception',[
                'exception' => $ex->getMessage().', '.$ex->getFile().': '.$ex->getLine()
            ]);
        }
    }

    public function details($slug){
        try {
            $news = DB::table('news')->where('slug', $slug)->first();
            if(empty($news))
                return view('templates.404');

            $categories = DB::table('categories')->orderBy('category_name')->get();
            $recent_news = $this->getNewQuery()->orderByDesc('id')->take(5)->get();
            $recent_news2 = $this->getNewQuery()->orderByDesc('id')->skip(5)->take(5)->get();
            $recent_news3 = $this->getNewQuery()->orderByDesc('id')->skip(10)->take(5)->get();
            $upcoming_matches = $this->matchesService->getUpcomingMatch();

            foreach ($categories as $cat){
                $cat->total = DB::table('news')->where('category_id', $cat->id)->count();
            }

            $comments = DB::table('news_comments')->where('news_id', $news->id)->where('approve', 1)->get();
           foreach ($comments  as $comment){
               $comment->avatar = strtoupper($this->get_avatar($comment->name));
           }
            return view('projects.website.news.details', [
                'news' => $news,
                'categories' => $categories,
                'recent_news' => $recent_news,
                'recent_news2' => $recent_news2,
                'recent_news3' => $recent_news3,
                'upcoming_matches' => $upcoming_matches,
                'comments' => $comments
            ]);
        }
        catch (\Exception $ex) {
            return view('templates.exception',[
                'exception' => $ex->getMessage().'<br>'.$ex->getFile().': '.$ex->getLine()
            ]);
        }
    }

    public function storeComments(Request $request){
        try {
            NewsComment::create([
                'news_id'=> $request->news_id,
                'name'=> $request->name,
                'email'=> $request->email,
                'comments'=> $request->comments,
                'approve'=> 0,
            ]);
            return  response()->json([
                'status' => 200
            ]);
        }
        catch (\Exception $ex) {
            return response()->json([
                'status' => 500,
                'data' => $ex->getMessage()
            ]);
        }
    }

    /**
     * @return \Illuminate\Database\Query\Builder
     */
    private function getNewQuery(): \Illuminate\Database\Query\Builder
    {
        return DB::table('news')
            ->join('categories', 'news.category_id', '=', 'categories.id')
            ->select('news.*', 'categories.category_name', DB::raw('(SELECT COUNT(news_comments.id) FROM news_comments WHERE news_comments.news_id = news.id AND news_comments.approve = 1) as comments_count'));
    }

    private function get_avatar($str){
        $acronym = '';
        $word = '';
        $words = preg_split("/(\s|\-|\.)/", $str);
        foreach($words as $w) {
            $acronym .= substr($w,0,1);
        }
        $word = $word . $acronym ;
        return $word;
    }
}

<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Services\MatchesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    private $matchesService;
    public function __construct(MatchesService $matchesService)
    {
        $this->matchesService = $matchesService;
    }

    private function getNewQuery(): \Illuminate\Database\Query\Builder
    {
        return DB::table('news')
            ->join('categories', 'news.category_id', '=', 'categories.id')
            ->select('news.*', 'categories.category_name', DB::raw('(SELECT COUNT(news_comments.id) FROM news_comments WHERE news_comments.news_id = news.id AND news_comments.approve = 1) as comments_count'));
    }

    public function match($slug){
        try {
            $recent_news = $this->getNewQuery()->orderByDesc('id')->take(5)->get();
            $recent_news2 = $this->getNewQuery()->orderByDesc('id')->skip(5)->take(5)->get();
            $recent_news3 = $this->getNewQuery()->orderByDesc('id')->skip(10)->take(5)->get();
            $upcoming_matches = $this->matchesService->getUpcomingMatch();

            $match = $this->matchesService->getBySlug($slug);

            return view('projects.website.match', [
                'recent_news' => $recent_news,
                'recent_news2' => $recent_news2,
                'recent_news3' => $recent_news3,
                'upcoming_matches' => $upcoming_matches,
                'match' => $match
            ]);
        }
        catch (\Exception $ex) {
            return view('projects.website.404');
        }
    }
}

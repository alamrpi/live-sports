<?php

namespace App\Http\Controllers;

use App\Services\MatchesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * @var MatchesService
     */
    private $matchesService;

    /**
     * Create a new controller instance.
     *
     * @param MatchesService $matchesService
     */
    public function __construct(MatchesService $matchesService)
    {
        $this->matchesService = $matchesService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sports = DB::table('sports')->orderBy('name')->get();
        $matches = $this->matchesService->gets();
        $upcoming_matches = $this->matchesService->getUpcomingMatch();
        $news = DB::table('news')->orderByDesc('id')->take(6)->get();
        $highlight_match = $this->matchesService->getHighLightMatch();
        return view('projects.home.index', [
            'sports' => $sports,
            'matches' => $matches,
            'available_dates' => $matches['available_dates'],
            'news' => $news,
            'upcoming_matches' => $upcoming_matches,
            'highlight_match' => $highlight_match
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getMatches(Request $request): JsonResponse
    {
        try {

            $current_page = $request->current_page;
            $sport_id = $request->sport_id;
            $date = $request->date;

            $matches = $this->matchesService->gets($current_page, $sport_id, $date);

            return  response()->json([
                'status' => 200,
                'pages' => $matches['pages'],
                'view' => view('projects.home.matches', [
                    'matches' => $matches,
                ])->render(),
                'dates' =>  view('projects.website.components.date-list', [
                    'available_dates' => $matches['available_dates'],
                ])->render(),
            ]);
        }
        catch (\Exception $ex) {
            return response()->json([
                'status' => 500,
                'error' => $ex->getMessage()
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Models\Club;
use App\Models\League;
use App\Models\SportMatch;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MatchesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        try {
            $recordPerPage = 100;
            $query = $this->getMatches();
            $matches = $query->orderByDesc('id')->paginate($recordPerPage);
            return view('projects.matches.index', [
                'matches'=> $matches,
            ])->with('i', (request()->input('page', '1') - 1) * $recordPerPage);
        }
        catch (\Exception $ex) {
            return view('templates.exception',[
                'exception' => $ex->getMessage().', '.$ex->getFile().': '.$ex->getLine()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        try {
            $sports = DB::table('sports')->orderByDesc('id')->get();
            return view('projects.matches.create', [
                'sports' => $sports
            ]);
        }
        catch (\Exception $ex) {
            return view('templates.exception',[
                'exception' => $ex->getMessage().', '.$ex->getFile().': '.$ex->getLine()
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'sport_id' => 'required',
                'league_id' => 'required',
                'club_id_one' => 'required',
                'club_id_two' => 'required',
                'date' => 'required',
                'time' => 'required',
                'sport_type' => 'required'
            ]);

           $match = SportMatch::create([
                'sport_id' => $request->sport_id,
                'league_id' => $request->league_id,
                'club_id_one' => $request->club_id_one,
                'club_id_two' => $request->club_id_two,
                'date' => $request->date,
                'time' => $request->time,
                'sport_type' => $request->sport_type,
                'channel' => $request->channel,
                'channel_url' => $request->channel_url,
                'location' => $request->location,
                'location_url' => $request->location_url,
                'description' => $request->description,
            ]);
            SportMatch::where('id', $match->id)->update([
                'slug' => $this->generateSlug($request->club_id_one, $request->club_id_two, $match->id)
            ]);

            DB::commit();
            return redirect()->route('matches/index')->with('success_msg', 'SportMatch has been created.');
        }
        catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with('error_msg', $ex->getMessage().', '.$ex->getFile().': '.$ex->getLine())->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        try {
            $match = $this->getMatches()->where('matches.id', $id)->first();
            if(empty($match))
                return view('templates.404');

            $sports = DB::table('sports')->orderByDesc('id')->get();
            $leagues = DB::table('leagues')->where('sport_id', $match->sport_id)->orderByDesc('id')->get();
            $clubs = DB::table('clubs')->where('sport_id', $match->sport_id)->orderByDesc('id')->get();

            return view('projects.matches.edit', [
                'sports' => $sports,
                'leagues' => $leagues,
                'clubs' => $clubs,
                'match' => $match
            ]);
        }
        catch (\Exception $ex) {
            return view('templates.exception',[
                'exception' => $ex->getMessage().'<br>'.$ex->getFile().': '.$ex->getLine()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'sport_id' => 'required',
            'league_id' => 'required',
            'club_id_one' => 'required',
            'club_id_two' => 'required',
            'date' => 'required',
            'time' => 'required',
            'sport_type' => 'required'
        ]);

        try {

            SportMatch::where('id' , $id)->update([
                'sport_id' => $request->sport_id,
                'league_id' => $request->league_id,
                'club_id_one' => $request->club_id_one,
                'club_id_two' => $request->club_id_two,
                'date' => $request->date,
                'time' => $request->time,
                'sport_type' => $request->sport_type,
                'channel' => $request->channel,
                'channel_url' => $request->channel_url,
                'location' => $request->location,
                'location_url' => $request->location_url,
                'description' => $request->description,
                'slug' => $this->generateSlug($request->club_id_one, $request->club_id_two, $id)
            ]);
            return redirect()->route('matches/index')->with('success_msg', 'SportMatch has been updated.');
        }
        catch (\Exception $ex) {
            return redirect()->back()->with('error_msg', $ex->getMessage().', '.$ex->getFile().': '.$ex->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        try {
            SportMatch::where('id', $id)->delete();
            return redirect()->route('matches/index')->with('success_msg', 'SportMatch has been deleted.');
        }
        catch (\Exception $ex) {
            return redirect()->back()->with('error_msg', "{$ex->getMessage()}, {$ex->getFile()}: {$ex->getLine()}");
        }
    }

    public function highlight(int $id){
        DB::beginTransaction();
        try {
            SportMatch::where('highlight', 1)->update(['highlight' => 0]);
            SportMatch::where('id', $id)->update(['highlight' => 1]);
            DB::commit();
            return redirect()->route('matches/index')->with('success_msg', 'SportMatch has been highlighted.');
        }
        catch (\Exception $ex) {
            return redirect()->back()->with('error_msg', "{$ex->getMessage()}, {$ex->getFile()}: {$ex->getLine()}");
        }
    }

    public function getLeaguesAndClubs(Request $request){
        try {

            $sport_id = $request->sport_id;
            $leagues = DB::table('leagues')->where('sport_id', $sport_id)->select('id', 'name')->get();
            $clubs = DB::table('clubs')->where('sport_id', $sport_id)->select('id', 'name')->get();
            if (count($leagues) > 0) {
                $leagues_dd = '<option value="">-- Select --</option>';
                foreach ($leagues as $league) {
                    $leagues_dd .= '<option value="' . $league->id . '">' . $league->name . '</option>';
                }
            } else {
                $leagues_dd = '<option value="">No league found</option>';
            }

            if (count($clubs) > 0) {
                $clubs_dd = '<option value="">-- Select --</option>';
                foreach ($clubs as $club) {
                    $clubs_dd .= '<option value="' . $club->id . '">' . $club->name . '</option>';
                }
            } else {
                $clubs_dd = '<option value="">No club found</option>';
            }

            return json_encode(array(
                'status' => 200,
                'leagues' => $leagues_dd,
                'clubs' => $clubs_dd
            ));
        } catch (\Exception $ex) {
            return json_encode(array(
                'status' => 500,
                'data' => $ex->getMessage()
            ));
        }
    }

    /**
     * @return Builder
     */
    private function getMatches(): Builder
    {
        return DB::table('matches')
            ->join('sports', 'matches.sport_id', '=', 'sports.id')
            ->join('leagues', 'matches.league_id', '=', 'leagues.id')
            ->join('clubs as first_clubs', 'matches.club_id_one', '=', 'first_clubs.id')
            ->join('clubs as second_clubs', 'matches.club_id_two', '=', 'second_clubs.id')
            ->select('matches.*', 'sports.name as sport_name', 'leagues.name as league_name', 'first_clubs.name as first_club_name', 'second_clubs.name as second_club_name');
    }

    private function generateSlug($club_id_one, $club_id_two, $id)
    {
        $club_one = Club::find($club_id_one)->slug;
        $club_two = Club::find($club_id_two)->slug;
        return "{$club_one}-vs-{$club_two}-{$id}";
    }
}

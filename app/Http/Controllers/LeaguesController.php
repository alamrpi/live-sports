<?php

namespace App\Http\Controllers;

use App\Models\League;
use App\Models\Sports;
use App\Services\FileService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class LeaguesController extends Controller
{
    private $fileService;
    public function __construct(FileService  $fileService)
    {
        $this->fileService = $fileService;
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
            $query = DB::table('leagues')
            ->join('sports', 'leagues.sport_id', '=', 'sports.id')
            ->select('leagues.*', 'sports.name as sport_name');
            $leagues = $query->orderByDesc('id')->paginate($recordPerPage);
            return view('projects.leagues.index', [
                'leagues'=> $leagues,
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

            return view('projects.leagues.create', [
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
                'name' => 'required'
            ]);

            $logo_path = 'uploads/logo/default.png';
            if($request->hasFile('logo')){
                $logo_path = $this->fileService->upload($request->file('logo'), 'uploads/logos');
            }

            $banner_path = 'uploads/banners/default.png';
            if($request->hasFile('banner')){
                $banner_path = $this->fileService->upload($request->file('banner'), 'uploads/banners');
            }

            League::create([
                'sport_id' => $request->sport_id,
                'name' => $request->name,
                'description' => $request->description,
                'logo' => $logo_path,
                'banner' => $banner_path,
            ]);
            DB::commit();
            return redirect()->route('leagues/index')->with('success_msg', 'League has been created.');
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
            $league = DB::table('leagues')->where('id', $id)->first();
            if(empty($league))
                return view('templates.404');

            $sports = DB::table('sports')->orderByDesc('id')->get();
            return view('projects.leagues.edit', [
                'league' => $league,
                'sports' => $sports
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
            'name' => 'required',
            'icon' => ''
        ]);
        try {
            $league = DB::table('leagues')->where('id', $id)->first();

            $logo_path = $league->logo;
            if($request->hasFile('logo')){
                if($league->logo != 'uploads/logos/default.png'){
                    $this->fileService->delete($league->logo);
                }
                $logo_path = $this->fileService->upload($request->file('logo'), 'uploads/logos');
            }

            $banner_path = $league->banner;
            if($request->hasFile('banner')){
                if($league->banner != 'uploads/banners/default.png'){
                    $this->fileService->delete($league->banner);
                }
                $banner_path = $this->fileService->upload($request->file('banner'), 'uploads/banners');
            }

            League::where('id' , $id)->update([
                'sport_id' => $request->sport_id,
                'name' => $request->name,
                'description' => $request->description,
                'logo' => $logo_path,
                'banner' => $banner_path,
            ]);
            return redirect()->route('leagues/index')->with('success_msg', 'League has been updated.');
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
            League::where('id', $id)->delete();
            return redirect()->route('leagues/index')->with('success_msg', 'League has been deleted.');
        }
        catch (\Exception $ex) {
            return redirect()->back()->with('error_msg', "{$ex->getMessage()}, {$ex->getFile()}: {$ex->getLine()}");
        }
    }
}

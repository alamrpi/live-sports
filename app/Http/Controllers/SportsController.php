<?php

namespace App\Http\Controllers;

use App\Models\Sports;
use App\Services\FileService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class SportsController extends Controller
{
    protected $fileService;
    public function __construct(FileService $fileService)
    {
        $this->middleware('auth');
        $this->fileService = $fileService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index(Sports $query)
    {
        try {
            $recordPerPage = 100;
            $query = $query->newQuery();
            $sports = $query->orderByDesc('id')->paginate($recordPerPage);
            return view('projects.sports.index', [
                'sports'=> $sports,
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
        return view('projects.sports.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'name' => 'required',
                'icon' => 'required|mimes:jpeg,png,gif,jpg',
            ]);

            $logo_path = 'uploads/sports/icons/default.png';
            if($request->hasFile('icon')){
                $logo_path = $this->fileService->upload($request->file('icon'), 'uploads/sports/icons');
            }

            Sports::create([
                'name' => $request->name,
                'icon' => $logo_path
            ]);
            return redirect()->route('sports/index')->with('success_msg', 'Sport has been created.');
        }
        catch (\Exception $ex) {
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
            $sport = DB::table('sports')->where('id', $id)->first();
            if(empty($sport))
                return view('templates.404');

            return view('projects.sports.edit', [
                'sport' => $sport,
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
            $sport = DB::table('sports')->where('id', $id)->first();
            $logo_path = $sport->icon;
            if($request->hasFile('icon')){
                if($sport->icon != 'uploads/sports/icons/default.png'){
                    $this->fileService->delete($sport->icon);
                }
                $logo_path = $this->fileService->upload($request->file('icon'), 'uploads/sports/icon');
            }

            Sports::where('id', $id)->update([
                'name' => $request->name,
                'icon' => $logo_path
            ]);
            return redirect()->route('sports/index')->with('success_msg', 'Sport has been updated.');
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
            Sports::where('id', $id)->delete();
            return redirect()->route('sports/index')->with('success_msg', 'Sport has been deleted.');
        }
        catch (\Exception $ex) {
            return redirect()->back()->with('error_msg', "{$ex->getMessage()}, {$ex->getFile()}: {$ex->getLine()}");
        }
    }
}

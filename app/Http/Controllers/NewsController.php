<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\News;
use App\Services\FileService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
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
            $query = DB::table('news')
                ->join('categories', 'news.category_id', '=', 'categories.id')
                ->select('news.*', 'categories.category_name');
            $news = $query->orderByDesc('id')->paginate($recordPerPage);
            return view('projects.news.index', [
                'news'=> $news,
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
            $categories = DB::table('categories')->orderByDesc('id')->get();

            return view('projects.news.create', [
                'categories' => $categories
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
                'title' => 'required',
                'category_id' => 'required'
            ]);

            $logo_path = 'uploads/news/feature_images/default.png';
            if($request->hasFile('feature_image')){
                $logo_path = $this->fileService->upload($request->file('feature_image'), 'uploads/news/feature_images');
            }

            News::create([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'description' => $request->description,
                'feature_image' => $logo_path
            ]);
            DB::commit();
            return redirect()->route('news/index')->with('success_msg', 'News has been created.');
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
            $news = DB::table('news')->where('id', $id)->first();
            if(empty($news))
                return view('templates.404');

            $categories = DB::table('categories')->orderByDesc('id')->get();
            return view('projects.news.edit', [
                'news' => $news,
                'categories' => $categories
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
            'title' => 'required',
            'category_id' => 'required'
        ]);
        try {
            $news = DB::table('news')->where('id', $id)->first();

            $logo_path = $news->feature_image;
            if($request->hasFile('feature_image')){
                if($logo_path != 'uploads/news/feature_images/default.png'){
                    $this->fileService->delete($logo_path);
                }
                $logo_path = $this->fileService->upload($request->file('logo'), 'uploads/news/feature_images');
            }

            News::where('id' , $id)->update([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'description' => $request->description,
                'feature_image' => $logo_path
            ]);
            return redirect()->route('news/index')->with('success_msg', 'News has been updated.');
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
            News::where('id', $id)->delete();
            return redirect()->route('news/index')->with('success_msg', 'News has been deleted.');
        }
        catch (\Exception $ex) {
            return redirect()->back()->with('error_msg', "{$ex->getMessage()}, {$ex->getFile()}: {$ex->getLine()}");
        }
    }
}

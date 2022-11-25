<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Category;
use App\Models\Sports;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CategoriesControllers extends Controller
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
    public function index(Category $query)
    {
        try {
            $recordPerPage = 100;
            $query = $query->newQuery();
            $categories = $query->orderByDesc('id')->paginate($recordPerPage);
            return view('projects.categories.index', [
                'categories'=> $categories,
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
        return view('projects.categories.create');
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
                'category_name' => 'required'
            ]);

            Category::create([
                'category_name' => $request->category_name
            ]);
            return redirect()->route('categories/index')->with('success_msg', 'Category has been created.');
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
            $category = DB::table('categories')->where('id', $id)->first();
            if(empty($category))
                return view('templates.404');

            return view('projects.categories.edit', [
                'category' => $category,
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
            'category_name' => 'required'
        ]);
        try {
            Category::where('id', $id)->update([
                'category_name' => $request->category_name
            ]);
            return redirect()->route('categories/index')->with('success_msg', 'Category has been updated.');
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
            Category::where('id', $id)->delete();
            return redirect()->route('categories/index')->with('success_msg', 'Category has been deleted.');
        }
        catch (\Exception $ex) {
            return redirect()->back()->with('error_msg', "{$ex->getMessage()}, {$ex->getFile()}: {$ex->getLine()}");
        }
    }
}

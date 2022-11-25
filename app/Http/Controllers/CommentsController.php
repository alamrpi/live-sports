<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsComment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $recordPerPage = 100;
            $query = DB::table('news_comments')
                ->join('news', 'news.id', '=', 'news_comments.news_id')
                ->select('news_comments.*', 'news.title');
            $comments = $query->orderByDesc('id')->paginate($recordPerPage);
            return view('projects.comments.index', [
                'comments'=> $comments,
            ])->with('i', (request()->input('page', '1') - 1) * $recordPerPage);
        }
        catch (\Exception $ex) {
            return view('templates.exception',[
                'exception' => $ex->getMessage().', '.$ex->getFile().': '.$ex->getLine()
            ]);
        }
    }

    public function toggleApprove($id): RedirectResponse
    {
        try {
            $approve = NewsComment::find($id)->approve;
            NewsComment::where('id', $id)->update([
                'approve' => $approve == 1 ? 0 : 1
            ]);
            return redirect()->route('comments/index')->with('success_msg', 'Comment approval status has been changed');
        }
        catch (\Exception $ex) {
            return redirect()->back()->with('error_msg', "{$ex->getMessage()}, {$ex->getFile()}: {$ex->getLine()}");
        }
    }

    public function  destroy($id): RedirectResponse
    {
        try {
            NewsComment::where('id', $id)->delete();
            return redirect()->route('comments/index')->with('success_msg', 'Comment has been deleted.');
        }
        catch (\Exception $ex) {
            return redirect()->back()->with('error_msg', "{$ex->getMessage()}, {$ex->getFile()}: {$ex->getLine()}");
        }
    }
}

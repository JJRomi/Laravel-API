<?php

namespace App\Http\Controllers;

use App\Comments;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CommentsController extends Controller
{
    public function index(Request $request, $target_table, $target_id)
    {
        $comments = Comments::where([
                                  ['target_table', $target_table],
                                  ['target_id', $target_id],
                                  ['parent_id', null],
                              ])->with('child')->paginate(5);

        return response()->json($comments, 200);
    }

    public function store(Request $request, $target_table, $target_id)
    {
        try{
          $comments = Comments::create([
              'target_table' => $target_table,
              'target_id' => $target_id,
              'contents' => $request->input('contents', null),
              'insert_dt' => Carbon::now()->toDateTimeString(),
          ]);
        }catch(Exception $e){
            return response()->json($e);
        }
        return response()->json(200);
    }

    public function recommentsStore(Request $request, $comments_id)
    {
        $parent_comments = Comments::findOrFail($comments_id);
        try{
          $recomments = Comments::create([
              'parent_id' => $parent_comments->id,
              'target_table' => $parent_comments->target_table,
              'target_id' => $parent_comments->target_id,
              'contents' => $request->input('contents', null),
          ]);
        }catch(Exception $e){
            return response()->json($e);
        }

        return response()->json(200);
    }
}

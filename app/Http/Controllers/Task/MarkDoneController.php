<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MarkDoneController extends Controller
{
    public function __invoke(Task $task) {
        
        $user = auth('sanctum')->user()->id;

        if( $task->user_id == $user) {
            
            $task->is_done = 1;
            $task->closing_date = Carbon::now()->toDateTimeString();
            $task->save();
            
            return response()->noContent();
        } else {
            return response()->json(['status' => '403', 'message' => 'Forbidden' ]);
        }

    }
}

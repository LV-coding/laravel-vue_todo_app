<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class DestroyController extends Controller
{
    public function __invoke(Task $task) {

        $user = auth('sanctum')->user()->id;

        if( $task->user_id == $user) {
            $task->delete();
            return response()->noContent();
        } else {
            return response()->json(['status' => '403', 'message' => 'Forbidden' ]);
        }
    }
}

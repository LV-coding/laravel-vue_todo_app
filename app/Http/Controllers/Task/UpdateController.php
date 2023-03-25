<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\TaskUpdateRequest;
use App\Http\Resources\Task\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __invoke(TaskUpdateRequest $request, Task $task) {
        
        $user = auth('sanctum')->user()->id;
        
        if( $task->user_id == $user) {

            $data = $request->validated();
            $task->update($data);
            
            return TaskResource::collection([$task]);
        } else {
            return response()->json(['status' => '403', 'message' => 'Forbidden' ]);
        }


    }
}

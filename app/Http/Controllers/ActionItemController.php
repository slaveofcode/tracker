<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tracker;
use App\Models\ActionItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class ActionItemController extends Controller
{
    public function create(Request $request)
    {
        $tracker = Tracker::where("slug", "=", $request->input('tracker'))->first();

        if ($tracker) {

            if ($this->checkAuthOfTracker($tracker)) {

                $actionItem                 = new ActionItem();
                $actionItem->tracker_id     = $tracker->id;
                $actionItem->description    = $request->input('content');
                $actionItem->status         = ActionItem::STATUS_PAUSED;
                $actionItem->save();

                return response()->json([
                    'created' => TRUE, 
                    'action_item' => [
                        'id' => $actionItem->id,
                        'content' => $actionItem->description,
                    ]
                ]);

            }
            
        }
        
        return response()->json(['created' => FALSE]);
    }

    public function set_done(Request $request)
    {
        $action = ActionItem::findOrFail($request->input('action'));

        if ($action) {
            $action->status = ActionItem::STATUS_DONE;
            $action->save();

            return response()->json(['done' => TRUE]);
        }

        return response()->json(['done' => FALSE]);
    }
}
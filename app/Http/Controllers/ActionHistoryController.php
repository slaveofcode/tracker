<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\ActionItem;
use App\Models\ActionHistory;
use Illuminate\Http\Request;


class ActionHistoryController extends Controller
{

    public function start(Request $request, $actionItemId)
    {
        $actionItem = ActionItem::findOrFail($actionItemId);

        if ($this->checkAuthOfTracker($actionItem->tracker)) {

            /* Check is any running action history */
            $runningHistory = $actionItem->actionHistories()
                                            ->where("status", "=", ActionHistory::STATUS_STARTED)
                                            ->orWhereNull("finish_time")
                                            ->orderBy("start_time", "DESC")
                                            ->first();
            if (!$runningHistory) {
                $actionHistory                      = new ActionHistory();
                $actionHistory->action_item_id      = $actionItemId;
                $actionHistory->start_time          = Carbon::now();
                $actionHistory->comment_on_start    = $request->input('comment');
                $actionHistory->status              = ActionHistory::STATUS_STARTED;
                $actionHistory->save();

                $actionItem->status = ActionItem::STATUS_RUNNING;
                $actionItem->save();
            }

            return response()->json([
                'started' => TRUE
            ]);
        }

        return response()->json(['started' => FALSE, 'reason' => 'Not authorized']);

    }

    public function stop(Request $request, $actionItemId)
    {
        $actionItem = ActionItem::findOrFail($actionItemId);

        if ($this->checkAuthOfTracker($actionItem->tracker)) {

            $runningHistory = $actionItem->actionHistories()
                                            ->where("status", "=", ActionHistory::STATUS_STARTED)
                                            ->orWhereNull("finish_time")
                                            ->orderBy("start_time", "DESC")
                                            ->first();

            if ($runningHistory) {
                $runningHistory->finish_time        = Carbon::now();
                $runningHistory->comment_on_finish  = $request->input('comment');
                $runningHistory->status             = ActionHistory::STATUS_FINISHED;
                $runningHistory->save();
            }

            $actionItem->status = ActionItem::STATUS_PAUSED;
            $actionItem->save();

            /* Stop another running histories if any */
            $runningHistories = $actionItem->actionHistories()
                                            ->where("status", "=", ActionHistory::STATUS_STARTED)
                                            ->orWhereNull("finish_time")
                                            ->get();

            $runningHistories->each(function($history) {
                $history->finish_time   = Carbon::now();
                $history->status        = ActionHistory::STATUS_FINISHED;
                $history->save();
            });

            return response()->json(['stopped' => TRUE]);

        }

        return response()->json(['stopped' => FALSE, 'reason' => 'Not authorized']);

    }


}
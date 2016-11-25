<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Tracker;
use App\Models\ActionItem;
use Hashids\Hashids;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class TrackerController extends Controller
{
    const HASHID_SALT               = 'This is the Salt ukdhBjgojlhggyiti$D6857*&)H0vtyuFHjrHFD*XRCtiJGNPIUH';
    const HASHID_MIN_LENGTH         = 4;
    const FILE_EXTENSION_LIST       = [
        'json', 'xml', 'php', 'js', 'css', 'rb', 'py', 'jpg', 'png', 'tiff', 'sh', 'java', 'gif', 'psd', 'html'];
    const TRACKER_STATUS_IDLE       = 'IDLE';
    const TRACKER_STATUS_RUNNING    = 'RUNNING';
    const TRACKER_STATUS_FINISHED   = 'FINISHED';

    public function create(Request $request)
    {
        if ($request->has('name')) {
            $authId = (Auth::check()) ? $request->user()->id : null;

            $hashids = new Hashids(self::HASHID_SALT, self::HASHID_MIN_LENGTH);

            $slugId     = $hashids->encode($this->getLastTrackerId());
            $extIdx     = array_rand(self::FILE_EXTENSION_LIST, 1);
            $ext        = self::FILE_EXTENSION_LIST[$extIdx];
            $slug       = "{$slugId}.{$ext}";
            
            $newTracker             = new Tracker();
            $newTracker->name       = $request->input('name');
            $newTracker->owner_id   = $authId;
            $newTracker->slug       = $slug;
            $newTracker->save();

            return response()->json([
                'created' => TRUE, 
                'tracker' => $slug
            ]);

        }

        return response()->json(['created' => FALSE]);
    }

    private function getLastTrackerId()
    {
        $lastTracker    = Tracker::orderBy('id', 'DESC')->first();
        $lastTrackerId  = 0;
        if ($lastTracker) {
            $lastTrackerId = $lastTracker->id;
        }

        return $lastTrackerId;
    }

    public function index(Request $request, $trackId)
    {
        $tracker = Tracker::with(['actionItems', 'user'])->where("slug", "=", $trackId)->firstOrFail();

        $title  = $tracker->name;
        $user   = $tracker->user;

        if ($user) {
            $title = "{$tracker->name} by {$user->name}";
        }

        return view('tracker', [
            'pageTitle'                 => $title,
            'tracker'                   => $tracker,
            'trackerStatus'             => $this->getStatus($tracker),
            'trackerTotalRunning'       => $this->getTotalRunningTime($tracker),
            'trackerHistoryStarted'     => $this->getFirstActivity($tracker),
            'trackerHistoryFinished'    => $this->getLastActivity($tracker)
        ]);
        
    }

    private function getStatus(Tracker $tracker)
    {
        /*
         * - No ActionItem = Idle
         * - If Has ActionItem: 
         *   - All (action.status == Done) = Finished
         *   - Any (action.status == Paused) = Idle
         *   - Any (action.status == Running) = Running 
         */
         $status = self::TRACKER_STATUS_IDLE;
         if ($tracker->actionItems) {

             foreach ($tracker->actionItems as $actionItem) {

                 if ($actionItem->status == ActionItem::STATUS_DONE 
                    && !in_array($status, [self::TRACKER_STATUS_RUNNING, self::TRACKER_STATUS_FINISHED])) {
                    
                    /* Set status as Finished if current status not set as 
                        self::TRACKER_STATUS_RUNNING or self::TRACKER_STATUS_FINISHED 
                    */
                    $status = self::TRACKER_STATUS_FINISHED;

                 }

                 if ($actionItem->status == ActionItem::STATUS_PAUSED
                    && $status != self::TRACKER_STATUS_RUNNING) {
                    /* Set status as Idle if current status not set as self::TRACKER_STATUS_RUNNING */
                    $status = self::TRACKER_STATUS_IDLE;
                 }

                 if ($actionItem->status == ActionItem::STATUS_RUNNING) {
                     
                     $status = self::TRACKER_STATUS_RUNNING;

                 }

             }

         }

         return $status;
    }

    private function getTotalRunningTime(Tracker $tracker) {
        $histories = $tracker->actionHistories;
        
        $totalMinutes = 0;

        if ($histories) {

            foreach ($histories as $actionHistory) {

                /* check if history already finished, we calculate the diff */
                if ($actionHistory->isFinished()) {
                    $diffInMinutes = $actionHistory->start_time->diffInMinutes($actionHistory->finish_time);
                    
                    $totalMinutes += $diffInMinutes;
                    
                } else {
                    $now = new Carbon();
                    
                    $diffInMinutes = $actionHistory->start_time->diffInMinutes($now);

                    $totalMinutes += $diffInMinutes;
                }

            }

        }

        $interval = new CarbonInterval();
        return $interval::minutes($totalMinutes)->format('%m month, %d days, %I minutes');
    }

    private function getFirstActivity(Tracker $tracker)
    {
        if ($firstHistory = $tracker->actionHistories->first()) {
            return $firstHistory->start_time;
        }

        return NULL;
    }

    private function getLastActivity(Tracker $tracker) {
        $lastCompleteHistory = $tracker->actionHistories()
                                        ->whereNotNull('start_time')
                                        ->whereNotNull('finish_time')
                                        ->orderBy('finish_time', 'DESC')
                                        ->first();
        if ($lastCompleteHistory) {
            return $lastCompleteHistory->finish_time;
        }

        return NULL;
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Tracker;
use Hashids\Hashids;


class TrackerController extends Controller
{
    const HASHID_SALT           = 'This is the Salt ukdhBjgojlhggyiti$D6857*&)H0vtyuFHjrHFD*XRCtiJGNPIUH';
    const HASHID_MIN_LENGTH     = 4;
    const FILE_EXTENSION_LIST   = [
        'json', 'xml', 'php', 'js', 'css', 'rb', 'py', 'jpg', 'png', 'tiff', 'sh', 'java', 'gif', 'psd', 'html'];

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
        if ($tracker = Tracker::where("slug", "=", $trackId)->first()) {
            return view('tracker', [
                'pageTitle' => $tracker->name
            ]);
        }

        /* TODO: show 404 */
        return response()->view();
    }
}
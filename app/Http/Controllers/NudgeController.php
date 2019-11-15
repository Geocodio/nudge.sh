<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use App\User;
use App\Nudge;
use App\Http\Controllers\Controller;
use App\Notifications\NudgeTriggered;

class NudgeController extends Controller
{
    const MAX_NUDGES_PER_DAY = 5;

    public function __invoke(Request $request, string $nudgeCode) {
        info('Got nudge from ' . $nudgeCode);

        $user = User::where('code', $nudgeCode)->firstOrFail();

        if ($user->nudges()->where('created_at', '>', now()->startOfDay())->count() > self::MAX_NUDGES_PER_DAY) {
            abort(429);
        }

        $output = $request->getContent();

        $nudge = new Nudge();
        $nudge->slug = Uuid::uuid4();
        $nudge->output = $output;
        $user->nudges()->save($nudge);

        $user->notify(new NudgeTriggered($nudge));

        return response()->json(['success' => true]);
    }
}

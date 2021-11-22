<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Notifications\NudgeTriggered;
use App\Nudge;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Ramsey\Uuid\Uuid;

class NudgeController extends Controller
{
    const MAX_NUDGES_PER_DAY = 5;

    public function __invoke(Request $request, string $nudgeCode)
    {
        info('Got nudge from '.$nudgeCode);

        $user = User::where('code', $nudgeCode)->firstOrFail();

        if ($user->nudges()->where('created_at', '>', now()->startOfDay())->count() > self::MAX_NUDGES_PER_DAY) {
            return response()->json([
                'success' => false,
                'message' => 'You have reached the limit of messages today. Please reach out to me@codemonkey.io if you think you need a higher limit.',
            ], 429);
        }

        $output = $request->getContent();

        $nudge = new Nudge();
        $nudge->slug = Uuid::uuid4();
        $nudge->output = strlen($output) > 0 ? Crypt::encryptString($output) : null;
        $user->nudges()->save($nudge);

        $user->notify(new NudgeTriggered($nudge));

        return response()->json(['success' => true]);
    }
}

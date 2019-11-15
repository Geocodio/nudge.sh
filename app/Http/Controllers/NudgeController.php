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
    public function __invoke(Request $request, string $nudgeCode) {
        $user = User::where('code', $nudgeCode)->firstOrFail();
        $output = $request->getContent();

        $nudge = new Nudge();
        $nudge->slug = Uuid::uuid4();
        $nudge->output = $output;
        $user->nudges()->save($nudge);

        $user->notify(new NudgeTriggered($nudge));
    }
}

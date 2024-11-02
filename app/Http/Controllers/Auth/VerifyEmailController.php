<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }


        $user = User::FindOrFail($request->user()->id);
        $user->status = 'active';
        $user->save();

        if ($user->role == 'admin') {
            return redirect()->route('admin.index');
        } elseif ($user->role == 'hirafi') {
            return redirect()->route('hirafi.index');
        } elseif ($user->role == 'user') {
            return redirect()->route('user.main');
        }

        return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if($request->email && $request->email != $user->email) {
            $user->email = $request->email;
            $user->email_verified_at = null;
            $user->sendEmailVerificationNotification();
        }


        if ($request->hasFile('profile_picture')) {
            $remove_image_profile = $user->profile_picture;

            $remove_image_profile = $user->image;

            $profile =  $request->file('profile_picture');
            $profile->store('public/photos');

            $user->profile_picture = $profile->hashName();

            if(!empty($remove_image_profile)) {
                if (file_exists(public_path('public/photos/' . $remove_image_profile))) {
                    unlink(public_path($remove_image_profile));
                }
            }
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function updatePasswordView()
    {
        return view('profile.change_password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => ['required', 'string'],
            'password' => ['required', 'confirmed'],
        ]);

        $new_password = Hash::make($request->input('password'));
        $user_id = $request->user()->id;

        if(!Hash::check($request->old_password, $request->user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }

        $user = User::findorfail($user_id);
        $user->password = $new_password;
        $user->save();
        return redirect(route('password.update_index'))->with('status', 'Password updated successfully.');
    }

    public function deleteAccountIndex()
    {
        return view('profile.delete-account');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

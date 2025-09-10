<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Profile;
use Intervention\Image\Facades\Image;

class ProfileHandler extends Controller
{

        // Display the profile Detailes with or without login
    public function index($user)
    {
        $follows        = (auth()->user())? auth()->user()->following->contains($user) :false;

        $user           = User::findOrFail($user);
        $time           = now()->addseconds(30);
        $postCount      = Cache::remember('cache.post.'.$user->id, $time,
                            function () use ($user) {
                                return $user->posts->count();
                            });

        $followesCount  = Cache::remember('cache.followersCount.'.$user->id, $time,
                            function () use ($user) {
                                return $user->profile->followers->count();
                            });

        $followingCount = Cache::remember('cache.followingCount.'.$user->id, $time,
                            function () use ($user) {
                                return $user->following->count();
                            });



        return view('profile.index', [
            'user'           => $user,
            'follows'        => $follows,
            'postCount'      => $postCount,
            'followesCount'  => $followesCount,
            'followingCount' => $followingCount,
        ]);
    }

    public function edit(User $user)
    {

        if (auth()->user()->id !== $user->id){abort(403);}

        return view('profile.editpro', compact('user'));

    }

    public function update(User $user)
    {
        if (auth()->user()->id !== $user->id){abort(403);}
        $data = request()->validate([
            'title'       => 'required',
            'description' => 'required',
            'url'         => 'url',
            'image'       => '',
        ]);

        if(request('image'))
        {
            $imagePath = request('image')->store('profile', 'public');
            $image     = Image::make(public_path("/storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();
            $imageArray = ['image' => $imagePath];
        }

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? [],
        ));
        return redirect('profile/'. $user->id);
    }
}

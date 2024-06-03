<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follow;
use App\Models\User;
use Auth;

class FollowController extends Controller
{
    public function follow($id)
    {
        $followee = User::findOrFail($id);
        $follower = Auth::user();

        if ($follower->id == $followee->id) {
            return response()->json(['message' => 'You cannot follow yourself'], 400);
        }

        // Periksa apakah sudah mengikuti
        $alreadyFollowing = Follow::where('follower_id', $follower->id)
                                  ->where('followee_id', $followee->id)
                                  ->exists();

        if ($alreadyFollowing) {
            return response()->json(['message' => 'You are already following this user'], 400);
        }

        $follow = Follow::create([
            'follower_id' => $follower->id,
            'followee_id' => $followee->id,
            'followed_at' => now(),
        ]);

        return response()->json(['message' => 'Successfully followed the user'], 200);
    }

    public function unfollow($id)
    {
        $followee = User::findOrFail($id);
        $follower = Auth::user();

        $follow = Follow::where('follower_id', $follower->id)
                        ->where('followee_id', $followee->id)
                        ->first();

        if ($follow) {
            $follow->delete();
            return response()->json(['message' => 'Successfully unfollowed the user'], 200);
        } else {
            return response()->json(['message' => 'You are not following this user'], 400);
        }
    }
}

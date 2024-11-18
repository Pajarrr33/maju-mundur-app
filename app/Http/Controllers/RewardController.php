<?php

namespace App\Http\Controllers;

use App\Http\Requests\RedemptionRewardRequest;
use App\Http\Resources\RedemptionResource;
use App\Http\Resources\RewardResource;
use App\Models\Redemptions;
use App\Models\Rewards;
use App\Models\Users;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RewardController extends Controller
{
    public function get(Request $request)
    {
        $reward = Rewards::all();

        return RewardResource::collection($reward);
    }

    public function redempt_reward(RedemptionRewardRequest $request): RedemptionResource
    {
        $user = Auth::user();
        $customer_id = $user->id;

        $redemption = new Redemptions($request->validated());
        $reward = Rewards::where('id', $redemption->reward_id)->first();
        $user = Users::where('id', $customer_id)->first();
        if ($user->point < $reward->points_required) {
            throw new HttpResponseException(response()->json([
                "errors" => [
                    'message' => 'Not enough points'
                ] 
            ], 400));
        }

        $redemption->customer_id = $customer_id;
        $redemption->redeemed_at = now();
        $redemption->points = $reward->points_required;
        $redemption->save();

        $user->point -= $redemption->points;
        $user->save();

        return new RedemptionResource($redemption);
        
    }
}

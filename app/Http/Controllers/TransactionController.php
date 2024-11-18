<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Products;
use App\Models\Transactions;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function get(Request $request)
    {
        $user = Auth::user();

        if ($user->role == 'customer') {
            $transactions = Transactions::where('customer_id', $user->id)->get();
            
            return TransactionResource::collection($transactions);
        } else {
            $products = Products::where('merchant_id', $user->id)->get();
            $transactions = Transactions::whereIn('product_id', $products->pluck('id'))->get();

            return TransactionResource::collection($transactions);
        }
    }

    public function create(CreateTransactionRequest $request): TransactionResource
    {
        $user = Auth::user();
        $customerid = $user->id;

        $transactions = new Transactions($request->validated());
        $products = Products::where('id', $transactions->product_id)->first();
        $transactions->customer_id = $customerid;
        $transactions->total_price = $products->price * $transactions->quantity;
        $transactions->points = floor($transactions->total_price / 10000);
        $transactions->save();

        $user = Users::where('id', $customerid)->first();
        $user->point += $transactions->points;
        $user->save();

        return new TransactionResource($transactions);
    }
}

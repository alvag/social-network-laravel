<?php

namespace App\Http\Controllers;

use App\Models\Models\Status;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StatusesController extends Controller
{

    public function store(Request $request): JsonResponse
    {
        request()->validate(['body' => 'required|min:5']);

        $status = Status::create([
            'body'    => $request->input('body'),
            'user_id' => auth()->user()->id
        ]);

        return response()->json(['body' => $status->body]);
    }
}

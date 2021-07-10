<?php

namespace App\Http\Controllers;

use App\Models\Models\Status;
use Illuminate\Http\Request;

class StatusesController extends Controller
{
    public function store(Request $request)
    {
        $status = Status::create([
            'body'    => $request->input('body'),
            'user_id' => auth()->user()->id
        ]);

        return response()->json(['body' => $status->body]);
    }
}

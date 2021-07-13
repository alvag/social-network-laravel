<?php

namespace App\Http\Controllers;

use App\Http\Resources\StatusResource;
use App\Models\Status;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StatusesController extends Controller
{

    public function index(): AnonymousResourceCollection
    {
        return StatusResource::collection(Status::latest()->paginate());
    }

    public function store(Request $request): StatusResource
    {
        request()->validate(['body' => 'required|min:5']);

        $status = Status::create([
            'body'    => $request->input('body'),
            'user_id' => auth()->user()->id
        ]);

        return StatusResource::make($status);
    }

}

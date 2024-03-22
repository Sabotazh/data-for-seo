<?php

namespace App\Http\Controllers;

use App\Actions\SendRequestAction;
use App\Http\Requests\StoreRequest;
use App\Http\Resources\DataforseoCollection;
use App\Models\Dataforseo;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class DataforseoController extends Controller
{
    public function index():View
    {
        return view('dataforseo.index');
    }

    public function create(): View
    {
        return view('dataforseo.create');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $parameter = Str::random(9);

        (new SendRequestAction)->sendPostRequest(
            $parameter,
            $request->validated()['target_domain'],
            $request->validated()['excluded_target']
        );

        return response()->json(
            new DataforseoCollection(
                Dataforseo::query()->where(['parameter' => $parameter])->get()
            )
        );
    }
}

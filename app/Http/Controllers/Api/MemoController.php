<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMemoRequest;
use App\Http\Resources\MemoDetailResource;
use App\Http\Resources\MemoResource;
use App\Models\Memo;
use Illuminate\Support\Facades\Auth;

class MemoController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Memo::class, 'memo');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return MemoResource::collection(Auth::user()->memos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMemoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMemoRequest $request)
    {
        $memo = Memo::create([
            'user_id' => Auth::id(),
            'title' => $request->input('title'),
            'body' => $request->input('body'),
        ]);

        return new MemoResource($memo);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Memo $memo)
    {
        return new MemoDetailResource($memo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreMemoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreMemoRequest $request, Memo $memo)
    {
        $memo->title = $request->title;
        $memo->body = $request->body;
        $memo->save();

        return new MemoDetailResource($memo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Memo $memo)
    {
        $memo->delete();
        return response()->noContent();
    }
}

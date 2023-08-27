<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateLinkRequest;
use App\Models\Link;
use App\Services\SlugGenerator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = Link::selectRaw("
            links.*,
            count(click_links.link_id) as clicks,
            concat('" . config('app.url') . "/click-link/', links.slug) as alias"
        )
        ->join('click_links', 'click_links.link_id', 'links.id')
        ->groupBy('links.id');

        return response()->json([
            'links' => $links->orderBy('created_at')->get()
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateLinkRequest $request)
    {
        Link::create($this->validarRequest($request));
        return response()->json([], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(['link' => Link::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateLinkRequest $request, $id)
    {
        Link::find($id)->update($this->validarRequest($request));
        return response()->json([], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Link::find($id)->delete();
        return response()->json([], Response::HTTP_OK);
    }

    /**
     * Remve all links from list
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteAll()
    {
        DB::transaction(function () {
            Link::getQuery()->delete();
        });

        return response()->json([], Response::HTTP_OK);
    }

    /**
     * Validation Slug
     * @return Array
     */
    private function validarRequest($request)
    {
        $uniqueSlug = SlugGenerator::generateUniqueSlug();
        $request['slug'] = isset($request->slug) ? Str::of($request->slug)->slug('-') : $uniqueSlug;
        return $request->all();
    }
}

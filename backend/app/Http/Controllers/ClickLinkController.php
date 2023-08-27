<?php

namespace App\Http\Controllers;

use App\Models\ClickLink;
use App\Models\Link;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClickLinkController extends Controller
{
    public function click($slug, Request $request)
    {
        $link = Link::whereSlug($slug)->first();

        ClickLink::create([
            'link_id' => $link->id,
            'ip' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'created_at' => Carbon::now()
        ]);

        return redirect($link->link);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWebsite;
use App\Website;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index(Request $request)
    {
        $limit = 5;
        $sites = Website::filter($request->filter)->limit($limit)->offset(($request->page - 1) * $limit);

        if ($request->name !== 'null') {
            $sites->orderBy('name', $request->name);
        }

        if ($request->created !== 'null') {
            $sites->orderBy('created_at', $request->created);
        }

        $sites = $sites->get();
        $count = Website::filter($request->filter)->count();

        return response()->json(['status' => 'OK', 'websites' => $sites, 'page' => $request->page, 'count' => ceil($count / $limit)], 200);
    }

    public function store(StoreWebsite $request)
    {
        try {
            $website = Website::create([
                'name' => $request->name,
                'url' => $request->url,
            ]);

            return response()->json(['status' => 'OK', 'message' => 'The website has been recorded successfully'], 200);
        } catch (\Exception $exception) {
            app('log')->info('The website couldn\'t be recorded due to:');
            app('log')->info($exception->getMessage());

            return response()->json(['status' => 'ERROR', 'message' => 'We have a problem registering your website, try again later'], 500);
        }
    }
}

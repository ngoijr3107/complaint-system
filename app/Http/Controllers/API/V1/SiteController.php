<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Site;
use Illuminate\Http\Request;

class SiteController extends BaseController
{
    protected $site = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct(Site $site)
    // {
    //     $this->middleware('auth:api');
    //     $this->site = $site;
    // }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sites = Site::latest()->paginate(10);

        return $this->sendResponse($sites, 'Sites list');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $sites = Site::get();

        return $this->sendResponse($sites, 'Sites list');
    }


    /**
     * Store a newly created resource in storage.
     *
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $tag = Site::create([
            'site_name' => $request->get('site_name'),
            'site_region' => $request->get('site_region'),
            'site_mobile' => $request->get('site_mobile')
        ]);

        return $this->sendResponse($tag, 'Site Created Successfully');
    }

    /**
     * Update the resource in storage
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $tag = Site::findOrFail($id);

        $tag->update($request->all());

        return $this->sendResponse($tag, 'Site Information has been updated');
    }

    public function destroy($id)
    {

        // $this->authorize('isAdmin');

        $site = Site::findOrFail($id);
        // delete the user

        $site->delete();

        return $this->sendResponse([$site], 'Site has been Deleted');
    }
}

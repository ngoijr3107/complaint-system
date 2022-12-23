<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Complaint;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    protected $category = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct(Category $category)
    // {
    //     $this->middleware('auth:api');
    //     $this->category = $category;
    // }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);

        return $this->sendResponse($categories, 'Category list');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $categories = Category::get();

        return $this->sendResponse($categories, 'Category list');
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
        $tag = Category::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ]);

        return $this->sendResponse($tag, 'Department Created Successfully');
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
        $tag = Category::findOrFail($id);

        $tag->update($request->all());

        return $this->sendResponse($tag, 'Department Information has been updated');
    }

    public function destroy($id)
    {

        // $this->authorize('isAdmin');

        $category = Category::findOrFail($id);
        // delete the user

        $category->delete();

        return $this->sendResponse([$category], 'Department has been Deleted');
    }
}

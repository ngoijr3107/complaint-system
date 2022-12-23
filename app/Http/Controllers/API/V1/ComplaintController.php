<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Complaint;
use App\Models\Category;
use App\Models\Site;
use Illuminate\Http\Request;
use App\Http\Requests\Products\ProductRequest;
use Illuminate\Support\Facades\DB;

class ComplaintController extends BaseController
{

    protected $complaint = '';
    protected $sites = '';
    protected $categories = '';


    public function index()
    {
        // $complaints = Complaint::latest()->paginate(10);
        // return $this->sendResponse($complaints, 'Complaints list');
        // $complaint = DB::join('complaints', 'complaints.category_id', '=', 'categories.id')
        // ->join('complaints', 'complaints.site_id', '=', 'sites.id')
        // ->get('complaints', 'categories.name', 'sites.site_name')
        // ->paginate(10);   
        // return $this->sendResponse($complaint, compact('sites', 'categories'));
        $sites = Site::get();
        $categories = Category::get();
        $complaints = Complaint::with('Site', 'Category')
        ->latest()
        ->paginate(10);
    return $this->sendResponse($complaints, compact('sites', 'categories'));
    }



    public function list()
    {
        // $complaints = $this->complaint->pluck('fullname', 'id', 'phone', 'complaint', 'category_id', 'location', 'suggestion', 'like');
        $title = 'Complaint List';
        // $complaints = Complaint::get();
        // $sites = Site::get();
        // $categories = Category::get();
        // $data = Complaint::join('complaints', 'complaints.category_id', '=', 'categories.id')
        //                     ->join('complaints', 'complaints.site_id', '=', 'sites.id')
        //                     ->get('complaints.fullname', 'categories.name', 'sites.site_name');
        $sites = Site::get();
        $categories = Category::get();
        $complaints = Complaint::with('site', 'category')
        ->latest()
        ->paginate(10);
    return $this->sendResponse($complaints, compact('sites', 'categories'));
    }


  
    public function store(ProductRequest $request)
    {
        $complaint = Complaint::create([
            'fullname' => $request->get('fullname'),
            'site_id' => $request->get('site_id'),
            'category_id' => $request->get('category_id'),
            'phone' => $request->get('phone'),
            'complain' => $request->get('complain'),
            'suggestion' => $request->get('suggestion'),
            'like' => $request->get('like'),
            'status' => '',
            'comment' => '',
        ]);

        return $this->sendResponse($complaint, 'Imefanikiwa/Sent successfully!');
    }

  
    public function update($id)
    {
        // $complaint = $this->complaint->findOrFail($id);

        // $complaint->update($request->all());
        $complaint = Complaint::where('id', $id)->firstOrFail();
        $complaint->comment = Complaint::get('comment');
        $complaint->save();
        return $this->sendResponse($complaint, 'Comment has been added');
    }

   
    public function destroy($id)
    {

        // $this->authorize('isAdminOrUser');

        // $complaint = $this->complaint->findOrFail($id);

        // $complaint->delete();

        // return $this->sendResponse($complaint, 'Product has been Deleted');

        $complaint = Complaint::where('id', $id)->findOrFail($id);
        $complaint->status = "Closed";
        $complaint->save();
        return $this->sendResponse($complaint, 'Complaint has been Closed');
    }

    public function close($id)
    {
        $complaint = Complaint::where('id', $id)->firstOrFail();
        $complaint->status = "Closed";
        $complaint->save();
        return $this->sendResponse($complaint, 'Complaint has been Closed');
    }
}

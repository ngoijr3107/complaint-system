<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Site;
use App\Models\User;
use App\Models\Complaint;
use DB;

class DashboadController extends BaseController
{
   public function AllComplaints(){
    $complaints = Complaint::count();
    return $this->sendResponse('complaints', 'All complaints');
   }
   public function OpenComplaints() {
    $OpenComplaints = Complaint::where('status', '=', 'Open')->count();
    return $this->sendResponse('complaints', 'OpenComplaints');
   }
   public function ClosedComplaints() {
    $ClosedComplaints = Complaint::where('status', '=', 'Closed')->count();
    return $this->sendResponse('complaints', 'ClosedComplaints');
   }
}

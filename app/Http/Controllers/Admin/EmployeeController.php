<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $rows = User::whereRoleIs('employee')->latest();
        $search = [];
        if ($request->has('employee_name') && $request->get('employee_name') != '') {
            $search['employee_name'] = $request->employee_name;
            $searchTerms = explode(' ', $request->employee_name);
            $rows->where(function ($subquery) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    $subquery->orWhere('users.first_name', 'like', '%' . $term . '%')
                                ->orWhere('users.last_name', 'like', '%' . $term . '%')
                                ->orWhere('users.email', 'like', '%' . $term . '%');
                }
            });
        }
        if ($request->has('employee_phone') && $request->get('employee_phone') != '') {
            $search['employee_phone'] = $request->employee_phone;
            $rows->whereHas('employee_profile', function ($query) use ($searchTerms) {
                $query->orWhere('employee_profiles.phone', 'like', '%' . $searchTerms . '%');

            });
        }
        if ($request->has('from_date') && !empty($request->get('from_date')) && $request->has('to_date') && !empty($request->get('to_date'))) {
            $fromDate = $request->from_date;
            $toDate = $request->to_date;
            // Ensure `to_date` includes the end of the day
            $toDate = Carbon::parse($toDate)->endOfDay();
            $search['from_date'] = $fromDate;
            $search['to_date'] = $toDate;

            $rows->whereBetween('created_at', [$fromDate, $toDate]);
        }
        $data = [
            'page_name' => 'employees',
            'page_title' => 'Employees',
            'employees' => $rows->get(),
            'search' => $search,
        ];
        return view('admin.employees.index', $data);
    }
}

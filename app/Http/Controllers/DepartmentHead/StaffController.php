<?php

namespace App\Http\Controllers\DepartmentHead;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $departmentId = $user->department_id;

        $sortable = ['name', 'staff_id', 'position', 'role', 'is_active'];
        $sort = $request->query('sort', 'name');
        $direction = $request->query('direction', 'asc');

        if (!in_array($sort, $sortable, true)) {
            $sort = 'name';
        }

        if (!in_array($direction, ['asc', 'desc'], true)) {
            $direction = 'asc';
        }

        $query = User::where('department_id', $departmentId)
            ->with('department');

        if ($sort === 'position') {
            $query->orderByRaw($direction === 'asc' ? 'position IS NOT NULL DESC' : 'position IS NOT NULL ASC')
                ->orderBy('position', $direction);
        } else {
            $query->orderBy($sort, $direction);
        }

        $query->orderBy('users.name');

        $staff = $query->paginate(15)->withQueryString();

        return view('department-head.staff.index', compact('staff', 'sort', 'direction'));
    }

    public function show(User $user)
    {
        $departmentHead = auth()->user();

        if ($user->department_id !== $departmentHead->department_id) {
            abort(403);
        }

        $user->load('department', 'leaveBalances.leaveType', 'leaveRequests.leaveType');

        return view('department-head.staff.show', compact('user'));
    }
}

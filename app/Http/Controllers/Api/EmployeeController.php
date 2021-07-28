<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Employee;
use App\Models\User;
use App\Models\EmployeeDetails;
use App\Models\Job;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Ulid\Ulid;
use App\Http\Controllers\BaseController;

class EmployeeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->limit ? $request->limit : 10;
        $results = DB::table('employees')
            ->paginate($limit);
        return $this->paginate($results);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestAll = $request->all();
        $validator = Validator::make($requestAll, [
            'department_id' => 'required|exists:departments,id',
            'user_id' => 'nullable|exists:users,id',
            'birth_date' => 'nullable|date_format:Y-m-d',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'avatar' => 'nullable|max:255',
            'age' => 'nullable|digits_between:1,2',
            'gender' => 'nullable|digits_between:1,2',
            'job_id' => 'nullable|exists:jobs,job_id',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->getMessageBag(),
            ]);
        }
        $requestAll['created_by'] = Auth::user()->id ?? 'SYSTEM';
        $requestAll['updated_by'] = Auth::user()->id ?? 'SYSTEM';
        $userId = $requestAll['user_id'];
        User::where(['id' => $userId])->update(['status' => 1]);
        $employee = Employee::create($requestAll);
        EmployeeDetails::create([
            'id' => (string) Ulid::generate(),
            'employee_id' => $employee->id,
            'created_by' => 'SYSTEM',
            'updated_by' => 'SYSTEM',
        ]);
        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Thêm mới thành công',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $EmployeeId = Employee::find($id);
        if (!$EmployeeId) {
            return response()->json(['message' => 'Không tìm thấy ID']);
        }
        $requestAll = $request->all();
        $validator = Validator::make($requestAll, [
            'department_id' => 'required|exists:departments,id',
            'birth_date' => 'nullable|date_format:Y-m-d',
            'department_manager' => 'max:255',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'avatar' => 'nullable|max:255',
            'age' => 'nullable|digits_between:1,2',
            'gender' => 'nullable|digits_between:1,2',
            'job_id' => 'nullable|exists:jobs,job_id',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->getMessageBag(),
            ]);
        }
        $requestAll['created_by'] = Auth::user()->id ?? 'SYSTEM';
        $requestAll['updated_by'] = Auth::user()->id ?? 'SYSTEM';
        $EmployeeId->update($requestAll);
        $EmployeeId->save();
        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Cập nhật thành công',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $EmployeeId = Employee::find($id);
        if (!$EmployeeId) {
            return response()->json(['message' => 'Không tìm thấy ID']);
        }
        $job = new Job();
        $employeeDetail = new EmployeeDetails();

        $EmployeeId->destroy($id);
        $job->where(['id' => $id])->delete();
        $employeeDetail->where(['employee_id' => $id])->delete();
        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Xóa nhân viên thành công',
        ]);
    }
}

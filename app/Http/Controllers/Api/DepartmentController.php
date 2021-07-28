<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DepartmentController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->limit ? $request->limit : 10;
        $results = DB::table('departments')
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
            'department_name' => 'required|min:8|unique:departments,department_name',
            'department_phone' => 'required|min:10|max:11|unique:departments,department_phone',
            'department_number_person' => 'required|min:0|max:1000',
            'department_manager' => 'max:255',
            'department_manager_other' => 'max:255',
            'department_note' => 'max:10000',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->getMessageBag(),
            ]);
        }
        Department::create($requestAll);
        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Thêm mới thành công',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $departmentId = Department::find($id);
        if (!$departmentId) {
            return response()->json(['message' => 'Không tìm thấy ID']);
        }
        $requestAll = $request->all();
        $validator = Validator::make($requestAll, [
            'department_name' => 'required|min:8|unique:departments,department_name,'.$id,
            'department_phone' => 'required|min:10|max:11|unique:departments,department_phone,'.$id,
            'department_number_person' => 'required|min:0|max:1000',
            'department_manager' => 'max:255',
            'department_note' => 'max:10000',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->getMessageBag(),
            ]);
        }
        $departmentId->update($requestAll);
        $departmentId->save();
        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Cập nhật thành công',
        ]);
    }

    /**
     * 
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $departmentId = Department::find($id);
        if (!$departmentId) {
            return response()->json(['message' => 'Không tìm thấy ID']);
        }
        $departmentId->destroy($id);
        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Xóa phòng ban thành công',
        ]);
    }
}

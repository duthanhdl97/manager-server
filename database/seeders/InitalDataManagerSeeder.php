<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use App\Models\Role;
use App\Models\Job;
use App\Models\EmployeeDetails;
use Ulid\Ulid;

class InitalDataManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $startTime = microtime(true);

        Department::query()->truncate();
        Role::query()->truncate();
        User::query()->truncate();
        Employee::query()->truncate();
        Job::query()->truncate();
        EmployeeDetails::query()->truncate();

        $departmentId = (string) Ulid::generate();
        Department::insert([
            [
                'id' => (string) Ulid::generate(),
                'department_name' => 'Division 1',
                'department_phone' => '0971192594',
                'department_number_person' => '19',
                'department_manager_other' => 'Trang',
                'department_manager' => 'Thành Dư',
                'department_note' => 'BE, FE',
                'created_by' => 'SYSTEM',
                'updated_by' => 'SYSTEM',
            ], [
                'id' => (string) Ulid::generate(),
                'department_name' => 'Division 2',
                'department_phone' => '0971192594',
                'department_number_person' => '19',
                'department_manager' => 'Trang Huyền',
                'department_manager_other' => 'Trang',
                'department_note' => 'BE (Php, Python), FE (Reactjs, Nodejs, Vuejs)',
                'created_by' => 'SYSTEM',
                'updated_by' => 'SYSTEM',
            ], [
                'id' => $departmentId,
                'department_name' => 'Division management',
                'department_phone' => '0971192594',
                'department_number_person' => '19',
                'department_manager' => 'Trang Huyền',
                'department_manager_other' => 'Trang',
                'department_note' => 'BE (Php, Python), FE (Reactjs, Nodejs, Vuejs)',
                'created_by' => 'SYSTEM',
                'updated_by' => 'SYSTEM',
            ]
        ]);

        $roleId = (string) Ulid::generate();
        Role::insert([
            [
                'id' => $roleId,
                'role_name' => 'Administrator',
                'role_permission' => json_encode([
                    'department' => [
                        'list' => 1,
                        'edit' => 1,
                        'create' => 1,
                        'delete' => 1,
                        'detail' => 1,
                        'confirm' => 1,
                        'complete' => 1,
                        'admin' => 1,
                    ],
                    'user' => [
                        'list' => 1,
                        'edit' => 1,
                        'create' => 1,
                        'delete' => 1,
                        'detail' => 1,
                        'confirm' => 1,
                        'complete' => 1,
                        'admin' => 1,
                    ],
                    'employee' => [
                        'list' => 1,
                        'edit' => 1,
                        'create' => 1,
                        'delete' => 1,
                        'detail' => 1,
                        'confirm' => 1,
                        'complete' => 1,
                        'admin' => 1,
                    ],
                ]),
                'created_by' => 'SYSTEM',
                'updated_by' => 'SYSTEM',
            ], [
                'id' => (string) Ulid::generate(),
                'role_name' => 'Admin',
                'role_permission' => json_encode([
                    'department' => [
                        'list' => 1,
                        'edit' => 1,
                        'create' => 1,
                        'delete' => 0,
                        'detail' => 1,
                        'confirm' => 1,
                        'complete' => 1,
                        'admin' => 1,
                    ],
                    'user' => [
                        'list' => 1,
                        'edit' => 1,
                        'create' => 1,
                        'delete' => 0,
                        'detail' => 1,
                        'confirm' => 1,
                        'complete' => 1,
                        'admin' => 1,
                    ],
                    'employee' => [
                        'list' => 1,
                        'edit' => 1,
                        'create' => 1,
                        'delete' => 0,
                        'detail' => 1,
                        'confirm' => 1,
                        'complete' => 1,
                        'admin' => 1,
                    ],
                ]),
                'created_by' => 'SYSTEM',
                'updated_by' => 'SYSTEM',
            ], [
                'id' => (string) Ulid::generate(),
                'role_name' => 'Manage',
                'role_permission' => json_encode([
                    'department' => [
                        'list' => 1,
                        'edit' => 1,
                        'create' => 1,
                        'delete' => 0,
                        'detail' => 1,
                        'confirm' => 1,
                        'complete' => 1,
                        'admin' => 1,
                    ],
                    'user' => [
                        'list' => 1,
                        'edit' => 1,
                        'create' => 1,
                        'delete' => 0,
                        'detail' => 1,
                        'confirm' => 1,
                        'complete' => 1,
                        'admin' => 1,
                    ],
                    'employee' => [
                        'list' => 1,
                        'edit' => 1,
                        'create' => 1,
                        'delete' => 0,
                        'detail' => 1,
                        'confirm' => 1,
                        'complete' => 1,
                        'admin' => 1,
                    ],
                ]),
                'created_by' => 'SYSTEM',
                'updated_by' => 'SYSTEM',
            ], [
                'id' => (string) Ulid::generate(),
                'role_name' => 'Guest',
                'role_permission' => json_encode([
                    'department' => [
                        'list' => 1,
                        'edit' => 0,
                        'create' => 0,
                        'delete' => 0,
                        'detail' => 0,
                        'confirm' => 0,
                        'complete' => 0,
                        'admin' => 1,
                    ],
                    'user' => [
                        'list' => 1,
                        'edit' => 0,
                        'create' => 0,
                        'delete' => 0,
                        'detail' => 0,
                        'confirm' => 0,
                        'complete' => 0,
                        'admin' => 1,
                    ],
                    'employee' => [
                        'list' => 1,
                        'edit' => 0,
                        'create' => 0,
                        'delete' => 0,
                        'detail' => 0,
                        'confirm' => 0,
                        'complete' => 0,
                        'admin' => 1,
                    ],
                ]),
                'created_by' => 'SYSTEM',
                'updated_by' => 'SYSTEM',
            ]
        ]);

        $userId = (string) Ulid::generate();
        DB::table('users')->insert([
            'id' => $userId,
            'name' => 'TrangHuyen',
            'email' => 'trangbth@rikkeisoft.com',
            'password' => bcrypt('trang123'),
            'role_id' => $roleId,
            'created_by' => 'SYSTEM',
            'updated_by' => 'SYSTEM',
        ]);
        $user = DB::table('users')->where('id', $userId)->first();

        $jobId = (string) Ulid::generate();

        Job::create([
            'id' => $jobId,
            'name' => 'Manager',
            'department_id' => $departmentId,
            'description' => 'Quản lý các Division',
            'start_date' => '10/20/2020',
            'end_date' => '10/20/2022',
            'created_by' => 'SYSTEM',
            'updated_by' => 'SYSTEM',
        ]);

        $employee = Employee::create([
            'id' => (string) Ulid::generate(),
            'department_id' => $departmentId,
            'user_id' => $user->id,
            'birth_date' => '03/02/1999',
            'first_name' => 'Bùi',
            'last_name' => 'Trang',
            'avatar' => '',
            'age' => '22',
            'gender' => '1',
            'job_id' => $jobId,
            'created_by' => 'SYSTEM',
            'updated_by' => 'SYSTEM',
        ]);

        EmployeeDetails::create([
            'id' => (string) Ulid::generate(),
            'employee_id' => $employee->id,
            'phone' => '0971192594',
            'phone_other' => '',
            'email' => 'email',
            'yahoo' => 'yahoo',
            'skype' => 'skype',
            'city' => 'city',
            'town' => 'town',
            'village' => 'village',
            'created_by' => 'SYSTEM',
            'updated_by' => 'SYSTEM',
        ]);

        echo (microtime(true) - $startTime) . " sec.\n";
    }
}

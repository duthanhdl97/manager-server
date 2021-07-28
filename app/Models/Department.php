<?php

namespace App\Models;

use Common\Eloquent\ModelBase;
use Ulid\Ulid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * This is the custom base model class for table "departments".
 *
 * The followings are the available columns in table "departments":
 * @property string $department_name
 * @property string $department_phone
 * @property string $department_note
 * @property string $department_number_person
 * @copyright s-cubism.co.ltd. All Rights Reserved.
 * @category framework
 * @package Eloquent
 * @mixin \Eloquent
 */

class Department extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'departments';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function($model) {
            $model->id = (string) Ulid::generate();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'department_name',
        'department_phone',
        'department_note',
        'department_number_person',
        'department_manager',
        'department_manager_other',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * Searchable properties
     *
     * @var array
     */
    protected $searchable = [
        'department_name',
        'department_phone',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    protected $primaryKey = 'employeeNumber';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'employeeNumber',
        'lastName',
        'firstName',
        'extension',
        'email',
        'officeCode',
        'reportsTo',
        'jobTitle'
    ];

    public function office()
    {
        return $this->belongsTo(Office::class, 'officeCode', 'officeCode');
    }

    public function manager()
    {
        return $this->belongsTo(Employee::class, 'reportsTo', 'employeeNumber');
    }

    public function subordinates()
    {
        return $this->hasMany(Employee::class, 'reportsTo', 'employeeNumber');
    }

    public function customers()
    {
        return $this->hasMany(Customer::class, 'salesRepEmployeeNumber', 'employeeNumber');
    }

    /**
     * Get the user associated with this employee.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
}

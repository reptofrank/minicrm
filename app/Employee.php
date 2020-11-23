<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /**
     * Get the employee level user associated with the employee.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

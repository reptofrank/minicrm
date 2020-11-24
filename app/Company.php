<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * Get the company level user associated with the company.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the employees associated with the company.
     */
    public function employees()
    {
        return $this->hasMany('App\Employee');
    }
}

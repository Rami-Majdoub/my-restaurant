<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }

    public function unpaidBills()
    {
        return $this->bills()->where('is_paid', 0);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

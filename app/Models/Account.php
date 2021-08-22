<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'accounts';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'agency_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function accountExpenses()
    {
        return $this->hasMany(Expense::class, 'account_id', 'id');
    }

    public function accountIncomes()
    {
        return $this->hasMany(Income::class, 'account_id', 'id');
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class, 'agency_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

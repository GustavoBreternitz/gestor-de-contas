<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Records extends Model
{
    protected $table = 'records';

    protected $primaryKey = 'id_record';

    protected $fillable = [
        'title',
        'value',
        'status',
        'type',
        'id_class',
        'id_user'
    ];
}

<?php

namespace App\Models;

class Records
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

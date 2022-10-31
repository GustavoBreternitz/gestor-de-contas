<?php

namespace Modules\Adm\Services;

use App\Models\Records;
use Illuminate\Support\Facades\DB;

class RecordsService
{
    public function __construct(Records $records)
    {
        $this->model = $records;
    }

    public function create($record)
    {
        try {
            DB::beginTransaction();
            

        } catch (\Exception $e) {
            DB::rollBack();

        }
    }
}
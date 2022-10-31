<?php

namespace App\Services;

use App\Models\Records;
use App\Utils\StatusHttp;
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
            $arr_insert = [
                'title' => $record["title"],
                'value' => $record["value"],
                'type' => $record["type"],
                'id_class' => $record["id_class"],
                'status' => 'ati'
            ];

            $this->model->create($arr_insert);
            DB::commit();
            return ['status' => StatusHttp::SUCCESS, 'message' => 'Lançamento criado com sucesso.'];

        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => StatusHttp::ERROR, 'message' => 'Ocorreu um erro interno, tente novamente ou entre em contato com o administrador.'];
        }
    }

    public function listAll()
    {
        try {
            $records = $this->model->where('status', '=', 'ati')->get();
            $arr_records = [];

            foreach($records as $record) {
                $arr_records[] = [
                    'title' => $record->title,
                    'value' => $record->value,
                    'type' => $record->type,
                    'class' => $record->id_class
                ];
            }

            if(empty($arr_records)) {
                return ['status' => StatusHttp::SUCCESS, 'message' => 'Não foram encontrados lançamentos.'];
            }

            return ['status' => StatusHttp::SUCCESS, 'itens' => $arr_records];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => StatusHttp::ERROR, 'message' => 'Ocorreu um erro interno, tente novamente ou entre em contato com o administrador.'];
        } 
    }
}
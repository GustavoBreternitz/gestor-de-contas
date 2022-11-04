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

            if(!isset($record['create'])) {
                $this->model->create([
                    'title' => $record["title"],
                    'value' => $record["value"],
                    'type' => $record["type"],
                    'id_class' => $record["id_class"],
                    'status' => 'ati'
                ]);
            } else if(isset($record['create']) && !empty($record['create'])) {
                foreach($record['create'] as $lanc) {
                    $this->model->create([
                        'title' => $lanc["title"],
                        'value' => $lanc["value"],
                        'type' => $lanc["type"],
                        'id_class' => $lanc["id_class"],
                        'status' => 'ati'
                    ]);
                }
            } else {
                DB::rollBack();
                return ['status' => StatusHttp::ERROR, 'message' => 'Não foi possivel adicionar multiplos lançamentos, por favor, reveja os dados passados e tente novamente.'];
            }

            DB::commit();
            return ['status' => StatusHttp::SUCCESS, 'message' => 'Lançamentoa(s) criado(s) com sucesso!'];

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

    public function update($record) 
    {
        try{ 
            DB::beginTransaction();
            $arr_insert = [
                'title' => $record["title"],
                'value' => $record["value"],
                'type' => $record["type"],
                'id_class' => $record["id_class"],
                'status' => 'ati'
            ];

            $this->model->where('id_record', '=', $record['id'])->update($arr_insert);
            DB::commit();
            return ['status' => StatusHttp::SUCCESS, 'message' => "Lançamento {$record['id']} editado com sucesso!"];

        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => StatusHttp::ERROR, 'message' => 'Ocorreu um erro interno, tente novamente ou entre em contato com o administrador.'];
        }
    }

    public function delete($id_record)
    {
        try {
            $this->model->where('id_record', '=', $id_record)->delete();
            return ['status' => StatusHttp::SUCCESS, 'message' => 'Lançamento deletado com sucesso!'];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => StatusHttp::ERROR, 'message' => 'Ocorreu um erro interno, tente novamente ou entre em contato com o administrador.'];
        } 
    }
}
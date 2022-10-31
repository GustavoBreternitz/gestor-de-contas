<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\Api\RecordCreateRequest;
use Illuminate\Routing\Controller as BaseController;
use App\Services\RecordsService;

class RecordController extends BaseController
{
    public function __construct(RecordsService $recordsService)
    {
        $this->recordService = $recordsService;
    }

    public function create(RecordCreateRequest $request) 
    {
        $record = $this->recordService->create($request->all());
        return response()->json(['message' => $record['message']], $record['status']);
    }

    public function list(Request $request) 
    {
        $records = $this->recordService->listAll();
        if(isset($records['itens'])) {
            return response()->json([$records['itens']], $records['status']);
        }
        return response()->json(['message' => $records['message']], $records['status']);
    }
}

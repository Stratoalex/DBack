<?php
namespace App\Repository;

use App\Models\Finance;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response; 

class FinanceRepository
{
    public function createFinance($data)
    {
        try {
            $finance = new Finance();
            $savedFinance = $this->addData($data, $finance);
            return response()->json(['message' => 'Se ha guardado correctamente la data', 'data' => $savedFinance], Response::HTTP_OK);
        } catch (\Exception $e) {
            Log::error([
                'ERROR' => $e->getMessage(),
                'Line' => $e->getLine(),
                'File' => $e->getFile(),
                'Process' => 'createFinance'
            ]);
            return response()->json(['error' => 'Error al guardar la data'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function listFinances()
    {
        try {
            $finances = Finance::get();
            return response()->json(['message' => 'Finances', 'data' => $finances], Response::HTTP_OK);
        } catch (\Exception $e) {
            Log::error([
                'ERROR' => $e->getMessage(),
                'Line' => $e->getLine(),
                'File' => $e->getFile(),
                'Process' => 'listFinances'
            ]);
            return response()->json(['error' => 'Error al enlistar la data'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function editFinance($id, $data)
    {
        try {
            $finance = Finance::find($id);
            
            if (!$finance) {
                return response()->json(['error' => 'Finance not found'], Response::HTTP_NOT_FOUND);
            }

            $updatedFinance = $this->updateData($data, $finance);
            return response()->json(['message' => 'Data actualizada', 'data' => $updatedFinance], Response::HTTP_OK);
        } catch (\Exception $e) {
            Log::error([
                'ERROR' => $e->getMessage(),
                'Line' => $e->getLine(),
                'File' => $e->getFile(),
                'Process' => 'editFinance'
            ]);
            return response()->json(['error' => 'Error al actualizar la data'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    protected function updateData($data, Finance $finance)
    {
        $finance->update([
            'date' => $data['date'],
            'income' => $data['income'],
            'expense' => $data['expense'],
            'profit' => $data['profit'],
        ]);

        return $finance;
    }

    protected function addData($data, Finance $finance)
    {
        $finance->date = $data->date;
        $finance->income = $data->income;
        $finance->expense = $data->expense;
        $finance->profit = $data->profit;

        $finance->save();
        return $finance;
    }


}


<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repository\FinanceRepository;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    protected $repo;

    public function __construct()
    {
        $this->repo = new FinanceRepository();
    }

    public function createFinance(Request $request)
    {
        return $this->repo->createFinance($request);
    }

    public function listFinances(Request $request)
    {
        return $this->repo->listFinances($request);
    }

    public function editFinance(Request $request)
    {
        return $this->repo->editFinance($request->id, $request->all());
    }

    public function deleteFinance(Request $request)
    {
        return $this->repo->deleteFinance($request->id);
    }
}

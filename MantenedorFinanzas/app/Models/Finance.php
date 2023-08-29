<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'income', 'expense', 'profit'];

    // Definir acceso a los atributos formateados
    public function getFormattedIncomeAttribute()
    {
        return number_format($this->attributes['income'], 2, '.', ',');
    }

    public function getFormattedExpenseAttribute()
    {
        return number_format($this->attributes['expense'], 2, '.', ',');
    }

    public function getFormattedProfitAttribute()
    {
        return number_format($this->attributes['profit'], 2, '.', ',');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\support\Facades\DB; 

class Companies extends Model
{
    use HasFactory;

    public function getCompany() {

        $companies = DB::table('companies') -> get();

        return $companies;
    }
}

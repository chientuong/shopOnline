<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class BillDetails extends Model
{
    protected $table = 'bill_details';
    protected $primaryKey=['bill_id','product_id'];
    public $timestamps = false;
    public $incrementing = false;

    // protected function setKeysForSaveQuery(Builder $query)
    // {
    //     return $query->where('qsymbol', $this->getAttribute('qsymbol'))
    //                  ->where('id_user', $this->getAttribute('id_user'));
    // }
}

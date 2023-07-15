<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use eloquentFilter\QueryFilter\ModelFilters\Filterable as Filterable;

class TransUsulan extends Model
{
    use Filterable;

    private static $whiteListFilter =['*'];

    /**
     * guarded
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * satuan
     *
     * @return void
     */
    public function satuans()
    {
        return $this->belongsTo(Satuan::class);
    }

     /**
     * jenis kenaikan
     *
     * @return void
     */

     public function jenisKenaikan()
     {
         return $this->belongsTo(JenisKenaikan::class);
     }

    /**
     * satuan
     *
     * @return void
     */
    public function fileUsulan()
    {
        return $this->hasMany(FileUsulan::class);
    }

    /**
     * jenis kenaikan
     *
     * @return void
     */

     public function fileUsulanDetail()
     {
         return $this->hasOne(FileUsulanDetail::class);
     }
}

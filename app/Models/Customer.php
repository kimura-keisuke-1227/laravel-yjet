<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
        /** @use HasFactory<\Database\Factories\ProjectFactory> */
        use HasFactory;

        const TABLE_NAME_OF_CUSTOMER = 'customer';

        const CLM_NAME_OF_ID = 'id';
        const CLM_NAME_OF_CUSTOMER_ID  = 'customer_id';
        const CLM_NAME_OF_CUSTOMER_NAME  = 'customer_name';
        const CLM_NAME_OF_CUSTOMER_OFFICIAL_NAME  = 'customer_official_name';
        const CLM_NAME_OF_TRANSFER_MONTH  = 'bTRANSFER_MONT';
        const CLM_NAME_OF_TRANSFER_DAY  = 'bTRANSFER_DAY';


        protected $fillable = [
            self::CLM_NAME_OF_CUSTOMER_ID,
            self::CLM_NAME_OF_CUSTOMER_NAME,
            self::CLM_NAME_OF_CUSTOMER_OFFICIAL_NAME,
            self::CLM_NAME_OF_TRANSFER_MONTH,
            self::CLM_NAME_OF_TRANSFER_DAY,
        ];

        public function tasks()
        {
            return $this->hasMany('App\Models\Task');
        }
}

<?php

namespace App\Models;

use CodeIgniter\Model;


class MerchantCustomerModel extends Model
{

    protected $table      = 'merchant_customer';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    //protected $useSoftDeletes = true;

    protected $allowedFields = ['customer_id', 'merchant_user_id'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    //protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getMerchantCustomer()
    {
        return $this->findAll();
    }
}

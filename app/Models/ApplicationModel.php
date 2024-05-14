<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface as DatabaseConnectionInterface;
use CodeIgniter\Model;


class ApplicationModel extends Model
{

    protected $table      = 'application';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    //protected $useSoftDeletes = true;

    protected $allowedFields = ['appId', 'pendingPaymentSiteUrl', 'refnum','dba_name'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    //protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getApplication()
    {
        return $this->findAll();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface as DatabaseConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;
use \CodeIgniter\Model\Concerns\Timestamps;


class WebhookModel extends Model
{

    protected $table      = 'webhook';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    //protected $useSoftDeletes = true;

    protected $allowedFields = ['response'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    //protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    // Callbacks 
   protected $allowCallbacks = true; 
   protected $beforeInsert = []; 
   protected $afterInsert = []; 
   protected $beforeUpdate = []; 
   protected $afterUpdate = []; 
   protected $beforeFind = []; 
   protected $afterFind = []; 
   protected $beforeDelete = []; 
   protected $afterDelete = []; 

    public function getLeads()
    {
        return $this->findAll();
    }
}

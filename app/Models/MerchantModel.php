<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface as DatabaseConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;


class MerchantModel extends Model
{

    protected $table      = 'mechants';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    //protected $useSoftDeletes = true;

    protected $allowedFields = ['firstname', 'lastname', 'title', 'dba', 'phone_number', 'email', 'corporate_name', 'website', 'street_address', 'city', 'state', 'zip', 'country', 'fax', 'add_contact_name', 'add_contact_title', 'add_contact_phonenumber', 'status', 'token', 'created_datetime','mpa_form_email','appId','pendingPaymentSiteUrl','key','userId','signature_token','ApplicationStatus','ProcessorMid','TierName','GatewayDeployed','FundingHold','CardknoxMid','CardknoxKey','DbaName','CorporationName','NotificationType'];

    protected $useTimestamps = false;
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

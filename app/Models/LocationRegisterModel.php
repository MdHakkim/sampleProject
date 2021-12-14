<?php

namespace App\Models;
use CodeIgniter\Model;

class LocationRegisterModel extends Model{
    protected $table = 'tbl_location_register';
    // protected $primaryKey = 'register_id';
    // protected $useAutoIncrement     = true;
    protected $allowedFields = ['register_id','location_title', 'location_description', 'room_no', 'contract_id', 'site_id', 'building_id', 'floor_id','zone_id','register_status','created_by','updated_by','created_date','updated_date','loc_type'];

}

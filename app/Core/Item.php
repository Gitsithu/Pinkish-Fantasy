<?php

namespace App\Core;

use App\Core\Config\ConfigRepository;
use Validator;
use Auth;
use DB;
use App\Http\Requests;
use App\Session;
use App\Core\User\UserRepository;
use App\Core\SyncsTable\SyncsTable;
use Image;
use App\Log\LogCustom;
use Mail;
use App\Setup\CoreSettings\CoreSettings;

class Item
{
    public static function getSpecsByConditions($conditions)
    {

        // getting data by php array format
        // $query = "SELECT
        //     gyt.*
        // FROM
        //     soccer_group_year_team AS gyt
        // WHERE gyt.group_year_id = ". $group_year_id;
        // $raw_data = DB::Select("$query");
            
        $query = "SELECT id,size,color FROM items_specification";
        if (isset($conditions) && count($conditions)>0) {
            $query .= " WHERE ";
            foreach ($conditions as $column => $value) {
                $query .= "items_specification.".$column ."=". $value . " ";

            }
        }
        $result_array = DB::Select("$query");
        
        
        
        
    
        return $result_array;
    }


}
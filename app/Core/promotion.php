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
use App\Setup\Item\Item;
use App\Setup\CoreSettings\CoreSettings;

class promotion
{
    public static function getProductsByConditions($conditions)
    {

        // getting data by php array format
        // $query = "SELECT
        //     gyt.*
        // FROM
        //     soccer_group_year_team AS gyt
        // WHERE gyt.group_year_id = ". $group_year_id;
        // $raw_data = DB::Select("$query");
            
        
        if (isset($conditions)) {
            // foreach ($conditions as $column => $value) {
            if($conditions == 2){
            $query = "SELECT id,name from categories where deleted_at is null";
            }
            elseif($conditions == 3){
            $query = "SELECT id,item_code as name from items where deleted_at is null";
            }
            elseif($conditions == 4){
                $query = "SELECT id,name from brands where deleted_at is null";
            }
            else{
                $query = "SELECT * FROM categories WHERE id = 0";
            }
            // }
        }
       
        $result_array = DB::Select("$query");
        
       
        return $result_array;
    }





}
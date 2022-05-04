<?php

use Illuminate\Database\Seeder;

class Default_002_Cities_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $existing_objs = DB::select('SELECT id FROM cities');
        $today = date('Y-m-d H:i:s');

        $objs = array(
            [ 'name'=>'Ayeyarwady',  'id' =>'1','created_by' =>'1', 'updated_by' =>'1','created_by'=>1,'created_at'=>$today],
            [ 'name'=>'Bago',  'id' =>'2', 'created_by' =>'1', 'updated_by' =>'1','created_by'=>1,'created_at'=>$today],
            [ 'name'=>'Chin',  'id' =>'3', 'created_by' =>'1', 'updated_by' =>'1','created_by'=>1,'created_at'=>$today],
            [ 'name'=>'Kachin',  'id' =>'4', 'created_by' =>'1', 'updated_by' =>'1','created_by'=>1,'created_at'=>$today],
            [ 'name'=>'Kayah',  'id' =>'5', 'created_by' =>'1', 'updated_by' =>'1','created_by'=>1,'created_at'=>$today],
            [ 'name'=>'Kayin',  'id' =>'6', 'created_by' =>'1', 'updated_by' =>'1','created_by'=>1,'created_at'=>$today],
            [ 'name'=>'Magway',  'id' =>'7',  'created_by' =>'1', 'updated_by' =>'1','created_by'=>1,'created_at'=>$today],
            [ 'name'=>'Mandalay',  'id' =>'8',  'created_by' =>'1', 'updated_by' =>'1','created_by'=>1,'created_at'=>$today],
            [ 'name'=>'Mon', 'id' =>'9',  'created_by' =>'1', 'updated_by' =>'1','created_by'=>1,'created_at'=>$today],
            [ 'name'=>'Rakhine', 'id' =>'10',  'created_by' =>'1', 'updated_by' =>'1','created_by'=>1,'created_at'=>$today],
            [ 'name'=>'Sagaing',  'id' =>'11',  'created_by' =>'1', 'updated_by' =>'1','created_by'=>1,'created_at'=>$today],
            [ 'name'=>'Shan',  'id' =>'12',  'created_by' =>'1', 'updated_by' =>'1','created_by'=>1,'created_at'=>$today],
            [ 'name'=>'Tanintharyi', 'id' =>'13',  'created_by' =>'1', 'updated_by' =>'1','created_by'=>1,'created_at'=>$today],
            [ 'name'=>'Yangon', 'id' =>'14',  'created_by' =>'1', 'updated_by' =>'1','created_by'=>1,'created_at'=>$today],
            [ 'name'=>'Naypyidaw', 'id' =>'15',  'created_by' =>'1', 'updated_by' =>'1','created_by'=>1,'created_at'=>$today],
        );
        if (isset($existing_objs) && count($existing_objs) > 0) {
            $new_objs = array();

            foreach ($objs as $default_obj) {
                $existFlag = 0;
                foreach ($existing_objs as $exist_obj) {
                    if ($default_obj['id'] == $exist_obj->id) {
                        $existFlag++;
                        break;
                    }
                }
                if ($existFlag == 0) {
                    array_push($new_objs, $default_obj);
                }
            }

            if (count($new_objs) > 0) {
                DB::table('cities')->insert($new_objs);
            }
        } else {
            DB::table('cities')->insert($objs);
        }

        echo "\n";
        echo "*****************************************************";
        echo "\n";
        echo "** Finished Running Default Cities Seeder **";
        echo "\n";
        echo "*****************************************************";
        echo "\n";
    }
}

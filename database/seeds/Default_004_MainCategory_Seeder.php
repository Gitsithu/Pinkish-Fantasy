<?php

use Illuminate\Database\Seeder;

class Default_004_MainCategory_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $existingObjs = DB::select('SELECT id FROM main_categories');

        $today = date('Y-m-d H:i:s');
        $objs = array(

            ['id'=>'1', 'name'=>'Clothing','status'=>'1','created_by'=>'2','created_at'=>$today],
            ['id'=>'2', 'name'=>'Accessories','status'=>'1','created_by'=>'2','created_at'=>$today],



        );


        if (isset($existingObjs) && count($existingObjs) > 0) {
            $newObjs = array();

            foreach ($objs as $defaultObj) {
                $existFlag = 0;
                foreach ($existingObjs as $existPermission) {
                    if ($defaultObj['id'] == $existPermission->id) {
                        $existFlag++;
                        break;
                    }
                }
                if ($existFlag == 0) {
                    array_push($newObjs, $defaultObj);
                }
            }

            if (count($newObjs) > 0) {
                DB::table('main_categories')->insert($newObjs);
            }
        } else {
            DB::table('main_categories')->insert($objs);
        }

        echo "\n";
        echo "*****************************************************";
        echo "\n";
        echo "** Finished Running Default Main Category Seeder **";
        echo "\n";
        echo "*****************************************************";
        echo "\n";
    }
}


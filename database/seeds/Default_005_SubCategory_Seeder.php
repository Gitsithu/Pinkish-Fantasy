<?php

use Illuminate\Database\Seeder;

class Default_005_SubCategory_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $existingObjs = DB::select('SELECT id FROM sub_categories');

        $today = date('Y-m-d H:i:s');
        $objs = array(

            ['id'=>'1', 'name'=>'Outer','main_categories_id'=>'1','status'=>'1','created_by'=>'2','created_at'=>$today],
            ['id'=>'2', 'name'=>'Tops','main_categories_id'=>'1','status'=>'1','created_by'=>'2','created_at'=>$today],
            ['id'=>'3', 'name'=>'Dress','main_categories_id'=>'1','status'=>'1','created_by'=>'2','created_at'=>$today],
            ['id'=>'4', 'name'=>'Pants','main_categories_id'=>'1','status'=>'1','created_by'=>'2','created_at'=>$today],
            ['id'=>'5', 'name'=>'Skirt','main_categories_id'=>'1','status'=>'1','created_by'=>'2','created_at'=>$today],
            ['id'=>'6', 'name'=>'Bag','main_categories_id'=>'2','status'=>'1','created_by'=>'2','created_at'=>$today],
            ['id'=>'7', 'name'=>'Shoes','main_categories_id'=>'2','status'=>'1','created_by'=>'2','created_at'=>$today],
            ['id'=>'8', 'name'=>'Lingerie','main_categories_id'=>'1','status'=>'1','created_by'=>'2','created_at'=>$today],
            ['id'=>'9', 'name'=>'Accessories','main_categories_id'=>'2','status'=>'1','created_by'=>'2','created_at'=>$today],

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
                DB::table('sub_categories')->insert($newObjs);
            }
        } else {
            DB::table('sub_categories')->insert($objs);
        }

        echo "\n";
        echo "*****************************************************";
        echo "\n";
        echo "** Finished Running Default Sub Category Seeder **";
        echo "\n";
        echo "*****************************************************";
        echo "\n";
    }
}


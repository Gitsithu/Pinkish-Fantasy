<?php

use Illuminate\Database\Seeder;

class Default_0011_serviceconfig_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $existingObjs = DB::select('SELECT id FROM service_config');

        $today = date('Y-m-d H:i:s');
        $objs = array(

            ['id'=>'1', 'type'=>'service_1', 'title'=>'Shipping Cost', 'description'=>'Costs differ on ByShip and ByPlane', 'status'=>'1', 'created_at'=>$today],
            ['id'=>'2', 'type'=>'service_2', 'title'=>'Money Back Guarantee', 'description'=>'If goods have Problems', 'status'=>'1', 'created_at'=>$today],
            ['id'=>'3', 'type'=>'service_3', 'title'=>'Online Support 24/7', 'description'=>'Dedicated Support', 'status'=>'1', 'created_at'=>$today],
            ['id'=>'4', 'type'=>'service_4', 'title'=>'Physical Bank Transfer', 'description'=>'Transfer before order or COD', 'status'=>'1', 'created_at'=>$today],
            ['id'=>'5', 'type'=>'footer_slider_1', 'title'=>'Heading-1', 'description'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus corrupti eaque, sed natus voluptate rerum? Minima nemo dolore modi officia recusandae.', 'status'=>'1', 'created_at'=>$today],
            ['id'=>'6', 'type'=>'footer_slider_2', 'title'=>'Heading-2', 'description'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus corrupti eaque, sed natus voluptate rerum? Minima nemo dolore modi officia recusandae.', 'status'=>'1', 'created_at'=>$today],
            ['id'=>'7', 'type'=>'footer_slider_3', 'title'=>'Heading-3', 'description'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus corrupti eaque, sed natus voluptate rerum? Minima nemo dolore modi officia recusandae.', 'status'=>'1', 'created_at'=>$today],
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
                DB::table('service_config')->insert($newObjs);
            }
        } else {
            DB::table('service_config')->insert($objs);
        }

        echo "\n";
        echo "*****************************************************";
        echo "\n";
        echo "** Finished Running Default Service Config Seeder **";
        echo "\n";
        echo "*****************************************************";
        echo "\n";
    }
}

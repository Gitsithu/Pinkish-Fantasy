<?php

use Illuminate\Database\Seeder;

class Default_0013_contactus_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $existingObjs = DB::select('SELECT id FROM contact_us');

        $today = date('Y-m-d H:i:s');
        $objs = array(

            ['id'=>'1', 'address'=>'160 Pennsylvania Ave NW, Washington, Castle, PA 16101-5161', 'phone'=>'09-191-199-119 | 09-123-456-789', 'email'=>'pinkishfatasty@gmail.com', 'created_at'=>$today]
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
                DB::table('contact_us')->insert($newObjs);
            }
        } else {
            DB::table('contact_us')->insert($objs);
        }

        echo "\n";
        echo "*****************************************************";
        echo "\n";
        echo "** Finished Running Default Contact Us Seeder **";
        echo "\n";
        echo "*****************************************************";
        echo "\n";
    }
}

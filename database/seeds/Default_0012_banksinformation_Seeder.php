<?php

use Illuminate\Database\Seeder;

class Default_0012_banksinformation_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $existingObjs = DB::select('SELECT id FROM banks_info');

        $today = date('Y-m-d H:i:s');
        $objs = array(

            ['id'=>'1', 'bank'=>'AGD', 'account_name'=>'', 'account_no'=>'', 'status'=>'0', 'created_at'=>$today],
            ['id'=>'2', 'bank'=>'AYA', 'account_name'=>'', 'account_no'=>'', 'status'=>'0', 'created_at'=>$today],
            ['id'=>'3', 'bank'=>'CB', 'account_name'=>'', 'account_no'=>'', 'status'=>'0', 'created_at'=>$today],
            ['id'=>'4', 'bank'=>'KBZ', 'account_name'=>'', 'account_no'=>'', 'status'=>'0', 'created_at'=>$today],
            ['id'=>'5', 'bank'=>'MAB', 'account_name'=>'', 'account_no'=>'', 'status'=>'0', 'created_at'=>$today],
            ['id'=>'6', 'bank'=>'YOMA', 'account_name'=>'', 'account_no'=>'', 'status'=>'0', 'created_at'=>$today],
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
                DB::table('banks_info')->insert($newObjs);
            }
        } else {
            DB::table('banks_info')->insert($objs);
        }

        echo "\n";
        echo "*****************************************************";
        echo "\n";
        echo "** Finished Running Default Banks Information Seeder **";
        echo "\n";
        echo "*****************************************************";
        echo "\n";
    }
}

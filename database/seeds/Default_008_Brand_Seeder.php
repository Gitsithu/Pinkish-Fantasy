<?php

use Illuminate\Database\Seeder;

class Default_008_Brand_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            //
            $existingObjs = DB::select('SELECT id FROM brands');

            $today = date('Y-m-d H:i:s');
            $objs = array(

                ['id'=>'0', 'name'=>'No Brand','status'=>'1','created_at'=>$today],



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
                    DB::table('brands')->insert($newObjs);
                }
            } else {
                DB::table('brands')->insert($objs);
            }

            echo "\n";
            echo "*****************************************************";
            echo "\n";
            echo "** Finished Running Default Brand Seeder **";
            echo "\n";
            echo "*****************************************************";
            echo "\n";
        }
    }


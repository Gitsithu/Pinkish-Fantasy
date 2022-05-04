<?php

use Illuminate\Database\Seeder;

class Default_001_Users_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
        public function run()
    {
        //
        $existingObjs = DB::select('SELECT id FROM users');

        $today = date('Y-m-d H:i:s');
        $objs = array(

            // default password is 'aaaaaaaa'
            // superadmin pass is Possys@321
            ['id'=>'1', 'name'=>'SUPER ADMIN','email' =>'superadmin@gmail.com', 'password' =>'$2y$10$g2qQ1E9uVLofv7/wWb2QLujGJz4FZWLLpRFxVWCPjDDWB.Q9i7Nzi','role_id' => '1','phone' => '09','address' =>'home','status'=>'1','created_at'=>$today],
            ['id'=>'2', 'name'=>'PF ADMINISTRATOR','email' =>'administrator@gmail.com', 'password' =>'$2y$10$KDarx27N4/WgKdW5TOspmOXdpxFQe8OJaeDPq1V0XSsXodrWBgB02','role_id' => '2','phone' => '09','address' =>'home','status'=>'1','created_at'=>$today],
            ['id'=>'3', 'name'=>'PF ADMIN','email' =>'admin@gmail.com', 'password' =>'$2y$10$KDarx27N4/WgKdW5TOspmOXdpxFQe8OJaeDPq1V0XSsXodrWBgB02','role_id' => '3','phone' => '09','address' =>'home','status'=>'1','created_at'=>$today],
            ['id'=>'4', 'name'=>'PF USER','email' =>'user@gmail.com', 'password' =>'$2y$10$KDarx27N4/WgKdW5TOspmOXdpxFQe8OJaeDPq1V0XSsXodrWBgB02','role_id' => '4','phone' => '09','address' =>'home','status'=>'1','created_at'=>$today],



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
                DB::table('users')->insert($newObjs);
            }
        } else {
            DB::table('users')->insert($objs);
        }

        echo "\n";
        echo "*****************************************************";
        echo "\n";
        echo "** Finished Running Default User Seeder **";
        echo "\n";
        echo "*****************************************************";
        echo "\n";
    }
}



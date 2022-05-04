<?php

use Illuminate\Database\Seeder;

class Default_0010_uiconfig_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //
         $existingObjs = DB::select('SELECT id FROM ui_config');

         $today = date('Y-m-d H:i:s');
         $objs = array(

             ['id'=>'1', 'indexname'=>'Slider1','img_url'=>'','status'=>'0','created_at'=>$today],
             ['id'=>'2', 'indexname'=>'Slider2','img_url'=>'','status'=>'0','created_at'=>$today],
             ['id'=>'3', 'indexname'=>'Slider3','img_url'=>'','status'=>'0','created_at'=>$today],
             ['id'=>'4', 'indexname'=>'Slider4','img_url'=>'','status'=>'0','created_at'=>$today],
             ['id'=>'5', 'indexname'=>'Slider5','img_url'=>'','status'=>'0','created_at'=>$today],
             ['id'=>'6', 'indexname'=>'Slider6','img_url'=>'','status'=>'0','created_at'=>$today],
             ['id'=>'7', 'indexname'=>'Slider7','img_url'=>'','status'=>'0','created_at'=>$today],
             ['id'=>'8', 'indexname'=>'Slider8','img_url'=>'','status'=>'0','created_at'=>$today],
             ['id'=>'9', 'indexname'=>'Insta1','img_url'=>'','status'=>'0','created_at'=>$today],
             ['id'=>'10', 'indexname'=>'Insta2','img_url'=>'','status'=>'0','created_at'=>$today],
             ['id'=>'11', 'indexname'=>'Insta3','img_url'=>'','status'=>'0','created_at'=>$today],
             ['id'=>'12', 'indexname'=>'Insta4','img_url'=>'','status'=>'0','created_at'=>$today],
             ['id'=>'13', 'indexname'=>'Insta5','img_url'=>'','status'=>'0','created_at'=>$today],
             ['id'=>'14', 'indexname'=>'Insta6','img_url'=>'','status'=>'0','created_at'=>$today],
             ['id'=>'15', 'indexname'=>'Career1','img_url'=>'','status'=>'0','created_at'=>$today],
             ['id'=>'16', 'indexname'=>'Career2','img_url'=>'','status'=>'0','created_at'=>$today],
             ['id'=>'17', 'indexname'=>'Career3','img_url'=>'','status'=>'0','created_at'=>$today],
             ['id'=>'18', 'indexname'=>'Career4','img_url'=>'','status'=>'0','created_at'=>$today],
             ['id'=>'19', 'indexname'=>'Career5','img_url'=>'','status'=>'0','created_at'=>$today],
             ['id'=>'20', 'indexname'=>'Logo','img_url'=>'/customerSite/img/Logo.jpg','status'=>'1','created_at'=>$today],




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
                 DB::table('ui_config')->insert($newObjs);
             }
         } else {
             DB::table('ui_config')->insert($objs);
         }

         echo "\n";
         echo "*****************************************************";
         echo "\n";
         echo "** Finished Running Default Ui Config Seeder **";
         echo "\n";
         echo "*****************************************************";
         echo "\n";
     }
 }

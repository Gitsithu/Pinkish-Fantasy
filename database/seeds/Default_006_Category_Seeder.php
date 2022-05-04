<?php

use Illuminate\Database\Seeder;

class Default_006_Category_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $existingObjs = DB::select('SELECT id FROM categories');

        $today = date('Y-m-d H:i:s');
        $objs = array(

            //Outer
            ['id'=>'1', 'name'=>'Coat','sub_categories_id'=>'1','status'=>'1','created_by'=>'2','created_at'=>$today],
            ['id'=>'2', 'name'=>'Jacket','sub_categories_id'=>'1','status'=>'1','created_by'=>'2','created_at'=>$today],
            ['id'=>'3', 'name'=>'Cardigan','sub_categories_id'=>'1','status'=>'1','created_by'=>'2','created_at'=>$today],
            ['id'=>'4', 'name'=>'Vest','sub_categories_id'=>'1','status'=>'1','created_by'=>'2','created_at'=>$today],

            //Tops
            ['id'=>'5', 'name'=>'Sleeveless','sub_categories_id'=>'2','status'=>'1','created_by'=>'2','created_at'=>$today],
            ['id'=>'6', 'name'=>'Hoodie','sub_categories_id'=>'2','status'=>'1','created_by'=>'2','created_at'=>$today],
            ['id'=>'7', 'name'=>'Pullover','sub_categories_id'=>'2','status'=>'1','created_by'=>'2','created_at'=>$today],
            ['id'=>'8', 'name'=>'Shirt','sub_categories_id'=>'2','status'=>'1','created_by'=>'2','created_at'=>$today],
            ['id'=>'9', 'name'=>'Blouse','sub_categories_id'=>'2','status'=>'1','created_by'=>'2','created_at'=>$today],
            ['id'=>'10', 'name'=>'Tee','sub_categories_id'=>'2','status'=>'1','created_by'=>'2','created_at'=>$today],
            ['id'=>'11', 'name'=>'Vest','sub_categories_id'=>'2','status'=>'1','created_by'=>'2','created_at'=>$today],
            ['id'=>'12', 'name'=>'Knit','sub_categories_id'=>'2','status'=>'1','created_by'=>'2','created_at'=>$today],

            //Dress
            ['id'=>'13', 'name'=>'Dress','sub_categories_id'=>'3','status'=>'1','created_by'=>'2','created_at'=>$today],
           
            //Pants
            ['id'=>'14', 'name'=>'Legging','sub_categories_id'=>'4','status'=>'1','created_by'=>'2','created_at'=>$today],
            ['id'=>'15', 'name'=>'Pants','sub_categories_id'=>'4','status'=>'1','created_by'=>'2','created_at'=>$today],
            ['id'=>'16', 'name'=>'Jean','sub_categories_id'=>'4','status'=>'1','created_by'=>'2','created_at'=>$today],
            ['id'=>'17', 'name'=>'Sweat Pant','sub_categories_id'=>'4','status'=>'1','created_by'=>'2','created_at'=>$today],
            ['id'=>'18', 'name'=>'Short','sub_categories_id'=>'4','status'=>'1','created_by'=>'2','created_at'=>$today],

            //Skirt
            ['id'=>'19', 'name'=>'Skirt','sub_categories_id'=>'5','status'=>'1','created_by'=>'2','created_at'=>$today],
            
            //Bag
            ['id'=>'20', 'name'=>'Bag','sub_categories_id'=>'6','status'=>'1','created_by'=>'2','created_at'=>$today],
            ['id'=>'21', 'name'=>'Shoulder Bag','sub_categories_id'=>'6','status'=>'1','created_by'=>'2','created_at'=>$today],
            
            //Shoe
            ['id'=>'22', 'name'=>'Shoes','sub_categories_id'=>'7','status'=>'1','created_by'=>'2','created_at'=>$today],

            //Lingerie
            ['id'=>'23', 'name'=>'Bra Top','sub_categories_id'=>'8','status'=>'1','created_by'=>'2','created_at'=>$today],
            ['id'=>'24', 'name'=>'Panties','sub_categories_id'=>'8','status'=>'1','created_by'=>'2','created_at'=>$today],

            //Accessories
            ['id'=>'25', 'name'=>'Belt','sub_categories_id'=>'9','status'=>'1','created_by'=>'2','created_at'=>$today],
            ['id'=>'26', 'name'=>'Accessories','sub_categories_id'=>'9','status'=>'1','created_by'=>'2','created_at'=>$today],
            ['id'=>'27', 'name'=>'Hair','sub_categories_id'=>'9','status'=>'1','created_by'=>'2','created_at'=>$today],
            ['id'=>'28', 'name'=>'Hat','sub_categories_id'=>'9','status'=>'1','created_by'=>'2','created_at'=>$today],
            ['id'=>'29', 'name'=>'Socks','sub_categories_id'=>'9','status'=>'1','created_by'=>'2','created_at'=>$today],


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
                DB::table('categories')->insert($newObjs);
            }
        } else {
            DB::table('categories')->insert($objs);
        }

        echo "\n";
        echo "*****************************************************";
        echo "\n";
        echo "** Finished Running Default Category Seeder **";
        echo "\n";
        echo "*****************************************************";
        echo "\n";
    }
}

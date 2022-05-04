<?php

use Illuminate\Database\Seeder;

class Default_0014_aboutus_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $existingObjs = DB::select('SELECT id FROM about_us');

        $today = date('Y-m-d H:i:s');
        $objs = array(

            ['id'=>'1', 'image'=>'/customerSite/img/about_us.jpg', 'title'=>'What is Pinkish Fantasy?', 'author'=>'Pinkish Fantasy', 'paragraph1'=>'Afashion season can be defined as much by the people on the catwalk as it can by the clothes they are wearing. This time around, a key moment came at the end of Marc Jacobs’ New York show, when an almost makeup-free Christy Turlington made a rare return to the catwalk, aged 50 (she also stars, with the designer himself, in the label’s AW ad campaign), where the average catwalk model is around 18.', 'paragraph2'=>'A few days later, Simone Rocha arguably upped the ante. The 32-year-old’s show – in part inspired by Louise Bourgeois, who lived until she was 98 – featured models in their 30s and 40s, including cult favourite Jeny Howorth and actor Chloë Sevigny.', 'created_at'=>$today]
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
                DB::table('about_us')->insert($newObjs);
            }
        } else {
            DB::table('about_us')->insert($objs);
        }

        echo "\n";
        echo "*****************************************************";
        echo "\n";
        echo "** Finished Running Default About Us Seeder **";
        echo "\n";
        echo "*****************************************************";
        echo "\n";
    }
}

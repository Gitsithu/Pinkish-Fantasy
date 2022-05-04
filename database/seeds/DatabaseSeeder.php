<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Default_001_Users_Seeder::class);
        $this->call(Default_002_Cities_Seeder::class);
        $this->call(Default_003_Townships_Seeder::class);
        $this->call(Default_004_MainCategory_Seeder::class);
        $this->call(Default_005_SubCategory_Seeder::class);
        $this->call(Default_006_Category_Seeder::class);
        $this->call(Default_008_Brand_Seeder::class);
        $this->call(Default_0010_uiconfig_Seeder::class);
        $this->call(Default_0011_serviceconfig_Seeder::class);
        $this->call(Default_0012_banksinformation_Seeder::class);
        $this->call(Default_0013_contactus_Seeder::class);
        $this->call(Default_0014_aboutus_Seeder::class);






    }
}

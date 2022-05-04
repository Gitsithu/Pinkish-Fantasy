<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class sub_category extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at']; 
    
    protected $table = 'sub_categories';
    protected $fillable = ['id','name','main_categories_id','status'];

    public static function MainCategoriesBasedSubCategories() {
        return DB::table('sub_categories')
            ->select('sub_categories.id','sub_categories.name')
            ->where('sub_categories.status','1');
    }

    public static function BrandBasedSubCategories() {
        return DB::table('sub_categories')
            ->select('sub_categories.id','sub_categories.name')
            ->distinct('sub_categories.id','sub_categories.name')
            ->leftJoin('categories','categories.sub_categories_id','sub_categories.id')
            ->leftJoin('items','items.categories_id','categories.id')
            ->where('sub_categories.status','1')
            ->orderBy('sub_categories.id','asc');
    }
}
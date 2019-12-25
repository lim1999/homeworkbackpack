<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    use CrudTrait;
    use SoftDeletes;
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'products';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
    protected $fillable = ['name','rent_price','list_price','sold_price','sale_price'];
    // protected $hidden = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function categories(){
        return $this->belongsTo(\App\Models\Category::class,'category_id');
    }
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */
    public function getCodeAttribute(){
        return '0000'.$this->id;
    }
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    public function setImageAttribute($value)
        {
            $attribute_name = "image";
            $disk = "uploads";
            $destination_path = "/printshop-types";
    
            // if the image was erased
            if ($value==null) {
                // delete the image from disk
                \Storage::disk($disk)->delete($this->image);
    
                // set null in the database column
                $this->attributes[$attribute_name] = null;
            }
    
            // if a base64 was sent, store it in the db
            if (starts_with($value, 'data:image'))
            {
                // 0. Make the image
                $image = \Image::make($value);
                // 1. Generate a filename.
                $filename = md5($value.time()).'.jpg';
                // 2. Store the image on disk.
                \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());
                // 3. Save the path to the database
                $this->attributes[$attribute_name] = $destination_path.'/'.$filename;
            }
        }
}

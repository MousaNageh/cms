<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class posts extends Model
{
    use SoftDeletes ;
    protected $dates=[
        "published_at" 
    ] ; 
    protected $fillable = ["title","description","content","image","published_at","category_id","user_id"];
    /*
    * @return void
    *delete image from the server
    */
    public function deleteImage(){
        Storage::delete($this->image) ;
    }
    public function category() {
        return $this->belongsTo(Category::class) ;
    }
    public function user(){
        return $this->belongsTo(User::class) ; 
    }
    public function tags (){
        return $this->belongsToMany(tags::class) ;
    }
    public function hasTag($tagID){
        return in_array($tagID , $this->tags->pluck("id")->toArray()) ;
    }
    public function scopePublished($query){
        return $query->where("published_at","<=",now()) ; 
    }
    public function scopeSearched($query){
        $search = request()->query("search") ; 
        if(!$search){
            return $query->published() ; 
        }
        else 
        {
            return $query->published()->where("title","LIKE","%{$search}%") ; 
        }
    }
    
    
}

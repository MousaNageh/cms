<?php

use App\Category;
use App\posts;
use App\tags;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User ; 
class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {  
        $user1 = User::create([
            "name"=>"nageh moureed" , 
            "email"=>"nageh@gmail.com" , 
            "password" =>Hash::make("mousamousa1234")
        ]);
        $user2 = User::create([
            "name"=>"moustafa sayed" , 
            "email"=>"moustafa@gmail.com" , 
            "password" =>Hash::make("mousamousa1234")
        ]);
        $user3 = User::create([
            "name"=>"khaled motawa" , 
            "email"=>"khaled@gmail.com" , 
            "password" =>Hash::make("mousamousa1234")
        ]);
        $user4 = User::create([
            "name"=>"Ahemd Gamal" , 
            "email"=>"Ahemd@gmail.com" , 
            "password" =>Hash::make("mousamousa1234")
        ]);
        $category1=Category::create([
            "name"=>"News"
        ]) ;
        $post1=$user1->posts()->create([
            "title"=>"post for news 1" ,
            "description"=>"this is post for news 1" ,
            "content"=>"this is post for news 1" ,
            "category_id"=>$category1->id ,
            "image"=>"posts/1.jpg" , 
            "published_at"=>"2020-2-2 11:11:11" , 
            "user_id"=>$user1->id
        ]);
        $category2=Category::create([
            "name"=>"News 2"
        ]) ;
        $post2=posts::create([
            "title"=>"post for news 2" ,
            "description"=>"this is post for news " ,
            "content"=>"this is post for news 1" ,
            "category_id"=>$category2->id ,
            "image"=>"posts/2.jpg" ,
            "published_at"=>"2020-2-2 11:11:11", 
            "user_id"=>$user2->id
        ]);
        $category3=Category::create([
            "name"=>"News 3"
        ]) ;
        $post3=posts::create([
            "title"=>"post for news 3" ,
            "description"=>"this is post for news 1" ,
            "content"=>"this is post for news 1" ,
            "category_id"=>$category3->id , 
            "image"=>"posts/3.jpg", 
            "published_at"=>"2020-2-2 11:11:11", 
            "user_id"=>$user3->id
        ]);
        $post4=posts::create([
            "title"=>"post for news 4" ,
            "description"=>"this is post for news 1" ,
            "content"=>"this is post for news 1" ,
            "category_id"=>$category3->id , 
            "image"=>"posts/4.jpg",
            "published_at"=>"2020-2-2 11:11:11", 
            "user_id"=>$user4->id
        ]);
        $post5=posts::create([
            "title"=>"post for news 5" ,
            "description"=>"this is post for news 1" ,
            "content"=>"this is post for news 1" ,
            "category_id"=>$category2->id , 
            "image"=>"posts/5.jpg",
            "published_at"=>"2020-2-2 11:11:11", 
            "user_id"=>$user1->id
        ]);
        $post6=posts::create([
            "title"=>"post for news 5" ,
            "description"=>"this is post for news 1" ,
            "content"=>"this is post for news 1" ,
            "category_id"=>$category1->id , 
            "image"=>"posts/4.jpg",
            "published_at"=>"2020-2-2 11:11:11", 
            "user_id"=>$user2->id
        ]);
        $tag1 = tags::create([
            "name"=>"tag1"
        ]);
        $tag2 = tags::create([
            "name"=>"tag2"
        ]);
        $tag3 = tags::create([
            "name"=>"tag3"
        ]);
        $post1->tags()->attach([$tag1->id,$tag2->id]);
        $post2->tags()->attach([$tag2->id,$tag3->id]);
        $post3->tags()->attach([$tag1->id,$tag2->id]);
        $post4->tags()->attach([$tag3->id,$tag2->id]);
        $post5->tags()->attach([$tag3->id,$tag1->id]);
        $post6->tags()->attach([$tag1->id,$tag3->id]);
    }
}

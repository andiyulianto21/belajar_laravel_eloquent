<?php

namespace Tests\Feature;

use App\Models\Category;
use Database\Seeders\CategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertTrue;

class CategoryModelTest extends TestCase
{
    public function test_insert() {
        $category = new Category([
            'id' => 'GADGET',
            'name' => 'Gadget'
        ]);

        $result = $category->save();
        assertTrue($result);
    }
    
    public function test_bulk_insert() {
        $categories = [];
        for ($i=1; $i <= 10; $i++) { 
            $categories[] = [
                'id' => "CAT$i",
                'name' => "c$i",
            ];
        }
        $result = Category::insert($categories);
        
        assertTrue($result);

        $get = Category::get();
        Log::info(json_encode($get));
        assertCount(10, $get);
        assertEquals('c3', $get[3]->name);
    }

    public function test_find(){
        $this->seed(CategorySeeder::class);

        $category = Category::find('FOOD');
        assertNotNull($category);
        assertEquals('Food', $category->name);
        assertEquals('this is food', $category->description);
    }

    public function test_update() {
        $this->seed(CategorySeeder::class);

        $category = Category::find('FOOD');
        $category->name = "Food Updated";
        $result = $category->update();

        assertTrue($result);
        assertEquals('Food Updated', Category::find('FOOD')->name);
    }

    public function test_select() {
        $this->seed(CategorySeeder::class);
        $categories = [];
        for ($i=0; $i <= 9; $i++) { 
            $categories[] = [
                'id' => "CAT$i",
                'name' => "c$i",
            ];
        }
        Category::insert($categories);

        $categories = Category::where('description', '=', null)->get();
        $categoriesIsNotNull = Category::where('description', '!=', null)->get();
        Log::info(json_encode($categories));
        Log::info(json_encode($categoriesIsNotNull));
        assertCount(1, $categoriesIsNotNull);
        assertCount(10, $categories);

        //update dari variable sebelumnya
        $categories->each(function(Category $category){
            $category->description = 'Updated';
            $category->save();
        });
    }

    public function test_multiple_update() {
        $categories = [];
        for ($i=0; $i <= 9; $i++) { 
            $categories[] = [
                'id' => "CAT$i",
                'name' => "category$i",
            ];
        }
        $insert = Category::insert($categories);
        assertTrue($insert);

        //update semua
        Category::whereNull('description')->update([
            'description'=> 'updated..'
        ]);
        
        //cek total
        assertEquals(10, Category::where('description', '=', 'updated..')->count());
    }

    public function test_delete() {
        $this->seed(CategorySeeder::class);

        $result = Category::find('FOOD')->delete();
        assertTrue($result);
        assertCount(0, Category::get());
    }

    public function test_multiple_delete() {
        $categories = [];
        for ($i=0; $i <= 9; $i++) { 
            $categories[] = [
                'id' => "CAT$i",
                'name' => "category$i",
            ];
        }
        $insert = Category::insert($categories);
        assertTrue($insert);
        assertCount(10, Category::get());
        
        $delete = Category::whereNull('description')->delete();
        assertCount(0, Category::get());
    }

    public function test_update_fill() {
        $this->seed(CategorySeeder::class);

        $requests = [
            'name' => 'Food Updated',
            'description' => 'description food updated',
        ];

        $category = Category::find('FOOD');
        $category->fill($requests);

        $result = $category->save();

        assertTrue($result);
        assertEquals('Food Updated', Category::find('FOOD')->name);
        assertEquals('description food updated', Category::find('FOOD')->description);
    }
}

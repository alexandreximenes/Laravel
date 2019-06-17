<?php

namespace App\Http\Controllers\Category;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class CategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return $this->showAll($categories, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:1',
            'description' => 'required|min:1'
        ];

        $this->validate($request, $rules);

        $newCategory = Category::create($request->all());

        return $this->showOne($newCategory, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return void
     */
    public function show(Category $category)
    {
        return $this->show($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Category $category
     * @return void
     */
    public function update(Request $request, Category $category)
    {
        /**
         * $fieldsAccept = ['name', 'description'];
         * $intersect = $request->intersect($fieldsAccept);
         * $category->fill($intersect);
         */

        $category->fill($request->intersect([
            'name',
            'description'
        ]));

        if ($category->isClean()):
            return $this->errorResponse("You need specified different value to update", 422);
        endif;

        $category->save();

        return $this->showOne($category);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return void
     */
    public function destroy(Category $category)
    {
        $category->delete();

        $this->showOne($category);
    }
}

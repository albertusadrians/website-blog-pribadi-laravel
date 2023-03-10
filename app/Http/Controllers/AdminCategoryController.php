<?php

namespace App\Http\Controllers;


use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.categories.index', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request;
        DB::beginTransaction();
        try {
            $rules = [
                'category_name' => 'required|max:255',
                'category_slug' => 'required|unique:categories',
                'category_image' => 'required|image|file|max:1024',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $validation_error = $validator->messages();
                return response()->json(['status' => 'error', 'message' => 'Failed to saved data, please try again', 'errorMessage' => $validation_error], 400);
            } else {
                $validatedData = $validator->validated();
                // Simpan gambar di Storage
                if ($request->file('category_image')) {
                    $validatedData['category_image'] = $request->file('category_image')->store('category_images');
                }
                // if ($category_id == 0) {
                // } else {
                //     Category::where('id',$category->id)->update($validator->validated());
                // }
                // return response()->json([
                //     'status'=>200,
                //     'message'=>'success add category'
                // ]);
                Category::create($validatedData);
                DB::commit();
                return response()->json(['status' => 'success', 'message' => 'Data has been successfully saved.'], 200);
            }
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => 'Failed to saved data, please try again', 'errorMessage' => $e->getMessage()], 400);
        }
    }

    public function fetchCategories()
    {
        $categories = Category::all();
        // return response()->json([
        //     'categories'=>$categories
        // ]);

        return response()->json(['status' => 'success', 'data' => $categories], 200);
    }

    // public function fetchCategories() {
    //     $categories = Category::all();
    //     return view('dashboard.categories.data', [
    //         'categories'=>$categories
    //     ]);
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        if ($category) {
            return response()->json([
                'status' => 200,
                'category' => $category
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "Category not found!"
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        DB::beginTransaction();
        try {
            $rules = [
                'category_name' => 'required|max:255',
            ];
            if ($request->category_slug != $category->category_slug) {
                $rules['category_slug'] = 'required|unique:categories';
            }
            if ($request->category_image) {
                $rules['category_image'] = 'image|file|max:1024';
            }
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $validation_error = $validator->messages();
                return response()->json(['status' => 'error', 'message' => 'Failed to updated data, please try again', 'errorMessage' => $validation_error], 400);
            } else {
                $validatedData = $validator->validated();
                if ($request->file('category_image')) {
                    if ($request->category_image) {
                        Storage::delete($request->old_category_image);
                    }
                    $validatedData['category_image'] = $request->file('category_image')->store('category_images');
                }
                Category::where('id', $category->id)->update($validatedData);
                // return response()->json([
                //     'status'=>200,
                //     'message'=>'success update category'
                // ]);
                DB::commit();
                return response()->json(['status' => 'success', 'message' => 'Data has been successfully updated.'], 200);
            }
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => 'Failed to updated data, please try again', 'errorMessage' => $e->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        DB::beginTransaction();
        try {
            if($category->category_image){
                Storage::delete($category->category_image);
            }
            Category::destroy($category->id);
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Data has been successfully deleted.'], 200);
        }
        catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => 'Failed to deleted data, please try again', 'errorMessage' => $e->getMessage()], 400);
        }
    }
}

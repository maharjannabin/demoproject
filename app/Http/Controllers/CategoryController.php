<?php

namespace NepalFlag\Http\Controllers;

use NepalFlag\Category;
use NepalFlag\UtilityFunction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;


class CategoryController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
        
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $categories     = Category::findCategories();

        return view('category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        $model      = new Category;
        $method     = $request -> method();

        if ($request -> isMethod('POST')) {
            $request -> merge(['slug' => UtilityFunction::generateSlug($request -> name), 'created_by' => $model -> created_by]);
            
            $input      = Input::all();
            $validator  = $model -> validate($input);

            if ($validator -> fails()) 
                return redirect() -> back() -> withErrors($validator) -> withInput();
            
            $response    = $model -> store($input);

            if(isset($response)) {
                $success    = isset($response['response']) ? $response['response'] : null;
                $error      = isset($response['error']) ? $response['error'] : null;

                if($success) 
                    return redirect() -> back() -> with('success', 'Successfully Added!');
                else 
                    return redirect() -> back() -> withErrors($error) -> withInput();
                
            } else {
                return redirect() -> back() -> withErrors('Something went wrong. Please try again!') -> withInput();
            }

        }
        return view ('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        
        $model      = new Category;
        $category   = $model -> where('id', $id) -> first();


        $method     = $request -> method();

        if ($request -> isMethod('POST')) {
            $request -> merge(['slug' => UtilityFunction::generateSlug($request -> name), 'updated_by' => $model -> updated_by]);
            $input      = Input::all();

            $validator  = $model -> validateUpdate($id, $input);

            if ($validator -> fails())
                return redirect() -> back() -> withErrors($validator) -> withInput();

            $response   = $model -> change($id, $input);

            if (isset($response)) {
                $success    = isset($response['response']) ? $response['response'] : NULL;
                $error      = isset($response['error']) ? $response['response'] : NULL;

                if ($success)
                    return redirect() -> back() -> with('success', 'Successfully Updated!');
                else 
                    return redirect() -> back() -> withErrors($error) -> withInput();

            } else {
                return redirect() -> back() -> withErrors('Something went wrong. Please try again!');
            }
        }
        return view('category.update', ['category' => $category]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $model = Category::find($id) -> update(['is_disabled' => Category::INACTIVE]);

        if ($model) 
            return redirect() -> back() -> with('success', "Successfully Disabled!");
        else 
            return redirect() -> back() -> withErrors("Error Disabling the Referer!");

    }
}

<?php

namespace NepalFlag\Http\Controllers;



use NepalFlag\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use NepalFlag\UtilityFunction;

class ProductController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }
    
        
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $products    = Product::findProducts();

        return view('product.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {


        $model    = new Product;
        $method     = $request -> method();

        if( $request -> isMethod('POST')) { 
            $request -> merge(['slug' => UtilityFunction::generateSlug($request -> name), 'created_by' => auth()->user() -> id]);

            $input      = Input::all();

            $validator = $model -> validate($input);
            if ($validator -> fails()) {
                return redirect() -> back() -> withErrors($validator) -> withInput();
            }

            $addResponse    = $model -> store($input);
            if(isset($addResponse)) {
                $success    = isset($addResponse['response']) ? $addResponse['response'] : null;
                $error      = isset($addResponse['error']) ? $addResponse['error'] : null;
                if($success) {
                    return redirect() -> back() -> with('success', 'Successfully Added!');
                } else {
                    return redirect() -> back() -> withErrors($error) -> withInput();
                }
            } else {
                return redirect() -> back() -> withErrors('Something went wrong. Please try again!') -> withInput();
            }
        } 

        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $model    = new Product;

        $input      = Input::all();
        $method     = $request -> method();
        
        if($request -> isMethod('post')) { 
            $validate = $model -> validate($input);

            if ($validate -> fails()) {
                return redirect() -> back() -> withErrors($validate) -> withInput();
            }

            $addResponse    = $model -> store($input);
            if(isset($addResponse)) {
                $success    = isset($addResponse['response']) ? $addResponse['response'] : null;
                $error      = isset($addResponse['error']) ? $addResponse['error'] : null;
                if($success) {
                    return redirect() -> back() -> with('success', 'Successfully Added!');
                } else {
                    return redirect() -> back() -> withErrors($error) -> withInput();
                }
            } else {
                return redirect() -> back() -> withErrors('Something went wrong. Please try again!') -> withInput();
            }
        }
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $model      = new Product;
        $product    = $model -> where('id', $id) -> first();

        $method     = $request -> method();

        if ($request -> isMethod('POST')) {
            $request -> merge(['slug' => UtilityFunction::generateSlug($request -> name), 'updated_by' => auth()->user() -> id]);
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
        return view('product.update', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

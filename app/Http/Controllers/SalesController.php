<?php

namespace NepalFlag\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use NepalFlag\ProductOrder;
use NepalFlag\ProductDetail;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $orders  = ProductOrder::findOrders();

        return view('sales.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        
        $model = new ProductOrder;
        $method     = $request -> method();

        if( $request -> isMethod('POST')) { 
            
            
            $total      = $request -> request -> get('sub_total');

            if(!is_null($quantity = $request -> request -> get('quantity')))
                $total      = $total * $quantity;

            if (!is_null($discount = $request -> request -> get('discount')) )  {
                $total = ($total - $discount);
            }

            if (!is_null($serviceCharge = $request -> request -> get('service_charge')) )  {
                $total = ($total + $serviceCharge);
            }

            if (!is_null($taxRate = $request -> request -> get('tax'))) {
                $tax        = $total*$taxRate/100;
                $total      = $total + $tax;
            }


            $size       = $request -> request -> get('product_size');
            $productId = $request -> request -> get('product_id');
            $productDetailId    = NULL;
            $productDetail      = ProductDetail::findProductDetail($productId, $size);

            if (!empty($productDetail))
                $productDetailId = $productDetail -> id;


            $request -> merge(['grand_total' => $total, 'product_id' => $productDetailId, 'created_by' => auth()->user() -> id]);


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
        return view('sales.create');
    }

    public function productDetail($id, $size) {
        $productDetail  = ProductDetail::findProductDetail($id, $size) -> toArray();
        $status         = true;

        if(empty($productDetail))
            $status     = false;

        echo json_encode(['status' => $status, 'response' => $productDetail]);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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

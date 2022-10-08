<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Cart;
use App\Models\Product;
use App\Mail\NotifyMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Cartalyst\Stripe\Laravel\Facades\Stripe;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Products= Product::all();
        return view('Product.index' , compact('Products'));  
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
    public function addToCart(Product $product) {
        
        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
        } else {
            $cart = new Cart();
        }
        $cart->add($product);
        // dd($cart);
        session()->put('cart', $cart);
        return redirect()->route('product.index')->with('success', 'Product was added');
    }
    public function showCart() {

        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
        } else {
            $cart = null;
        }

        return view('cart.show', compact('cart'));
    }
    public function checkout($amount) {
        $randomId       =   rand(4,5000);
    //    dd( $randomId );
    $useremail = auth()->user()->email;

    // dd($id);
    // dd($user);
        $data=[
            'subject' => "SMART ASSISTANT GLASSES",
            'body'    => "SAG_".$randomId ,
        ];
        Mail::to($useremail)->send(new NotifyMail($data));
          Alert::success('CHECK YOUR GMAIL', 'CODE SENT SUCCESSFULU !');


        // try
        // {
        //     return response()->json(['goood']);
        // } 
        // catch (Exception $th) {
        //     return response()->json(['baaaaaaaaaaaad']);

        // }
        return view('cart.checkout',compact('amount'));
    }

    public function charge(Request $request) {
        $useremail = auth()->user()->email;

       // dd($request->stripeToken);
        $charge =Stripe::charges()->create([
            'currency' => 'USD',
            'source' => $request->stripeToken,
            'amount'   => $request->amount,
            'description' => ' SMART ASSISTANT GLASSES',
        ]);
        $charge['customer'] =$useremail;
            //dd($charge['customer']);
            //dd($charge['amount']);
            // dd($charge);
            $chargeId = $charge['id'];

        if ($chargeId) 
        {
            auth()->user()->orders()->create([
                'cart' => serialize( session()->get('cart'))
            ]);
            session()->forget('cart');  
            return redirect()->route('store')->with('success', " Payment was done. Thanks");
        } 
        else 
        {
            return redirect()->back();
        }
    }
    
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'qty' => 'required|numeric|min:1'
        ]);

        $cart = new Cart(session()->get('cart'));
        $cart->updateQty($product->id, $request->qty);
        session()->put('cart', $cart);
        return redirect()->route('cart.show')->with('success', 'Product updated');
    }
    public function destroy(Product $product)
    {
        $cart = new Cart( session()->get('cart'));
        $cart->remove($product->id);

        if( $cart->totalQty <= 0 ) {
            session()->forget('cart');
        } else {
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.show')->with('success', 'Product was removed');

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
  

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
   
}

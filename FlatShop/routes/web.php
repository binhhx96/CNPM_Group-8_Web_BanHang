<?php

use Illuminate\Http\RedirectResponse;
use App\User;
use App\Order;
use App\Product;
use App\Mail\NotificationMail;
use Illuminate\Support\Facades\Mail;

Route::get('/test',function(){
    return view('Mail.mail-form');
});

Route::get('/mail',function(){    
    if(Auth::check())
        Mail::to(Auth::user()->email)->send(new NotificationMail(Auth::id(),Cookie::get('amount')));
    else{
        $order = Order::where('userID',Cookie::get('user_ip'))->orderBy('orderID','desc')->first(); 
        if($order->email != "")              
            Mail::to($order->email)->send(new NotificationMail(Cookie::get('user_ip'),Cookie::get('amount')));
    }
    return redirect('/');
});

Route::get('/', function () {
    Cookie::queue('amount', '0', 180);    
    if(Auth::check())
        Cookie::queue('login', '1', 180);
    else
        Cookie::queue('login', '0', 180);  
	return redirect('/Trang-Chu');
});

Route::get('/Trang-Chu',function(){            
    return view('welcome');
});

Route::get('/details={id}', 'ProductController@detail');
Route::get('/Men', 'ProductController@product');
Route::get('/Women', 'ProductController@product');
Route::get('/Kids', 'ProductController@product');
Route::get('/Watch', 'ProductController@product');
Route::get('/Jewelry', 'ProductController@product');
// Route::get('/productlitst', function () {
//     return view('productlitst',['user'=>Auth::user()]);
// });

Route::get('/productgird', function () {
    return view('productgird',['user'=>Auth::user()]);
});

Route::get('/cart', function () {   
    if(Auth::check())
        return view('cart',['user'=>Auth::user(),'type'=>1]);        
    else
        return view('cart',['user'=>Auth::user(),'type'=>0]);    

});

Route::get('/list-product', function () {
    $type = Auth::user()->typeofuser;
    if($type == 1 || $type == 2)
        $ls_product = Product::paginate(5);    
    else
        $ls_product = Product::paginate(5);    
    return view('UserManager',['ls_product'=>$ls_product,'type'=>0,'product'=>null,'user'=>Auth::user()]);
});

Route::get('/manager',function(){
	 return redirect('list-order');
});

Route::get('/list-order', function () {
    $ls_order = Order::all(); 
    $typeofuser = Auth::user()->typeofuser;   
    if($typeofuser == 3){
        $ls_order = Order::where('status','!=',0)->get();
        return view('ListOrder',['ls_order'=>$ls_order,'user'=>Auth::user()]);    
    }
    if($typeofuser == 4){
        $ls_order = Order::where('userID',Auth::id())->get();
        return view('ListOrder',['ls_order'=>$ls_order,'user'=>Auth::user()]);    
    }
    return view('ListOrder',['ls_order'=>$ls_order,'user'=>Auth::user()]);
});

Route::get('/list-account', function () {
    $ls_account = User::where('typeofuser','!=','1')->get();
    $typeofuser = Auth::user()->typeofuser;
    if ($typeofuser == 1){
        return view('AccountManager',['ls_account'=>$ls_account,'type'=>0,'product'=>null,'user'=>Auth::user()]);
    }else{        
        return view('AccountManager',['ls_account'=>$ls_account,'type'=>0,'product'=>null,'user'=>Auth::user()]);
        // return back()->withInput();
    }    
});

Route::get('/login', function () {
    if(isset($_GET['update']))
        return view('login',['update'=>$_GET['update']]);
    return view('login',['update'=>0]);
});

Route::get('/register', function () {
    $oldURL = $_SERVER['HTTP_REFERER'];
    return view('register',['url'=>$oldURL]);
});

Route::get('/register={userID}', function ($userID) {    
    $oldURL = $_SERVER['HTTP_REFERER'];
    $user = User::where('userID',$userID)->get();
    return view('register',['user'=>$user,'url'=>$oldURL,'type'=>1,'userAd'=>Auth::user()]);
});

Route::get('/contact', function () {
    return view('contact',['user'=>Auth::user()]);
});

Route::get('/list-product={productID}', function ($productID) {    
    $product = Product::where('productID',$productID)->get();    
    $ls_product = Product::where('isActive',1)->paginate(5);    
    return view('UserManager',['product'=>$product,'ls_product'=>$ls_product,'type'=>1,'user'=>Auth::user()]);
});

Route::post('/login','UserController@login');

Route::post('/add-user','UserController@index');
Route::post('/edit-user','UserController@index');
Route::get('/delete-user','UserController@index');

Route::post('/add-product','ProductController@index');
Route::post('/edit-product','ProductController@index');
Route::get('/delete-product','ProductController@index');
Route::post('/update-customer','OrderController@order_user');

Route::get('/checkorder','OrderController@index');
Route::post('/add-order','OrderController@store');
Route::get('/delete-order','OrderController@destroy');

Route::get('/logout',function(){
    Auth::logout();
    return Redirect::to('/');
});

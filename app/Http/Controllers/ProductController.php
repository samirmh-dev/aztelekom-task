<?php

namespace App\Http\Controllers;

use App\Product_Color;
use App\Product_Photos;
use App\Product_Rating;
use App\Product_Size;
use App\Product_Tags;
use App\Products;
use const ENT_QUOTES;
use File;
use Gloudemans\Shoppingcart\Facades\Cart;
use function htmlspecialchars;
use Illuminate\Http\Request;
use Image;
use function mb_strtolower;
use function print_r;
use function redirect;
use function response;
use Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use function trim;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$products=Products::select('id','title','code','stock','price')->get()->toArray();

        return view('admin.product.index',compact(['products']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

	    $request->validate( [
			'tags_hidden'=>'required|string',
			'size_hidden'=>'required|string',
			'title'=>'required|string|max:20',
		    'price'=>'required|numeric',
		    'code'=>'required|string|max:20',
		    'description'=>'required|string',
		    'kateqoriya'=>'required|string',
		    'color'=>'required|array',
		    'color.*'=>'required|string|max:6',
			'sekil'=>'required|array',
			'sekil.*'=>'required|image|mimes:jpg,png,jpeg',
	    ]);

	    $product = new Products();
	    $product->title=htmlspecialchars( trim($request['title']),ENT_QUOTES);
	    $product->price=htmlspecialchars( trim($request['price']),ENT_QUOTES);
	    $product->code=htmlspecialchars( trim($request['code']),ENT_QUOTES);
	    $product->description=htmlspecialchars( trim($request['description']),ENT_QUOTES);
	    $product->kateqoriya=htmlspecialchars( trim($request['kateqoriya']),ENT_QUOTES);

	    $product->save();

	    //save etdikden sonra birbasa elave olunan malin id`ne muraciet ede bilerik
	    $last_product= Products::find($product->id);

	    $tags=str_replace(' ','',$request['tags_hidden']);
	    $tags=explode(',',$tags);

	    foreach ($tags as $tag){
	    	$new_tag = new Product_Tags([
	    		'tag'=>htmlspecialchars( trim($tag),ENT_QUOTES)
		    ]);

	    	$last_product->tags()->save($new_tag);
	    }

	    $sizes=str_replace(' ','',$request['size_hidden']);
	    $sizes=explode(',',$sizes);

	    foreach ($sizes as $size){
		    $new_size = new Product_Size([
			    'olcu'=>htmlspecialchars( trim($size),ENT_QUOTES)
		    ]);

		    $last_product->sizes()->save($new_size);
	    }

	    foreach ($request['color'] as $color){
	    	$new_color = new Product_Color([
			    'reng'=>htmlspecialchars( trim($color),ENT_QUOTES)
		    ]);

		    $last_product->colors()->save($new_color);
	    }

	    // Images
	    foreach ($request['sekil'] as $index=>$sekil){

		    $ad=time().rand(0,999).'.'.$request['sekil'][$index]->getClientOriginalExtension();
		    $ad=mb_strtolower($ad);
		    $path_original=public_path('/src/images/original/');
		    $path_thumbnail=public_path('/src/images/thumbnail/');

		    $img= Image::make($request['sekil'][$index]->getRealPath());
		    $img->orientate();
		    $img->resize(570, 812,
			    function ($constraint) {
				    $constraint->upsize();
				    $constraint->aspectRatio();
			    })->save($path_original.$ad);

		    $img= Image::make($request['sekil'][$index]->getRealPath());
		    $img->orientate();
		    $img->resize(145, 170,
			    function ($constraint) {
				    $constraint->upsize();
				    $constraint->aspectRatio();
			    })->save($path_thumbnail.$ad);

		    $new_image = new Product_Photos([
			    'fayl'=>trim(mb_strtolower(htmlspecialchars($ad,ENT_QUOTES))),
		    ]);
		    $last_product->photos()->save($new_image);
	    }

	    return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('product_page',['id'=>$id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
	    $product = Products::find($id);
	    if($product===null){
		    return redirect()->route('product.index');
	    }else{
		    $product_details=$product->all()->toArray()[0];
		    $product_details['colors']=$product->colors()->select('reng')->get()->toArray();
		    $product_details['sizes']=$product->sizes()->select('olcu')->get()->toArray();
		    $product_details['photos']=$product->photos()->select('fayl')->get()->toArray();
		    $product_details['tags']=$product->tags()->select('tag')->get()->toArray();

		    return view('admin.product.edit',compact(['product_details']));
	    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
	    $request->validate( [
		    'tags_hidden'=>'required|string',
		    'size_hidden'=>'required|string',
		    'title'=>'required|string|max:20',
		    'price'=>'required|numeric',
		    'code'=>'required|string|max:20',
		    'description'=>'required|string',
		    'kateqoriya'=>'required|string',
		    'color'=>'required|array',
		    'color.*'=>'required|string|max:6',
		    'sekil'=>'array',
		    'sekil.*'=>'image|mimes:jpg,png,jpeg',
		    'silinecek'=>'array',
		    'silinecek.*'=>'string',
	    ]);

	    print_r($request->toArray());

	    $product=Products::find($id);

	    $product->update([
		    'title'=>htmlspecialchars(  trim( $request['title']),ENT_QUOTES),
		    'price'=>htmlspecialchars( mb_strtolower( trim( $request['price'])),ENT_QUOTES),
		    'code'=>htmlspecialchars( mb_strtolower( trim( $request['code'])),ENT_QUOTES),
		    'description'=>htmlspecialchars( trim( $request['description']),ENT_QUOTES),
		    'kateqoriya'=>htmlspecialchars( mb_strtolower( trim( $request['kateqoriya'])),ENT_QUOTES),
	    ]);

	    if(isset($request['stokda'])){
	    	$product->update([
			    'stock'=>1,
		    ]);
	    }else{
		    $product->update([
			    'stock'=>0,
		    ]);
	    }

	    $product->tags()->delete();

	    $tags=str_replace(' ','',$request['tags_hidden']);
	    $tags=explode(',',$tags);

	    foreach ($tags as $tag){
		    $new_tag = new Product_Tags([
			    'tag'=>htmlspecialchars( trim($tag),ENT_QUOTES)
		    ]);

		    $product->tags()->save($new_tag);
	    }


	    $product->sizes()->delete();

	    $sizes=str_replace(' ','',$request['size_hidden']);
	    $sizes=explode(',',$sizes);

	    foreach ($sizes as $size){
		    $new_size = new Product_Size([
			    'olcu'=>htmlspecialchars( trim($size),ENT_QUOTES)
		    ]);

		    $product->sizes()->save($new_size);
	    }

	    $product->colors()->delete();

	    foreach ($request['color'] as $color){
		    $new_color = new Product_Color([
			    'reng'=>htmlspecialchars( trim($color),ENT_QUOTES)
		    ]);

		    $product->colors()->save($new_color);
	    }

	    if(isset($request['silinecek'])){
		    foreach ($request['silinecek'] as $silinecek){
			    $product->photos()->where('fayl','=',$silinecek)->delete();
			    $original=public_path().'/src/images/original/'.$silinecek;
			    $thumbnail=public_path().'/src/images/thumbnail/'.$silinecek;
			    File::delete($original);
			    File::delete($thumbnail);
		    }
	    }

	    if(isset($request['sekil'])){
		    foreach ($request['sekil'] as $index=>$sekil){

			    $ad=time().rand(0,999).'.'.$request['sekil'][$index]->getClientOriginalExtension();
			    $ad=mb_strtolower($ad);
			    $path_original=public_path('/src/images/original/');
			    $path_thumbnail=public_path('/src/images/thumbnail/');

			    $img= Image::make($request['sekil'][$index]->getRealPath());
			    $img->orientate();
			    $img->resize(570, 812,
				    function ($constraint) {
					    $constraint->upsize();
					    $constraint->aspectRatio();
				    })->save($path_original.$ad);

			    $img= Image::make($request['sekil'][$index]->getRealPath());
			    $img->orientate();
			    $img->resize(145, 170,
				    function ($constraint) {
					    $constraint->upsize();
					    $constraint->aspectRatio();
				    })->save($path_thumbnail.$ad);

			    $new_image = new Product_Photos([
				    'fayl'=>trim(mb_strtolower(htmlspecialchars($ad,ENT_QUOTES))),
			    ]);
			    $product->photos()->save($new_image);
		    }
	    }

		return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $product=Products::find($id);
        if($product!==NULL){
        	$photos=$product->photos()->get()->toArray();
	        foreach ( $photos as $photo ) {
		        $original=public_path().'/src/images/original/'.$photo['fayl'];
		        $thumbnail=public_path().'/src/images/thumbnail/'.$photo['fayl'];
		        File::delete($original);
		        File::delete($thumbnail);
        	}

        	$product->delete();
        }

        return redirect()->route('product.index');
    }

	public function product_page($id) {
    	$product = Products::find($id);
    	if($product===null){
    		throw new NotFoundHttpException();
	    }else{
    		$product_details=$product->toArray();
		    $product_details['colors']=$product->colors()->select('reng')->get()->toArray();
		    $product_details['sizes']=$product->sizes()->select('olcu')->get()->toArray();
		    $product_details['photos']=$product->photos()->select('fayl')->get()->toArray();
		    $product_details['tags']=$product->tags()->select('tag')->get()->toArray();
		    $product_details['ratings']=$product->rating()->select('count')->get()->toArray();

		    $product_details['avarage_rating']=0;

		    $product_details['rating_say']=count($product_details['ratings']);

		    if($product_details['rating_say']!=0){
			    foreach($product_details['ratings'] as $rate){
				    $product_details['avarage_rating']+=$rate['count'];
			    }

			    $product_details['avarage_rating']/=$product_details['rating_say'];
			    $product_details['avarage_rating']=round($product_details['avarage_rating']);
		    }

		    return view('product',compact(['product_details']));
	    }
    }

	public function add_to_cart(Request $request) {
		Cart::add($request['id'],$request['name'],$request['qty'],$request['price'],[
			'olcu'=>$request['size'],
			'reng'=>$request['color'],
			'image'=>$request['image'],
		]);
		Session::flash('status', 1);
		return back();
    }

	public function add_rating(Request $request) {
		if($request->ajax()){
			$new_rating= new Product_Rating([
				'count'=> htmlspecialchars( trim($request['rating']),ENT_QUOTES)
			]);

			$product= Products::find(htmlspecialchars( trim( $request['product'])));

			$product->rating()->save($new_rating);

			$rating=$product->rating()->get()->toArray();

			$avarage_rate=0;
			$say=count($rating);

			foreach($rating as $rate){
				$avarage_rate+=$rate['count'];
			}

			$avarage_rate/=$say;

			return response()->json([
				round($avarage_rate),
				$say,
			]);
		}else{
			throw new NotFoundHttpException();
		}
    }
}

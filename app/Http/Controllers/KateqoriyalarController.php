<?php

namespace App\Http\Controllers;

use App\Kateqoriyalar;
use function compact;
use const ENT_QUOTES;
use function htmlspecialchars;
use Illuminate\Http\Request;
use function mb_strtolower;
use function redirect;
use function trim;

class KateqoriyalarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$kateqoriyalar=Kateqoriyalar::all()->toArray();
        return view('admin.kateqoriyalar.index',compact('kateqoriyalar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kateqoriyalar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
	        "ad"=>"bail|required|string|max:30",
	        "slug"=>"bail|required|string|max:20|unique:kateqoriyalar",
        ],[
	        'ad.required'=>'Ad yazılmalıdır.',
	        'ad.max'=>'Ad maksimum 30 simvol olmalıdır.',
	        'slug.required'=>'Link yazılmalıdır.',
	        'slug.max'=>'Link maksimum 20 simvol olmalıdır.',
	        'slug.unique'=>'Link artıq istifadə olunub.'
        ]);

		$kateqoriyalar = new Kateqoriyalar();

	    $kateqoriyalar->ad=htmlspecialchars( mb_strtolower( trim( $request['ad'])),ENT_QUOTES);
	    $kateqoriyalar->slug=htmlspecialchars( mb_strtolower( trim( $request['slug'])),ENT_QUOTES);
	    if(isset($request['alt_kateqoriya']) && $request['alt_kateqoriya']=='on'){
		    $kateqoriyalar->alt_kateqoriya=1;
	    }

	    $kateqoriyalar->save();

	    return redirect()->route('kateqoriyalar.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$kat_id=htmlspecialchars( mb_strtolower(trim($id)),ENT_QUOTES);
	    $kateqoriya = Kateqoriyalar::find($kat_id);
	    if ($kateqoriya === null) {
		   return redirect()->route('kateqoriyalar.index');
	    }else{
			$kateqoriya_details=Kateqoriyalar::select('ad','slug','alt_kateqoriya')->where('id','=',$kat_id)->get()->first()->toArray();
			return view('admin.kateqoriyalar.edit',compact( ['kateqoriya_details','kat_id']));
	    }
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
	    $request->validate([
		    "ad"=>"bail|string|max:30",
		    "slug"=>"bail|string|max:20|unique:kateqoriyalar",
	    ],[
		    'ad.max'=>'Ad maksimum 30 simvol olmalıdır.',
		    'slug.max'=>'Link maksimum 20 simvol olmalıdır.',
			'slug.unique'=>'Link artıq istifadə olunub.'
	    ]);

	    $kat_id=htmlspecialchars( mb_strtolower(trim($id)),ENT_QUOTES);
	    $kateqoriya = Kateqoriyalar::find($kat_id);

	    if ($kateqoriya !== null) {
		    if(isset($request['ad'])){
			    $kateqoriya->update([
				    'ad'=>htmlspecialchars( mb_strtolower( trim( $request['ad'])),ENT_QUOTES)
			    ]);
		    }

		    if(isset($request['slug'])){
			    $kateqoriya->update([
				    'slug'=>htmlspecialchars( mb_strtolower( trim( $request['slug'])),ENT_QUOTES)
			    ]);
		    }

		    if(isset($request['alt_kateqoriya']) && $request['alt_kateqoriya']=='on'){
			    $kateqoriya->update([
				    'alt_kateqoriya'=>1
			    ]);
		    }else{
			    $kateqoriya->update([
				    'alt_kateqoriya'=>0
			    ]);
		    }
	    }

	    return redirect()->route('kateqoriyalar.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
	    $kat_id=htmlspecialchars( mb_strtolower(trim($id)),ENT_QUOTES);
	    $kateqoriya = Kateqoriyalar::find($kat_id);

	    if ($kateqoriya !== null) {
	    	$kateqoriya->delete();
	    }

	    return redirect()->route('kateqoriyalar.index');
    }
}

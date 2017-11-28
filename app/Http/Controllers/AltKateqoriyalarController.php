<?php

namespace App\Http\Controllers;

use App\AltKateqoriyalar;
use App\Kateqoriyalar;
use function compact;
use const ENT_QUOTES;
use function htmlspecialchars;
use Illuminate\Http\Request;
use function mb_strtolower;
use function trim;

class AltKateqoriyalarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$alt_kateqoriyalar=AltKateqoriyalar::all()->toArray();
        return view('admin.alt-kateqoriyalar.index',compact( ['alt_kateqoriyalar']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$kateqoriyalar=Kateqoriyalar::select('id','ad')->where('alt_kateqoriya','=','1')->get()->toArray();
        return view('admin.alt-kateqoriyalar.create',compact(['kateqoriyalar']));
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
	        "ad"=>"bail|required|string|max:30",
	        "slug"=>"bail|required|string|max:20|unique:alt_kateqoriyalar",
	        "ust_kateqoriya"=>"bail|required|numeric"
        ],[
	        'ad.required'=>'Ad yazılmalıdır.',
	        'ad.max'=>'Ad maksimum 30 simvol olmalıdır.',
	        'slug.required'=>'Link yazılmalıdır.',
	        'slug.max'=>'Link maksimum 20 simvol olmalıdır.',
	        'slug.unique'=>'Link artıq istifadə olunub.'
        ]);


        $kateqoriya=Kateqoriyalar::find(htmlspecialchars( $request['ust_kateqoriya']));

        $yeni_alt_kateqoriya=new AltKateqoriyalar([
	        "ad"=>htmlspecialchars( mb_strtolower( trim( $request['ad']))),
        	"slug"=>htmlspecialchars( mb_strtolower( trim( $request['slug'])))
        ]);

        $kateqoriya->alt_kateqoriyalar()->save($yeni_alt_kateqoriya);

        return redirect()->route('alt-kateqoriyalar.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	    $alt_kat_id=htmlspecialchars( mb_strtolower(trim($id)),ENT_QUOTES);
	    $alt_kateqoriya = AltKateqoriyalar::find($alt_kat_id);
	    $kateqoriyalar=Kateqoriyalar::select('id','ad')->where('alt_kateqoriya','=','1')->get()->toArray();

	    if ($alt_kateqoriya === null) {
		    return redirect()->route('alt-kateqoriyalar.index');
	    }else{
		    $alt_kateqoriya_details=AltKateqoriyalar::select('ad','slug','foreign_kateqoriya_id')->where('id','=',$alt_kat_id)->get()->first()->toArray();
		    return view('admin.alt-kateqoriyalar.edit',compact( ['alt_kateqoriya_details','alt_kat_id','kateqoriyalar']));
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
    	$alt_kat_id=htmlspecialchars( mb_strtolower(trim($id)),ENT_QUOTES);

        $request->validate( [
	        "ad"=>"bail|string|max:30",
	        "slug"=>"bail|string|max:20|unique:alt_kateqoriyalar",
	        "ust_kateqoriya"=>"bail|numeric"
        ],[
	        'ad.max'=>'Ad maksimum 30 simvol olmalıdır.',
	        'slug.max'=>'Link maksimum 20 simvol olmalıdır.',
	        'slug.unique'=>'Link artıq istifadə olunub.'
        ]);

        if(isset($request['ad'])){
			AltKateqoriyalar::find($alt_kat_id)->update([
				'ad'=>htmlspecialchars( mb_strtolower(trim($request['ad'])),ENT_QUOTES)
			]);
        }

	    if(isset($request['slug'])){
		    AltKateqoriyalar::find($alt_kat_id)->update([
			    'slug'=>htmlspecialchars( mb_strtolower(trim($request['slug'])),ENT_QUOTES)
		    ]);
	    }

	    if(isset($request['ust_kateqoriya'])){
		    AltKateqoriyalar::find($alt_kat_id)->update([
			    'foreign_kateqoriya_id'=>htmlspecialchars( mb_strtolower(trim($request['ust_kateqoriya'])),ENT_QUOTES)
		    ]);
	    }

	    return redirect()->route('alt-kateqoriyalar.index');
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
	    $kateqoriya = AltKateqoriyalar::find($kat_id);

	    if ($kateqoriya !== null) {
		    $kateqoriya->delete();
	    }

	    return redirect()->route('alt-kateqoriyalar.index');
    }
}

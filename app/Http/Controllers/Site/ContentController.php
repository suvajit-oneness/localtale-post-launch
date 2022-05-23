<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Models\LocalTradeQueryRequest;

class ContentController extends BaseController
{

    /**
     * ContentController constructor.
     */
    public function __construct(){

    }

    public function index(){
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about(){
        $this->setPageTitle('About', 'About Local Tales');
        return view('site.content.about');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function terms(){
        $this->setPageTitle('Terms Of Use', 'Local Tales - Terms Of Use');
        return view('site.content.terms');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function privacy(){
        $this->setPageTitle('Privacy Policy', 'Local Tales - Privacy Policy');
        return view('site.content.privacy');
    }

    public function getQuotes()
    {
        return view('site.quotes.index');
    }

    public function getCateory(Request $request)
    {
        $resp = DB::table('business_categories')->where('title', 'LIKE', '%'.$request->data.'%')->limit(7)->get();
        if (count($resp) > 0) {
            return response()->json(['type' => 'success', 'message' => 'Data found', 'data' => $resp], 200);
        } else {
            return response()->json(['type' => 'failure', 'message' => 'No data found'], 400);
        }
    }

    public function submitQuotes(Request $request)
    {
        // dd($request->all());
        $business_cat_id = DB::table('business_categories')->select('id')->where('title', 'LIKE', '%'.$request->category.'%')->first();
        $resp = DB::table('businesses')->where('address', 'LIKE', '%'.$request->postcode.'%')->where('category_id', 'LIKE', '%'.$business_cat_id->id.'%')->get();
        // dd($business_cat_id->id, $resp);

        $queryRFQ = new LocalTradeQueryRequest();
        $queryRFQ->ip = $_SERVER['REMOTE_ADDR'];
        if (Auth::user()) {
            $queryRFQ->user_id = Auth::user()->id;
        }
        $queryRFQ->postcode = $request->postcode;
        $queryRFQ->time_frame = $request->time_frame;
        $queryRFQ->job_details = $request->job_details ?? null;
        $queryRFQ->budget = $request->budget;
        $queryRFQ->category = $request->category;
        $queryRFQ->save();

        return view('site.quotes.result', compact('resp', 'queryRFQ'));
    }
}

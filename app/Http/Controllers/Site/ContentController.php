<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Auth;

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
}

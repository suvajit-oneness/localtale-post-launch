<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Contracts\BusinessContract;
use App\Contracts\CategoryContract;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Auth;

class BusinessController extends BaseController
{
    /**
     * @var BusinessContract
     */
    protected $businessRepository;
    /**
     * @var CategoryContract
     */
    protected $categoryRepository;


    /**
     * BusinessController constructor.
     * @param BusinessContract $businessRepository
     */
    public function __construct(BusinessContract $businessRepository,CategoryContract $categoryRepository)
    {
        $this->businessRepository = $businessRepository;
        $this->categoryRepository = $categoryRepository;
        
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $pinCode = (isset($request->pin) && $request->pin!='')?$request->pin:'3000';
        $businesses = $this->businessRepository->getBusinessByPinCode($pinCode);

        $this->setPageTitle('Business', 'List of all businesses');
        return view('site.business.index', compact('businesses','pinCode'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $businesses = $this->businessRepository->detailsBusiness($id);
        $business = $businesses[0];

        $businessSaved = 0;

        if(Auth::guard('user')->check()){
            $user_id = Auth::guard('user')->user()->id;

            $businessSavedResult = $this->businessRepository->checkUserBusinesses($id,$user_id);

            if(count($businessSavedResult)>0){
                $businessSaved = 1;
            }else{
                $businessSaved = 0;
            }
        }

        $this->setPageTitle($business->title, 'Business Details : '.$business->title);
        return view('site.business.details', compact('business','businessSaved'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function saveUserBusiness($id){
        $user_id = Auth::user()->id;

        $this->businessRepository->saveUserBusiness($id,$user_id);

        return $this->responseRedirectBack( 'You have saved this directory' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deleteUserBusiness($id){
        $user_id = Auth::user()->id;

        $this->businessRepository->deleteUserBusiness($id,$user_id);

        return $this->responseRedirectBack( 'You have removed this directory from your list' ,'success',false, false);
    }
}
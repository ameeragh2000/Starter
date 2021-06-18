<?php

namespace App\Http\Controllers;

use App\Http\Requests\offerRequest;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use LaravelLocalization;
class CrudController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    public function getOffers(){
        return Offer::select('id','name')->get();
    }
//    public function store(){
//        Offer::create([
//            'name'=> 'Offer3',
//            'price'=> '5000',
//            'details'=> 'offer details',
//        ]);
//    }
    public function create(){
        return view('offers.create');
    }
    public function store(offerRequest $request){
        //validate data before insert to database
//        $rules=$this->getRules();
//        $messages=$this->getMessages();
//        $validator =Validator::make($request->all(),$rules,$messages);
//        if($validator ->fails()){
//            //return json_encode($validator ->errors(), JSON_UNESCAPED_UNICODE);
//            return redirect()->back()->withErrors($validator)->withInputs($request->all());
//        }
        //insert
        Offer::create([
            'name_ar'=> $request->name_ar,
            'name_en'=> $request->name_en,
             'price'=> $request->price,
             'details_ar'=> $request->details_ar,
            'details_en'=> $request->details_en,
        ]);
        return redirect()->back()->with(['success'=>'تم اضافة العرض بنجاح']);
    }
//    protected function getMessages(){
//        return [
//            'name.required' =>trans('messages.offer name required'),
//            'name.unique' => __('messages.offer name must be unique'),
//            'price.numeric' =>'سعر العرض يجب ان يكون ارقام',
//        ];
//    }
//    protected function getRules(){
//        return [
//            'name'=> 'required|max:100|unique:offers,name',
//            'price'=> 'required|numeric',
//            'details'=> 'required',
//        ];
//    }

public function getAllOffers(){
        $offers=Offer::select('id','name_'.LaravelLocalization::getCurrentLocale().' as name','price','details_'.LaravelLocalization::getCurrentLocale().' as details')->get();//return collection
        return view('offers.all',compact('offers'));

}
}

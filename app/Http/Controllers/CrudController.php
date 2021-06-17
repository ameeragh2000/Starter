<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
    public function store(Request $request){
        //validate data before insert to database
        $rules=$this->getRules();
        $messages=$this->getMessages();
        $validator =Validator::make($request->all(),$rules,$messages);
        if($validator ->fails()){
            //return json_encode($validator ->errors(), JSON_UNESCAPED_UNICODE);
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        //insert
        Offer::create([
            'name'=> $request->name,
             'price'=> $request->price,
             'details'=> $request->details,
        ]);
        return redirect()->back()->with(['success'=>'تم اضافة العرض بنجاح']);
    }
    protected function getMessages(){
        return $messages=[
            'name.required' =>trans('messages.offer name required'),
            'name.unique' => __('messages.offer name must be unique'),
            'price.numeric' =>'سعر العرض يجب ان يكون ارقام',
        ];
    }
    protected function getRules(){
        return [
            'name'=> 'required|max:100|unique:offers,name',
            'price'=> 'required|numeric',
            'details'=> 'required',
        ];
    }

}

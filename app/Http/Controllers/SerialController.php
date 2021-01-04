<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Response;
use Auth;   
use Carbon;

use App\Models\Serial;
use App\Models\Lot;
use Illuminate\Http\Request;

class SerialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // $serials = Serial::all();
        $totalSerials = Serial::max('id');
        $totalSerials = Serial::count();
        // return $totalSerials;
        return view('serials.index')->with('totalSerials', $totalSerials);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('serials.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return 'serial to be generated;';
        // $last = Serial::all()->last();
        // $last = Serial::latest()->first();
        $last = Serial::orderBy('id', 'DESC')->first();
        // return $last;
        if(!$last){
            $sNumber = 1000000000;
        }else{
        $sNumber = $last->serialNumber;
        }
        $count = $request->count;;
        $size =12;
        $append = '202';
        $appendNo = '10';
        $serials = [];
        for($i = 0; $i < $count; $i++){
            $pinNumber = mt_rand(1000000000, 9999999999);
            // $serialNumber = strtoupper(substr(md5(time().rand(10000,99999)), 0, $size));
            $serialArr['pinNumber'] = intval($append.$pinNumber);
            $serialArr['serialNumber'] = $i + $sNumber;
            $serialArr['checkCode'] = mt_rand(10000,99999);
            array_push($serials, $serialArr);
            
        }
        // return $serials;
        // return $serials;
        foreach (array_chunk($serials,1000) as $t) {
            Serial::insert($t);
         }
         return redirect('/serials')->with('success', 'Serials generated succesfully');
        // $serialEntry = Serial::insert($serials);
        // if($serialEntry){
        //     // return 'Serials generated succesfully';
        //     return redirect('/serials')->with('success', 'Serials generated succesfully');
        // }
        
       
        // $randomNumber = rand(); 
        // return $randomNumber;
    }

    /**     
     * Display the specified resource.
     *
     * @param  \App\Models\Serial  $serial
     * @return \Illuminate\Http\Response
     */
    public function show(Serial $serial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Serial  $serial
     * @return \Illuminate\Http\Response
     */
    public function edit(Serial $serial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Serial  $serial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Serial $serial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Serial  $serial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Serial $serial)
    {
        //
    }

    public function check(Request $request){
        $check = Serial::where('pinNumber',$request->serialNumber)->whereNotNull('lotNumber')->first();
        // $check = Serial::where('serialNumber',$request->serialNumber)->first();
        // $check = Serial::where('serialNumber',$request->serialNumber)->where('pinNumber',$request->pinNumber)->first();

        if(!$check){
            return redirect('/')->with('failed', 'Serial do not match');
            return 'Please re-enter the serial correctly';
        }

        if($check->checked){
            return redirect('/')->with('failed', 'Serial number already used');
        }

        if(!$check->checked){
            $check->checked = true;
            $save = $check->save();
            if($save){
                return redirect('/')->with('success', 'Success, verified');
            }
        }else{
            return redirect('/')->with('failed', 'Serial number already used');
        }

       
    }

    public function print(){
        $lots = Lot::orderBy('id', 'DESC')->get();
        return view('serials.print')->with('lots', $lots);
    }


    public function printCode(Request $request){
        $request['manufacture_date']= date("Y-m-d", strtotime($request->manufacture_date));
        $request['expiry_date']= date("Y-m-d", strtotime($request->expiry_date));
        // return $request->all();
        // validate data from the input
        $validator = Validator::make($request->all(), [
            'package' => 'required|integer',
            'lot_no'=>'required|string|unique:lots',
            'count'=>'required|integer',
            'manufacture_date'=>'required|date',
            'expiry_date'=>'required|date',

            
        ]);
        if($validator->fails()){
            $errors =  $validator->messages();
            return back()->with('errors',$errors);
        }

        // return $request->all();
        $count = $request->count;
        // return $request->lot_no;
        // $last = Serial::all()->whereNull('lotNumber')->first();
        $last = Serial::whereNull('lotNumber')->min('id');
        // return $last->id;
        $upto =  $last + $count;
        // $update = Serial::whereBetween('id', [$last->id, $upto - 1])->get();
        $update = Serial::whereBetween('id', [$last, $upto - 1])->update(['lotNumber' => $request->lot_no]);

        if($update){
            $storeLot = Lot::create($request->all());
            if($storeLot){
                return back()->with('success','Lot created successfully');
            }
            else{
                return back()->with('errors',$errors);
            }
        }
        

        return $last;
        return 'logics to print codes';
    }


    public function download(Request $request){
        // return Auth::user()->id;
        $lotname = Lot::find($request->lot_id);
        // return $request->lot_id;
        $serials = DB::table('serials')
                ->where('serials.lotNumber','=', $lotname->lot_no)
                ->select('serials.serialNumber', 'serials.pinNumber')
                ->get();
                
        $lots = Lot::all();
        $content = "";

        foreach($serials as $serial){
            $content .= "SNo: ".$serial->serialNumber."|PinNo: ".$serial->pinNumber."|Lot No: ".$lotname->lot_no."|MFG: ". date('m/y', strtotime($lotname->manufacture_date))."|EXP ".date('m/y', strtotime($lotname->expiry_date));
            $content .="\n";
        }

        $filename = $lotname->lot_no;
        // return $content;
        $headers = [
            'Content-type' => 'text/plain',
            'Content-Disposition'=> sprintf('attachment; filename="%s"', $filename),
        ];

        $store = Response::make($content, 200, $headers);
        if($store){
            $updateLot = Lot::where('id', $request->lot_id)->update(['status'=>1,'user_id'=>Auth::user()->id]);
            return $store;
        }
        
        // $lt = $request->lot_id;
        // $lot = Lot::find($lt);
        // return $lot;
    }

    public function assign(){
        return view('serials.assign');
    }


    

}

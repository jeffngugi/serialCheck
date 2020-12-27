<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Response;
use Auth;   

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
        $serials = Serial::all();
        // return view('serial.index')->with('serails',$serials);
        // $serials = Serial::paginate(50);
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
        $last = Serial::all()->last();
        if(!$last){
            $sNumber = 1000000000;
        }else{
        $sNumber = $last->pinNumber;
        }
        $count = $request->count;;
        $size =12;
        $append = '202';
        $appendNo = '10';
        $serials = [];
        for($i = 0; $i < $count; $i++){
            $serialNumber = mt_rand(1000000000, 9999999999);
            // $serialNumber = strtoupper(substr(md5(time().rand(10000,99999)), 0, $size));
            $serialArr['serialNumber'] = intval($append.$serialNumber);
            $serialArr['pinNumber'] = $i + $sNumber;
            $serialArr['checkCode'] = mt_rand(10000,99999);
            array_push($serials, $serialArr);
            
        }
        // return $serials;
        $serialEntry = Serial::insert($serials);
        if($serialEntry){
            // return 'Serials generated succesfully';
            return redirect('/serials')->with('success', 'Serials generated succesfully');
        }
        
       
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
        $check = Serial::where('serialNumber',$request->serialNumber)->whereNotNull('lotNumber')->first();
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
                return redirect('/')->with('success', 'Success, serial verified');
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
        $last = Serial::all()->whereNull('lotNumber')->first();
        $upto =  $last->id + $count;
        // $update = Serial::whereBetween('id', [$last->id, $upto - 1])->get();
        $update = Serial::whereBetween('id', [$last->id, $upto - 1])->update(['lotNumber' => $request->lot_no]);

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
            $content .= "sNO: ".$serial->serialNumber."|PinNo: ".$serial->pinNumber."|LotNo: ".$lotname->lot_no."|Mfg.Date ". $lotname->manufacture_date;
            $content .="\n";
        }

        $filename = $lotname->lot_no;

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

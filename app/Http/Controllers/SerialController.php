<?php

namespace App\Http\Controllers;

use App\Models\Serial;
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
// return 'jefff';
        

        
       
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
        return view('serials.print');
    }

    public function printCode(Request $request){
        return $request;
        return 'logics to print codes';
    }

    public function assign(){
        return view('serials.assign');
    }


    

}

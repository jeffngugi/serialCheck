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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'create serial codes';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       
        
        // $number = mt_rand(1000000000, 9999999999);
        // return $number;
        // return $this->genSerial();

        // $last = Serial::latest();
        $last = Serial::all()->last();
        if(!$last){
            $sNumber = 0;
        }else{
        $sNumber = $last->serialNumber;
        }
        $count = 200;
        $size =12;
        $append = '202';
        $appendNo = '10';
        $serials = [];
        for($i = 0; $i < $count; $i++){
            $serialCode = mt_rand(1000000000, 9999999999);
            // $serialCode = strtoupper(substr(md5(time().rand(10000,99999)), 0, $size));
            $serialArr['serialCode'] = intval($append.$serialCode);
            $serialArr['serialNumber'] = $i + $sNumber + 1;
            array_push($serials, $serialArr);
            
        }
        // return $serials;
        $serialEntry = Serial::insert($serials);
        if($serialEntry){
            return 'Serials generated succesfully';
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
        $check = Serial::where('serialCode',$request->serialCode)->where('serialNumber',$request->serialNumber)->first();
        if(!$check){
            return 'Please re-enter the serial correctly';
        }

        if($check->checked){
            return 'serial number already used';
        }

        if(!$check->checked){
            // return 'serial success';
            $check->checked = true;
            $save = $check->save();
            if($save){
                return 'saved succesfully';
            }
        }else{
            return 'Serial was already verfied';
        }

        return $check;
        return $request;
        return 'check serial codes';
    }

    

}

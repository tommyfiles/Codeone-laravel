<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;


class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        foreach ($this->employeesdata() as $index => $value) {
     
            \DB::table('employees')->insert([
                "salutation" => $value['salutation'] ,
                "fname" => $value['fname'] ,
                "lname" =>  $value['lname'] ,
                "suffixes" =>  $value['suffixes'] ,
                "companyid" =>  $value['companyid'],
                "username" =>  $value['username'],
                "email" =>  $value['email'],
                "phone" =>  $value['phone']
                ]); 


       }
    }
    public function employeesdata(){
        
        $data = Http::get('https://jsonplaceholder.typicode.com/users')->json();
        $res = [];
        foreach ($data as $index => $value) {
            $name= explode(" ", $value['name']);
            $count_temp = count($name);
            $salutation = $this->checkSalutation($name[0]);
            $fname = empty($salutation) ? $name[0] : $name[1];
            $lname =  empty($salutation) ? $name[1] : $name[2];
            $suffixes = empty($salutation)&&$count_temp>2 ?  $name[--$count_temp] : "" ;

            $res[] =[
                "salutation" => $salutation ,
                "fname" => $fname ,
                "lname" =>  $lname ,
                "suffixes" =>  $suffixes ,
                "companyid" =>  $value['id'],
                "username" =>  $value['username'],
                "email" =>  $value['email'],
                "phone" =>  $value['phone'],

            ];
        }

        return  $res;
    
    }


    private function checkSalutation($data){
        $res="";
        $salutations = array('mr','mrs','ms');
        if( in_array( str_replace(".","",strtolower($data)),$salutations ) ){
            $res = $data;
        }
        return $res;
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;


class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
     {
        //   $post = $factory( class : 'App\Company,amount:25)->create();
     //  $data[] = CompanyController::companiesdata();

       foreach ($this->companiesdata() as $index => $value) {
     
            // Company::create(array(
            //     "name"=> $value['name'],
            //     "website"=> $value['website'],
            //     "logo"=> $value['logo'],
            //     "catchPhrase"=> $value['catchPhrase'],
            //     "bs"=> $value['bs']
            // ));
            \DB::table('companies')->insert([
                ["name"=> $value['name'],
                "website"=> $value['website'],
                "logo"=> $value['logo'],
                "catchPhrase"=> $value['catchPhrase'],
                "bs"=> $value['bs']
                ]
            ]); 



       }
       
    }
    public function companiesdata(){
        $data = Http::get('https://jsonplaceholder.typicode.com/users')->json();
        $res = [];
        foreach ($data as $index => $value) {
            $res[] = [
                    "name" => $value['company']['name'],
                    "website" => $value['website'] ,
                    "logo" => $this->getCompanyLogo($value['website']),
                    "catchPhrase" => $value['company']['catchPhrase'],
                    "bs" => $value['company']['bs']
            ];
         }
         return $res;
    }


    private function getCompanyLogo($website){
       
        switch ($website) {
            case "hildegard.org":
                $res ="https://www.abtei-st-hildegard.de/wp2012/wp-content/uploads/2018/03/tuerme_rot_1-2-1.gif";
              break;
            case "ola.org":
                $res ="https://www.ola.org/sites/default/files/Wordmark-Asymmetrical-Colour_English1x.jpg";
              break;
            case  "conrad.com":
                $res ="https://electronic-info.eu/foto/logo-7678.jpg";
              break;       
            default:
              $res ="";
          }

        return $res;
    }
}

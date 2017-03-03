<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\Network\Exception\HttpException;

/**
 * Play shell command.
 */
class PlayShell extends Shell
{

    public function go()
    {
        $data = ["food", "attention", "knowledge"];

        for ($i = 0; $i<3; $i++){
            foreach ($data as $d){

                $lng = 19;
                if($d == 'food'){
                    $lng = 14;
                }

                $json = json_encode(['bar' => $d]);
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.kamergotchi.nl/game/care",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => $json,
                    CURLOPT_HTTPHEADER => array(
                        "cache-control: no-cache",
                        "content-length: $lng",
                        "content-type: application/json",
                        "postman-token: 9f141bc4-5d3a-a72c-28f3-da91ecf80c14",
                        "x-player-token: android:595056988663d8be"
                    ),
                ));
                $response = curl_exec($curl);
                curl_close($curl);
                debug($response);
            }
        }



    }

    public function test(){

        $json = json_encode(["bar" => trim("attention")]);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.kamergotchi.nl/game/care",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $json,
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-length: 19",
                "content-type: application/json",
                "postman-token: 21ae1ebc-7c61-74e3-bedb-99973ab631ad",
                "x-player-token: android:595056988663d8be"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        debug($response);
        debug($err);
    }
}

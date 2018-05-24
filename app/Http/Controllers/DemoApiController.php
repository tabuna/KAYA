<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class DemoApiController extends Controller
{

    /**
     *
     */
    public function index()
    {
        return view('demo');
    }


    /**
     * @param Request $request
     * @return Request
     */
    public function send(Request $request)
    {
        $faker = \Faker\Factory::create();

        $message = [
            'user'     => [
                'name'        => $faker->firstName,
                'lastName'         => $faker->lastName,
                'address'          => [
                    'streetAddress' => $faker->streetAddress,
                    'city'          => $faker->city,
                    'country'       => $faker->country,
                    'postcode'      => $faker->postcode,
                ],
                'creditCardNumber' => $faker->creditCardNumber,
            ],
            'company'  => [
                'company'       => $faker->company,
                'companyEmail'  => $faker->companyEmail,
                'companySuffix' => $faker->companySuffix,
            ],
            'hardware' => [
                'macAddress'   => $faker->macAddress,
                'userAgent'    => $faker->userAgent,
                'languageCode' => $faker->languageCode,
                'latitude'     => $faker->latitude,
            ],
        ];

        try {
            $result = file_get_contents('https://kaya.orchid.software/api/logs', false, stream_context_create([
                'http' => [
                    'method'  => 'POST',
                    'header'  => 'Content-type: application/x-www-form-urlencoded',
                    'content' => http_build_query([
                        'name'    => $request->get('name'),
                        'message' => json_encode($message),
                        'token'   => $request->get('token'),
                    ]),
                ],
            ]));
        }catch (\Exception $exception){
            $result =  $exception->getMessage();
        }

        return redirect()->back()
            ->withInput([
                'name' => $request->get('name'),
                'token' => $request->get('token'),
            ])
            ->withErrors([
            'response' => $result,
        ]);
    }
}

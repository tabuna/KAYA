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

        $result = file_get_contents(route('api.logs.write'), false, stream_context_create([
            'http' => [
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => http_build_query([
                    'name'    => $request->get('name'),
                    'message' => $message,
                    'token'   => $request->get('token'),
                ]),
            ],
        ]));

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

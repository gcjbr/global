<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Http\Transformers\PersonTransformer;
use Illuminate\Support\Facades\DB;

class PersonController extends Controller
{



    /**
     * Create a random new user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $person = Http::get('https://pipl.ir/v1/getPerson')->collect()->all()['person'];

        $image = file_get_contents('https://robohash.org/' . $person['personal']['name']);
        $filename = rand().'-'.$person['online_info']['password_md5'].'.png';

        Storage::put('public/avatars/'.$filename, $image);
        

        $new_person = Person::create(
            [
                'name' => $person['personal']['name'],
                'last_name' => $person['personal']['last_name'],
                'age' => $person['personal']['age'],
                'gender' => $person['personal']['gender'],
                'country' => $person['personal']['country'],
                'avatar' => "avatars/$filename"
            ]
        );


        return fractal($new_person, new PersonTransformer);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        return fractal($person, new PersonTransformer);
    }
    
    /**
     * Display the top 10 newest people.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function newest()
    {
        $people = Person::limit(10)->orderBy('created_at', 'desc')->get();
        return fractal()->collection($people)->transformWith(new PersonTransformer)->toArray();
    }
    
    
    /**
     * Display the statistics
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function statistics()
    {
        $data = DB::select("SELECT 
        COUNT(*) as total_people, 
        AVG(age) as avg_age, 
        COUNT(case when gender = 'Female' then 1 end) as total_women,
        COUNT(case when gender = 'Male' then 1 end) as total_men
        FROM people")[0];

        $countries = DB::select("SELECT DISTINCT country FROM people ORDER BY country");
        $data_countries = [];
        
        foreach ($countries as $c) {
            array_push($data_countries, $c->country);
        }


        $data = [
            'total_people' => $data->total_people,
            'total_women' => $data->total_women,
            'total_men' => $data->total_men,
            'average_age' => $data->avg_age,
            'countries' => $data_countries
        ];


        return response()->json($data);
    }
}

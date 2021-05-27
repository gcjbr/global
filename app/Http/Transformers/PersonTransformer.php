<?php
namespace App\Http\Transformers;

use App\Models\Person;
use League\Fractal\TransformerAbstract;

class PersonTransformer extends TransformerAbstract
{
    public function transform(Person $person)
    {
        return [
        'name' => $person->name,
        'last_name' => $person->last_name,
        'age' => $person->age,
        'gender' => $person->age,
        'country' => $person->country,
        'avatar' => asset($person->avatar)
      ];
    }
}

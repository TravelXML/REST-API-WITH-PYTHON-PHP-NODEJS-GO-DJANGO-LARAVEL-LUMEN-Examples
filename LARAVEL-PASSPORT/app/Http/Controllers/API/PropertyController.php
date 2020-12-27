<?php 
namespace App\Http\Controllers\API;

use App\Property;
use App\Http\Controllers\Controller;
use App\Http\Resources\PropertyResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $propertys = Property::all();
        return response([ 'property' => PropertyResource::collection($propertys), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'property_name' => 'required|unique:properties|max:255',
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'country' => 'required|max:255',
            'type' => 'required|max:255',
            'minimum_price' => 'required',
            'maximum_price' => 'required',
            'ready_to_sell' => 'required'
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $property = Property::create($data);

        return response([ 'property' => new PropertyResource($property), 'message' => 'Property Created Successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        return response([ 'property' => new PropertyResource($property), 'message' => 'Retrieved Successfully'], 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {

        $property->update($request->all());

        return response([ 'property' => new PropertyResource($property), 'message' => 'Property Updated Successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Property $property
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Property $property)
    {
        $property->delete();

        return response(['message' => 'Property Deleted Successfully']);
    }
}

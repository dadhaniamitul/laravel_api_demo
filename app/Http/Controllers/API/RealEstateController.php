<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\RealEstateEntity;
use Jekk0\laravel\Iso3166\Validation\Rules\Iso3166Alpha2;
use App\Rules\BathroomValidator;

class RealEstateController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $realEstateEntities = RealEstateEntity::select("id", "name", "real_state_type", "city", "country")->paginate(10);
        return response()->json([
            'status'  => true,
            'message' => 'Real estate entity list',
            'data'    => $realEstateEntities
        ], 200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:128',
            'real_state_type' => 'required|string|in:house,department,land,commercial_ground',
            'street' => 'required|max:128',
            'external_number' => 'required|regex:/^[A-Za-z0-9-]+$/|max:12',
            'internal_number' => 'required_if:real_state_type,department,commercial_ground|regex:/^[A-Za-z0-9-\s]+$/',
            'neighborhood' => 'required|string|max:128',
            'city' => 'required|string|max:64',
            'country' => ['required', new Iso3166Alpha2()],
            'rooms' => 'required|numeric',
            'bathrooms' => ['required','numeric','min:0', new BathroomValidator($request->post('real_state_type'))],
            'comments' => 'max:128',
        ]);

        if($validator->fails()){
            return response()->json([
                'status'  => false,
                'message' => 'Validation errors',
                'data'    => $validator->errors()
            ]);       
        }

        $realEstateEntity = new RealEstateEntity;
        $realEstateEntity->name = $request->name;
        $realEstateEntity->real_state_type = $request->real_state_type;
        $realEstateEntity->street = $request->street;
        $realEstateEntity->external_number = $request->external_number;
        $realEstateEntity->internal_number = $request->internal_number;
        $realEstateEntity->neighborhood = $request->neighborhood;
        $realEstateEntity->city = $request->city;
        $realEstateEntity->country = $request->country;
        $realEstateEntity->rooms = $request->rooms;
        $realEstateEntity->bathrooms = $request->bathrooms;
        $realEstateEntity->comments = $request->comments;
        $realEstateEntity->save();
        
        return response()->json([
            'status' => true,
            'message' => 'Real estate entity created successfully'
        ], 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (RealEstateEntity::where('id', $id)->exists()) {
            $realEstateEntity = RealEstateEntity::find($id);
            return response()->json([
                'status'  => true,
                'message' => 'Real estate entity retrieved successfully',
                'data'    => $realEstateEntity
            ], 200);
        }
        else{
            return response()->json([
                'status' => false,
                'message' => 'Real estate entity not found'
            ], 404);
        }
    }
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:128',
            'real_state_type' => 'required|string|in:house,department,land,commercial_ground',
            'street' => 'required|max:128',
            'external_number' => 'required|regex:/^[A-Za-z0-9_]+$/|max:12',
            'internal_number' => 'required_if:real_state_type,department,commercial_ground',
            'neighborhood' => 'required|string|max:128',
            'city' => 'required|string|max:64',
            'country' => ['required', new Iso3166Alpha2()],
            'rooms' => 'required|numeric',
            'bathrooms' => ['required','numeric','min:0', new BathroomValidator($request->post('real_state_type'))],
            'comments' => 'max:128',
        ]);

        if($validator->fails()){
            return response()->json([
                'status'  => false,
                'message' => 'Validation errors',
                'data'    => $validator->errors()
            ]);       
        }

        if (RealEstateEntity::where('id', $id)->exists()) {
            $realEstateEntity = RealEstateEntity::find($id);
            $realEstateEntity->name = $request->name;
            $realEstateEntity->real_state_type = $request->real_state_type;
            $realEstateEntity->street = $request->street;
            $realEstateEntity->external_number = $request->external_number;
            $realEstateEntity->internal_number = $request->internal_number;
            $realEstateEntity->neighborhood = $request->neighborhood;
            $realEstateEntity->city = $request->city;
            $realEstateEntity->country = $request->country;
            $realEstateEntity->rooms = $request->rooms;
            $realEstateEntity->bathrooms = $request->bathrooms;
            $realEstateEntity->comments = $request->comments;
            $realEstateEntity->save();
            
            return response()->json([
                'status' => true,
                'message' => 'Real estate entity updated successfully'
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => 'Real estate entity not found'
            ], 404);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        if (RealEstateEntity::where('id', $id)->exists()) {
            RealEstateEntity::find($id)->delete();
            return response()->json([
                'status' => false,
                'message' => 'Real estate entity deleted successfully'
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => 'Real estate entity not found'
            ], 404);
        }
    }
}

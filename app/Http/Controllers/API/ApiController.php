<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Api;
use Validator;
use App\Http\Resources\Api as ApiResource;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $epresencess = Api::all();
    
        return $this->sendResponse(ApiResource::collection($epresencess), 'Apis retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'id_user' => 'required',
            'type' => 'required',
            'is_approve' => 'required',
            'waktu' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $epresencess = Api::create($input);
   
        return $this->sendResponse(new ApiResource($epresencess), 'Api created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $epresences = Api::find($id);
  
        if (is_null($api)) {
            return $this->sendError('Api not found.');
        }
   
        return $this->sendResponse(new ApiResource($epresences), 'Api retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Api $api)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'id_user' => 'required',
            'type' => 'required',
            'is_approve' => 'required',
            'waktu' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $api->name = $input['name'];
        $api->detail = $input['detail'];
        $api->save();
   
        return $this->sendResponse(new ProductResource($api), 'Product updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Api $api)
    {
        $api->delete();
   
        return $this->sendResponse([], 'Product deleted successfully.');
    }
}

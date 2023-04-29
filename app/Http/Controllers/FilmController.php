<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use App\Models\Film;
use App\Helpers\ApiFormatter;
use Exception;
class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $films = Film::all();
        // return FilmResource::collection($films);

        if($films) {
            return ApiFormatter::createApi(200, 'OK', $films);
        } else {
            return ApiFormatter::createApi(404, 'Data not Found');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'genre' => 'required',
            'film_image' => 'required',
            'rating' => 'required',
            'description' => 'required',
        ]);

        $films = Film::create($request->all());
        
        if($films) {
            return ApiFormatter::createApi(200, 'OK', $films);
        } else {
            return ApiFormatter::createApi(404, 'Data not Found');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $films = Film::findOrFail($id);
        
        if($films) {
            return ApiFormatter::createApi(200, 'OK', $films);
        } else {
            return ApiFormatter::createApi(404, 'Data not Found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $validated = $request->validate([
            'title' => 'required',
            'genre' => 'required',
            'film_image' => 'required',
            'rating' => 'required',
            'description' => 'required',
        ]);

        $films = Film::findOrFail($id);
        $films->update($request->all());

        if($films) {
            return ApiFormatter::createApi(200, 'OK', $films);
        } else {
            return ApiFormatter::createApi(404, 'Data not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $films = Film::findOrFail($id);
        $films->delete();
        
        if($films) {
            return ApiFormatter::createApi(200, 'OK', $films);
        } else {
            return ApiFormatter::createApi(404, 'Data not Found');
        }
    }
}
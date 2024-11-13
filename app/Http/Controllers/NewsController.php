<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Validator;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::all();

		if ($news->isEmpty()) {
			return response()->json([
				'message' => 'news not found',
				'data' => $news,
            ], 200);
        }
        return response()->json([
            'massege' => 'Succesfully view all news',
            'data' => $news
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'content' => 'required',
            'url' => 'required',
            'url_image' => 'required',
            'published_at' => 'detime|required',
            'category' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'massege' => 'Succesfully view all news',
                'error' => $validator->errors()
            ], 422);
        }

        $data = News::create($request->all());

        $data = [
            'massege' => 'Succesfully view all news',
            'data' => $data
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

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

        // jika data tidak ada
		if ($news->isEmpty()) {
			return response()->json([
				'message' => 'Data is Empity',
				'data' => $news,
            ], 200);
        }

        // jika data di temukan
        return response()->json([
            'massege' => 'Get All Resource',
            'data' => $news
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // memvalidasi data
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'content' => 'required',
            'url' => 'required',
            'url_image' => 'required',
            'published_at' => 'required | date',
            'category' => 'required',
        ]);

        // jika data tidak ditemukan
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 422);
        }

        // jika data ditemukan
        $data = News::create($request->all());
        $data = [
            'massege' => 'Resource is added succesfully',
            'data' => $data
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // cari berdasarkan id
        $news = News::find($id);

        if ($news) {
            $data = [
                'message' => 'Get detail Resource',
                'data' => $news,
            ];

           
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Resource not found',
            ];

            
            return response()->json($data, 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $news = news::find($id);

        // memvalidasi data 
        if ($news) {
            $news->update([
                'title' => $request->title ?? $news->title,
                'author' => $request->author ?? $news->author,
                'description' => $request->description ?? $news->description,
                'content' => $request->content ?? $news->content,
                'url' => $request->url ?? $news->url,
                'url_image' => $request->url_image ?? $news->url_image,
                'published_at' => $request->published_at ?? $news->published_at,
                'category' => $request->category ?? $news->category
            ]);

            // jika data berhasil
            $data = [
                'message' => 'Resource is update Succesfully',
                'data' => $news 
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                // jika data tidak ada
                'message' => 'resource not found',
            ];

            return response()->json($data, 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news = News::find($id);

        if ($news) {
            $news->delete();

            // jika berhasil menghapus data
            $data = [
                'message' => 'Resource is delete Succesfully',
                'data' => $news
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Resource not found',
            ];

            return response()->json($data, 400);
        }
    }

    public function search($title)
{
    // Cari berita by title
    $news = News::where('title', 'like', '%' . $title . '%')->get();

    // Jika tidak ada berita yang ditemukan
    if ($news->isEmpty()) {
        return response()->json([
            'message' => 'Resource not found'
        ], 404);
    }

    // Jika ditemukan, kembalikan hasil pencarian
    return response()->json([
        'message' => 'Get Searched Resource',
        'data' => $news
    ], 200);
}
    public function sport()
    {
        // mecari data sesuai dengan kategori sport
    $News = News::where('category', 'sport')->get();

    if ($News->isEmpty()) {
        return response()->json(['message' => 'Sport Resource not found'], 404);
    }

    return response()->json([
        'message' => 'Get sport Resource',
        // untuk menghitung semua resource sport
        'total' => $News->count(),
        'data' => $News
    ]);
    }

    public function finance()
    {

        // mencari data sesuai dengan kategori finance
    $News = News::where('category', 'finance')->get();

    if ($News->isEmpty()) {
        return response()->json(['message' => 'Finance Resource not found'], 404);
    }

    return response()->json([
        'message' => 'Get finance resource',
        // untuk menghitung semua finance resource
        'total' => $News->count(),
        'data' => $News
    ]);
    }

    public function automotive()
    {

        // mencari data untuk kategori automotive
    $News = News::where('category', 'automotive')->get();

    if ($News->isEmpty()) {
        return response()->json(['message' => 'resource not found'], 404);
    }

    return response()->json([
        'message' => 'Get Aoutomotive Resource',
        'total' => $News->count(),
        'data' => $News
    ]);
    }

}

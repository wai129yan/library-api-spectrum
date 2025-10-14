<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::withCount('books')->paginate(10);
        // $authors = Author::with('books')->paginate(10);
        return AuthorResource::collection($authors)
            ->additional(["message" => 'Authors Fetched with success']);

        // // eager loading ကို သုံးပြီး books count ကို API ထဲမှာ ထုတ်ပြတယ်
        // // $authors = Author::paginate(10);
        // return response()->json([
        //     "authors" => $authors,
        //     "message" => 'Authors Fetched with success'
        // ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuthorRequest $request)
    {
        $author = Author::create($request->validated());

        return new AuthorResource($author);

        //way of simple json response
        // return response()->json([
        //     "author" => $author,
        //     "message" => 'Author Created with success'
        // ], 201);



        //Normal way
        // $author = Author::create([
        //     'name' => $request->name,
        //     'bio'  => $request->bio,
        //     'nationality' => $request->nationality
        // ]);
        // return response()->json([
        //     "author" => $author,
        //     "message" => 'Author Created with success'
        // ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $author = Author::find($id);
        if (!$author) {
            return response()->json([
                "message" => 'Author not found'
            ], 404);
        }
        return new AuthorResource($author);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAuthorRequest $request, Author $author)
    {
        $author->update($request->validated());
        return new AuthorResource($author);//go back to resource
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $author->delete();
        return response()->json([
            "message" => 'Author Deleted with success'
        ], 200);
    }
}

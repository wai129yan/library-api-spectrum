<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('author')->paginate(10);
        return BookResource::collection($books);







        //traditonal way
        // $books = Book::all();
        // return response()->json([
        //     "books" => $books,
        //     "message" => 'Books Fetched with success'
        // ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $book = Book::create($request->validated());
        $book->load('author');
        return (new BookResource($book))
            ->additional(['message' => 'Book created successfully']);
    }

    /**
     * Display the specified resource.
   */

//         // $book->load('author'); //to ask
//         // return new BookResource($book);
//         // $book->load('author');

//         // //try catch
    public function show($id)
    {
        try {
            $book = Book::findOrFail($id);
            $book->load('author');
            return (new BookResource($book))
                ->additional(['message' => 'Book retrieved successfully']);
        } catch (\Exception $th) {
            return response()->json([
                'status' => false,
                'message' => 'The Book is not found'
            ], 404);
        }
    }

//     /**
//      * Update the specified resource in storage.
//      */
    public function update(StoreBookRequest $request, Book $book)
    {
        $book->update($request->validated());
        $book->load('author');
        return new BookResource($book);
    }

//     /**
//      * Remove the specified resource from storage.
//      */
    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json([
            "status" => true,
            "message" => 'Book deleted successfully!'
        ], 200);
    }
}

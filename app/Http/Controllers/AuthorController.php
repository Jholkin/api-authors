<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function showAllAuthors(Request $request)
    {
        //$authors = \DB::table('authors')->paginate(10);
        return $request->isJson() ? response()->json(Author::paginate(15), 200)
                                    : response()->json(['error' => 'Unauthorized'], 401, []);
    }

    public function showOneAuthor(Request $request, $id)
    {
        return $request->isJson() ? response()->json(Author::findOrFail($id), 200)
                                    : response()->json(['error' => 'Unauthorized'], 401, []);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:authors',
            'location' => 'required|alpha'
        ]);

        $author = Author::create($request->all());

        return response()->json($author, 201);
    }

    public function update($id, Request $request)
    {
        $author = Author::findOrFail($id);
        $author->update($request->all());

        return response()->json($author, 200);
    }

    public function delete($id)
    {
        Author::findOrFail($id)->delete();

        return response()->json('Deleted Successfully', 200);
    }
        
}
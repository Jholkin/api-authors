<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AuthorController extends Controller
{
    public function showAllAuthors(Request $request)
    {
        //$authors = \DB::table('authors')->paginate(10);
        //Cache::put('prueba', 'esto es un dato en cache');
        //var_dump(Cache::get('prueba'));
        //return response()->json(Author::paginate(10), 200);/*
        //var_dump($request->isJson());exit();
        return $request->isJson() ? response()->json(Author::paginate(15), 200)
                                    : response()->json(['error' => 'Unauthorized dx'], 401, []);
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
<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Book;
use App\Mybook;

class MybookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->id;
        $mybooks = Mybook::where('user_id', $user)
               ->get();


 
         
     $books=Book::all();
     
        return view('mybooks.index' , compact('books','mybooks'));
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
        $user = Auth::user()->id;
        
        $mybook = Mybook::create([
                'user_id'         => $user,                
                'book_id'     => $request['book_id'], 
               
                
            ]);
        
       
           return redirect()->route('mybooks.index')->withSuccess('New Book Successfully Created');        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mybook =Mybook::findOrFail($id);
        return view('mybooks.edit', compact('mybook'));
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
        $mybook = Mybook::findOrFail($id);
        $mybook->speed         = $request['speed'];                
        $mybook->pages_read      = $request['pages_read'];
        
        
        $mybook->save();
                       
        return redirect()->route('mybooks.index')->withSuccess('New Book Info is Added');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mybook = Mybook::find($id);
        $mybook->delete();
        return redirect()->route('mybooks.index')->withSuccess('BOOK deleted');
    }
}

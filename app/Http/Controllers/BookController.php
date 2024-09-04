<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function books(Request $request){

        $books = Book::latest('id');

        if(!empty($request->keyword)){
            $books->where(function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->keyword . '%')
                      ->orWhere('author', 'like', '%' . $request->keyword . '%')
                      ->orWhere('publisher', 'like', '%' . $request->keyword . '%');
            });
        }

        $books =$books->paginate(7);

        return view('book.book', compact('books'));
    }

    public function add_book(){
        return view('book.create');
    }
    public function edit_book($id,Request $request){
        $book=Book::find($id);

        if(empty($book)){
            session()->flash('errors','Book Not Found');
            return redirect()->route('books');
        }
        return view('book.edit',compact('book'));
    }

    public function add_book_process(Request $request){

        $validator=Validator::make($request->all(),[
            'title'=>'required',
            'author'=>'required',
            'publisher'=>'required',
            'year'=>'required'
        ]);

        if($validator->fails()){

            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors()
            ]);
        }else{

            $book=new Book();
            $book->title=$request->title;
            $book->author=$request->author;
            $book->publisher=$request->publisher;
            $book->Year_published=$request->year;
            $book->save();

            session()->flash('success','Book Added Successfully');
            return response()->json([
                'status'=>true,
                'message'=>'Book Added Successfully'
            ]);
        }
    }

    public function update_book($id,Request $request){

        $book=Book::find($id);

        if(empty($book)){
            session()->flash('errors','Book Not Found');
            return response()->json([
                'status'=>true,
            ]);
        }

        $validator=Validator::make($request->all(),[
            'title'=>'required',
            'author'=>'required',
            'publisher'=>'required',
            'year'=>'required'
        ]);

        if($validator->fails()){

            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors()
            ]);
        }else{
            $book->title=$request->title;
            $book->author=$request->author;
            $book->publisher=$request->publisher;
            $book->Year_published=$request->year;
            $book->save();

            session()->flash('success','Book Updated Successfully');
            return response()->json([
                'status'=>true,
                'message'=>'Book Updated Successfully'
            ]);
        }

    }

    public function delete_book($id,Request $request){

        $book=Book::find($id);

        if(empty($book)){
            session()->flash('errors','Book Not Found');
            return response()->json([
                'status'=>true,
            ]);
        }

        $book->delete();

        session()->flash('success','Book Deleted Successfully');

        return response()->json([
            'status'=>true,
            'message'=>'Book Deleted Successfully'
        ]);
    }

}

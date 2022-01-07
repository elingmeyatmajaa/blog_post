<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\post;
use Illuminate\Support\Str;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $post = post::select('id', 'judul', 'sampul','slug')->latest()->paginate(10);
        return view('post/index', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('post/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'judul' => 'required',
            'sampul' => 'required|mimes:jpg,bmp,png',
            'konten' => 'required',
        ]);


        

        $sampul = time() . '-' .$request->sampul->getClientOriginalName();
        $request->sampul->move('upload/post', $sampul);

        post::create([
            
            'judul' => $request->judul,
            'sampul' => $sampul,
            'konten' => $request->konten,
            'slug' => Str::slug($request->judul, '-'),

        ]);
        
        $request->session()->flash('sukses', '
            <div class="alert alert-success" role="alert">
                Data berhasil ditambahkan
            </div>
        ');

        return redirect('/post');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

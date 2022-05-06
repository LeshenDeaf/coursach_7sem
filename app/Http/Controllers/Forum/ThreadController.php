<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Forum\Category;
use App\Models\Forum\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function index()
    {
        $threads = Thread::orderBy('id', 'desc')->get();
        $categories = Category::all();

        return view('home.forum.index', compact('threads', 'categories'));
    }

    public function categoryIndex(string $categorySlug)
    {
        $threads = Category::where('slug', $categorySlug)->firstOrFail()->threads;
        $categories = Category::all();

        return view('home.forum.index', compact('threads', 'categories'));
    }

    public function addressIndex(int $addressId)
    {
        $threads = Thread::where('address_id', $addressId)->get();
        $categories = Category::all();

        return view('home.forum.index', compact('threads', 'categories'));
    }

    public function searchByAddress(string $address)
    {
        $address = Address::where('address', $address)->firstOrFail();

        $threads = Thread::where('address_id', $address->id)->get();
        $categories = Category::all();

        return view('home.forum.index', compact('threads', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('home.forum.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // $trimmed = preg_replace("/\n{2,}/", "\n\n", preg_replace('/\ +/', ' ', $text));

        $request->validate([
            'title' => ['string', 'max:128', 'required', 'min:6'],
            'text' => ['string', 'max:8192', 'required', 'min:6'],
            'addresses' => ['array', 'min:1', 'max:256'],
            'addresses.*' => ['string', 'max:512'],
            'category' => ['string', 'required'],
        ]);

        if (!($category = Category::where('slug', $request->input('category'))->first())) {
            return redirect()->back()->with('error', 'Category does not exist')->withInput();
        }

        if (!($title = clear_extra_spaces($request->input('title')))) {
            return redirect()->back()->with('error', 'Title is empty')->withInput();
        }

        if (!($text = clear_extra_spaces($request->input('text')))) {
            return redirect()->back()->with('error', 'Text is empty')->withInput();
        }

        $addressIds = [];

        foreach ($request->input('addresses') as $address) {
            if (!($addressId = Address::getOrCreate($address))) {
                return redirect()->back()->with('error', 'Address does not exist')->withInput();
            }

            $addressIds[] = $addressId;
        }

        $thread = Thread::create([
            'title' => $title,
            'text' => $text,
            'category_id' => $category->id,
            'address_id' => $addressIds[0],
            'user_id' => auth()->id()
        ]);

        return redirect(route('home.forum.show', $thread->slug))->with('success', 'Thread created!');
    }

    public function show(string $slug)
    {
        $thread = Thread::where('slug', $slug)->firstOrFail();

        return view('home.forum.show', compact('thread'));
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

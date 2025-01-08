<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use Illuminate\Support\Facades\Auth;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faq::orderBy('id', 'asc')->get();
        $search = [];
        if (request()->has('question') && request()->get('question') != '') {
            $searchTerms = request()->question;
            $search['question'] = $searchTerms;
            $faqs->where('question', 'like', '%' . $searchTerms . '%');
        }
        $data = [
            'page_question' => 'FAQs',
            'page_title' => 'FAQs',
            'search' => $search,
            'faqs' => $faqs,
        ];
        return view('admin.faqs.index', $data);
    }

    public function faq_guest()
    {
        $faqs = Faq::orderBy('id', 'asc')->get();
        $data = [
            'page_question' => 'FAQs',
            'page_title' => 'FAQs',
            'faqs' => $faqs,
        ];
        return view('website.faqs', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data = [
            'page_question' => 'FAQs',
            'page_title' => 'Create FAQ',
        ];
        return view('admin.faqs.create', $data);
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
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);
        Faq::create(
            [
                'question' => $request->question,
                'answer' => $request->answer,
                'user_id' => Auth::id(),
            ]
        );
        session()->flash('alert_message', ['message' => 'New Question has been added successfully', 'icon' => 'success']);
        return redirect()->route('faqs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        $data = [
            'page_question' => 'FAQs',
            'page_title' => 'Edit FAQs question',
            'faq' => $faq,
        ];
        return view('admin.faqs.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);
        $faq->update(['question' => $request->question, 'answer' => $request->answer]);
        session()->flash('alert_message', ['message' => 'The FAQ has been updated successfully', 'icon' => 'success']);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();
        session()->flash('alert_message', ['message' => 'The Question has been deleted successfully', 'icon' => 'success']);
        return redirect()->route('faqs.index');
    }
}

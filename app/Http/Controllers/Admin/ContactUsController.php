<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Auth;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = ContactUs::orderBy('id', 'asc')->get();
        $search = [];
        if (request()->has('name') && request()->get('name') != '') {
            $searchTerms = request()->name;
            $search['name'] = $searchTerms;
            $contacts->where('name', 'like', '%' . $searchTerms . '%');
        }
        $data = [
            'page_name' => 'Contact Us',
            'page_title' => 'Contact Us',
            'search' => $search,
            'contacts' => $contacts,
        ];
        return view('admin.contact_us.index', $data);
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
        if (Auth::check()) {
            $request->validate([
                'description' => 'required|string',
            ]);
            ContactUs::create(
                [
                    'name' => auth()->user()->first_name . ' ' . auth()->user()->last_name,
                    'mobile' => auth()->user()->employee_profile->phone,
                    'email' => auth()->user()->email,
                    'description' => $request->description,
                ]
            );
        } else {
            $request->validate([
                'name' => 'required|string',
                'mobile' => 'nullable|digits:11',
                'email' => 'email:rfc,dns',
                'description' => 'required|string',
                'g-recaptcha-response' => 'recaptcha',
            ]);
            ContactUs::create(
                [
                    'name' => $request->name,
                    'mobile' => $request->mobile,
                    'email' => $request->email,
                    'description' => $request->description,
                ]
            );
        }
        session()->flash('alert_message', ['message' => 'Your Inquery has been sent to Egy Finance Jobs team, Thank You!', 'icon' => 'success']);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function show(ContactUs $contactUs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactUs $contactU)
    {

        $data = [
            'page_question' => 'Contact Us',
            'page_title' => 'Reply Inquery',
            'contact' => $contactU,
        ];
        return view('admin.contact_us.reply', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactUs $contactU)
    {
        $request->validate([
            'reply' => 'required|string',
        ]);
        $contactU->update(['reply' => $request->reply, 'user_id' => Auth::id()]);
        session()->flash('alert_message', ['message' => 'The Inquery has been updated successfully', 'icon' => 'success']);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactUs $contactU)
    {
        $contactU->delete();
        session()->flash('alert_message', ['message' => 'The Inquery has been deleted successfully', 'icon' => 'success']);
        return redirect()->route('contact_us.index');
    }
}

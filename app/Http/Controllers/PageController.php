<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Form;
use App\Models\Page;
use App\Models\Product;
use App\Models\Region;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\IpUtils;

class PageController extends Controller
{
    public function stock()
    {
        $products = Product::orderBy('created_at', 'DESC')->get();
        $categories = Category::orderBy('sort', 'ASC')->get();
        return view('pages.stock', compact('products', 'categories'));
    }

    public function about()
    {
        $page = Page::where('id', 11)->firstOrFail();
        return view('pages.about', compact('page'));
    }

    public function contacts()
    {
        $contacts = Contact::get();
        return view('pages.contacts', compact('contacts'));
    }

    public function search()
    {
        $title = $_GET['search'];
        $search = Product::query()
            ->where('title', 'like', '%' . $title . '%')
            ->get();
        return view('search', compact('search'));
    }

    public function contactpage()
    {
        return view('pages.form');
    }

    public function contactform(Request $request) : RedirectResponse
    {
        $params = $request->all();
        Form::create($params);
        $recaptcha_response = $request->input('g-recaptcha-response');
        if (is_null($recaptcha_response)) {
            return redirect()->back()->with('status', 'Please Complete the Recaptcha to proceed');
        }
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $body = [
            'secret' => config('services.recaptcha.secret'),
            'response' => $recaptcha_response,
            'remoteip' => IpUtils::anonymize($request->ip()) //anonymize the ip to be GDPR compliant. Otherwise just pass the default ip address
        ];
        $response = Http::asForm()->post($url, $body);
        $result = json_decode($response);

        if ($response->successful() && $result->success == true) {
            Mail::to('info@wonwookorea.com')->send(new ContactMail($request));
            session()->flash('success', 'Ваша заявка отправлена!');
        } else {
            return redirect()->back()->with('status', 'Please Complete the Recaptcha Again to proceed');
        }

        return back();
    }

    public function policy()
    {
        $page = Page::where('id', 8)->first();
        return view('pages.policy', compact('page'));
    }

    public function oferta()
    {
        $page = Page::where('id', 10)->first();
        return view('pages.oferta', compact('page'));
    }

    public function dogovor()
    {
        $page = Page::where('id', 13)->first();
        return view('pages.dogovor', compact('page'));
    }

    public function fetchState(Request $request)
    {
        $data['states'] = Region::where("country_id", $request->country_id)->get(["title", "id"]);
        return response()->json($data);
    }

    public function failure_page()
    {
        return view('pages.failure');
    }

    public function check_page()
    {
        return view('pages.check');
    }

    public function state_page()
    {
        return view('pages.state');
    }

    public function success_page()
    {
        return view('pages.success');
    }

}
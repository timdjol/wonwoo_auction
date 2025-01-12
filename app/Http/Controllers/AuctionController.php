<?php

namespace App\Http\Controllers;

use App\Mail\AuctionMail;
use App\Mail\ShopMail;
use App\Models\Auction;
use App\Models\Contact;
use App\Models\Form;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class AuctionController extends Controller
{
    public function index($id)
    {
        $product = Product::where('id', $id)->get();
        return view('pages.auction', compact('id', 'product'));
    }

    public function store(Request $request, Order $order)
    {
        $params = $request->all();
        Order::create($params);
        Auction::create($params);
        //session()->flash('success', 'Ваша ставка выставлена на сумму ' . $request->sum . 'сом');
        return back();
    }

    public function sales()
    {
        $contacts = Contact::first();
        $date = Carbon::parse($contacts->date_auc);
        $cars = Product::where('dateLot', $date->format('Y-m-d'))->where('status', 1)->orderBy('lot', 'asc')->get();
        $users = User::whereBetween('last_seen', [now()->subMinute(5), now()])->where('status', 1)->get();

        return view('pages.sales', compact('cars', 'users', 'contacts'));
    }

    public function listings()
    {
        $contacts = Contact::first();
        $date = Carbon::parse($contacts->date_auc);
        $cars = Product::where('dateLot', $date->format('Y-m-d'))->where('status', 1)->orderBy('lot', 'asc')->get();
        $users = User::whereTime('last_seen', '<=', Config::get('session.lifetime'))->where('status', 1)->get();
        return view('pages.listings', compact('cars', 'users'));
    }

    public function end()
    {
        DB::table('contacts')->where('id', 1)->update([
            'date_auc' => now()->addDay(7)
        ]);

        $orders = Auction::whereDate('created_at', today())->whereNot('product_id', null)->orderBy('sum', 'desc')->get()
            ->unique('product_id');
        foreach ($orders as $user){
            Mail::to($user->email)->send(new AuctionMail($user));
            //$user::latest()->skip(1)->delete();
            $user->update([
                'status' => 1,
            ]);
        }

        DB::table('orders')->truncate();

        return view('pages.end', compact('orders'));
    }

    public function pause()
    {
        $contacts = Contact::first();
        $date = Carbon::parse($contacts->date_auc);
        $cars = Product::where('dateLot', $date->format('Y-m-d'))->where('status', 1)->orderBy('lot', 'asc')->get();
        return view('pages.pause', compact('cars'));
    }

    public function pause2()
    {
        $contacts = Contact::first();
        $date = Carbon::parse($contacts->date_auc);
        $cars = Product::where('dateLot', $date->format('Y-m-d'))->where('status', 1)->orderBy('lot', 'asc')->get();
        return view('pages.pause2', compact('cars'));
    }

    public function pause3()
    {
        $contacts = Contact::first();
        $date = Carbon::parse($contacts->date_auc);
        $cars = Product::where('dateLot', $date->format('Y-m-d'))->where('status', 1)->orderBy('lot', 'asc')->get();
        return view('pages.pause3', compact('cars'));
    }

    public function pause4()
    {
        $contacts = Contact::first();
        $date = Carbon::parse($contacts->date_auc);
        $cars = Product::where('dateLot', $date->format('Y-m-d'))->where('status', 1)->orderBy('lot', 'asc')->get();
        return view('pages.pause4', compact('cars'));
    }

    public function pause5()
    {
        $contacts = Contact::first();
        $date = Carbon::parse($contacts->date_auc);
        $cars = Product::where('dateLot', $date->format('Y-m-d'))->where('status', 1)->orderBy('lot', 'asc')->get();
        return view('pages.pause5', compact('cars'));
    }

    public function pause6()
    {
        $contacts = Contact::first();
        $date = Carbon::parse($contacts->date_auc);
        $cars = Product::where('dateLot', $date->format('Y-m-d'))->where('status', 1)->orderBy('lot', 'asc')->get();
        return view('pages.pause6', compact('cars'));
    }

    public function pause7()
    {
        $contacts = Contact::first();
        $date = Carbon::parse($contacts->date_auc);
        $cars = Product::where('dateLot', $date->format('Y-m-d'))->where('status', 1)->orderBy('lot', 'asc')->get();
        return view('pages.pause7', compact('cars'));
    }

    public function pause8()
    {
        $contacts = Contact::first();
        $date = Carbon::parse($contacts->date_auc);
        $cars = Product::where('dateLot', $date->format('Y-m-d'))->where('status', 1)->orderBy('lot', 'asc')->get();
        return view('pages.pause8', compact('cars'));
    }

    public function pause9()
    {
        $contacts = Contact::first();
        $date = Carbon::parse($contacts->date_auc);
        $cars = Product::where('dateLot', $date->format('Y-m-d'))->where('status', 1)->orderBy('lot', 'asc')->get();
        return view('pages.pause9', compact('cars'));
    }

    public function sale_frame()
    {
        $cars = Product::where('dateLot', '2024-11-04')->get();
        return view('pages.sale_frame', compact('cars'));
    }

    public function orderFormBuy(Request $request)
    {
        $params = $request->all();
        Form::create($params);
        Mail::to('info@wonwookorea.com')->send(new ShopMail($request));
        session()->flash('success', 'Ваша заявка на покупку принята!');
        return back();
    }

    public function deposit()
    {
        return view('pages.deposit');
    }


    public function paybox(Request $request)
    {
        $pg_merchant_id = 554374;
        $secret_key = 'GryTvyPcUNnFozVM';

        $req = $requestForSignature = [
            'pg_order_id' => rand(0, 999999),
            'pg_merchant_id' => $pg_merchant_id,
            'pg_amount' => $request->sum,
            'pg_description' => $request->name,
            'pg_salt' => 'random wonwoo',
            'pg_currency' => 'KGS',
            'pg_check_url' => route('check_page'),
            'pg_result_url' => 'https://wonwookorea.com/result/',
            'pg_request_method' => 'POST',
            'pg_success_url' => 'https://wonwookorea.com/success?pg_description=' . $request->name . '&pg_amount='
                . $request->sum . '&pg_user_contact_email=' . $request->email . '&pg_user_phone=' .
                $request->phone . '&pg_param1=' . $request->user_id,
            'pg_failure_url' => route('failure_page'),
            'pg_success_url_method' => 'GET',
            'pg_failure_url_method' => 'GET',
            //'pg_redirect_url' => 'https://wonwookorea.com/redirect',
            //'pg_redirect_url_type' => 'payment system',
            'pg_state_url' => route('state_page'),
            'pg_state_url_method' => 'GET',
            'pg_site_url' => 'https://wonwookorea.com/return',
            //'pg_payment_system' => 'EPAYWEBKZT',
            'pg_lifetime' => '86400',
            'pg_user_phone' => $request->phone,
            'pg_user_contact_email' => $request->email,
            'pg_user_ip' => $_SERVER['REMOTE_ADDR'],
            'pg_language' => 'ru',
            'pg_testing_mode' => '1',
        ];

        /**
         * Функция превращает многомерный массив в плоский
         */
        function makeFlatParamsArray($arrParams, $parent_name = '')
        {
            $arrFlatParams = [];
            $i = 0;
            foreach ($arrParams as $key => $val) {
                $i++;
                /**
                 * Имя делаем вида tag001subtag001
                 * Чтобы можно было потом нормально отсортировать и вложенные узлы не запутались при сортировке
                 */
                $name = $parent_name . $key . sprintf('%03d', $i);
                if (is_array($val)) {
                    $arrFlatParams = array_merge($arrFlatParams, makeFlatParamsArray($val, $name));
                    continue;
                }
                $arrFlatParams += array($name => (string)$val);
            }

            return $arrFlatParams;
        }

// Превращаем объект запроса в плоский массив
        $requestForSignature = makeFlatParamsArray($requestForSignature);

// Генерация подписи
        ksort($requestForSignature); // Сортировка по ключю
        array_unshift($requestForSignature, 'payment.php'); // Добавление в начало имени скрипта
        array_push($requestForSignature, $secret_key); // Добавление в конец секретного ключа


        $req['pg_sig'] = md5(implode(';', $requestForSignature)); // Полученная подпись

        unset($req[0], $req[1]);

        $query = http_build_query($req);


        return Redirect::to('https://api.freedompay.kg/payment.php?' . $query);

    }
}

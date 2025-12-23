<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use App\Models\User;
use ConfigVariables;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\SendMail_info;
use Illuminate\Support\Carbon;
use Mpdf\Config\FontVariables;
use App\Models\InvoiceTemplate;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Models\ComplateInvoiceCount;
use App\Models\PaymentGetway;
use App\Models\Subscription;
use App\Models\SubscriptionPackage;
use App\Models\SubscriptionPackageTemplate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Mpdf\Config\ConfigVariables as ConfigConfigVariables;
use NumberFormatter;
use Spatie\Browsershot\Browsershot;

class InvoiceController extends Controller
{
    public function __construct()
    {
        session_start();
    }

    public   $template_id;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // If the user has login Start
        if (Auth::check()) {
            $data  = Invoice::where('id', 1)->get()->first();
            $user = Auth::user()->id;
            $template_id = "";
            $template_id_check = InvoiceTemplate::get()->first();
            $template_id_check = $template_id_check->templateName;

            $lastInvoice = Invoice::where('user_id', $user)->orderBy('created_at', 'desc')->get([
                'invoice_form',
                'invoice_to',
                'invoice_id',
                'id',
            ])->first();

            $text = "INVC-000";
            if ($lastInvoice != null) {
                $text = $lastInvoice->invoice_id;
            }
            $all = "";
            $lastnum = $text;
            $value = preg_match('/(\d+)\D*$/', $text, $m);
            if ($value == 1) {
                $lastnum = $m[1];
                $all = explode($lastnum, $text)[0];
                $lastnum = $lastnum + 1;
            }

            $invoiceCountNew = Invoice::where('user_id', Auth::user()->id)->count();
            $invoiceCountNew += 1;

            $invoice_template_not_com = InvoiceTemplate::where('company', 'not company')->get();

            $user_logo_terms = User::where('id', Auth::user()->id)->get([
                'invoice_logo',
                'terms',
                'signature'
            ])->first();

            $session = Session::get('session_invoice_id');

            $packages = [];
            if (Auth::check()) {
                if (Auth::user()->email === 'womenindigitalbd@gmail.com' ){
                    $packages = SubscriptionPackage::all();
                } else {
                    // $find_subscription = PaymentGetway::where('user_id', auth()->user()->id)->first();
                    // if ($find_subscription) {
                    //     // User has a subscription, show their current plan
                    //     $packages = SubscriptionPackage::where('id', $find_subscription->subscription_package_id)->get();
                    // } else {
                    //     // User has no subscription, show Free Plan
                    //     $packages = SubscriptionPackage::where('price', '0')->get();
                    // }

                    // Always load free plan
                    $packages = SubscriptionPackage::where('price', 0)->get();

                    // Check user subscription
                    $find_subscription = PaymentGetway::where('user_id', auth()->id())->first();

                    if ($find_subscription) {
                        // Add subscribed package
                        $subscribed = SubscriptionPackage::where('id', $find_subscription->subscription_package_id)->first();

                        if ($subscribed) {
                            $packages->push($subscribed); // add subscribed plan to list
                        }
                    }

                }
            }






            if ($session != "") {
                return redirect()->to('/edit/invoices/' . $session);
            } else {
                return view('frontend.create-invoice')->with(compact('all', 'lastnum', 'lastInvoice', 'user_logo_terms', 'invoiceCountNew', 'template_id', 'packages', 'invoice_template_not_com', 'template_id_check', 'data',));
            }
        } else {

            // If the user is not logined in Start.
            $sessionId = session_id();
            $data  = Invoice::where('id', 1)->get()->first();
            $template_id = "";
            $template_id_check = InvoiceTemplate::get()->first();
            $template_id_check = $template_id_check->templateName;

            $lastInvoice = Invoice::where('session_id',  $sessionId)
                ->orderBy('created_at', 'desc')
                ->get([
                    'invoice_form',
                    'invoice_to',
                    'id',
                ])
                ->first();
            $invoiceCountNew = Invoice::where('session_id',  $sessionId)->count();
            $invoiceCountNew += 1;
            $invoice_template = InvoiceTemplate::get();
            $invoice_template_not_com = InvoiceTemplate::where('company', 'not company')->get();

            $user_logo_terms = User::where('id', 1 && 'is_admin', 1)->get([
                'invoice_logo',
                'terms',
                'signature'

            ])->first();

            $packages = SubscriptionPackage::all();


            return view('frontend.create-invoice')->with(compact('user_logo_terms', 'lastInvoice', 'invoiceCountNew', 'template_id', 'invoice_template', 'invoice_template_not_com', 'template_id_check', 'data', 'packages'));
        }
    }


    // public function loadmore(Request $request)
    // {
    //     $template_id_check = InvoiceTemplate::get()->first();
    //     $template_id = $request->template_id;
    //     $invoice_template = DB::table('invoice_templates')->limit($request['limit'])->offset($request['start'])->get();
    //     $get_data = view('frontend.craet_page_load_data', compact('invoice_template', 'template_id_check'))->render();
    //     $get_data_select = view('frontend.craete_data_select_tmp', compact('invoice_template', 'template_id'))->render();
    //     return response()->json(['data' => $get_data, 'get_data_select' => $get_data_select]);
    // }

    public function index_home($id)
    {
        $template_id = $id;

        $user = Auth::user()->id;

        $join_table_template = DB::table('users')
            ->join('payment_getways', 'users.id', '=', 'payment_getways.user_id')
            ->join('subscription_packages', 'payment_getways.subscription_package_id', '=', 'subscription_packages.id')
            ->join('subscription_package_templates', 'payment_getways.subscription_package_id', '=', 'subscription_package_templates.subscriptionPackageId')
            ->where('users.id',  $user)->get();

        $lastInvoice = Invoice::where('user_id', $user)->orderBy('created_at', 'desc')
            ->get([
                'invoice_form',
                'invoice_to',
                'id',
            ])->first();

        $invoice_template = InvoiceTemplate::get();
        $invoice_template_not_com = InvoiceTemplate::where('company', 'not company')->get();
        $invoiceCountNew = Invoice::where('user_id', Auth::user()->id)->count();
        $invoiceCountNew += 1;

        $user_logo_terms = User::where('id', Auth::user()->id)->get([
            'invoice_logo',
            'terms',
            'signature'
        ])->first();


        return view('frontend.create-invoice')->with(compact('lastInvoice', 'user_logo_terms', 'invoiceCountNew', 'template_id', 'invoice_template', 'invoice_template_not_com'));
    }

    public function complete($id)
    {
        dd($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'currency' => 'required|max:30',
            'invoice_form' => 'required|max:1000',
            'invoice_to' => 'required|max:1000',
            'invoice_id' => 'required',
            'invoice_date' => 'required|date',
            'invoice_payment_term' => 'max:30',
            'invoice_po_number' => 'max:30',
            'invoice_notes' => 'max:1000',
            'invoice_terms' => 'max:1000',
            'invoice_logo' => 'max:1024',
        ]);

        $user_id = Auth::id();
        $template_id_check = $request->template_id;
        $invoiceStatus = $request->input('invoice_status', 'complete');

        // Check if user has a package, if not assign Free Plan
        $userPackage = PaymentGetway::where('user_id', $user_id)->first();

        if (!$userPackage) {
            // User has no package, assign Free Plan
            $freePlan = SubscriptionPackage::where('price', '0')->first();
            if ($freePlan) {
                PaymentGetway::create([
                    'user_id' => $user_id,
                    'amount' => '0',
                    'subscription_package_id' => $freePlan->id,
                    'created_at' => Carbon::now(),
                ]);

                ComplateInvoiceCount::create([
                    'user_id' => $user_id,
                    'invoice_count_total' => 0,
                    'current_invoice_total' => 0,
                    'count_invoice_id' => $request->id,
                    'created_at' => Carbon::now()
                ]);

                $userPackage = PaymentGetway::where('user_id', $user_id)->first();
            }
        }

        // Check package limit
        $packages = DB::table('users')
            ->join('payment_getways', 'users.id', '=', 'payment_getways.user_id')
            ->join('subscription_packages', 'payment_getways.subscription_package_id', '=', 'subscription_packages.id')
            ->join('subscription_package_templates', 'payment_getways.subscription_package_id', '=', 'subscription_package_templates.subscriptionPackageId')
            ->select('subscription_packages.*', 'subscription_package_templates.template', 'payment_getways.created_at as payment_created_at')
            ->where('users.id', $user_id)
            ->get();

        $isAllowedTemplate = $template_id_check == 1 || $packages->contains(fn($p) => (int) $p->template === (int) $template_id_check);
        $activePackage = $packages->first();

        // checking  error for test
        // return response()->json([
        //     'message' => 'No active package found or template not allowed.',
        //     'data' => $activePackage,
        // ]);


        // check package expired
        $subscription = Subscription::where('user_id', $user_id)->latest()->first();
        if ($subscription && $this->isPackageExpired($subscription->starts_at, $subscription->ends_at)) {
            return response()->json(['message' => 'Your package has expired.']);
        }


        // If no active package found, try to get Free Plan
        if (!$activePackage) {
            $freePlan = SubscriptionPackage::where('price', '0')->first();
            if ($freePlan) {
                $activePackage = $freePlan;
                $isAllowedTemplate = true; // Allow basic templates for free plan
            }
        }

        if (!$isAllowedTemplate || !$activePackage) {
            return response()->json(['message' => 'Template access denied.']);
        }

        // --- Monthly Invoice Limit Logic ---
        $now = Carbon::now();
        $currentMonth = $now->format('Y-m');
        $check = ComplateInvoiceCount::firstOrCreate(
            ['user_id' => $user_id],
            [
                'count_invoice_id' => $request->id,
                'invoice_count_total' => 0,
                'current_invoice_total' => 0,
                'created_at' => $now
            ]
        );

        // If month has changed since last update, reset current_invoice_total
        $lastUpdatedMonth = $check->updated_at ? Carbon::parse($check->updated_at)->format('Y-m') : $currentMonth;
        if ($lastUpdatedMonth !== $currentMonth) {
            $check->current_invoice_total = 0;
            $check->save();
        }

        // check package limited
        if ($subscription && $subscription->invoice_generate <= $check->current_invoice_total) {
            return response()->json(['message' => 'Your package limit is over! Please update your package.']);
        }

        // --- End Monthly Invoice Limit Logic ---

        // ... rest of your invoice creation logic ...

        $id = $request->id;
        $invoice_logo = $request->file('invoice_logo');
        $filename = null;

        // Handle logo upload
        if ($invoice_logo) {
            $filename = time() . '.' . $invoice_logo->getClientOriginalExtension();
            $invoice_logo->move(public_path('storage/invoice/logo'), $filename);

            $user = User::findOrFail($user_id);
            if ($user->invoice_logo) {
                $old_path = public_path('storage/invoice/logo/') . $user->invoice_logo;
                if (File::exists($old_path)) File::delete($old_path);
            }

            $user->update(['invoice_logo' => $filename]);
        }

        // Save invoice terms if present
        if ($request->invoice_terms) {
            User::where('id', $user_id)->update(['terms' => $request->invoice_terms]);
        }

        $products = Invoice::find($id)?->products->pluck('product_amount')->sum() ?? 0;
        $tax = ($request->invoice_tax * $products) / 100;
        $total = $products + $tax;
        $status = $request->receive_advance_amount == $request->final_total ? 'paid' : 'due';
        $statusDuePaid = $invoiceStatus === 'incomlete' ? 'draft' : $status;

        // Save invoice
        $invoice = Invoice::updateOrCreate(
            ['id' => $id],
            [
                'invoice_logo' => 0,
                'currency' => $request->currency,
                'invoice_form' => $request->invoice_form,
                'invoice_to' => $request->invoice_to,
                'invoice_id' => $request->invoice_id,
                'invoice_date' => $request->invoice_date,
                'invoice_payment_term' => $request->invoice_payment_term,
                'invoice_dou_date' => $request->invoice_dou_date,
                'invoice_po_number' => $request->invoice_po_number,
                'invoice_notes' => $request->invoice_notes,
                'invoice_terms' => 0,
                'invoice_tax_percent' => $request->invoice_tax,
                'invoice_tax_amounts' => round($request->invoice_tax_amounts, 2),
                'requesting_advance_amount_percent' => round($request->requesting_advance_amount, 2),
                'total' => round($total, 2),
                'final_total' => round($request->final_total, 2),
                'receive_advance_amount' => round($request->receive_advance_amount, 2),
                'balanceDue_amounts' => round($request->balanceDue_amounts, 2),
                'discount_amounts' => round($request->discount_amounts, 2),
                'discount_percent' => $request->discount_percent,
                'invoice_status' => $invoiceStatus,
                'status_due_paid' => $statusDuePaid,
                'subtotal_no_vat' => round($request->subtotal_no_vat, 2),
                'template_name' => $request->template_name,
                'invoice_signature' => $request->invoice_signature,
            ]
        );

        // Increment invoice counts after successful creation
        $check->increment('invoice_count_total');
        $check->increment('current_invoice_total');

        // On draft save, redirect user back to all invoices
        if ($invoiceStatus === 'incomlete') {
            return response()->json(['redirect' => url('/my-trash-invoice')]);
        }

        return response()->json([$invoice->id]);
    }

    // this function check package expired
    /**
     * Check if the package is expired based on start and end date.
     *
     * @param string $startDate
     * @param string $endDate
     * @return bool
     */
    function isPackageExpired($startDate, $endDate): bool
    {
        // Both $startDate and $endDate are expected to be date strings like '2025-07-29 11:32:02'
        if (!$startDate || !$endDate) {
            return true;
        }

        $now = Carbon::now();
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        // Expired if now is after end date
        return $now->gt($end);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }


    public function update(Request $request, Invoice $invoice)
    {
        //
    }


    public function destroy(Invoice $invoice)
    {
        //
    }


    public function invoice_download($id)
    {

        $invoiceData = Invoice::where('id', $id)->get([
            'invoice_logo',
            'invoice_form',
            'currency',
            'invoice_to',
            'invoice_id',
            'invoice_date',
            'invoice_payment_term',
            'invoice_dou_date',
            'invoice_po_number',
            'invoice_notes',
            'invoice_terms',
            'invoice_tax_percent',
            'invoice_tax_amounts',
            'requesting_advance_amount_percent',
            'receive_advance_amount',
            'discount_percent',
            'total',
            'template_name',
            'subtotal_no_vat',
            'final_total',
            'discount_amounts'
        ])->first();

        $userInvoiceLogo  = user::where('id', Auth::user()->id)->get(['invoice_logo', 'terms', 'signature'])->first();

        $productsDatas = Invoice::find($id)->products->skip(0)->take(10);
        $due = $invoiceData->total;

        $data  = Invoice::find($id);
        $userLogoAndTerms = User::where('id', Auth::user()->id)->get([
            'invoice_logo',
            'terms',
            'signature',

        ])->first();
        //amount in word
        $amount = $invoiceData->final_total - $invoiceData->receive_advance_amount;

        $fmt = new NumberFormatter('en', NumberFormatter::SPELLOUT);
        $amountInWords = ucfirst($fmt->format($amount));


        Session::forget('last_invoice_id_download');
        if (Auth::user()->plan == 'free') {

            $defaultConfig = (new ConfigConfigVariables())->getDefaults();
            $fontDirs = $defaultConfig['fontDir'];
            $defaultFontConfig = (new FontVariables())->getDefaults();
            $fontData = $defaultFontConfig['fontdata'];
            $path = public_path() . "/fonts";
            $mpdf = new \Mpdf\Mpdf([
                'format' => 'A4',
                'orientation' => 'P',

                'margin_top'    => 25,

                'fontDir' => array_merge($fontDirs, [$path]),
                'fontdata' => $fontData + [
                    'solaimanlipi' => [
                        'R' => 'SolaimanLipi_20-04-07.ttf',
                        'useOTL' => 0xFF,
                    ],
                ],
                'default_font' => 'solaimanlipi',
            ]);
            $mpdf->AddPage();

            $mpdf->SetHTMLHeader('
            <table width="100%">
                <tr>
                    <td  style="text-align: right;">
                        <img class="invoice-logo" src="'.public_path('storage/invoice/logo/'.$userInvoiceLogo->invoice_logo).'"  width="100" style="float: right;">
                    </td>
                </tr>
            </table>
            ');

            if($invoiceData->template_name == "3"){
                $mpdf->SetHTMLFooter('
                    <div class="invoiceNumberLaft" >
                        <table style="margin-bottom:300px; ">
                            <tr text-rotate="90">
                                <td style="padding-left:55px; color:#CC3D3B;  font-size:21px">
                                    <h1>Invoice: '.$invoiceData->invoice_id.' </h1>
                                </td>
                            </tr>
                        </table>

                        <div style="position:absolute; bottom:20px; right:20px; font-size:11px; color:#666;">
                            Page {PAGENO} of {nbpg}
                        </div>
                    </div>
                ');
            }else{
                $mpdf->SetHTMLFooter('
                <div class="invoiceNumberLaft" >
                    <div style="position:absolute; bottom:20px; right:20px; font-size:11px; color:#666;">
                        Page {PAGENO} of {nbpg}
                    </div>
                </div>
            ');
            }





            $mpdf->WriteHTML(view('invoices.free.all_invoice')->with(compact('invoiceData', 'data', 'userLogoAndTerms', 'productsDatas', 'userInvoiceLogo', 'due', 'amountInWords')));
            // $mpdf->Output('newdocument.pdf', 'I');
            $mpdf->Output($invoiceData->invoice_id . '.pdf', 'I');
        } elseif (Auth::user()->plan == 'premium') {
            $pdf = Pdf::loadView('invoices.wid')->with(compact('invoiceData', 'productsDatas', 'userInvoiceLogo', 'due'));
            return $pdf->stream('invoices.wid.pdf');
        }
    }

    public function send_invoice(Request $request)
    {
        $template_id = $request->template_id;
        $data['invoiceData']  = Invoice::where('id', $template_id)->get([
            'invoice_logo',
            'invoice_form',
            'currency',
            'invoice_to',
            'invoice_id',
            'invoice_date',
            'invoice_payment_term',
            'invoice_dou_date',
            'invoice_po_number',
            'invoice_notes',
            'invoice_terms',
            'invoice_tax_percent',
            'invoice_tax_amounts',
            'requesting_advance_amount_percent',
            'receive_advance_amount',
            'discount_percent',
            'total',
            'template_name',
            'subtotal_no_vat',
            'final_total',
            'discount_amounts'
        ])->first();

        $data['productsDatas'] = Invoice::find($template_id)->products->skip(0)->take(10);
        $data['due'] = $data['invoiceData']->total;
        $data['email'] = "$request->emai_to";
        $data['subject'] = "$request->email_subject";
        $data['body'] = "$request->email_body";
        $data['template_id'] = "$template_id";
        $data['userInvoiceLogo']  = user::where('id', Auth::user()->id)->get(['invoice_logo', 'terms', 'signature'])->first();

        $defaultConfig = (new ConfigConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];
        $defaultFontConfig = (new FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        $path = public_path() . "/fonts";
        $mpdf = new \Mpdf\Mpdf([
            'format' => 'A4',
            'orientation' => 'p',
            'fontDir' => array_merge($fontDirs, [$path]),
            'fontdata' => $fontData + [
                'solaimanlipi' => [
                    'R' => 'SolaimanLipi_20-04-07.ttf',
                    'useOTL' => 0xFF,
                ],
            ],
            'default_font' => 'solaimanlipi',
        ]);
        $mpdf->WriteHTML(view('invoices.sendMail.mail_pdf')->with($data));
        $pdf =  $mpdf->Output('newdocument.pdf', 'S');
        Mail::send('invoices.sendMail.mail', $data,  function ($message) use ($data, $pdf) {
            $message->to($data['email'])->subject($data['subject'])->attachData($pdf, "Invoice.pdf");
        });

        SendMail_info::create([
            'user_id' => Auth::user()->id,
            'send_mail_to' => $data['email'],
            'mail_subject' => $data['subject'],
            'mail_body' => $data['body'],
            'invoice_tamplate_id' => $data['template_id'],
            'created_at' => Carbon::now()
        ]);

        Session::forget('last_invoice_id_send');
        return response()->json(['message' => '1']);
        // return redirect()->back();
    }




    public function previewImage($id)
    {
        $data  = Invoice::find($id);
        $userLogoAndTerms = User::where('id', Auth::user()->id)->get([
            'invoice_logo',
            'terms',
            'signature',

        ])->first();

        $productsDatas = Product::where('invoice_id', $id)->get();
        return view('invoices.preview_invoice.all_pre_invoice', compact('data', 'productsDatas', 'userLogoAndTerms'))->render();
    }


    public function complate_invoice($id)
    {
        Session::put('last_invoice_id_send', $id);
        Session::put('last_invoice_id_download', $id);
        Invoice::where('id', $id)->update(['invoice_status' => "complete"]);
        Session::forget('session_invoice_id');

        return response()->json(['message' => $id]);
    }

    public function show_invoice()
    {
        $data  = Invoice::find(48);
        $productsDatas = Product::where('invoice_id', 48)->get();
        $userLogoAndTerms = User::where('id', Auth::user()->id)->get([
            'invoice_logo',
            'terms',
            'signature',
            'name',
            'email'

        ])->first();

        // dd($userLogoAndTerms);

        // Add CSS to ensure proper rendering
        $cssFilePath = public_path('assets/frontend/css/invoices/invoice_two.css');
        // $stylesheet = file_get_contents($cssFilePath);
        $stylesheet = '';
        $html = view('invoices.preview_invoice.invoice_pre_one', compact('productsDatas', 'data', 'userLogoAndTerms'))->render();



        $bootstrap = '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">';
        $styledHtml = "$bootstrap<style>$stylesheet</style>$html";


        // dd($data);
        // return response($styledHtml);
        // dd($data);
        // Browsershot pdf
        $pdf = Browsershot::html($styledHtml)
            ->setOption('args', ['--no-sandbox'])
            ->showBackground()
            ->format('A4')
            // ->save(storage_path('app/public/test.pdf'));
            ->pdf();

        $data['due'] = 500;
        $data['email'] = "mhshakil06@gmail.com";
        $data['subject'] = "subject";
        $data['body'] = "body";
        $data['template_id'] = "4";
        $data['userInvoiceLogo']  = user::where('id', Auth::user()->id)->get(['invoice_logo', 'terms', 'signature'])->first();



        Mail::raw('Please find the attached invoice.', function ($message) use ($data, $pdf) {
            $message->to($data['email'])
                ->subject($data['subject'])
                ->attachData($pdf, 'Invoice.pdf', [
                    'mime' => 'application/pdf',
                ]);
        });




        return response($pdf)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="document.pdf"');



        return redirect()->back()->with('message', 'Successfully create PDF');
    }
}

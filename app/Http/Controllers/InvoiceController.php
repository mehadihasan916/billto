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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Mpdf\Config\ConfigVariables as ConfigConfigVariables;

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
            $invoice_template = InvoiceTemplate::get();
            $invoice_template_not_com = InvoiceTemplate::where('company', 'not company')->get();

            $user_logo_terms = User::where('id', Auth::user()->id)->get([
                'invoice_logo',
                'terms',
                'signature'
            ])->first();

            $session = Session::get('session_invoice_id');
            if ($session != "") {
                return redirect()->to('/edit/invoices/' . $session);
            } else {
                return view('frontend.create-invoice')->with(compact('all', 'lastnum', 'lastInvoice', 'user_logo_terms', 'invoiceCountNew', 'template_id', 'invoice_template', 'invoice_template_not_com', 'template_id_check', 'data'));
            }
        } else {

            // If the user is not logined in Start.
            $sessionId = session_id();
            $data  = Invoice::where('id', 1)->get()->first();
            $template_id = "";
            $template_id_check = InvoiceTemplate::get()->first();

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

            return view('frontend.create-invoice')->with(compact('user_logo_terms', 'lastInvoice', 'invoiceCountNew', 'template_id', 'invoice_template', 'invoice_template_not_com', 'template_id_check', 'data'));
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
    // public function store(Request $request)
    // {

    //     $validated = $request->validate([
    //         'currency' => 'required|max:30',
    //         'invoice_form' => 'required|max:90',
    //         'invoice_to' => 'required|max:90',
    //         'invoice_id' => 'required',
    //         'invoice_date' => 'required|date',
    //         'invoice_payment_term' => 'max:30',
    //         'invoice_po_number' => 'max:30',
    //         'invoice_notes' => 'max:100',
    //         'invoice_terms' => 'max:100',
    //         'invoice_logo' => 'max:1024',
    //     ]);


    //     $user_id = Auth::user()->id;

    //     $template_id_check = $request->template_name;

    //     // Chack package limit
    //     $join_table_value = DB::table('users')
    //         ->join('payment_getways', 'users.id', '=', 'payment_getways.user_id')
    //         ->join('subscription_packages', 'payment_getways.subscription_package_id', '=', 'subscription_packages.id')
    //         ->join('subscription_package_templates', 'payment_getways.subscription_package_id', '=', 'subscription_package_templates.subscriptionPackageId')
    //         ->selectRaw('users.*, payment_getways.*, subscription_packages.*,subscription_package_templates.*, payment_getways.created_at as payment_created_at')
    //         ->where('users.id',  $user_id)->get();
    //     $data = "";


    //     foreach ($join_table_value as $join_table) {
    //         $truvalue = $join_table->template === $template_id_check;
    //         if ($truvalue == true) {
    //             $data = 1;
    //         }
    //     }

    //     $check = ComplateInvoiceCount::where('user_id', $user_id)->first();
    //     $invoice_last_id = $check->count_invoice_id;



    //     ComplateInvoiceCount::where('user_id', $user_id)->update([
    //         'count_invoice_id' => $request->id
    //     ]);

    //     $packageDuration = $join_table->packageDuration;
    //     $create_date = $join_table->payment_created_at;
    //     return response()->json([
    //         'data' => $packageDuration,
    //     ]);

    //     $date = new Carbon($create_date);
    //     $today_date = $date->diffInDays(Carbon::now());





    //     if ($join_table->limitInvoiceGenerate >= $check->current_invoice_total + 1 && $packageDuration >= $today_date && $data == 1) {

    //         if ($invoice_last_id != $request->id) {
    //             ComplateInvoiceCount::where('user_id', $user_id)->where('count_invoice_id', $request->id)->increment('invoice_count_total');
    //             ComplateInvoiceCount::where('user_id', $user_id)->where('count_invoice_id', $request->id)->increment('current_invoice_total');
    //         }

    //         if ($request->id != null) {
    //             // Tax Calculation Formula Start
    //             $taxPercentage = $request->invoice_tax;
    //             $products = Invoice::find($request->id)->products->pluck('product_amount')->sum();
    //             $tax = ($taxPercentage * $products) / 100;
    //             $total = $tax + $products;
    //             // invocie Logo name Strat
    //             $id = $request->id;
    //             $filename = null;
    //             $invoice_logo = $request->invoice_logo;

    //             if ($id == null && $invoice_logo != null) {
    //                 if ($request->file('invoice_logo')) {
    //                     $file = $request->file('invoice_logo');
    //                     $extension = $file->getClientOriginalExtension();
    //                     $filename = time() . '.' . $extension;
    //                     $file->move(public_path('storage/invoice/logo'), $filename);
    //                     User::where('id', Auth::user()->id)
    //                         ->update([
    //                             'invoice_logo' => $filename,
    //                         ]);
    //                 }
    //             } elseif ($id != null && $invoice_logo != null) {

    //                 $find = User::findOrFail(Auth::user()->id);
    //                 $image_path         = public_path("storage/invoice/logo//") . $find->invoice_logo;
    //                 if (File::exists($image_path)) {
    //                     File::delete($image_path);
    //                     // Create File
    //                     $file = $request->file('invoice_logo');
    //                     $extension = $file->getClientOriginalExtension();
    //                     $filename = time() . '.' . $extension;
    //                     $file->move(public_path('storage/invoice/logo'), $filename);
    //                     User::where('id', Auth::user()->id)
    //                         ->update([
    //                             'invoice_logo' => $filename,
    //                         ]);
    //                 }
    //             }
    //             if ($request->invoice_terms != null) {
    //                 User::where('id', Auth::user()->id)->update([
    //                     'terms' => $request->invoice_terms,
    //                 ]);
    //             }


    //             // invocie Logo name End
    //             $status = "";
    //             if ($request->receive_advance_amount === $request->final_total) {
    //                 $status = "paid";
    //             } else {
    //                 $status = "due";
    //             }
    //             // Update Invoice Data
    //             $data = array(
    //                 'invoice_logo' => 0,
    //                 'currency' => $request->currency,
    //                 'invoice_form' => $request->invoice_form,
    //                 'invoice_to' => $request->invoice_to,
    //                 'invoice_id' => $request->invoice_id,
    //                 'invoice_date' => $request->invoice_date,
    //                 'invoice_payment_term' => $request->invoice_payment_term,
    //                 'invoice_dou_date' => $request->invoice_dou_date,
    //                 'invoice_po_number' => $request->invoice_po_number,
    //                 'invoice_notes' => $request->invoice_notes,
    //                 'invoice_terms' => 0,
    //                 'invoice_tax_percent' => $request->invoice_tax,
    //                 'invoice_tax_amounts' => round($request->invoice_tax_amounts, 2),

    //                 'requesting_advance_amount_percent' => round($request->requesting_advance_amount, 2),
    //                 'total' => round($total, 2),
    //                 'final_total' => round($request->final_total, 2),
    //                 'receive_advance_amount' => round($request->receive_advance_amount, 2),
    //                 'balanceDue_amounts' => round($request->balanceDue_amounts, 2),
    //                 'discount_amounts' => round($request->discount_amounts, 2),
    //                 'discount_percent' => $request->discount_percent,

    //                 'invoice_status' => 'complete',
    //                 'status_due_paid' => $status,
    //                 'subtotal_no_vat' => round($request->subtotal_no_vat, 2),
    //                 'template_name' => $request->template_name,
    //                 'invoice_signature' => $request->invoice_signature,
    //             );
    //             $invoice =  Invoice::updateOrCreate(['id' => $id], $data);
    //             return response()->json([$invoice->id]);
    //         }
    //         return response()->json(['message' => 'Please create product']);
    //     } else {
    //         return response()->json(['message' => '123']);
    //     }
    // }

    // new version of store function
    public function store(Request $request)
    {
        $validated = $request->validate([
            'currency' => 'required|max:30',
            'invoice_form' => 'required|max:90',
            'invoice_to' => 'required|max:90',
            'invoice_id' => 'required',
            'invoice_date' => 'required|date',
            'invoice_payment_term' => 'max:30',
            'invoice_po_number' => 'max:30',
            'invoice_notes' => 'max:100',
            'invoice_terms' => 'max:100',
            'invoice_logo' => 'max:1024',
        ]);

        $user_id = Auth::id();
        $template_id_check = $request->template_name;

        // Check package limit
        $packages = DB::table('users')
            ->join('payment_getways', 'users.id', '=', 'payment_getways.user_id')
            ->join('subscription_packages', 'payment_getways.subscription_package_id', '=', 'subscription_packages.id')
            ->join('subscription_package_templates', 'payment_getways.subscription_package_id', '=', 'subscription_package_templates.subscriptionPackageId')
            ->select('subscription_packages.*', 'subscription_package_templates.template', 'payment_getways.created_at as payment_created_at')
            ->where('users.id', $user_id)
            ->get();

        $isAllowedTemplate = $packages->contains(fn($p) => $p->template === $template_id_check);
        $activePackage = $packages->first();

        if (!$isAllowedTemplate || !$activePackage) {
            return response()->json(['message' => 'Template access denied.']);
        }

        $check = ComplateInvoiceCount::firstOrCreate(
            ['user_id' => $user_id],
            ['count_invoice_id' => $request->id]
        );

        if ($check->count_invoice_id !== $request->id) {
            $check->update(['count_invoice_id' => $request->id]);
        }

        $createdAt = Carbon::parse($activePackage->payment_created_at);
        $usedDays = $createdAt->diffInDays(Carbon::now());

        if (
            $activePackage->limitInvoiceGenerate >= ($check->current_invoice_total + 1) &&
            $activePackage->packageDuration >= $usedDays
        ) {
            if ($check->count_invoice_id !== $request->id) {
                $check->increment('invoice_count_total');
                $check->increment('current_invoice_total');
            }

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
                    'invoice_status' => 'complete',
                    'status_due_paid' => $status,
                    'subtotal_no_vat' => round($request->subtotal_no_vat, 2),
                    'template_name' => $request->template_name,
                    'invoice_signature' => $request->invoice_signature,
                ]
            );

            return response()->json([$invoice->id]);
        }

        return response()->json(['message' => 'Fill up invoice form properly or package limit reached.']);
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
                'fontDir' => array_merge($fontDirs, [$path]),
                'fontdata' => $fontData + [
                    'solaimanlipi' => [
                        'R' => 'SolaimanLipi_20-04-07.ttf',
                        'useOTL' => 0xFF,
                    ],
                ],
                'default_font' => 'solaimanlipi',
            ]);

            $mpdf->WriteHTML(view('invoices.free.all_invoice')->with(compact('invoiceData', 'productsDatas', 'userInvoiceLogo', 'due')));
            $mpdf->Output('newdocument.pdf', 'I');
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
        // Set the path to your font directory
        $fontPath = public_path('fonts/');

        // Configure MPDF with proper Bangla font support
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P',
            'fontDir' => [
                $fontPath,
                // Add any additional font directories if needed
            ],
            'fontdata' => [
                'solaimanlipi' => [
                    'R' => 'SolaimanLipi_20-04-07.ttf', // Make sure the filename matches exactly
                    'useOTL' => 0xFF, // Enable all OpenType Layout features
                    'useKashida' => 75, // Enable kashida for justification
                ],
                // You can add fallback fonts here
                'bangla' => [
                    'R' => 'SolaimanLipi_20-04-07.ttf', // Another common Bangla font
                    'useOTL' => 0xFF,
                    'useKashida' => 75,
                ],
            ],
            'default_font' => 'solaimanlipi',
            'autoScriptToLang' => true, // Automatically switch to appropriate language script
            'autoLangToFont' => true,   // Automatically switch to appropriate font
        ]);

        // Set metadata for better language support
        $mpdf->SetTitle('Invoice');
        $mpdf->SetAuthor('Your Company');
        $mpdf->SetSubject('Invoice');
        $mpdf->SetKeywords('Invoice, Bangla');

        // Set the language
        $mpdf->baseScript = 1;
        $mpdf->autoVietnamese = true;
        $mpdf->autoArabic = true;

        $html = view('frontend.invoices.invoice_two')->render();

        // Add CSS to ensure proper rendering
        $stylesheet = '
        <style>
            body {
                font-family: solaimanlipi;
                margin: 0;
                padding: 0;
                direction: ltr; /* Change to rtl if needed */
                transform: scale(0.95); /* Scale down slightly */
                transform-origin: top left;
                width: 100%;
            }

            .invoice-container {
                width: 80%;
                margin: 20px auto;
                border: 1px solid #ccc;
                padding: 20px;
            }
            .header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
            }
            .company-info {
                text-align: left;
            }
            .invoice-number {
                text-align: right;
            }
            // .from-to {
            //     display: flex;
            //     justify-content: space-between;
            //     margin-bottom: 20px;
            // }
            // .address-block {
            //     flex: 1;
            //     padding: 10px;
            //     border: 1px solid #eee;
            // }

            .form-section{
                margin-bottom: 20px;
                font-family: solaimanlipi;
            }
            .form-section .td{
                padding: 10px;
                border: 1px solid #eee;
                vertical-align: top;
            }


            .items-table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }
            .items-table th, .items-table td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }
            .total {
                text-align: right;
                margin-bottom: 10px;
            }
            .instructions {
                margin-top: 20px;
                border: 1px solid #eee;
                padding: 10px;
            }

            .a4-container {
                background-color: white;
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
                margin: auto;
                padding: 20px;
            }


        </style>
        ';

        $mpdf->WriteHTML($stylesheet . $html);
        $mpdf->Output('invoice.pdf', 'I');
    }
}

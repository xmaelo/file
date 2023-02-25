<?php

namespace App\Http\Controllers;

use App\Mail\CarPublishedMail;
use App\Mail\ClientApproval;
use App\Mail\EmailVerificationMail;
use App\Models\BuyerInvoice;
use App\Models\Car;
use App\Models\Client;
use App\Models\Membership;
use App\Models\SellerInvoice;
use App\Models\TempDocument;
use App\Models\TempFile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isNull;

class ClientController extends Controller
{

    public function index()
    {
        if (!auth()->check()) {
            return redirect('/admin/accounts/login');
        }
        $users = User::where('user_type', 'user')->get();
        return view('admin.users.index', [
            'users' => $users
        ]);
    }
    public function show($user)
    {
        if (!auth()->check()) {
            return redirect('/admin/accounts/login');
        }
        $memberships = Membership::all();
        $data = User::find($user);
        return view('admin.users.edit', [
            'user' => $data,
            'memberships' => $memberships
        ]);
    }
    public function update()
    {
        if (!auth()->check()) {
            return redirect('/admin/accounts/login');
        }


        request()->validate([
            'company' => 'required',
            'street' => 'required',
            'postcode' => 'required',
            'town' => 'required',
            'country' => 'required',
            'form_of_address' => 'required',
            'first_name' => 'required',
            'surname' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        $user = User::find(request('u_id'));

        $user->update([
            'company' => request('company'),
            'addition' => request('addition'),
            'street' => request('street'),
            'post_box' => request('post_box'),
            'postcode' => request('postcode'),
            'town' => request('town'),
            'country' => request('country'),
            'form_of_address' => request('form_of_address'),
            'first_name' => request('first_name'),
            'surname' => request('surname'),
            'email' => request('email'),
            'phone' => request('phone'),
            'mobile' => request('mobile'),
            'lang' => request('lang'),
            'membership' => request('membership'),
        ]);
        return back()->with('success', 'Updated successfully!');
    }

    public function register(Request $req)
    {
        //dd( 'CHE-'.request('ide'));
        request()->validate([
            'company' => 'required',
            'street' => 'required',
            'postcode' => 'required',
            'town' => 'required',
            'country' => 'required',
            'form_of_address' => 'required',
            'first_name' => 'required',
            'surname' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'password_confirmation ' => 'same:password'
        ]);

        $user = User::create([
            'company' => request('company'),
            'addition' => request('addition'),
            'street' => request('street'),
            'user_type' => 'user',
            'post_box' => request('post_box'),
            'postcode' => request('postcode'),
            'town' => request('town'),
            'country' => request('country'),
            'form_of_address' => request('form_of_address'),
            'first_name' => request('first_name'),
            'surname' => request('surname'),
            'email' => request('email'),
            'phone' => request('phone'),
            'mobile' => request('mobile'),
            'lang' => request('lang'),
            'ide' => !empty(request('ide-1')) ?  request('ide-1') . request('ide-2') . request('ide-3') : null,
            'username' => request('username'),
            'password' => Hash::make(request('password')),

        ]);
        Mail::to(request('email'))->send(new EmailVerificationMail($user));

        return redirect()->back()->with('reg_success', 'Registration successful!');
    }

    public function sell_car()
    {
        return view('sell-your-car');
    }

    public function upload(Request $req)
    {
        if (!session()->has('client_id')) {
            return redirect('/');
        }
        $folder = uniqid() . '-' . time();
        if ($req->hasFile('images')) {

            foreach ($req->file('images') as $file) {
                $fileName = $file->getClientOriginalName();
                $extention = $file->getClientOriginalExtension();
                $random_name = Str::random(20) . '.' . $extention;
                Log::info($random_name);
                $file->storePubliclyAs('public/images/cars/tmp/' . $folder, $random_name);
                TempFile::create([
                    'u_id' => session()->get('client_id'),
                    'folder' => $folder,
                    'filename' => $random_name
                ]);
                return $folder;
            }

            return '';
        }

        if ($req->hasFile('documents')) {
            foreach ($req->file('documents') as $file) {
                $fileName = $file->getClientOriginalName();
                $extention = $file->getClientOriginalExtension();
                $random_name = Str::random(20) . '.' . $extention;
                $file->storePubliclyAs('public/documents/cars/tmp/' . $folder, $random_name);
                TempDocument::create([
                    'u_id' => session()->get('client_id'),
                    'folder' => $folder,
                    'filename' => $random_name
                ]);
                return $folder;
            }

            return '';
        }
    }




    public function store(Request $req)
    {

        if (!session()->has('client_id')) {
            return redirect('/');
        }



        request()->validate([
            'brand' => 'required',
            'model' => 'required',
            'body_type' => 'required',
            'doors' => 'required',
            'first_registration' => 'required',
            'milage' => 'required',
            'exterior_color' => 'required',
            'exterior_finish' => 'required',
            'interior_color' => 'required',
            'interior_finish' => 'required',
            'wheel_drive' => 'required',
            'gear' => 'required',
            'fuel' => 'required',
            'displacement' => 'required',
            'performance_hp' => 'required',
            'performance_kw' => 'required',
            'registration_document' => 'required',
            'service_record_booklet' => 'required',
            'repairs' => 'required',
            'service_record_digital' => 'required',
            'keys' => 'required',
            'min_price' => 'required',
            'location' => 'required',
        ]);

        $slug = Str::random(15);
        $date = new Carbon(request('first_registration'));
        $year = (int) $date->year;



        $car = Car::create([
            'brand' => request('brand'),
            'model' => request('model'),
            'type' => request('type'),
            'body_type' => request('body_type'),
            'doors' => request('doors'),
            'first_registration' => request('first_registration'),
            'reg_year' => $year,
            'milage' => request('milage'),
            'exterior_color' => request('exterior_color'),
            'exterior_finish' => request('exterior_finish'),
            'interior_color' => request('interior_color'),
            'interior_finish' => request('interior_finish'),
            'special_equipments' => request('special_equipments'),
            'serial_equipments' => request('serial_equipments'),
            'wheel_drive' => request('wheel_drive'),
            'gear' => request('gear'),
            'fuel' => request('fuel'),
            'displacement' => request('displacement'),
            'performance_hp' => request('performance_hp'),
            'performance_kw' => request('performance_kw'),
            'seats' => request('seats'),
            'frame_number' => request('frame_number'),
            'model_number' => request('model_number'),
            'vehicle_number' => request('vehicle_number'),
            'register_number' => request('register_number'),
            'direct_import' => request('direct_import'),
            'additional_info' => request('additional_info'),
            'factory_price' => request('factory_price'),
            'general_conditions' => request('general_conditions'),
            'registration_document' => request('registration_document'),
            'service_record_booklet' => request('service_record_booklet'),
            'inspection' => request('inspection'),
            'repairs' => request('repairs'),
            'service_record_digital' => request('service_record_digital'),
            'keys' => request('keys'),
            'mechanics' => request('mechanics'),
            'body' => request('body'),
            'car_finish' => request('car_finish'),
            'others' => request('others'),
            'documents' => null,
            'images' =>  null,
            'min_price' => request('min_price'),
            'location' => request('location'),
            'status' => "Not sold",
            'bidder_id' => null,
            "slug" =>  $slug,
            "u_id" => session()->get('client_id'),
            "p_id" => null,
            "ref_number" => generateUniqueCode()
        ]);


        $tempFile = TempFile::where('u_id', session()->get('client_id'))->get();
        $images = [];
        if ($tempFile->count() > 0) {
            foreach ($tempFile as $t) {
                $images[] = $t->folder . '/' . $t->filename;
                Storage::move(
                    'public/images/cars/tmp/' . $t->folder,
                    'public/images/cars/' . $t->folder
                );
                $t->delete();
            }


            $car->update([
                "images"  =>  $images
            ]);
        }


        $tempDocs = TempDocument::where('u_id', session()->get('client_id'))->get();
        $documents = [];
        if ($tempDocs->count() > 0) {
            foreach ($tempDocs as $t) {
                $documents[] = $t->folder . '/' . $t->filename;
                Storage::move(
                    'public/documents/cars/tmp/' . $t->folder,
                    'public/documents/cars/' . $t->folder
                );
                $t->delete();
            }

            $car->update([
                "documents"  =>  $documents
            ]);
        }

        Mail::to(userDetails($slug)->email)->send(new CarPublishedMail($car));
        return redirect('/accounts/current-vehicles')->with('success', 'Car details added successfully.');
    }


    public function client_data()
    {
        if (!session()->has('client_id')) {
            return redirect('/');
        }

        request()->validate([
            'company' => 'required',
            'street' => 'required',
            'postcode' => 'required',
            'town' => 'required',
            'country' => 'required',
            'form_of_address' => 'required',
            'first_name' => 'required',
            'surname' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        $client = User::find(session()->get('client_id'));

        $client->update([
            'company' => request('company'),
            'addition' => request('addition'),
            'street' => request('street'),
            'post_box' => request('post_box'),
            'postcode' => request('postcode'),
            'town' => request('town'),
            'country' => request('country'),
            'form_of_address' => request('form_of_address'),
            'first_name' => request('first_name'),
            'surname' => request('surname'),
            'email' => request('email'),
            'phone' => request('phone'),
            'mobile' => request('mobile'),
            'lang' => request('lang'),
            'isApproved' => false
        ]);
        session()->flush();
        return redirect('/')->with('updated', 'Profile updated successfully. Your account disabled temporarily until admin approves updates.');
    }

    public function invoices()
    {
        if (!session()->has('client_id')) {
            return redirect('/');
        }
        $sold = Car::where('u_id', session()->get('client_id'))
            ->where('status', 'sold')->count();
        $purchased = Car::where('p_id', session()->get('client_id'))
            ->count();
        $current = Car::where('u_id', session()->get('client_id'))
            ->where('status', 'Not sold')->count();

        $outstanding = Car::where('p_id', session()->get('client_id'))
            ->where('is_paid', false);
        $paid = Car::where('p_id', session()->get('client_id'))
            ->where('is_paid', true);
        $seller_invoices = SellerInvoice::where('user_id',auth()->user()->id)->get();
        $buyer_invoices = BuyerInvoice::where('user_id',auth()->user()->id)->get();

        return view('invoices', [
            'outstanding_invoices' => $outstanding,
            'paid_invoices' => $paid,
            'sold' => $sold,
            'purchased' => $purchased,
            'current' => $current,
            'seller_invoices' => $seller_invoices,
            'buyer_invoices' => $buyer_invoices,
        ]);
    }


    public function user_accept()
    {
        request()->validate([
            'u_id' => 'required',
        ]);
        $uid = request('u_id');
        $user = User::find($uid);
        $user->update([
            'isApproved' => true
        ]);

        $user_data = [
            'email' => $user->email,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'username' => $user->username,
        ];


        Mail::to($user->email)->send(new ClientApproval($user_data));

        return back();
    }
    public function user_reject()
    {
        request()->validate([
            'u_id' => 'required',
        ]);
        $uid = request('u_id');
        $user = User::find($uid);
        $user->update([
            'isApproved' => false
        ]);
        return back();
    }

    public function destroy(User $user)
    {
        $cars = Car::where('u_id', $user->id)->get();

        if ($cars->count() > 0) {
            foreach ($cars as $car) {
                $car->delete();
            }
        }
        $user->delete();
        return back();
    }

    public function verify_email($verification_code)
    {

        $user = User::where('username', $verification_code)->first();
        Log::info($user->id);
        $user_data = User::find($user->id);

        if (!$user) {
            Log::info('not user');
            return redirect('/')->with('error', 'Invalid URL');
        } else {
            Log::info('user');
            if ($user->email_verified_at) {
                Log::info('user if');
                return redirect('/')->with('error', 'Email already verified');
            } else {
                Log::info('user else');
                $user_data->update([
                    'isEmailVerified' => true
                ]);
                return redirect('/')->with('verified', 'Email successfully verified. However, you need to wait to access your account until admin accepts it.');
            }
        }
    }
}

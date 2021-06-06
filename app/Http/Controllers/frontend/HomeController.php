<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cms;
use App\Service;
use App\Client;
use App\Blog;
use App\Photos;
use App\Videos;
use App\Admin_setting;
use App\Contact;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

  // public function __construct()
  //   {

  //   }

public function index(){
	$data['services']=Service::latest()->orderBy('id','desc')->get();
	$data['patients']=Client::latest()->orderBy('id','desc')->get();
    $setting = Admin_setting::latest()->where('id', 1)->first();

	return view('frontend.home',compact("data","setting"));
}

public function about_us(){
 $cms = Cms::latest()->where('id', 2)->first();
return view('frontend.about',compact('cms'));

}

public function privacypolocy(){
    $cms = Cms::latest()->where('id', 3)->first();
   return view('frontend.privacypolocy',compact('cms'));

   }

public function termsConditions(){
    $cms = Cms::latest()->where('id', 4)->first();
   return view('frontend.termsconditions',compact('cms'));

   }

public function our_services(){
	$data['services']=Service::latest()->orderBy('id','desc')->get();
	return view('frontend.services',compact('data'));

}

public function details_service($service_id){
	$heading=str_replace("-"," ", $service_id);
    $service = Service::latest()->where('heading', $heading)->first();
	return view('frontend.single_service',compact('service'));

}

public function doctors(){

	return view('frontend.doctors');

}

public function gallery(){
	$data['photo']=Photos::latest()->orderBy('id','desc')->get();
	$data['video']=Videos::latest()->orderBy('id','desc')->get();
	return view('frontend.gallery',compact('data'));

}

public function contact_us(){
   $setting = Admin_setting::latest()->where('id', 1)->first();
	return view('frontend.contact',compact('setting'));
}

    public function processContact(Request $request){
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "mobile_no" => "required",
            "email" => "required",
            "message" => "required",
            'g-recaptcha-response'=>'required|recaptcha'
        ],
        [
            'name.required' => 'Name is Required.',
            'mobile_no.required' => 'Contact No is Required.',
            'email.required' => 'Email is Required.',
            'message.required' => 'Message is Required.',
            'recaptcha'=>'Please ensure that you are a human!'
        ]);

        if($validator->fails()){
         return redirect()->back()->withErrors($validator)->withInput($request->all());

        }else{
        //     $data = [
        //             'name' => strip_tags($request->name),
        //             'contact_no' => $request->mobile_no,
        //             'email' => $request->email,
        //             'message' => strip_tags($request->message),
        //             'ip_address' => $request->ip(),
        //         ];

        //         $objContact = Contact::create($data);
        //         if($objContact){
        //             $objCompany = Admin_setting::get()->first();
        //             $frontemail=$data['email'];
        //             $mBody    = "<p>Hi,<br>".$data['name']." <br><br>Thank you for getting in touch!<br>We appreciate you contacting us. One of our customer happiness members will be getting back to you shortly.<br>While we do our best to answer your queries quickly, it may take about 10 hours to receive a response from us during peak hours.<br>Thanks in advance for your patience.<br><br>Have a great day!<br><br>Thanks<br>".$objCompany->address."<br>".$objCompany->email."<br>".$objCompany->website."<br>".$objCompany->mobile_no."</p>";
        //             $mSubject = "Thank you for getting in touch";
        //             Mail::send('emails.feedback', ['body' => $mBody], function($m) use ($frontemail, $mSubject) {
        //                 $m->from("demo@omsoftware.org", "OmSoftWare");
        //                 $m->to($frontemail)->subject($mSubject);
        //             });
        //             $request->session()->flash('success', 'Contact Us Data Submitted Successfully!!');
        //             return redirect()->back();
        //         }
        //         else{
        //             $request->session()->flash('error', 'Error: while data submittion!');
        //             return redirect()->back();
        //         }

          }

    }

    public function getYourLocation(Request $request){
        $latitude = $request->cookie('latitude');
        $longitude = $request->cookie('longitude');
        $location = $request->cookie('location');
        $data = [
            'latitude' => $latitude,
            'longitude' => $longitude,
            'location' => $location,
        ];
        return $data;
    }

public function blogs(){
	$data['blogs']=Blog::paginate(3);
	return view('frontend.blog',compact('data'));

}


public function blog_details($blogId){
$heading=str_replace("-"," ", $blogId);
$blog = Blog::latest()->where('heading', $heading)->first();
return view('frontend.single-blog',compact('blog'));
}


public function elements(){

	return view('frontend.elements');

}

 public function book_appoint(Request $request){
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "mobile_no" => "required",
            "email" => "required",
            "message" => "required",
            "date" => "required",
            // 'g-recaptcha-response'=>'required|recaptcha'
        ],
        [
            'name.required' => 'Name is Required.',
            'mobile_no.required' => 'Contact No is Required.',
            'email.required' => 'Email is Required.',
            'date.required' => 'Date is Required.',
            'message.required' => 'Message is Required.',
            // 'recaptcha'=>'Please ensure that you are a human!'
        ]);

        if($validator->fails()){
         return redirect()->back()->withErrors($validator)->withInput($request->all());

        }else{
        //     $data = [
        //             'name' => strip_tags($request->name),
        //             'contact_no' => $request->mobile_no,
        //             'email' => $request->email,
        //             'message' => strip_tags($request->message),
        //             'ip_address' => $request->ip(),
        //         ];

        //         $objContact = Contact::create($data);
        //         if($objContact){
        //             $objCompany = Admin_setting::get()->first();
        //             $frontemail=$data['email'];
        //             $mBody    = "<p>Hi,<br>".$data['name']." <br><br>Thank you for getting in touch!<br>We appreciate you contacting us. One of our customer happiness members will be getting back to you shortly.<br>While we do our best to answer your queries quickly, it may take about 10 hours to receive a response from us during peak hours.<br>Thanks in advance for your patience.<br><br>Have a great day!<br><br>Thanks<br>".$objCompany->address."<br>".$objCompany->email."<br>".$objCompany->website."<br>".$objCompany->mobile_no."</p>";
        //             $mSubject = "Thank you for getting in touch";
        //             Mail::send('emails.feedback', ['body' => $mBody], function($m) use ($frontemail, $mSubject) {
        //                 $m->from("demo@omsoftware.org", "OmSoftWare");
        //                 $m->to($frontemail)->subject($mSubject);
        //             });
        //             $request->session()->flash('success', 'Contact Us Data Submitted Successfully!!');
        //             return redirect()->back();
        //         }
        //         else{
        //             $request->session()->flash('error', 'Error: while data submittion!');
        //             return redirect()->back();
        //         }

          }

    }

    public function submitFeedback(Request $request){
        $input = [
            "name" => $request->name,
            "email" => $request->email,
            "contactNumber" => $request->contactNo,
            "message" => $request->message,
        ];

        Feedback::create($input);
        if($this->feedbackMail($input) == "success"){
            return response()->json(['success'=>"done"]);
        }
        //return response()->json(['success'=>"done"]);

    }



}

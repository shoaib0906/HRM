<?php
namespace App\Http\Controllers;
use Entrust;
use Config;
use DB;
use Activity;
use Auth;
use PDF;
use File;
use Mail;
use App\Classes\Helper;
use Illuminate\Http\Request;

Class TemplateController extends Controller{

  public function test_db()
  {
    $data= DB::select('select * from tmData');
    dd($data);
  }
  public function pdf()
  {
      $data['emps'] = DB::table('birthday_info')->orderby('status','asc')->get();
      //dd($data['emps']);
      return view('birthday_index',$data);
  }
  public function post_pdf()
  {
  $emps = DB::table('birthday_info')->where('status','=',0)->get();
  foreach ($emps as $emp) { 
    $data['name']=$emp->emp_name;
    $pdf = \App::make('dompdf.wrapper');
  
  $pdf->getDomPDF()->set_option("enable_php", true);
  $pdf->loadView('invoice', $data);
  $pdf->save('public/birthday_pdf/'.$emp->emp_name.'_'.$emp->emp_code.'_birthday.pdf');
  $filename = base_path().'/config/template/birth_day_mail';
    $content = File::get($filename);
    $mail_content = str_replace('[NAME]',$emp->emp_name,$content);
    $birthday_file = 'public/birthday_pdf/'.$emp->emp_name.'_'.$emp->emp_code.'_birthday.pdf';
    //$birthday_file = File::get($file_url);
    //dd($birthday_file);
    Mail::send('template.mail', compact('mail_content'), function($message) use ($emp,$birthday_file){
        $message->to($emp->emp_email, $emp->emp_name)->subject('Birthday Greetings from MD&CEO to '.$emp->emp_name)
        ->bcc('agranigreetings@agranibank.org','Agrani Greeting')
        ->bcc('dgmit@agranibank.org','DGM (IT)') 
        //->bcc('gmit@agranibank.org','GM(IT)')
          ;             
        $message->attach($birthday_file);        
    });
       $timestamp=date('Y-m-d H:i:s');
      if (Mail::failures()) {
        DB::table('birthday_info')->where('emp_code','=',$emp->emp_code)
        ->update(['status'=>2,'mail_sent_at'=>$timestamp]);
      }
      else
      {
        DB::table('birthday_info')->where('emp_code','=',$emp->emp_code)->update(['status'=>1,'mail_sent_at'=>$timestamp]);
      }
    }
    return redirect()->back();
  }
  public function index(){
    $templates = Helper::getTemplate();

    foreach($templates as $template){
      $key = $template[0];
      $filename = base_path().'/config/template/'.$key;
      $content = File::get($filename);
      $template_content[$key] = $content;
    }
    return view('template.index',compact('templates','template_content'));
  }
  
  public function update(Request $request, $id){

    if(!Entrust::can('manage_template'))
      return redirect('/dashboard')->withErrors(config('constants.NA'));

    $templates = Helper::getTemplate();
    $templates[$id][2] = $request->input('template_subject');
    $key = $templates[$id][0];
    $filename = base_path().'/config/template/'.$key;
    File::put($filename,$request->input('template_description'));

    $filename = base_path().'/config/template.php';
    File::put($filename,var_export($templates, true));
    File::prepend($filename,'<?php return ');
    File::append($filename, ';');

    $activity = 'Template updated';
    Activity::log($activity);
    return redirect('/template')->withSuccess(config('constants.UPDATED'));
  }
  
  public function welcomeEmail($user_id,$token){

  
    if(!Entrust::can('send_template'))
      return redirect('/dashboard')->withErrors(config('constants.NA'));

    if(!Helper::verifyCsrf($token))
      return redirect('/dashboard')->withErrors(config('constants.CSRF'));

    $user = \App\User::find($user_id);
//dd($user);
  $filename = base_path().'/config/template/send_welcome_email';
    $content = File::get($filename);

    if(!$user)
      return redirect()->back()->withErrors(config('constants.INVALID_LINK'));
    
    $mail_content = str_replace('[NAME]',$user->first_name." ".$user->last_name,$content);

      Mail::send('template.mail', compact('mail_content'), function($message) use ($user){
        $message->to($user->email, 'Agtani Bank Ltd.')->subject('Welcome');
    });

    return redirect()->back()->withSuccess('Mail send successfully. ');
  }
   public function welcomesms($user_id,$token){

    
    if(!Helper::verifyCsrf($token))
      return redirect('/dashboard')->withErrors(config('constants.CSRF'));

    $user = \App\User::find($user_id);

  $filename = base_path().'/config/sms_template/send_welcome_sms';
    $content = File::get($filename);

    if(!$user)
      return redirect()->back()->withErrors(config('constants.INVALID_LINK'));
    
    $mail_content = str_replace('[NAME]',$user->first_name." ".$user->last_name,$content);
    
     /* Mail::send('template.mail', compact('mail_content'), function($message) use ($user){
        $message->to($user->email, 'WM Lab')->subject('Welcome');
    });*/
      $response = Helper::sendSMS($user->Profile->contact_number,$mail_content);
  //$response = Helper::sendSMS('+353860247895',$mail_content);
        if($response == 1)
          return redirect()->back()->withSuccess('SMS Sent successfully. ');
        else
          return redirect()->back()->withErrors($response);

    
  }
}
?>
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
class LoginController extends Controller
{

  function admin_login(Request $req)
  {
    if (!empty($req->session()->has('admin_data'))) {
      // echo "hii"; die();
      return redirect('/admin_index');
    } else {
      return view('admin/login/index');
    }
  }



  //login Admin
  public function admin_login_process(Request $req)
  {
    if (empty($req->session()->has('admin_data'))) {

      $req->validate([
        'email' => 'required|email',
        'password' => 'required',

      ]);


      $email = $req->input('email');
      $password = $req->input('password');
      $pass = md5($password);


      $team_da = Team::wherenull('deleted_at')->where('is_active', 1)->where('email', $email)->first();

      if (!empty($team_da)) {
        $db_name = $team_da->name;
        $db_email = $team_da->email;
        $db_password = $team_da->password;



        if ($db_password == $pass) {
          // $db_contact= $user_da->contact;
          $db_id = $team_da->id;


          $db_image = $team_da->image;
          $db_power = $team_da->power;
          $db_services = $team_da->services;




          if ($db_power == 1) {
            $pos = "Super Admin";
          }
          if ($db_power == 2) {
            $pos = "Admin";
          }
          if ($db_power == 3) {
            $pos = "Manager";
          }




          $req->session()->put('admin_data', 1);
          $req->session()->put('admin_name', $db_name);
          $req->session()->put('admin_image', $db_image);
          $req->session()->put('power', $db_power);
          $req->session()->put('services', $db_services);
          $req->session()->put('position', $pos);
          $req->session()->put('admin_id', $db_id);


          return Redirect('/admin_index')->with('success', 'Login Successfully.');
        } else {
          return redirect()->back()->with('error', 'Invalid Password!');
        }
      } else {
        return redirect()->back()->with('error', 'Invalid Credentials!');
      }
    } else {
      // log::debug("Invalid out");
      return Redirect('/admin_index');
    }
  }



  //logout Admin function
  public function admin_logout(Request $req)
  {

    if (!empty($req->session()->has('admin_data'))) {


      $req->session()->forget('admin_data');
      $req->session()->forget('admin_name');
      $req->session()->forget('admin_image');
      $req->session()->forget('power');
      $req->session()->forget('services');
      $req->session()->forget('position');
      $req->session()->forget('admin_id');

      return Redirect('/admin_login')->with('success', 'Logout Successfully.');
    } else {
      return Redirect('/admin_login');
    }
  }



  // admin profile data

  function admin_profile(Request $req)
  {

    if (!empty($req->session()->has('admin_data'))) {

      $admin_id = $req->session()->get('admin_id');
      // die();
      $profile_data = Team::wherenull('deleted_at')->where('is_active', 1)->where('id', $admin_id)->first();

      return view('admin/profile/view_profile', compact('profile_data'));
    } else {
      return view('admin/login/index');
    }
  }


  //view admin change Password
  function admin_change_pass_view(Request $req)
  {

    if (!empty($req->session()->has('admin_data'))) {

      $admin_id = $req->session()->get('admin_id');

      return view('admin/profile/change_password');
    } else {
      return view('admin/login/index');
    }
  }



  //change Admin password
  public function admin_change_password(Request $req)
  {

    if (!empty($req->session()->has('admin_data'))) {

      $req->validate([
        'old' => 'required',
        'new' => 'required',
        'confirm' => 'required'

      ]);


      $old = $req->input('old');
      $old_enc = md5($old);
      $new = $req->input('new');
      $confirm = $req->input('confirm');
      $admin_id = $req->session()->get('admin_id');

      $team_da = Team::wherenull('deleted_at')->where('is_active', 1)->where('id', $admin_id)->first();

      if (!empty($team_da)) {

        if ($confirm == $new) {

          if ($team_da->password == $old_enc) {

            //update password
            $teamUpdateInfo = [
              'password' => md5($new),
            ];


            $TeamData = Team::wherenull('deleted_at')->where('id', $admin_id)->first();

            $TeamData->update($teamUpdateInfo);

            return redirect()->back()->with('success', 'Password Successfully Changed!');
          } else {

            return redirect()->back()->with('error', 'Invalid Old Password!');
          }
        } else {

          return redirect()->back()->with('error', 'New And Confirm Password Does Not Matched!');
        }
      }
    } else {
      return view('admin/login/index');
    }
  }
}

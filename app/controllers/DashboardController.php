<?php

class DashboardController extends \BaseController {

    public function __construct()
    {
        // require csrf token for all post, delete, and put actions
        $this->beforeFilter('auth', array('only' => array('show')));
    }



    public function show($id)
    {
        $user = User::find($id);
        $is_mentor = User::checkIfMentor($user);

        if ($is_mentor){
         
            $relationship = DB::table('relationships')->where('mentor_id', $id)->get();
            $pending = [];
            $active = [];

            
            foreach($relationship as $value) {

                if ($value->is_pending == 1) {
                    $temp = $value->student_id;
                    $temp = DB::table('users')->where('id', $temp)->first();
                    $pending[]= $temp;
                } elseif ($value->is_pending == 0) {
                    $temp = $value->student_id;
                    $temp = DB::table('users')->where('id', $temp)->first();
                    $active[]= $temp;
                }
            }
            
         // var_dump($user->students());
         // var_dump($relationship = Relationship::where('mentor_id', '=', $id)->get());

        } else {

            $relationship = DB::table('relationships')->where('student_id', $id)->get();
            $pending = [];
            $active = [];
            
            foreach($relationship as $value) {

                if ($value->is_pending == 1) {
                    $temp = $value->mentor_id;
                    $temp = DB::table('users')->where('id', $temp)->first();
                    $pending[]= $temp;
                } elseif ($value->is_pending == 0) {
                    $temp = $value->mentor_id;
                    $temp = DB::table('users')->where('id', $temp)->first();
                    $active[]= $temp;
                }
            }

        
            // var_dump($user->mentors());
            // var_dump($relationship = Relationship::where('student_id', '=', $id)->get());
        }
        return View::make('dashboard')->with(array('pending' => $pending, 'active' => $active, 'user' => $user));

    }


    // public function mentorIndex()
    // {
    //         // We'll need this input on the page somewhere.
    //     $search = Input::get('search');

    //     if (is_null($search)) {
    //         $mentors = DB::table('users')->where('is_mentor', 1)->orderBy('created_at', 'desc')->get();
    //     } else {
    //         $mentors = DB::table('users')->where('is_mentor', 1)->where('interests', 'LIKE', "%$search%")->orderBy('created_at', 'desc')->get();
    //     }

    //     return View::make('mentor_index_test')->with('mentors', $mentors);
    // }

    public function aboutUs()
    {
        $user = Auth::user();
        return View::make('aboutUs')->with(array('user' => $user));
    }
}


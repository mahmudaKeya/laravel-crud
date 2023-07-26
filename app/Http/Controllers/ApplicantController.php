<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   

            // Check if the user is logged in
        // if (!Auth::check()) {
        //     return redirect()->route('login');
        // }
        $search = $request['q'] ?? "";

        if ($search != ""){
            $applicants = Applicant::where('name', 'LIKE', '%' . $search . '%')
                                  ->orWhere('id', $search)
                                  ->paginate(5);
        } else {
            $applicants = Applicant::latest()->paginate(5);
        }

        return view('applicants.index', compact('applicants', 'search'))
            ->with(request()->input('page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('applicants.create');
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(Request $request)
     {
         $request->validate([
             'name' => 'required|string',
             'mobile_number' => 'required|string|digits:11|unique:applicants',
             'previous_institution' => 'required|string',
             'date_of_birth' => 'required|date',
         ]);
     
         // Generate a UUID
         $uuid = Str::uuid();
     
        //  Create the applicant and set the UUID along with other attributes
         Applicant::create([
             'uuid' => $uuid,
             'name' => $request->input('name'),
             'mobile_number' => $request->input('mobile_number'),
             'previous_institution' => $request->input('previous_institution'),
             'date_of_birth' => $request->input('date_of_birth'),
         ]);
     
         return redirect()->route('applicants.index')
                         ->with('success', 'Applicant created successfully.');
     }
     //     public function store(Request $request)
// {
//     $request->validate([
//         'name' => 'required|string',
//         'mobile_number' => 'required|string',
//         'previous_institution' => 'required|string',
//         'date_of_birth' => 'required|date',
//     ]);

//     // Generate a UUID
//     $uuid = Str::uuid();

//     // Create the applicant and set the UUID along with other attributes
//     Applicant::create([
//         // 'uuid' => $uuid,
//         'uuid' => $uuid,
//         'name' => $request->input('name'),
//         'mobile_number' => $request->input('mobile_number'),
//         'previous_institution' => $request->input('previous_institution'),
//         'date_of_birth' => $request->input('date_of_birth'),
//     ]);

//     return redirect()->route('applicants.index')
//                     ->with('success', 'Applicant created successfully.');
// }


    /**
     * Display the specified resource.
     */
    public function show(Applicant $applicant)
    {
        return view('applicants.show',compact('applicant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Applicant $applicant)
    {
        return view('applicants.edit',compact('applicant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Applicant $applicant)
{
    $request->validate([
        'name' => 'required|string',
        'mobile_number' => 'required|string',
        'previous_institution' => 'required|string',
        'date_of_birth' => 'required|date',
    ]);

    // Update the attributes of the specific $applicant instance
    $applicant->update([
        'name' => $request->input('name'),
        'mobile_number' => $request->input('mobile_number'),
        'previous_institution' => $request->input('previous_institution'),
        'date_of_birth' => $request->input('date_of_birth'),
    ]);

    return redirect()->route('applicants.index')
                     ->with('success', 'Applicant updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Applicant $applicant)
    {
        $applicant->delete();

        return redirect()->route('applicants.index')
                        ->with('success','Product deleted successfully');
    }


    public function search(Request $request)
{
    $query = $request->input('q');
    $applicants = Applicant::where('name', 'LIKE', '%' . $query . '%')
                          ->orWhere('id', $query)
                          ->get();

    return view('applicants.index', compact('applicants'));
}

// public function showRegistrationForm()
// {
//     return view('applicants.register');
// }

// public function register(Request $request)
// {
//     $request->validate([
//         'name' => 'required|string|max:255',
//         'email' => 'required|string|email|max:255|unique:users',
//         'password' => 'required|string|min:8|confirmed',
//     ]);

//     $user = new User();
//     $user->name = $request->input('name');
//     $user->email = $request->input('email');
//     $user->password = Hash::make($request->input('password'));
//     $user->save();

//     return redirect()->route('login')->with('success', 'Registration successful! You can now log in.');
// }

//     public function showLoginForm()
//     {
//         return view('applicants.login');
//     }

//     public function login(Request $request)
//     {
//         // Debug: Check if the form data is being submitted correctly
//         // dd($request->all());

//             // Debug: Check if the form data is being submitted correctly
//     //dd($request->all());

//     // $credentials = $request->only('username', 'password');
//     // // Debug: Check the values of $credentials
//     // dd($credentials);
    
//         $credentials = $request->only('username', 'password');
//         // Debug: Check the values of $credentials
//         // dd($credentials);
    
//         $friendUsername = 'root'; // Replace 'friend_username' with the actual predefined username
//         $friendPassword = 'root'; // Replace 'friend_password' with the actual predefined password
    
//         if ($credentials['username'] === $friendUsername && $credentials['password'] === $friendPassword) {
//             if (Auth::attempt($credentials)) {
//                 // Authentication passed, log in the user
//                 return redirect()->route('applicants.index');
//             }
//         }
    
//         return redirect()->back()->withErrors(['message' => 'Invalid credentials']);
//     }
    

//     public function logout()
//     {
//         Auth::logout();
//         return redirect()->route('applicants.login');
//     }

}


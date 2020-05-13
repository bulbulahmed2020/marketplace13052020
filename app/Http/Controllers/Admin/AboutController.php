<?php
namespace App\Http\Controllers\Admin;
use App\Model\About;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.about.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $msg=[
            'full_name.required' => 'Name field is required',
            'avatar.required' => 'Image is required',
            
        ];
        $this->validate($request,[
            'full_name' => 'required',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            
        ],$msg);

       $full_name = $request->get('full_name');
       $designation = $request->get('designation');
      
       $status= $request->get('status');
       $role_in_company = $request->get('role_in_company');
      


if ($request->file('avatar')) {

        $imagePath = $request->file('avatar');

        $imageName = $imagePath->getClientOriginalName();
        $fileName_without_ex = pathinfo($imageName, PATHINFO_FILENAME);
        $fileName_ex = pathinfo($imageName, PATHINFO_EXTENSION);
        $timestamp = time();
      
        $newimgname=$fileName_without_ex.'-'.$timestamp.'.'.$fileName_ex;
         
          $path = $request->file('avatar')->storeAs('uploads', $newimgname, 'public');
        }

        //$image->name = $imageName;
        $avatar_path = '/storage/'.$path.$newimgname;
    



        //dd($request->all());
        About::create([
            'full_name' => $full_name,
            'designation' => $designation,
            'avatar' => $avatar_path,
            'status' => $status,
            'role_in_company' => $role_in_company,
            

        ]);
        return redirect()->back()->with('success','Member Added Successfully');
   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $about)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        //
    }
}

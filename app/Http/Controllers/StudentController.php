<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Mail\StudentMail;
use Exception;
use Illuminate\Support\Facades\Mail;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::orderBy('created_at', 'DESC')->get();
        $students = Student::orderBy('updated_at', 'DESC')->get();
        return view('studentCRUD.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('studentCRUD.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //membuat validasi
        $request->validate([
            'nama_depan' => 'required|max:15',
            'nama_belakang' => 'required|max:15',
            'email' => 'required|unique:students,email|email',
            'no_telp' => 'required|digits_between:10,13|numeric',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
        ]);

        //insert setiap request dari form ke dalam database via model
        //jika menggunakan metode ini, maka nama field dan nama form harus sama
        Student::create($request->all());

        //redirect jika sukses menyimpan data
        return redirect()->route('students.index')->with('success','Item created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $students = Student::find($id);

        return view('studentCRUD.show',compact('students'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $students = Student::find($id);

        return view('studentCRUD.edit',compact('students'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //membuat validasi
        $request->validate([
            'nama_depan' => 'required|max:15',
            'nama_belakang' => 'required|max:15',
            'email' => 'required|unique:students,email|email',
            'no_telp' => 'required|numeric|digits_between:10,13',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
        ]);

        Student::find($id)->update($request->all());

        //redirect jika sukses menyimpan data
        return redirect()->route('students.index')
                        ->with('success','Item update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Student::find($id)->delete();

        return redirect()->route('students.index')
                            ->with('success','Item deleted successfully');
    }

    public function sendEmail()
    {
        $detail = Student::get();

        try{
            
            Mail::to('heloyellow54@gmail.com')->send(new StudentMail($detail));
            
            return redirect()->route('students.index')->with('success','Successfully send email');
        
        }catch(Exception $e){
            return redirect()->route('students.index')->with('success','Cannot send email');
        }
    }
}

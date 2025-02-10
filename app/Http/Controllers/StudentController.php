<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Students;
use Illuminate\Support\Facades\validator;



class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Students::all();
        // return view('students.index', compact('students'));
        if ($students->isEmpty()) {
            return response()->json(['message' => 'No hay estudiantes'], 404);
        }
        return $students;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator::make($request->all(), [
            'name'=>'required',
            'email'=> 'required|email|unique:student',
            'phone'=>'required|digits:10',
            'language'=>'required|in:English,Spanish,Frech',
        ]);
        
        if($validator->fails()){
            $data = [
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
                'status' => 400
        
            ];
            return response()->json($data, 400);
        }
        
        $student = Students::create($validator->validated());
        
        if(!$student){
            $data = [
                'message' => 'Error al crear el estudiante',
                'status' => 500
            ];
            return response()->json($data, 500);
        }
        $data = [
            'student' => $student,
            'status' => 201
        ];
        return response()->json($data, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Students $students, $id)
    {
        $student = Students::find($id);

        if (!$student){
            $data = [
                'message' => 'estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'student' => $student,
            'status' => 200
        ];

        return response()->json($data, 200);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Students $students)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Students $students, $id)
    {
        $student = Students::find($id);
        if (!$student){
            $data = [
                'message' => 'Estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Students $students , $id)
    {
        $student = Students::find($id);
        if (!$student){
            $data = [ 
            'message' => 'estudiante no encontrado',
            'status' => 404
            ];
            return response()->json($data, 404);
        }

        $student->delete();

        $data = [
            'message' => 'Estudiante eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);

    }
}

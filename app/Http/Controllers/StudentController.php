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

    public function store(Request $request)
    {
        $validator = validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'language' => 'required|in:English,Spanish,French',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
                'status' => 400

            ];
            return response()->json($data, 400);
        }

        $student = Students::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'language'=> $request->language
        ]);

        if (!$student) {
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




    public function show(Students $students, $id)
    {
        $student = Students::find($id);

        if (!$student) {
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



    public function update(Request $request, Students $students, $id)
    {
        $student = Students::find($id);
        if (!$student) {
            $data = [
                'message' => 'Estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:student',
            'phone' => 'required|digits:10',
            'language' => 'required|in:English,Spanish,Frech',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error de validación',
                'errors' => $validator->errors(),
                'status' => 400

            ];
            return response()->json($data, 400);
        }
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->language = $request->language;

        $student->save();

        $data = [
            'message' => 'Estudiante actualizado',
            'student' => $student,
            'status' => 200
        ];
        return response()->json($data, 200);

    }




    public function destroy(Students $students, $id)
    {
        $student = Students::find($id);
        if (!$student) {
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




    public function updatePartial(Request $request, $id){
        $student = Students::find($id);
        if (!$student){
            $data = [
                'message'=> 'Estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
    

        $validator = Validator::make(($request->all()),[
            'name' => 'max:255',
            'email' => 'email|unique:student',
            'phone' => 'digits:10',
            'language' => 'in:English,Spanish,Frech',
        ]);
        if ($validator->fails()){
            $data = [
                'message' => 'Error al crear el estudiante',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('name')){
            $student->name = $request->name;
        }

        if ($request->has('email')){
            $student->email = $request->email;
        }
 
        if ($request->has('phone')){
            $student->phone = $request->phone;
        }

        if ($request->has('language')){
            $student->language = $request->language;
        }

        $student->save();

        $data = [
            'message' => 'Estudiante actualizado',
            'student' => $student,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}

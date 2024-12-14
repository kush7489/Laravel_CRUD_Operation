<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User_Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Mycontroller extends Controller
{
    //
    public function index()
    {
        // $userDetails = User_Detail::all();
        $alldata = User_Detail::all();
        // Unserialize the attachment field for each record
        foreach ($alldata as $userDetail) {
            // Unserialize the image paths stored in the attachment field
            $userDetail->imagePaths = unserialize($userDetail->attachment);
        }
        return view('index', compact('alldata'));
    }

    public function send(Request $request)
    {
        // dd($request->input('students'));
        // dd($request->all());
        // Log::info('From send controller data received:', $request->all());
        $rules = [
            'students.*.name' => 'required|string|max:255',
            'students.*.start_date' => 'required|date',
            'students.*.end_date' => 'required|date|after_or_equal:students.*.start_date',
            'students.*.attachement' => 'required|array',
            'students.*.attachement.*' => 'nullable|image|file|mimes:jpg,png,pdf|max:2048',
            'students.*.department' => 'required|string',
            'students.*.Course' => 'required|string',
            'students.*.rollno' => 'required|string|max:50',
            'students.*.email' => 'required|email|max:255',
            'students.*.contactno' => 'required|string|max:15',
            'students.*.enrollmentno' => 'required|string|max:50',
            'students.*.branch' => 'required|string',
            'students.*.category' => 'required|string',
            'students.*.batch' => 'required|string|max:50',
            'students.*.address' => 'required|string|max:255',
            'students.*.collage_name' => 'required|string|max:255',
            'students.*.father_name' => 'required|string|max:255',
            'students.*.mother_name' => 'required|string|max:255',
            'students.*.perma_address' => 'required|string|max:255',


        ];
        // try {
        //     $validatedData = $request->validate($rules);
        // } catch (\Illuminate\Validation\ValidationException $e) {
        //     Log::error('Validation Errors:', $e->validator->errors()->toArray());
        //     return redirect()->back()->withErrors($e->validator)->withInput();
        // }


        // Validate the request data
        $validatedData = $request->validate($rules);
        Log::info('Validated Data data with multiple images:', $validatedData);

        // Process each student's data
        foreach ($validatedData['students'] as $student) {
            // Create a new UserDetail instance and save the data
            $userDetail = new user_detail();
            $userDetail->name = $student['name'];
            $userDetail->start_date = $student['start_date'];
            $userDetail->end_date = $student['end_date'];


            // Initialize an empty array to store image paths
            $imageNames = [];

            // Loop through each file uploaded for 'attachement' (which is an array of files for each student)
            foreach ($student['attachement'] as $image) {
                // Check if the $image is an instance of UploadedFile (to ensure it's a valid file)
                if ($image instanceof \Illuminate\Http\UploadedFile) {
                    // Store the image in the 'images' folder (within public storage)
                    $imagePath = $image->store('images', 'public');  // Store image and get path

                    // Add the image path/name to the array
                    $imageNames[] = $imagePath;  // You can store just the path or filename
                }
            }

            // Store the serialized array of images in the database if there are any images
            if (!empty($imageNames)) {
                $userDetail->attachment = serialize($imageNames);  // Serialize the array of images' paths
            }

            // Handle file upload
            // if ($request->hasFile('students.*.attachement')) {
            //     $file = $student['attachement'];
            //     $filename = time() . '_' . $file->getClientOriginalName();
            //     $file->move(public_path('uploads'), $filename);
            //     $userDetail->attachment = $filename;
            // }

            $userDetail->department = $student['department'];
            $userDetail->course = $student['Course'];
            $userDetail->rollno = $student['rollno'];
            $userDetail->email = $student['email'];
            $userDetail->contact_no = $student['contactno'];
            $userDetail->enrollment = $student['enrollmentno'];
            $userDetail->branch = $student['branch'];
            $userDetail->category = $student['category'];
            $userDetail->batch = $student['batch'];
            $userDetail->address = $student['address'];
            $userDetail->college_name = $student['collage_name'];
            $userDetail->father_name = $student['father_name'];
            $userDetail->mother_name = $student['mother_name'];
            $userDetail->permanent_address = $student['perma_address'];


            // Save other fields as necessary
            $userDetail->save();
        }
        return redirect()->route('index')->with('success', 'Data for multiple students saved successfully!');
    }

    public function edit_page()
    {
        $alldata = User_Detail::all();
        // Unserialize the attachment field for each record
        foreach ($alldata as $userDetail) {
            // Unserialize the image paths stored in the attachment field
            $userDetail->imagePaths = unserialize($userDetail->attachment);
        }
        return view('store', compact('alldata'));
    }

    public function update_data(Request $request)
    {
        $changedData = $request->input('changedData');
        // dd($request->all());
        // dd($changedData);
        Log::info('For Update data received', $request->all());
        $rules = [
            'students.*.name' => 'required|string|max:255',
            'students.*.start_date' => 'required|date',
            'students.*.end_date' => 'required|date|after_or_equal:students.*.start_date',
            /*
                [{"name":"Eight","start_date":"2024-12-18","end_date":"2024-12-25","department":"Civil","Course":"MCA","rollno":"2323","email":"kushlen@gmail.com","contactno":"43433","enrollmentno":"4334","branch":"Computer","category":"OBC","batch":"4343","address":"fsdf","collage_name":"fsd","father_name":"fsdf","mother_name":"fsd","perma_address":"fds","attachement":{"Illuminate\\Http\\UploadedFile":"C:\\xampp\\tmp\\php9CCD.tmp"}}]
                */
            'students.*.attachement' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'students.*.department' => 'required|string',
            'students.*.Course' => 'required|string',
            'students.*.rollno' => 'required|string|max:50',
            'students.*.email' => 'required|email|max:255',
            'students.*.contactno' => 'required|string|max:15',
            'students.*.enrollmentno' => 'required|string|max:50',
            'students.*.branch' => 'required|string',
            'students.*.category' => 'required|string',
            'students.*.batch' => 'required|string|max:50',
            'students.*.address' => 'required|string|max:255',
            'students.*.collage_name' => 'required|string|max:255',
            'students.*.father_name' => 'required|string|max:255',
            'students.*.mother_name' => 'required|string|max:255',
            'students.*.perma_address' => 'required|string|max:255',

            // Add other validation rules as needed
        ];
        try {
            $validatedData = $request->validate($rules);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation Errors:', $e->validator->errors()->toArray());
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
        // Validate the request data
        $validatedData = $request->validate($rules);
        Log::info('Validated Data two:', $validatedData);

        // Process each student's data
        foreach ($changedData as $index => $changes) {
            // Each $changes is an associative array with the field names and their updated values
            foreach ($changes as $field => $value) {
                // Process the specific changes

                $user = User_Detail::find($index); // Find the user by index (or primary key)
                // dd($user->all());

                if ($request->hasFile('attachement')) {
                    if ($user->attachment) {
                        $oldfilepath = public_path('uploads/' . $user->attachment);
                        // Log::info('old file path:', $oldfilepath);
                        if (file_exists($oldfilepath)) {
                            unlink($oldfilepath);
                        }
                    }
                    $file = $request->file('attachement');
                    if ($file->isValid()) {
                        $fake_browser_path = $file->getClientOriginalName();
                        $length_of_attachement = strlen($fake_browser_path);
                        $slice_attachement_path = substr($fake_browser_path, 13, $length_of_attachement);
                        $filename = time() . '_' . $slice_attachement_path;
                        $file->move(public_path('uploads'), $filename);
                        $user->attachment = $filename;
                    } else {
                        Log::error('Uploaded file is not valid.');
                    }
                }

                $user->$field = $value; // Update the corresponding field
                $user->save();
            }
        }
        return redirect()->route('index')->with('success', 'Data for multiple students saved successfully!');
    }


    public function delete_data()
    {
        User_Detail::query()->delete();
        return redirect()->route('index');
    }

    public function delete_user($id)
    {
        $user_find = User_Detail::find($id);
        $user_find->delete();
        return redirect()->route('index');
    }

    public function images_delete($id, $imageIndex)
    {
        // Find the image record from the database
        $image = User_Detail::findOrFail($id);

        // Unserialize the image data to get the list of image paths
        $imagePaths = unserialize($image->attachment);

        // Check if the image index exists
        if (isset($imagePaths[$imageIndex])) {
            // Get the image path (relative path from storage)
            $imagePath = $imagePaths[$imageIndex];

            // Delete the image file from storage
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            // Remove the image path from the array
            unset($imagePaths[$imageIndex]);

            // Re-serialize the image paths array and update the record
            $image->attachment = serialize(array_values($imagePaths));  // Reindex the array
            $image->save();
        }

        // Redirect back with a success message
        // return redirect()->route('index')->with('success', 'Image deleted successfully.');
        return redirect()->route('index')->with('success', 'Image deleted successfully!!');
    }

    public function upload_new_image(Request $request)
    {
        // Get the user ID
        $userId = $request->input('user_id');

        // Get the uploaded files
        $files = $request->file('attachement');
        if ($files) {
            // Loop through each file
            foreach ($files as $file) {
                // Store the file in the storage folder (local disk or cloud storage)
                // The 'public' disk stores files in the 'storage/app/public' folder
                $path = $file->store('uploads', 'public'); // Store the file
    
                // Save the file path in the database
                User_Detail::create([
                    'id' => $userId,   // Associate with the user
                    'attachment' => $path,        // Store the file path
                ]);
            }
    
            return response()->json([
                'success' => true,
                'message' => 'Files uploaded successfully.'
            ]);
            return response()->json([
                'success' => false,
                'message' => 'No files uploaded.'
            ]);
        }
    
        $studentIndex = $request->all();
        Log::info("Student Index is : ", $studentIndex);
        return response()->json(['message' => 'files selected for upload.'], 200);
        // return "Upload new Images";
    }
}

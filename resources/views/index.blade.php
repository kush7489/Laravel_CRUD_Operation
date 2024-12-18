<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Welcom in SIMS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            /* Distribute space between buttons */
            align-items: center;
            /* Align buttons vertically */
            margin-bottom: 10px;
        }

        .table-container {
            overflow-x: auto;
            padding: 10px;
            max-width: 100%;
            border: 1px solid #ddd;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            background-color: #f9f9f9;
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        .add-btn,
        .download-btn {
            display: inline-block;
            padding: 10px 20px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            border: none;
        }

        .add-btn {
            background-color: #4CAF50;
        }

        .download-btn {
            background-color: #007bff;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <center>
        <h1>Student Information Management System</h1>
    </center>

    <div class="header">
        <button class="add-btn" id="duplicateRowBtn" onclick="showElement()">Add +</button>
        <a href="{{ route('edit_page') }}"><button class="add-btn" id="">Edit</button></a>
    </div>
    <div class="header">
        <a href="{{ route('show_chart') }}"><button class="add-btn" id="">Show Chart</button></a>
    </div>
    <form action="{{ route('send') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <table id="myTable1">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Attachment</th>
                    <th>Department</th>
                    <th>Course</th>
                    <th>Roll No.</th>
                    <th>Email</th>
                    <th>Contact No.</th>
                    <th>Enrollment No.</th>
                    <th>Branch</th>
                    <th>Category</th>
                    <th>Batch</th>
                    <th>Address</th>
                    <th>College Name</th>
                    <th>Father Name</th>
                    <th>Mother Name</th>
                    <th>Perm. Addres</th>
                    <th>Action</th>

                </tr>
            </thead>

            <tbody>
                @foreach ($alldata as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        {{-- <td>{{ $user->name }}</td> --}}
                        <td> {{ $user->name }} </td>


                        <td> {{ $user->start_date }}
                        </td>

                        <td> {{ $user->end_date }} </td>

                        <td>
                            @if (!empty($user->imagePaths))
                                @foreach ($user->imagePaths as $index => $imagePath)
                                    {{-- <img src="{{ Storage::url($imagePath) }}" alt="Uploaded Image" class="img-fluid" /> --}}

                                    <div>{{ $index + 1 }}.
                                        {{ Str::limit(basename($imagePath), 10) }}
                                        {{-- {{ basename($imagePath) }} --}}
                                        <a href="{{ asset('storage/' . $imagePath) }}"
                                            style="text-decoration: none">View
                                        </a>

                                        <a href="{{ route('images.delete', ['id' => $user->id, 'imageIndex' => $index]) }}"
                                            style="text-decoration: none">Delete
                                        </a>
                                    </div>
                                    <br>
                                    </div>
                                @endforeach
                                <div style="display: flex">
                                    <input type="hidden" class="user-id" value="{{ $user->id }}">
                                    <input type="file" class="attachement"
                                        name="students[{{ $index }}][attachement][]" multiple>
                                    <button type="button" class="uploadBtn"
                                        data-index="{{ $index }}">Upload</button>
                                    <span id="stu_id" value="{{ $user->id }}"></span>
                                </div>
                            @endif
                            @if (empty($user->imagePaths))
                                <p>No attachment available for this user.</p>

                                <div style="display: flex">
                                    <!-- Add hidden input for the user ID -->
                                    <input type="hidden" class="user-id" value="{{ $user->id }}">
                                    <input type="file" class="attachement"
                                        name="students[{{ $index }}][attachement][]" multiple>
                                    <button type="button" class="uploadBtn"
                                        data-index="{{ $index }}">Upload</button>
                                    <span id="stu_id" value="{{ $user->id }}"></span>
                                </div>
                            @endif

                        </td>


                        <td>
                            {{ $user->department }}
                        </td>

                        <td>
                            {{ $user->course }}
                        <td>
                            {{ $user->rollno }}
                        </td>


                        <td> {{ $user->email }} </td>

                        <td> {{ $user->contact_no }} </td>

                        <td>
                            {{ $user->enrollment }} </td>


                        <td>
                            {{ $user->branch }}

                        <td>
                            {{ $user->category }}
                        </td>


                        <td> {{ $user->batch }} </td>


                        <td> {{ $user->address }} </td>


                        <td>
                            {{ $user->college_name }} </td>


                        <td> {{ $user->father_name }} </td>


                        <td>
                            {{ $user->mother_name }}</td>


                        <td> {{ $user->permanent_address }} </td>
                        <td>
                            <a href="{{ route('delete_user', $user->id) }}"><button type="button" class="save-btn"
                                    style="color: #e70e0e">Remove</button>
                            </a>
                        </td>

                    </tr>
                @endforeach
                <tr id="row1">
                    <td id="serial"></td>
                    <td><input type="text" name="students[0][name]" placeholder="Enter your name" required></td>
                    <td><input type="date" name="students[0][start_date]" id="startDate" required></td>
                    <td><input type="date" name="students[0][end_date]" id="endDate"></td>

                    {{-- attachment --}}
                    <td>
                        <label for="attachement" required></label>
                        <input type="file" id="attachement" name="students[0][attachement][]"
                            placeholder="Upload document" multiple>
                    </td>


                    <td><!-- department Field -->
                        <label for="department" required></label>
                        <select id="department" name="students[0][department]">
                            <option value="" disabled selected>Select your department</option>
                            <option value="Computer Science">Computer Science</option>
                            <option value="Mechanical">Mechanical</option>
                            <option value="Civil">Civil</option>
                            <option value="Electrical">Electrical</option>
                        </select>
                    </td>
                    <td><!-- Course Field -->
                        <label for="Course"></label>
                        <select id="Course" name="students[0][Course]" required>
                            <option value="" disabled selected>Select your Course</option>
                            <option value="B.Tech">B.Tech</option>
                            <option value="M.Tech">M.Tech</option>
                            <option value="BCA">BCA</option>
                            <option value="MCA">MCA</option>
                            <option value="BSC">BSC</option>
                            <option value="MSC">MSC</option>
                            <option value="BA">BA</option>
                            <option value="MA">MA</option>
                        </select>

                    </td>
                    <td><!-- rollno Field -->
                        <label for="rollno"></label>
                        <input type="text" id="rollno" name="students[0][rollno]" placeholder="Enter rollno"
                            required>
                    </td>
                    <td><!-- email Field -->
                        <label for="email"></label>
                        <input type="email" id="email" name="students[0][email]" placeholder="Enter email"
                            required>
                    </td>
                    <td><!-- contactno Field -->
                        <label for="contactno"></label>
                        <input type="text" id="contactno" name="students[0][contactno]" placeholder="Enter contactno"
                            required>
                    </td>
                    <td><!-- enrollmentno Field -->
                        <label for="enrollmentno" required></label>
                        <input type="text" id="enrollmentno" name="students[0][enrollmentno]"
                            placeholder="Enter enrollment no." reuired>
                    </td>


                    <td><!-- branch Field -->
                        <label for="branch"></label>
                        <select id="branch" name="students[0][branch]">
                            <option value="" required disabled selected>Select your branch</option>
                            <option value="Computer">Computer</option>
                            <option value="Mechanical">Mechanical</option>
                            <option value="Civil">Civil</option>
                            <option value="Electrical">Electrical</option>
                        </select>
                    </td>
                    <td><!-- category Field -->

                        <label for="category"></label>
                        <select id="category" name="students[0][category]" required>
                            <option value="" disabled selected>Select your category</option>
                            <option value="General">General</option>
                            <option value="OBC">OBC</option>
                            <option value="SC">SC</option>
                            <option value="ST">ST</option>
                            <option value="EWS">EWS</option>
                        </select>
                    </td>
                    <td><!-- batch Field -->
                        <label for="batch"></label>
                        <input type="text" id="batch" name="students[0][batch]" placeholder="Enter batch"
                            required>
                    </td>
                    <td><!-- address Field -->
                        <label for="address"></label>
                        <input type="text" id="address" name="students[0][address]" placeholder="Enter address"
                            required>
                    </td>
                    <td><!-- collage_name Field -->
                        <label for="collage_name"></label>
                        <input type="text" id="collage_name" name="students[0][collage_name]"
                            placeholder="Enter collage Name" required>
                    </td>
                    <td><!-- father_name Field -->
                        <label for="father_name"></label>
                        <input type="text" id="father_name" name="students[0][father_name]"
                            placeholder="Enter father name" required>
                    </td>
                    <td><!-- mother_name Field -->
                        <label for="mother_name"></label>
                        <input type="text" id="mother_name" name="students[0][mother_name]"
                            placeholder="Enter mother name" required>
                    </td>
                    <td><!-- perma_address Field -->
                        <label for="perma_address"></label>
                        <input type="text" id="perma_address" name="students[0][perma_address]"
                            placeholder="Enter permanent address" required>
                    </td>

                    <td><button type="button" onclick="deleteRow(this)">Delete</button></td>

                </tr>
                <button type="submit" style="color: #4CAF50">Save</button>
            </tbody>
        </table>
    </form>


    <script>
        // Store the original row template
        var originalRow = document.getElementById('row1');
        var rowIndex = 1; // Start from 1 since the first row is index 0

        // // Handle date change
        // document.getElementById('row1').style.display = 'none';
        document.getElementById('myTable1').addEventListener('change', function(event) {
            if (event.target && event.target.name.includes('start_date')) {
                const startDate = event.target;
                // const startDate = start_date;
                const endDate = startDate.closest('tr').querySelector('[name*="end_date"]');
                endDate.setAttribute('min', startDate.value); // Set min end date to start date
            }

            // Handle end date change
            if (event.target && event.target.name.includes('end_date')) {
                const endDate = event.target;
                // const endDate = end_date;
                const startDate = endDate.closest('tr').querySelector('[name*="start_date"]');

                // Set the maximum value of start date to be the selected end date
                startDate.setAttribute('max', endDate.value);
            }
        });


        // function showElement() {
        //     document.getElementById('row1').style.display = 'block';
        // }
        document.getElementById('duplicateRowBtn').addEventListener('click', function() {
            // Get the table body
            var tableBody = document.getElementById('myTable1').getElementsByTagName('tbody')[0];
            // document.getElementById('row1').style.display = 'block';

            // Clone the original row

            var newRow = originalRow.cloneNode(true);
            // document.getElementById('serial').innerHTML=rowIndex;          
            // Clear the input values in the cloned row            
            var inputs = newRow.getElementsByTagName('input');
            for (var i = 0; i < inputs.length; i++) {
                inputs[i].value = ''; // Clear the value
                // Update the name attribute to reflect the new index
                inputs[i].name = inputs[i].name.replace(/\[\d+\]/, '[' + rowIndex + ']');
            }

            // Clear the selected values in the select inputs
            var selects = newRow.getElementsByTagName('select');
            for (var j = 0; j < selects.length; j++) {
                selects[j].selectedIndex = 0; // Reset to the first option (disabled)
                // Update the name attribute to reflect the new index
                selects[j].name = selects[j].name.replace(/\[\d+\]/, '[' + rowIndex + ']');
            }

            // Optionally, remove the ID or change it
            newRow.removeAttribute('id'); // Remove the ID

            // Append the new row to the table body
            tableBody.appendChild(newRow);
            rowIndex++; // Increment the row index for the next duplicate

        });

        function deleteRow(button) {
            // Get the row of the button that was clicked
            var row = button.closest('tr');

            // Prevent deletion of the original row
            if (row === originalRow) {
                alert("You cannot delete the original row.");
                return;
            }

            // Remove the row from the table
            row.remove();
        }

        $(document).ready(function() {
            // Handle the file upload button click event
            $('.uploadBtn').click(function() {
                var index = $(this).data('index'); // Get the index of the student from data-index
                var inputFile = $('input[name="students[' + index + '][attachement][]"]')[
                    0]; // Get the file input by index

                // Retrieve the user ID from the hidden input in the same row
                var userId = $(this).closest('td').find('.user-id').val();

                var files = inputFile.files;
                var validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml',
                    'application/pdf', 'application/msword'
                ];

                for (var i = 0; i < files.length; i++) {
                    if (validTypes.indexOf(files[i].type) === -1) {
                        alert('Invalid file type. Only images and documents are allowed.');
                        return;
                    }
                }

                // If no files are selected, show an alert
                if (inputFile.files.length === 0) {
                    alert('Please select a file to upload.');
                    return;
                }

                var formData = new FormData(); // Create a new FormData object

                // Append the selected files to FormData
                $.each(inputFile.files, function(i, file) {
                    formData.append('attachement[]', file);
                });

                // Append the user ID to FormData
                formData.append('user_id', userId); // This is the key where we store the user ID

                // console.log("Form data is : ", formData);


                // Get the CSRF token from the meta tag
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                // Send the data via AJAX
                $.ajax({
                    url: '{{ route('upload_new_image') }}', // Your Laravel route for handling the upload
                    type: 'POST',
                    data: formData,
                    processData: false, // Don't let jQuery process the data
                    contentType: false, // Don't set content-type for multipart/form-data
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Include CSRF token in the request headers
                    },
                    success: function(response) {
                        alert('Files uploaded successfully');
                        // console.log(response); // Optionally, log the response for debugging
                        window.location.reload(); // Reloads the current page
                    },
                    error: function(xhr, status, error) {
                        alert('There was an error uploading the file.');
                        console.error(error);
                    }
                });
            });
        });
    </script>




</body>

</html>

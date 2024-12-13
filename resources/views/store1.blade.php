<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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



</head>

<body>
    <center>
        <h1>Student Information Management System</h1>
    </center>

    <div class="header">

        <a href="{{ route('index') }}"><button class="add-btn" id="">Back</button></a>
        <form action="{{ route('delete_data') }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="add-btn" id="">Delete All</button>
        </form>

    </div>
    <form action="{{ route('update_data') }}" method="POST" enctype="multipart/form-data"
        onsubmit="handleSubmit(event)">
        @csrf
        @method('PUT')

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

                </tr>
            </thead>

            <tbody>
                @foreach ($alldata as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        {{-- <td>{{ $user->name }}</td> --}}
                        <td><input type="text" name="students[{{ $index }}][name]" value="{{ $user->name }}"
                                placeholder="Enter your name"
                                onchange="trackChange({{ $user->id }}, 'name', this.value)" required></td>


                        <td><input type="date" name="students[{{ $index }}][start_date]"
                                value="{{ $user->start_date }}" id="startDate"
                                onchange="trackChange({{ $user->id }}, 'start_date', this.value)" required>
                        </td>

                        <td><input type="date" name="students[{{ $index }}][end_date]"
                                value="{{ $user->end_date }}" id="endDate"
                                onchange="trackChange({{ $user->id }}, 'end_date', this.value)" required</td>


                            {{-- <td><a href="{{ asset('uploads/' . $user->attachment) }}">View Attachment</a></td> --}}

                        <td>

                            <p> <a href="{{ asset('uploads/' . $user->attachment) }}" style="text-decoration: none">
                                    {{ basename($user->attachment) }} </a></p>
                            <p>

                                <label for="attachement" required></label>
                                <input type="file" id="attachement"
                                    name="students[{{ $index }}][attachement]" placeholder="Upload document"
                                    onchange="trackChange({{ $user->id }}, 'attachment', this.value)">
                            </p>



                        </td>


                        <td>
                            <select id="department" name="students[{{ $index }}][department]"
                                onchange="trackChange({{ $user->id }}, 'department', this.value)">
                                <option value="" disabled selected>Select your department</option>
                                <option value="Computer Science"
                                    {{ $user->department == 'Computer Science' ? 'selected' : '' }}>
                                    Computer Science</option>
                                <option value="Mechanical" {{ $user->department == 'Mechanical' ? 'selected' : '' }}>
                                    Mechanical
                                </option>
                                <option value="Civil" {{ $user->department == 'Civil' ? 'selected' : '' }}>Civil
                                </option>
                                <option value="Electrical" {{ $user->department == 'Electrical' ? 'selected' : '' }}>
                                    Electrical</option>
                            </select>
                        </td>

                        <td><select id="Course" name="students[{{ $index }}][Course]"
                                onchange="trackChange({{ $user->id }}, 'Course', this.value)" required>
                                <option value="" disabled selected>Select your Course</option>
                                <option value="B.Tech" {{ $user->course == 'B.Tech' ? 'selected' : '' }}>
                                    B.Tech</option>
                                <option value="M.Tech" {{ $user->course == 'M.Tech' ? 'selected' : '' }}>M.Tech
                                </option>
                                <option value="BCA" {{ $user->course == 'BCA' ? 'selected' : '' }}>BCA</option>

                                <option value="MCA" {{ $user->course == 'MCA' ? 'selected' : '' }}>MCA</option>

                                <option value="BSC"{{ $user->course == 'BSC' ? 'selected' : '' }}>BSC</option>

                                <option value="MSC"{{ $user->course == 'MSC' ? 'selected' : '' }}>MSC</option>

                                <option value="BA"{{ $user->course == 'BA' ? 'selected' : '' }}>BA</option>

                                <option value="MA" {{ $user->course == 'MA' ? 'selected' : '' }}>MA</option>
                            </select></td>


                        <td>
                            <label for="rollno"></label>
                            <input type="text" id="rollno" name="students[{{ $index }}][rollno]"
                                placeholder="Enter rollno" value="{{ $user->rollno }}"
                                onchange="trackChange({{ $user->id }}, 'rollno', this.value)" required>
                        </td>


                        <td> <label for="email"></label>
                            <input type="email" id="email" name="students[{{ $index }}][email]"
                                value="{{ $user->email }}" placeholder="Enter email"
                                onchange="trackChange({{ $user->id }}, 'email', this.value)" required</td>

                        <td><label for="contactno"></label>
                            <input type="text" id="contactno" name="students[{{ $index }}][contactno]"
                                value="{{ $user->contact_no }}" placeholder="Enter contactno"
                                onchange="trackChange({{ $user->id }}, 'contactno', this.value)"</td>

                        <td>
                            <label for="enrollmentno" required></label>
                            <input type="text" value="{{ $user->enrollment }}" id="enrollmentno"
                                name="students[{{ $index }}][enrollmentno]"
                                onchange="trackChange({{ $user->id }}, 'enrollmentno', this.value)"</td>


                        <td><select id="branch" name="students[{{ $index }}][branch]"
                                onchange="trackChange({{ $user->id }}, 'branch', this.value)">

                                <option value="" required disabled selected>Select your branch</option>

                                <option value="Computer" {{ $user->branch == 'Computer' ? 'selected' : '' }}>Computer
                                </option>

                                <option value="Mechanical" {{ $user->branch == 'Mechanical' ? 'selected' : '' }}>
                                    Mechanical</option>

                                <option value="Civil" {{ $user->branch == 'Civil' ? 'selected' : '' }}>Civil</option>
                                <option value="Electrical" {{ $user->branch == 'Electrical' ? 'selected' : '' }}>
                                    Electrical</option>
                            </select></td>

                        <td>
                            {{-- category --}}
                            <select id="category" name="students[{{ $index }}][category]"
                                onchange="trackChange({{ $user->id }}, 'category', this.value)" required>
                                <option value="" disabled selected>Select your category</option>
                                <option value="General" {{ $user->category == 'General' ? 'selected' : '' }}>
                                    General
                                </option>
                                <option value="OBC" {{ $user->category == 'OBC' ? 'selected' : '' }}>OBC</option>

                                <option value="SC" {{ $user->category == 'SC' ? 'selected' : '' }}>SC</option>

                                <option value="ST" {{ $user->category == 'ST' ? 'selected' : '' }}>ST</option>

                                <option value="EWS" {{ $user->category == 'EWS' ? 'selected' : '' }}>EWS</option>
                            </select>
                        </td>


                        <td><label for="batch"></label>
                            <input type="text" id="batch" name="students[{{ $index }}][batch]"
                                value="{{ $user->batch }}" placeholder="Enter batch"
                                onchange="trackChange({{ $user->id }}, 'batch', this.value)"</td>


                        <td> <label for="address"></label>
                            <input type="text" value="{{ $user->address }}" id="address"
                                name="students[{{ $index }}][address]" placeholder="Enter address"
                                onchange="trackChange({{ $user->id }}, 'address', this.value)"</td>


                        <td>
                            <label for="collage_name"></label>
                            <input type="text" id="collage_name" value="{{ $user->college_name }}"
                                name="students[{{ $index }}][collage_name]"
                                onchange="trackChange({{ $user->id }}, 'collage_name', this.value)"</td>


                        <td><label for="father_name"></label>
                            <input type="text" id="father_name" value="{{ $user->father_name }}"
                                name="students[{{ $index }}][father_name]"
                                onchange="trackChange({{ $user->id }}, 'father_name', this.value)"</td>


                        <td>
                            <label for="mother_name"></label>
                            <input type="text" id="mother_name" name="students[{{ $index }}][mother_name]"
                                value="{{ $user->mother_name }}"
                                onchange="trackChange({{ $user->id }}, 'mother_name', this.value)"</td>


                        <td> <label for="perma_address"></label>
                            <input type="text" id="perma_address"value="{{ $user->permanent_address }}"
                                name="students[{{ $index }}][perma_address]"
                                onchange="trackChange({{ $user->id }}, 'perma_address', this.value)"</td>
                    </tr>
                @endforeach


            </tbody>
        </table>
        <div>
            <center> {{ $alldata->links() }}</center>
        </div>
        <button type="submit" class="add-btn" id="">Update All</button>
    </form>

    <script>
        console.log('Hello This is store file');
        let changedData = []; // Initialize it with an empty object, or any relevant data.

        // // Handle start date change
        // var start_date = document.getElementById('startDate');
        // var end_date = document.getElementById('endDate');
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
                let startdate = new Date(startDate);
                let enddate = new Date(endDate);
                if (startdate > enddate) {
                    alert('This not possible ')
                } else {
                    const startDate = endDate.closest('tr').querySelector('[name*="start_date"]');

                    // Set the maximum value of start date to be the selected end date
                    startDate.setAttribute('max', endDate.value);
                }
            }
        });






        function trackChange(index, field, value) {
            // Find the record in the changedData 
            console.log(index, field, value);
            let record = changedData.find(item => item.index === index);
            // console.log('Record is : ', record);

            if (!record) {
                record = {
                    index: index
                };
                changedData.push(record);
            }

            // Update the record with the new field and value
            record[field] = value;

            // You can log or process the changed data as needed
            console.log(changedData);
        }

        function handleSubmit(event) {
            // Prevent the default form submission to handle it manually
            event.preventDefault();

            // Loop through the changedData array and create hidden input fields for each change
            changedData.forEach(record => {
                for (let field in record) {
                    if (field !== 'index') {
                        // Create a hidden input for each change
                        let input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = `changedData[${record.index}][${field}]`;
                        input.value = record[field];

                        // Append the input field to the form
                        document.forms[0].appendChild(input);
                    }
                }
            });

            // Now submit the form manually
            event.target.submit();
        }
    </script>
</body>

</html>

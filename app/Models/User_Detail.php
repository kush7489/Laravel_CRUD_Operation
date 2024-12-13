<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_Detail extends Model
{
    //
    protected $fillable = ['name','start_date','end_date','attachment','department','course','rollno','email','contactno','enrollment','branch','category','batch','address','college_name','father_name','mother_name','permanent_address']; 
}

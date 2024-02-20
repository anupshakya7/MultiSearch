<?php

namespace App\Http\Controllers;

use App\Models\Institute;
use App\Models\StudyLevel;
use Illuminate\Http\Request;
use Monolog\Level;

class DropdownController extends Controller
{
    public function country($id)
    {
        $institute = Institute::with('course')->where('country_id', $id)->get();
        
        $finalArray = [];
        
        foreach ($institute as $institute) {
            $instituteData = $institute->toArray(); // Get the basic attributes
        
            // Flatten the "course" array
            $courses = [];
            foreach ($instituteData['course'] as $course) {
                $courses[] = $course;
            }
        
            $instituteData['course'] = $courses;
        
            $finalArray[] = $instituteData;
        }
        $allCourseArray = [];

        foreach ($finalArray as $item) {
            if (isset($item['course'])) {
                $allCourseArray = array_merge($allCourseArray, $item['course']);
            }
        }
        $course = array_values(array_map("unserialize", array_unique(array_map("serialize", $allCourseArray), SORT_REGULAR)));
        $level = array();
        foreach($course as $key=>$level_ids){
            $levels = StudyLevel::where('id',$level_ids['level_id'])->get();    
            $level[] = $levels;
        }
        $flattenedArray = collect($level)->flatten()->toArray();
        $study_level = array_values(array_map("unserialize",array_unique(array_unique(array_map("serialize",$flattenedArray),SORT_REGULAR))));

        return response()->json([
            'status'=>200,
            'institute'=>$institute,
            'course'=>$course,
            'study_level'=>$study_level
        ]);
    }
}

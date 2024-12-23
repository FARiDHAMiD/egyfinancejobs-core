<?php

use App\Models\AboutUS;
use Illuminate\Support\Facades\Http;
use App\Models\Job;
use App\Models\User;


function about_us(){
    $aboutSection = AboutUS::firstOrCreate(
        [],  // Conditions to find the record
        ['phone' => '01015891836']   // Attributes to create if not found
    );
    return $aboutSection;
}
function export_jobApplication($collection){
    $data = [];
    $university = [];
    foreach($collection as $key=>$application){

        foreach ($application->employee->employee_educations  as $education){
            $university[]=optional($education->university)->name;
        }



        $status = null;
        if($application->status == 'pending'){
            $status = 'Pending';
        }elseif($application->status == 'ReviewedyourApplication'){
            $status = 'Reviewed your Application';
        }elseif($application->status == 'Shortlisted'){
            $status = 'Shortlisted';
        }elseif($application->status == 'accepted'){
            $status = 'Accepted';
        }elseif($application->status == 'rejected'){
            $status = 'Rejected';
        }

        $data[] = [
            'SL'=>$key+1,
            'Employee Name' => $application->employee->first_name . ' ' . $application->employee->last_name,
            'Job Title' => $application->job->job_title,
            'Company Name' => optional($application->job->employer_profile)->company_name,
            'status' => $status,
            'city' =>optional(optional(optional($application->employee)->employee_profile)->city)->name,
            'university' => $university,
            'Date'=>date('d-m-Y', strtotime($application->created_at))

        ];
    }
    return $data;
}

function get_latitude_longitude($area, $city, $country) {
    $search_terms = array("$area, $city, $country", "$area, $city", "$area", "$city, $country", "$country");

    foreach ($search_terms as $term) {
        $apiKey = env('LOCATIONIQ_API_KEY');
        $response = Http::withoutVerifying()->get("https://us1.locationiq.com/v1/search.php", [
            'key' => $apiKey,
            'q' => $term,
            'format' => 'json',
            'limit' => 1,
        ]);

        $json = $response->json();

        if ($response->successful() && isset($response[0]) && !isset($json['error'])) {
            return $json[0];
        }
    }

    return array('lat' => null, 'lon' => null);
}

function getCoordinatesFromAddress($address)
{
    // Retrieve the API key from the .env file
    $apiKey = env('LOCATIONIQ_API_KEY');
    
    // Send a GET request to the LocationIQ API
    return $response = Http::withoutVerifying()->get("https://us1.locationiq.com/v1/search.php", [
        'key' => $apiKey,
        'q' => $address,
        'format' => 'json',
        'limit' => 1,
    ]);

    // Check if the response was successful
    if ($response->successful() && isset($response[0])) {
        return [
            'lat' => $response[0]['lat'],
            'lon' => $response[0]['lon'],
        ];
    }

    // Return null if no results are found or if there's an error
    return null;
}

function is_has_job($user_id, $job_id){
    $user = User::find($user_id);
    $isSaved = $user->saved_jobs()->where('job_id', $job_id)->exists();
    return $isSaved;
}
function is_job_applied($user_id, $job_id){
    $user = User::find($user_id);
    $isSaved = $user->applied_jobs()->where('job_id', $job_id)->exists();
    return $isSaved;
}


function experience_calc($starting_from, $ending_in){
    $date1 = new DateTime($starting_from);
    $date2 = new DateTime($ending_in);
    $now = new DateTime();

    if($date2 > $now){
        $date2 = $now;
    }

    $interval = $date1->diff($date2);
    $years = $interval->y;
    $months = $interval->m;

    if ($years > 0) {
        $diff = "$years year" . ($years > 1 ? 's' : '');
        if ($months > 0) {
            $diff .= ", $months month" . ($months > 1 ? 's' : '');
        }
    } else {
        $diff = "$months month" . ($months > 1 ? 's' : '');
    }
    return $diff;
}

function degree_grades(){
    return [
        'Fair',
        'Good',
        'Very Good',
        'Excellent',
        'Very good with honors',
    ];
}
function get_age($birthdate){
    $birthDate = new DateTime($birthdate);
    $currentDate = new DateTime();
    $age = $currentDate->diff($birthDate);
    return $age->y;
}



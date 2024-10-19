<?php
namespace App\Repositories;

use App\Models\Image;
use App\Models\Note;
use App\Models\Subscriber;
use App\Services\ReduceImage;
use Illuminate\Support\Facades\Auth;
use Str;

class SubscriberRepository{

    protected $subscriber;
    protected $imageService;

    public function __construct(Subscriber $subscriber, ReduceImage $imageService) {
        $this->subscriber = $subscriber;
        $this->imageService = $imageService;
    }

    public function createSubscriber($request)
    {
        $user = Auth::user();
        // create subscriber
        $subscriber = Subscriber::create([
            'first_name'=> $request->input('first_name'),
            'last_name'=> $request->input('last_name'),
            'email'=> $request->input('email'),
            'birth'=> $request->input('birth'),
            'address'=> $request->input('address'),
            'phone'=> $request->input('phone'),
            'user_id'=> $user->id,

            ]);

            // create Note
            $note = Note::create([
                'description' => $request->input('description'),
                'subscriber_id' => $subscriber->id, 
            ]);

            // upload images            
            $requestFiles = $request->file('url');
            $maxSize = 2 * 1024 * 1024;
            $max_width = 800; 
            $max_height = 600; 

            if (!is_array($requestFiles)) {
                return ['status' => 'Error', 'message' => 'The input must be an array of files '];
            }

            $uploadedImages = []; 
            foreach ($requestFiles as $file) { 
                // check  image size
                if ($file->getSize() > $maxSize) {
                    return ['status' => 'Error', 'message' => 'File size must be less than 2MB'];
                }
                // storage image
                $dir = 'public/documents'; 
                $randomFileName = Str::random(32) . '.' . $file->getClientOriginalExtension(); // Generate a random file name 
               // Temporary path to save image
                $tempFilePath = $file->getPathName();
                // Resize the image using ImageService
                $outputFilePath = storage_path('app/' . $dir . '/' . $randomFileName); // Final path after minification
                
                //$filePath = $file->storeAs($dir, $randomFileName); // Store the file with the random name 

                // Service injection ---> imageService this is method
                if ($this->imageService->resizeImage($tempFilePath, $max_width, $max_height, $outputFilePath)) {
                    // Save the information in the database after reducing the image 
                    Image::create([ 
                        'url' =>  $randomFileName, 
                        'subscriber_id' => $subscriber->id, 
                    ]); 
                   $uploadedImages[] = asset('storage/documents/' . $randomFileName);
                } 
            }

            return [
                'subscriber' => $subscriber,
                'note' => $note,
                'uploadedImages' => $uploadedImages
            ];

       
    }
}
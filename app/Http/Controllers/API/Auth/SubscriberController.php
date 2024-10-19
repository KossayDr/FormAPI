<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriberRequest;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Repositories\SubscriberRepository;
class SubscriberController extends Controller
{
    use GeneralTrait;
    protected $subscriberRepository;
    public function __construct(SubscriberRepository $subscriberRepository){
        $this->subscriberRepository = $subscriberRepository;
    }
    public function createSubscriber(SubscriberRequest $request){
        $subscriber =$this->subscriberRepository->createSubscriber($request);
        return $this->buildResponse($subscriber,'Success','created successfully',201);
    }
}

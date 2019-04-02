<?php
namespace App\Exceptions;
use App\Exceptions\ExceptionTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

 trait ExceptionTrait
 {
	 public function apiException($request, $e)
	 {
		 if ($this->isModel($e)) 
		   {
			  return $this->isModelResponse($e);
		   }		

		   if ($this->isHttp($e))
		   {
			  return $this->isHttpResponse($e);
		   }
		return parent::render($request, $exception);		   
	 }
	 
	 protected function isModel($e)
	 {
		 return $e instanceof ModelNotFoundException;
	 }
	 
	 protected function isHttp($e)
	 {
		return $e instanceof NotFoundHttpException;
	 }
	 
	 protected function isModelResponse($e)
	 {
		return response()->json([
			     'Error' => 'Model Product Not Found'
			  ],Response::HTTP_NOT_FOUND);
	 }
	 
	 protected function isHttpResponse($e)
	 {
		return response()->json([
			     'Error' => 'Route Not Found'
			  ],Response::HTTP_NOT_FOUND);
	 }
 }

?>
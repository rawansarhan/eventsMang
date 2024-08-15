<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\userController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('super_admin')->group(function () {

    Route::post('login', [App\Http\Controllers\AuthController::class, 'Login']);

    Route::middleware('auth:api')->group(function () {
        //auth
        Route::get('index', [App\Http\Controllers\userController::class, 'index']);
        Route::get('showPersonalInfo/{id}', [App\Http\Controllers\userController::class, 'showPersonalInfo']);
        Route::get('logout', [App\Http\Controllers\AuthController::class, 'logout']);
        Route::post('update/Admin/{id}', [App\Http\Controllers\userController::class, 'updatePesonalInfo_Admin']);
        //wallet
        Route::get('showWalllet/{id}', [App\Http\Controllers\PaidController::class, 'show_Wallet']);
        //song
        Route::post('create/song', [App\Http\Controllers\songController::class, 'create']);
        Route::post('update/song/{id}', [App\Http\Controllers\songController::class, 'updateSong']);
        Route::get('show/song', [App\Http\Controllers\songController::class, 'index']);
        Route::get('delete/song/{id}', [App\Http\Controllers\songController::class, 'deleteSong']);
          
        //food
        Route::apiResource('foods', \App\Http\Controllers\FoodController::class);
        Route::apiResource('food_categories', \App\Http\Controllers\FoodCategoryController::class);
        //decorations
        Route::apiResource('decoration_categories', \App\Http\Controllers\DecorationCategoryController::class);
        Route::apiResource('decorations', \App\Http\Controllers\DecorationController::class);

         //Hall
         Route::get('index_hall', [App\Http\Controllers\HallController::class, 'index']);
         Route::get('acceptHall/{id}', [App\Http\Controllers\HallController::class, 'acceptHall']);
         Route::get('unrecordedHalls', [App\Http\Controllers\HallController::class, 'unrecordedHalls']);
         Route::get('hallDetails/{id}', [App\Http\Controllers\HallController::class, 'hallDetails']);
         Route::get('hallViews/{id}', [App\Http\Controllers\HallController::class, 'hallViews']);
         Route::get('rejectHall/{id}', [App\Http\Controllers\HallController::class, 'rejectHall']);
 
         //Hall Type
         Route::get('indexTypes', [App\Http\Controllers\HallTypeController::class, 'index']);
         Route::get('typeHalls/{id}', [App\Http\Controllers\HallTypeController::class, 'hallsOfType']);
 
         //Reservation
         Route::get('indexReservations', [App\Http\Controllers\ReservationController::class, 'index']);
         Route::post('acceptReservation/{id}', [App\Http\Controllers\ReservationController::class, 'acceptReservation']);
         Route::get('rejectReservation/{id}', [App\Http\Controllers\ReservationController::class, 'rejectReservation']);
         Route::get('pendingReservations', [App\Http\Controllers\ReservationController::class, 'pendingReservations']);
         Route::get('allPreviousReservations', [App\Http\Controllers\ReservationController::class, 'allPreviousReservations']);
         Route::get('allUpcomingReservations', [App\Http\Controllers\ReservationController::class, 'allUpcomingReservations']);
 
         //Report
         Route::get('indexReports', [App\Http\Controllers\ReportController::class, 'indexReports']);
 
         //Home Reservation
         Route::get('indexHomeReservations', [App\Http\Controllers\HomeReservationController::class, 'index']);
         Route::get('pendingHomeReservations', [App\Http\Controllers\HomeReservationController::class, 'pendingHomeReservations']);
         Route::get('allPreviousHomeReservations', [App\Http\Controllers\HomeReservationController::class, 'allPreviousHomeReservations']);
         Route::get('allUpcomingHomeReservations', [App\Http\Controllers\HomeReservationController::class, 'allUpcomingHomeReservations']);
 
         //Reservation Type
         Route::get('indexReservationTypes', [App\Http\Controllers\ReservationTypeController::class, 'index']);
         Route::get('reservationsOfType/{id}', [App\Http\Controllers\ReservationTypeController::class, 'reservationsOfType']);
         Route::get('homeReservationsOfType/{id}', [App\Http\Controllers\ReservationTypeController::class, 'homeReservationsOfType']);

         //Photography
         Route::post('addPhotography',[\App\Http\Controllers\PhotographyController::class, 'addPhotography']);
         Route::put('updatePhotography',[\App\Http\Controllers\PhotographyController::class, 'updatePhotography']);
         Route::delete('deletePhotography/{id}',[\App\Http\Controllers\PhotographyController::class, 'deletePhotography']);
         Route::get('indexPhotography',[\App\Http\Controllers\PhotographyController::class, 'indexPhotography']);
    });
});


Route::prefix('admin_hall')->group(function () {

    Route::post('register', [App\Http\Controllers\AuthController::class, 'Register_adminHall']);
    Route::post('Login', [App\Http\Controllers\AuthController::class, 'Login']);

    Route::middleware('auth:api')->group(function () {

        Route::get('logout', [App\Http\Controllers\AuthController::class, 'logout']);

        Route::get('showPersonalInfo/{id}', [App\Http\Controllers\userController::class, 'showPersonalInfo']);
        Route::post('update/user/{id}', [App\Http\Controllers\userController::class, 'updatePesonalInfo']);
        ///wallet
        Route::get('showWalllet/{id}', [App\Http\Controllers\PaidController::class, 'show_Wallet']);

        //hallViews
        Route::get('hallViews/{id}', [App\Http\Controllers\HallController::class, 'hallViews']);
        
        //Hall
        Route::get('hallViews/{id}', [App\Http\Controllers\HallController::class, 'hallViews']);
        Route::post('update', [App\Http\Controllers\HallController::class, 'update']);

        //Reservation
        Route::get('hallReservations', [App\Http\Controllers\ReservationController::class, 'hallReservations']);
        Route::get('hallPreviousReservations', [App\Http\Controllers\ReservationController::class, 'hallPreviousReservations']);
        Route::get('hallUpcomingReservations', [App\Http\Controllers\ReservationController::class, 'hallUpcomingReservations']);

        //Reservation Type
        Route::get('indexReservationTypes', [App\Http\Controllers\ReservationTypeController::class, 'index']);
        Route::get('hallReservationsOfType/{id}', [App\Http\Controllers\ReservationTypeController::class, 'hallReservationsOfType']);
    });
});


Route::prefix('client')->group(function () {

    Route::post('register', [App\Http\Controllers\AuthController::class, 'Register']);
    Route::post('Login', [App\Http\Controllers\AuthController::class, 'Login']);
    Route::get('login/google', [App\Http\Controllers\GoogleController::class, 'redirectToGoogle']);
    Route::get('login/google/callback', [App\Http\Controllers\GoogleController::class, 'handleGoogleCallback']);


    Route::middleware('auth:api')->group(function () {

        Route::get('logout', [App\Http\Controllers\AuthController::class, 'logout']);
        Route::get('showPersonalInfo/{id}', [App\Http\Controllers\userController::class, 'showPersonalInfo']);
        Route::post('update/user/{id}', [App\Http\Controllers\userController::class, 'updatePesonalInfo']);
        //song
        Route::get('show/song', [App\Http\Controllers\songController::class, 'index']);

        ///paid
        Route::get('paid/{id}', [App\Http\Controllers\PaidController::class, 'paid']);
        ///wallet
        Route::get('showWalllet/{id}', [App\Http\Controllers\PaidController::class, 'show_Wallet']);
        Route::post('create/wallet', [App\Http\Controllers\PaidController::class, 'createWallet']);
        Route::post('update/wallet/{id}', [App\Http\Controllers\PaidController::class, 'updateWalletBalancee']);

        //favorite
        Route::post('favorite/add', [App\Http\Controllers\FavoriteController::class, 'changeStatus']);
        Route::get('favorite', [App\Http\Controllers\FavoriteController::class, 'index']);
        Route::get('index_withfavorite', [App\Http\Controllers\HallController::class, 'index_withfavorite']);
        //hallViews
        Route::get('hallViews/{id}', [App\Http\Controllers\HallController::class, 'hallViews']);

         //Hall
         Route::get('index_hall', [App\Http\Controllers\HallController::class, 'index']);
         Route::post('hallFromCoordinates', [App\Http\Controllers\HallController::class, 'hallFromCoordinates']);
         Route::get('showAccordingRating', [App\Http\Controllers\HallController::class, 'showAccordingRating']);
         Route::get('lowestPrice', [App\Http\Controllers\HallController::class, 'lowestPrice']);
         Route::get('highestPrice', [App\Http\Controllers\HallController::class, 'highestPrice']);
         Route::get('smallestSpace', [App\Http\Controllers\HallController::class, 'smallestSpace']);
         Route::get('largestSpace', [App\Http\Controllers\HallController::class, 'largestSpace']);
         Route::get('hallDetails/{id}', [App\Http\Controllers\HallController::class, 'hallDetails']);
         Route::get('hallViews/{id}', [App\Http\Controllers\HallController::class, 'hallViews']);
         Route::post('search', [App\Http\Controllers\HallController::class, 'hallsAccordingQuestions']);
 
         //Hall Type
         Route::get('indexTypes', [App\Http\Controllers\HallTypeController::class, 'index']);
         Route::get('typeHalls/{id}', [App\Http\Controllers\HallTypeController::class, 'hallsOfType']);
 
         //Reservation
         Route::post('addReservation', [App\Http\Controllers\ReservationController::class, 'addReservation']);
         Route::put('updateReservation', [App\Http\Controllers\ReservationController::class, 'updateReservation']);
         Route::delete('deleteReservation/{id}', [App\Http\Controllers\ReservationController::class, 'deleteReservation']);
         Route::get('userReservations', [App\Http\Controllers\ReservationController::class, 'userReservations']);
         Route::get('reservationDates/{id}', [App\Http\Controllers\ReservationController::class, 'reservationDates']);
         Route::get('userPreviousReservations', [App\Http\Controllers\ReservationController::class, 'userPreviousReservations']);
         Route::get('userUpcomingReservations', [App\Http\Controllers\ReservationController::class, 'userUpcomingReservations']);
 
         //Report
         Route::post('addReport', [App\Http\Controllers\ReportController::class, 'addReport']);
 
         //Home Reservation
         Route::get('userHomeReservations', [App\Http\Controllers\HomeReservationController::class, 'userHomeReservations']);
         Route::post('addHomeReservation', [App\Http\Controllers\HomeReservationController::class, 'addHomeReservation']);
         Route::put('updateHomeReservation', [App\Http\Controllers\HomeReservationController::class, 'updateHomeReservation']);
         Route::delete('deleteHomeReservation/{id}', [App\Http\Controllers\HomeReservationController::class, 'deleteHomeReservation']);
         Route::get('userPreviousHomeReservations', [App\Http\Controllers\HomeReservationController::class, 'userPreviousHomeReservations']);
         Route::get('userUpcomingHomeReservations', [App\Http\Controllers\HomeReservationController::class, 'userUpcomingHomeReservations']);
 
         //Reservation Type
         Route::get('indexReservationTypes', [App\Http\Controllers\ReservationTypeController::class, 'index']);
         Route::get('userReservationsOfType/{id}', [App\Http\Controllers\ReservationTypeController::class, 'userReservationsOfType']);
         Route::get('userHomeReservationsOfType/{id}', [App\Http\Controllers\ReservationTypeController::class, 'userHomeReservationsOfType']);

         //Photography
         Route::get('indexPhotography',[\App\Http\Controllers\PhotographyController::class, 'indexPhotography']);
        Route::get('availablePhotography/{date}',[\App\Http\Controllers\PhotographyController::class, 'availablePhotography']);
    });
});

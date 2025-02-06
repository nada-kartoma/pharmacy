<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use GuzzleHttp\Client;
use App\Models\Medicine;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
  app(Controller::class)->checkAndSendReminders();
    $medicines = Medicine::all();
    $user = User::where('role' , 'Pharmacist')->get();
    return view('welcome' , compact('medicines' , 'user'));
});
Route::get('/details/{id}', [App\Http\Controllers\Controller::class, 'show_details'])->name('details');
Route::get('search', [App\Http\Controllers\Controller::class, 'search'])->name('search');
Route::get('request/alternative',  function () {

  return view('request-alternative' );
})->name('alternative');
Route::get('noResult/alternative',  function () {

  return view('not-found' );
})->name('notfound');

Route::get('result/alternative',  function(Request $request, ResponseFactory $response) {
  $client = new Client();

  // قراءة اسم الدواء من الطلب
  $drugName = $request->input('name');

  if (!$drugName) {
      // في حال عدم إرسال اسم الدواء
      return redirect()->back()->withErrors(['error' => 'Please provide the name of the medicine.']);
  }

  try {
      // إرسال الطلب إلى واجهة API
      $response = $client->get('http://127.0.0.1:5000/get_alternatives', [
          'query' => ['drug_name' => $drugName]
      ]);

      $statusCode = $response->getStatusCode();
      $dataBody = $response->getBody();
      $apiData = json_decode($dataBody, true);

      // معالجة الاستجابة بناءً على رمز الحالة
      if ($statusCode === 200) {
          // عرض البدائل إذا كانت الاستجابة ناجحة
          return view('alternative', ['alternatives' => $apiData]);
      } else {
          // إذا كانت الحالة غير ناجحة (لا يجب أن تصل هنا في الوضع الطبيعي)
          return redirect()->back()->withErrors(['error' => 'Unexpected response from the server.']);
      }

  } catch (\GuzzleHttp\Exception\ClientException $e) {
      // معالجة الأخطاء المتعلقة بالرموز 400 و 404
      if ($e->getResponse()->getStatusCode() == 400) {
          return redirect()->back()->withErrors(['error' => 'Invalid request: Please provide a valid medicine name.']);
      } elseif ($e->getResponse()->getStatusCode() == 404) {
          // في حال لم يتم العثور على الدواء، الانتقال إلى واجهة مخصصة
          return redirect()->route('notfound')->with('message', 'The medicine is not available in the Pharmacy.');
      }
  } catch (\GuzzleHttp\Exception\ServerException $e) {
      // معالجة أخطاء الخادم (500 وما شابه)
      return redirect()->back()->withErrors(['error' => 'The server encountered an error. Please try again later.']);
  } catch (\Exception $e) {
      // أي أخطاء أخرى غير متوقعة
      return redirect()->back()->withErrors(['error' => 'An unexpected error occurred: ' . $e->getMessage()]);
  }
})->name('demand.alternative');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

  Route::group(['prefix'=>'pharmacist', 'middleware' =>['auth'  ] ] , function()
  {
    Route::get('/medicines', [App\Http\Controllers\HomeController::class, 'show_medicines'])->name('medicines');
    Route::delete('/medicines/delete/{id}', [App\Http\Controllers\HomeController::class, 'delete_medicines'])->name('delete.medicines');
    Route::get('/add/medicines', [App\Http\Controllers\HomeController::class, 'add_medicines'])->name('add.medicines');
    Route::post('/add/medicines', [App\Http\Controllers\HomeController::class, 'store_medicines'])->name('store.medicines');
    Route::get('/edit/medicines/{id}', [App\Http\Controllers\HomeController::class, 'edit_medicines'])->name('edit.medicines');
    Route::put('/edit/medicines', [App\Http\Controllers\HomeController::class, 'update_medicines'])->name('update.medicines');
    Route::get('/notifications/mark-as-read/{id}', [App\Http\Controllers\HomeController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/demand', [App\Http\Controllers\HomeController::class, 'store_demand_amount'])->name('store.demand.amount');
    Route::get('/show/demand', [App\Http\Controllers\HomeController::class, 'browse_demand'])->name('browse.demand');
    Route::get('/show/demand/patient', [App\Http\Controllers\HomeController::class, 'browse_demand_patient'])->name('browse.demand.patient');
    Route::get('/reject/demand/patient/{id}', [App\Http\Controllers\HomeController::class, 'reject_demand_patient'])->name('reject.demand.patient');
    Route::get('/accept/demand/patient/{id}', [App\Http\Controllers\HomeController::class, 'accept_demand_patient'])->name('accept.demand.patient');
    Route::post('/preview/demand/patient', [App\Http\Controllers\HomeController::class, 'preview_demand_patient'])->name('preview.demand.patient');
    Route::get('/preview/{id}', [App\Http\Controllers\HomeController::class, 'preview'])->name('preview');
    Route::post('/invoice', [App\Http\Controllers\HomeController::class, 'get_invoice'])->name('demand.invoice');
    Route::get('/invoice', [App\Http\Controllers\HomeController::class, 'show_invoice'])->name('show.invoice');
    Route::get('/demand/medicine', [App\Http\Controllers\HomeController::class, 'show_demand_medicine'])->name('show.demand.medicine');
    Route::get('/accept/demand/medicine/{id}', [App\Http\Controllers\HomeController::class, 'accept_demand_medicine'])->name('accept.new.demand');
    Route::get('/reject/demand/medicine/{id}', [App\Http\Controllers\HomeController::class, 'reject_demand_medicine'])->name('reject.new.demand');


  });
  
  Route::group(['prefix'=>'repository', 'middleware' =>['auth'  ] ] , function()
  {
    Route::get('/demand', [App\Http\Controllers\HomeController::class, 'show_demand'])->name('show.demand');
    Route::get('/demand/reject/{id}', [App\Http\Controllers\HomeController::class, 'reject_demand'])->name('reject.demand');
    Route::post('/demand/accept/{id}', [App\Http\Controllers\HomeController::class, 'accept_demand'])->name('accept.demand');
  });

    
  Route::group(['prefix'=>'patient', 'middleware' =>['auth'  ] ] , function()
  {
    Route::post('/demand', [App\Http\Controllers\HomeController::class, 'send_demand'])->name('demand.patient');
    Route::get('/demand', [App\Http\Controllers\HomeController::class, 'my_demand'])->name('my.demand');
    Route::get('/preview/{id}', [App\Http\Controllers\HomeController::class, 'preview_patient'])->name('preview.patient');
    Route::get('/invoice', [App\Http\Controllers\HomeController::class, 'my_invoice'])->name('my.invoice');
    Route::get('/demand/medicine', [App\Http\Controllers\HomeController::class, 'new_demand'])->name('new.demand');
    Route::post('/demand/medicine', [App\Http\Controllers\HomeController::class, 'store_new_demand'])->name('store.new.demand');
    Route::get('/show/demand/medicine', [App\Http\Controllers\HomeController::class, 'show_new_demand'])->name('show.new.demand');

  });

  Route::group(['prefix'=>'admin', 'middleware' =>['auth'  ] ] , function()
  {
    Route::get('/drug', [App\Http\Controllers\HomeController::class, 'get_drug'])->name('drug');
    Route::get('/add/drug', [App\Http\Controllers\HomeController::class, 'add_drug'])->name('add.drug');
    Route::post('/add/drug', [App\Http\Controllers\HomeController::class, 'store_drug'])->name('store.drug');
    Route::get('/edit/drug/{id}', [App\Http\Controllers\HomeController::class, 'edit_drug'])->name('edit.drug');
    Route::put('/edit/drug', [App\Http\Controllers\HomeController::class, 'update_drug'])->name('update.drug');
    Route::delete('/delete/drug/{id}', [App\Http\Controllers\HomeController::class, 'delete_drug'])->name('delete.drug');


  });
  
  
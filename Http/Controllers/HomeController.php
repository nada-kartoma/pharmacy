<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Demand;
use App\Models\Medicine;
use App\Models\DamandAmount;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::id()){
            $usertype = Auth()->user()->role;
            if ($usertype == 'Pharmacist') {
                $lowStockMedicines = Medicine::where('count', '<', 3)->get();

                foreach ($lowStockMedicines as $medicine) {
                    // تحقق إذا كان هناك إشعار بالفعل لهذا الدواء
                    $existingNotification = Notification::where('medicine_id', $medicine->id)->first();

                    // إذا لم يكن هناك إشعار نشط، أضف إشعارًا جديدًا
                    if (!$existingNotification) {
                        Notification::create([
                            'medicine_id' => $medicine->id,
                            'message' => 'Medicine ' . $medicine->name . ' must demand new amount ,it still 3 medicine just',
                                             ]);
                    }
                }

                // اجلب جميع الإشعارات غير المقروءة
                $notifications = Notification::where('is_read', false)->get();

                return view('pharmacist.home', compact('notifications'));
            }  
              else   if ($usertype == 'Patient') {
                return view('patient.home'   );

              }
              else   if ($usertype == 'Repository') {
                return view('repository.home'   );

              }
             
            }
    }

    public function show_medicines(){
        $medicines = Medicine::all();
        $lowStockMedicines = Medicine::where('count', '<', 3)->get();

        foreach ($lowStockMedicines as $medicine) {
            // تحقق إذا كان هناك إشعار بالفعل لهذا الدواء
            $existingNotification = Notification::where('medicine_id', $medicine->id)->first();

            // إذا لم يكن هناك إشعار نشط، أضف إشعارًا جديدًا
            if (!$existingNotification) {
                Notification::create([
                    'medicine_id' => $medicine->id,
                    'message' => 'Medicine ' . $medicine->name . ' must demand new amount ,it still 3 medicine just',
                                     ]);
            }
        }

        // اجلب جميع الإشعارات غير المقروءة
        $notifications = Notification::where('is_read', false)->get();

        return view('pharmacist.medicines.table' , compact('medicines' , 'notifications' ));
     
        }
   
  
        public function delete_medicines($id){
          $medicines = Medicine::where('id' , $id)->first();
        $destination = 'uploads/medicines/'.$medicines->image;
        if(File::exists($destination))
        {
            File::delete($destination);
  
        }
        $medicines->delete();
        return redirect()-> back() -> with('status', ' Deleted Done ');
        }
   
        public function edit_medicines($id){
          $medicines = Medicine::find($id);
          $lowStockMedicines = Medicine::where('count', '<', 3)->get();

          foreach ($lowStockMedicines as $medicine) {
              // تحقق إذا كان هناك إشعار بالفعل لهذا الدواء
              $existingNotification = Notification::where('medicine_id', $medicine->id)->first();

              // إذا لم يكن هناك إشعار نشط، أضف إشعارًا جديدًا
              if (!$existingNotification) {
                  Notification::create([
                      'medicine_id' => $medicine->id,
                      'message' => 'Medicine ' . $medicine->name . ' must demand new amount ,it still 3 medicine just',
                                       ]);
              }
          }

          // اجلب جميع الإشعارات غير المقروءة
          $notifications = Notification::where('is_read', false)->get();

          return view('pharmacist.medicines.edit' , compact('medicines' ,'notifications') );
  
      }
      public function update_medicines(Request $request ){
          $id = $request->input('id') ;
          $medicines=Medicine::find($id);
          
          $medicines -> pharmacist = Auth::user()->id;
          $medicines -> name = $request->input('name') ;
          $medicines -> count = $request->input('count') ;
          $medicines -> price = $request->input('price') ;
          $medicines -> compenent = $request->input('compenent') ;
          $medicines -> time = $request->input('time') ;
          $medicines -> details = $request->input('details') ;

          if($request->hasfile('image'))
          {
              $destination = 'uploads/medicines/'.$medicines->image;
              if(File::exists($destination))
              {
                  File::delete($destination);
  
              }
              $file = $request->file('image');
              $extention = $file ->getClientOriginalExtension();
              $filename = time().'.'.$extention;
              $file->move('uploads/medicines/' , $filename);
              $medicines->image = $filename ;
          }
          $medicines->update();
        
           return redirect()-> back()     ->with('status', ' Updated done  ');
       
      }
      public function add_medicines(){
        $lowStockMedicines = Medicine::where('count', '<', 3)->get();

        foreach ($lowStockMedicines as $medicine) {
            // تحقق إذا كان هناك إشعار بالفعل لهذا الدواء
            $existingNotification = Notification::where('medicine_id', $medicine->id)->first();

            // إذا لم يكن هناك إشعار نشط، أضف إشعارًا جديدًا
            if (!$existingNotification) {
                Notification::create([
                    'medicine_id' => $medicine->id,
                    'message' => 'Medicine ' . $medicine->name . ' must demand new amount ,it still 3 medicine just',
                                     ]);
            }
        }

        // اجلب جميع الإشعارات غير المقروءة
        $notifications = Notification::where('is_read', false)->get();

          return view('pharmacist.medicines.add' , compact('notifications') );
  
      }
      public function store_medicines(Request $request ){
        $request->validate([
            'image' => 'required|mimes:png,jpeg,jpg',
            'name' => 'required',
            'count' => 'required',
            'compenent' => 'required',
            'time' => 'required',
            'price' => 'required',


        ], [
            
            'image.mimes' => 'Image must be  jpg  , jpeg , png' ,
        ]);
        $medicines=new Medicine();
        $medicines -> pharmacist = Auth::user()->id;

        $medicines -> name = $request->input('name') ;
          $medicines -> count = $request->input('count') ;
          $medicines -> price = $request->input('price') ;
          $medicines -> compenent = $request->input('compenent') ;
          $medicines -> time = $request->input('time') ;
          $medicines -> details = $request->input('details') ;

          if($request->hasfile('image'))
          {
              $destination = 'uploads/medicines/'.$medicines->image;
              if(File::exists($destination))
              {
                  File::delete($destination);
  
              }
              $file = $request->file('image');
              $extention = $file ->getClientOriginalExtension();
              $filename = time().'.'.$extention;
              $file->move('uploads/medicines/' , $filename);
              $medicines->image = $filename ;
          } else {
              $medicines->image = null ;
  
          }
         
          $medicines->save();
        
           return redirect()-> back()     ->with('status', 'Added Done' ) ;
       
      }

      public function markAsRead($notificationId)
{
    $notification = Notification::find($notificationId);
    if ($notification) {
        $notification->is_read = true;
        $notification->save();
    }
    $id = $notification->medicine_id;
    $medicine= Medicine::where('id' , $id)->first();
    $user =User::where('role' , 'Repository')->first();
    $lowStockMedicines = Medicine::where('count', '<', 3)->get();

    foreach ($lowStockMedicines as $medicine) {
        // تحقق إذا كان هناك إشعار بالفعل لهذا الدواء
        $existingNotification = Notification::where('medicine_id', $medicine->id)->first();

        // إذا لم يكن هناك إشعار نشط، أضف إشعارًا جديدًا
        if (!$existingNotification) {
            Notification::create([
                'medicine_id' => $medicine->id,
                'message' => 'Medicine ' . $medicine->name . ' must demand new amount ,it still 3 medicine just',
                                 ]);
        }
    }

    // اجلب جميع الإشعارات غير المقروءة
    $notifications = Notification::where('is_read', false)->get();

    return view('pharmacist.demand.add' , compact('medicine' , 'user' , 'notifications'));
}
public function store_demand_amount(Request $request ){
    $request->validate([
        'count' => 'required',
    ]);
    $demand=new DamandAmount();
    $demand -> medicine_id =$request->input('medicine');
    $demand -> repository_id = $request->input('repository') ;
    $demand -> count = $request->input('count') ;
      $demand->save();
    
       return redirect()-> back()     ->with('status', 'Demand Done' ) ;
   
  }
  public function browse_demand(){
    $demand = DamandAmount::all();
    $lowStockMedicines = Medicine::where('count', '<', 3)->get();

    foreach ($lowStockMedicines as $medicine) {
        // تحقق إذا كان هناك إشعار بالفعل لهذا الدواء
        $existingNotification = Notification::where('medicine_id', $medicine->id)->first();

        // إذا لم يكن هناك إشعار نشط، أضف إشعارًا جديدًا
        if (!$existingNotification) {
            Notification::create([
                'medicine_id' => $medicine->id,
                'message' => 'Medicine ' . $medicine->name . ' must demand new amount ,it still 3 medicine just',
                                 ]);
        }
    }

    // اجلب جميع الإشعارات غير المقروءة
    $notifications = Notification::where('is_read', false)->get();
    return view('pharmacist.demand.table' , compact('demand' , 'notifications')  );

}
  public function show_demand(){
    $demand = DamandAmount::all();
    return view('repository.demand' , compact('demand')  );

}
  public function reject_demand($id){
    $demand = DamandAmount::find($id);
    $demand->status = 'No amount for this medicine';
    $demand->update();
    return redirect()-> back()     ->with('status', 'Demand reject' ) ;
    }

    public function accept_demand(Request $request  , $id){
        $demand = DamandAmount::find($id);
        $demand->status = 'accept for this count';
        $demand->update();
        $count = $request->input('count');
        $id_medicine = $request->input('medicine');
        $medicine = Medicine::find($id_medicine);
        $medicine->count = $medicine->count + $count;
        $medicine->update();
        return redirect()-> back()     ->with('status', 'Demand accept' ) ;
        }

        public function send_demand(Request $request ){
            $demand=new Demand();
            $demand -> patient_id = Auth::user()->id;
            $demand -> medicine_id = $request->input('medicine') ;
            $demand -> count = $request->input('count') ;
            $demand->save();
            
               return redirect()-> back()     ->with('status', 'Demand Done' ) ;
           
          }

          public function my_demand(){
            $demand = Demand::where('patient_id' , Auth::user()->id)->get();
            return view('patient.demand' , compact('demand')  );
        
        }
}

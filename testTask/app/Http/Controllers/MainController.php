<?php

namespace App\Http\Controllers;
use App\Models\{ClientModel,CarsModel};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Redirect};

class MainController extends Controller
{

    public function changeParking(Request $req)
    {   
        $valid = $req->validate([
            'client_id' =>'required',
            'car_id' =>'required'
        ]);
        $carId = $req->input('car_id');
        DB::update("UPDATE cars SET on_parking = NOT on_parking WHERE car_id = $carId ");
        return Redirect::to(url()->previous());
    }

    public function fetch(Request $req)
    { 
        //Больше сделал чем понял. Почитать про аджакс
        $select  = $req->get('select');
        $value  = $req->get('value');
        $dependent  = $req->get('dependent');
        $data = DB::select("SELECT * FROM cars WHERE $select = $value");
        $output = '<option value =""> Select car </option>';
        foreach($data as $row)
        {
            $on =  $row->on_parking == True ? "On parking" : "Not on parking";
            $output.='<option value ="'.$row->car_id.'"> Select car: '.$row->plate_num.' '.$row->color.' '.$row->brand.' .Currently '.$on.'</option>';
        }
        echo $output;
    }
    public function main($page = 1)
    {   
        //Размер страницы для пагинации
        $pageSize = 5;
        $offset = $pageSize * ($page - 1);
        //Запрос создающий таблицу в стиле той что с картинки в примерах. Работа с жсоном здесь потому что была проблема с выводом русских букв
        $data = DB::select("SELECT clients.client_id,clients.full_name,clients.phone_num, cars.brand, cars.plate_num, cars.on_parking, cars.car_id FROM
        clients JOIN cars ON clients.client_id = cars.client_id
        ORDER BY clients.client_id asc LIMIT $offset,$pageSize");
        $q = 0 ? count($data) % $pageSize == 0 : 1;
        $btnsAmount = ceil((count($data) / $pageSize)+ $q);
        $inc = DB::select('SELECT client_id + 1 as next_id from clients order by client_id desc limit 1');
        
        $prevpage = $page - 1 ? $page > 1 : 1;
        $nextpage = $page + 1 ? $page <= $btnsAmount : $page;
        $enc = json_encode($data,JSON_UNESCAPED_UNICODE);
        return view('main',["data" =>json_decode($enc,true),"inc"=>$inc, 'btns'=>$btnsAmount, 'prev'=>$prevpage, 'next'=>$nextpage]);
    }

    public function allCars($page = 1)
    { 
        $user_list = DB::select("SELECT client_id,full_name from clients order by client_id");
        $pageSize = 5;
        $offset = $pageSize * ($page - 1);
        //Запрос создающий таблицу в стиле той что с картинки в примерах. Работа с жсоном здесь потому что была проблема с выводом русских букв
        $data = DB::select("select  cars.car_id, cars.brand, cars.model, cars.plate_num, clients.full_name FROM
        clients JOIN cars ON clients.client_id = cars.client_id
        WHERE cars.on_parking = 1 ORDER BY clients.client_id asc LIMIT $offset,$pageSize");
        $q = 0 ? count($data) % $pageSize == 0 : 1;
        $btnsAmount = ceil((count($data) / $pageSize)+ $q) ? count($data)% $pageSize == 0:(int)(count($data) / $pageSize);
        $inc = DB::select('SELECT client_id + 1 as next_id from clients order by client_id desc limit 1');
        $prevpage = $page - 1 ? $page > 1 : 1;
        $nextpage = $page + 1 ? $page <= $btnsAmount : $page;
        $enc = json_encode($data,JSON_UNESCAPED_UNICODE);
        return view('allCars',["data" =>json_decode($enc,true),"inc"=>$inc, 'btns'=>$btnsAmount, 'prev'=>$prevpage, 'next'=>$nextpage,'user_list' => $user_list]);
    }

    public function addUserPage()
    {
        $inc = DB::select('SELECT client_id + 1 as next_id from clients order by client_id desc limit 1');
        return view('addUser',["inc"=>$inc]);
    }

    public function addClient(Request $req){
        $nr = '[a-zA-Zа-яА-Я]';
        $valid = $req->validate([
            'full_name' => "min:3 | max:100 | regex:/$nr+\s+$nr+\s+$nr+\s*/",
            'phone_num' => 'regex:/\+7([0-9]){10}/ | unique:clients',
            'plate_num' => 'unique:cars',
        ]);

        $full_name = $req->input('full_name');
        $phone_num = $req->input('phone_num');
        $gender = $req->input('gender');
        $address = $req->input('address');
        DB::insert("INSERT INTO clients(full_name,phone_num,gender,address) VALUES (?,?,?,?)",[$full_name,$phone_num,$gender,$address]);

        $color = $req->input('color');
        $model = $req->input('model');
        $brand = $req->input('brand');
        $plate_num = $req->input('plate_num');
        $on_parking = $req->input('on_parking');
        $client_id = $req->input('next_id');
        DB::insert("INSERT INTO cars(color,model,brand,plate_num,on_parking,client_id) VALUES (?,?,?,?,?,?)",[$color,$model,$brand,$plate_num,$on_parking,$client_id]);

        return Redirect::to(url()->previous());
    }

    public function updateClient(Request $req)
    {
        $valid = $req->validate([
            'full_name' => 'min:3 | max:100',
            'phone_num' => 'regex:/(\+7[0-9]{10}){1}/',
            
        ]);

        $name = $req->input('full_name');
        $phone = $req->input('phone_num');
        $gender = $req->input('gender');
        $address = $req->input('address');
        $id = $req->input('client_id');

        DB::update("UPDATE clients SET full_name = ?, phone_num = ?, gender=?,address=? 
        WHERE client_id=?",[$name,$phone,$gender,$address,$id]);

        return Redirect::to(url()->previous());
    }

    public function updateClientPage($id)
    {
        $req = DB::select("SELECT * FROM clients JOIN cars on clients.client_id = cars.client_id WHERE clients.client_id = $id ");
        return view('updateClientPage', ['data'=>[$req]]);
    }

    public function addCarPage(){
        $clients = DB::select('SELECT client_id, full_name from clients');
        return view('addCar',['cl' => $clients]);
    }

    public function addCar(Request $req){
        $valid = $req->validate([
          
            'plate_num' => 'unique:cars',
        ]);

        $color = $req->input('color');
        $model = $req->input('model');
        $brand = $req->input('brand');
        $plate_num = $req->input('plate_num');
        $on_parking = $req->input('on_parking');
        $client_id = $req->input('next_id');
        DB::insert("INSERT INTO cars(color,model,brand,plate_num,on_parking,client_id) VALUES (?,?,?,?,?,?)",[$color,$model,$brand,$plate_num,$on_parking,$client_id]);
        return Redirect::to(url()->previous());
    }

    public function updateCar(Request $req)
    {
        $color = $req->input('color');
        $model = $req->input('model');
        $brand = $req->input('brand');
        $plate_num = $req->input('plate_num');
        $on_parking = $req->input('on_parking');
        $id = $req->input('car_id');
        DB::update("UPDATE cars SET color = ?, model = ?, brand= ?,plate_num=?,on_parking = ? WHERE car_id=?",[$color,$model,$brand,$plate_num,$on_parking,$id]);
        return Redirect::to(url()->previous());
    }

    public function deleteUser($id)
    {
        DB::delete("DELETE FROM cars where cars.client_id = $id");
        DB::delete("DELETE FROM clients where client_id=$id");
        return redirect('/1');
    }

    public function deleteCar($id)
    {
        DB::delete("DELETE from cars WHERE car_id = $id");
        return Redirect::to(url()->previous());
    }

}

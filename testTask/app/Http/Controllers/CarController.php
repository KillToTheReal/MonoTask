<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\{DB,Redirect};
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function changeParking(Request $req)
    {
        $valid = $req->validate([
            'car_id' =>'required',
        ]);
        $carId = $req->input('car_id');
        DB::update("UPDATE cars SET on_parking = NOT on_parking WHERE car_id = $carId ");
        return Redirect::to('/allCars/1');
    }

    public function allCars($page = 1)
    {
        $user_list = DB::select("SELECT client_id,full_name from clients order by client_id");
        $pageSize = 5;
        $offset = $pageSize * ($page - 1);
        $fulldata = DB::Select("SELECT COUNT(*) as count from clients join cars on clients.client_id = cars.client_id WHERE cars.on_parking=1")[0]->count;
        //Запрос создающий таблицу в стиле той что с картинки в примерах. Работа с жсоном здесь потому что была проблема с выводом русских букв
        $data = DB::select("SELECT  cars.car_id, cars.brand, cars.model, cars.plate_num, clients.full_name FROM
        clients JOIN cars ON clients.client_id = cars.client_id
        WHERE cars.on_parking = 1 ORDER BY cars.car_id asc LIMIT $offset,$pageSize");

        $btnsAmount = $fulldata % $pageSize == 0 ? ceil($fulldata / $pageSize):(int)($fulldata / $pageSize);
        $inc = DB::select('SELECT client_id + 1 as next_id from clients order by client_id desc limit 1');
        $prevpage = $page > 1 ? $page - 1 : 1;
        $nextpage = $page < $btnsAmount ? $page + 1 : $page;
        $enc = json_encode($data,JSON_UNESCAPED_UNICODE);
        return view('allCars',["data" =>json_decode($enc,true),"inc"=>$inc, 'btns'=>$btnsAmount, 'prev'=>$prevpage, 'next'=>$nextpage,'user_list' => $user_list]);
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
        $car = $req->input('car');
        $id = $car['car_id'];
        $valid = $req->validate([
            'car.plate_num' =>'min:6 | max: 6 |unique:cars,plate_num,'.$id.',car_id',

        ]);
        $color = $car['color'];
        $model = $car['model'];
        $brand = $car['brand'];
        $plate_num = $car['plate_num'];
        $on_parking = $car['on_parking'];
        DB::update("UPDATE cars SET color = ?, model = ?, brand= ?,plate_num=?,on_parking = ? WHERE car_id=?",[$color,$model,$brand,$plate_num,$on_parking,$id]);
        return Redirect::to(url()->previous());
    }

    public function deleteCar($id)
    {
        DB::delete("DELETE from cars WHERE car_id = $id");
        return Redirect::to(url()->previous());
    }

    public function fetch(Request $req)
    {
        $select  = $req->get('select');
        $value  = $req->get('value');

        $data = DB::select("SELECT * FROM cars WHERE client_id = $value");
        return json_encode($data);
    }
}

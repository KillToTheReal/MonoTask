<?php

namespace App\Http\Controllers;
use App\Models\{ClientModel,CarsModel};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Redirect};

class MainController extends Controller
{
    public function main($page = 1)
    {   
        $pageSize = 5;
        $offset = $pageSize * ($page - 1);
        //Запрос создающий таблицу в стиле той что с картинки в примерах. Работа с жсоном здесь потому что была проблема с выводом русских букв
        $data = DB::select("select clients.client_id,clients.full_name,clients.phone_num, cars.brand, cars.plate_num, cars.on_parking FROM
        clients JOIN cars ON clients.client_id = cars.client_id
        ORDER BY clients.client_id asc LIMIT $offset,$pageSize");
        $btnsAmount = ceil(count($data) / $pageSize + 1);
        $inc = DB::select('SELECT client_id + 1 as next_id from clients order by client_id desc limit 1');

        $prevpage = $page - 1 ? $page > 1 : 1;
        $nextpage = $page + 1 ? $page <= $btnsAmount : $page;
        $enc = json_encode($data,JSON_UNESCAPED_UNICODE);
        return view('main',["data" =>json_decode($enc,true),"inc"=>$inc, 'btns'=>$btnsAmount, 'prev'=>$prevpage, 'next'=>$nextpage]);
    }

    public function addUserPage()
    {
        $inc = DB::select('SELECT client_id + 1 as next_id from clients order by client_id desc limit 1');
        return view('addUser',["inc"=>$inc]);
    }

    public function addClient(Request $req){
        $valid = $req->validate([
            'full_name' => 'min:3 | max:100',
            'phone_num' => 'regex:/\+7([0-9]){10}/ | unique:clients',
            'plate_num' => 'unique:cars',
        ]);

        $myuser = new ClientModel();
        $myuser->full_name = $req->input('full_name');
        $myuser->phone_num = $req->input('phone_num');
        $myuser->gender = $req->input('gender');
        $myuser->address = $req->input('address');
        $myuser->save();

        $newcar = new CarsModel();
        $newcar->color = $req->input('color');
        $newcar->model = $req->input('model');
        $newcar->brand = $req->input('brand');
        $newcar->plate_num = $req->input('plate_num');
        $newcar->on_parking = $req->input('on_parking');
        $newcar->client_id = $req->input('next_id');

        $newcar->save();

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

            $newcar = new CarsModel();
            $newcar->color = $req->input('color');
            $newcar->model = $req->input('model');
            $newcar->brand = $req->input('brand');
            $newcar->plate_num = $req->input('plate_num');
            $newcar->on_parking = $req->input('on_parking');
            $newcar->client_id = $req->input('client_id');
    
            $newcar->save();

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

}

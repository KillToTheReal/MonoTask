<?php

namespace App\Http\Controllers;
use App\Models\{ClientModel,CarsModel};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Redirect};

class MainController extends Controller
{




    public function main($page = 1)
    {
        //Размер страницы для пагинации
        $pageSize = 5;
        $offset = $pageSize * ($page - 1);
        //Запрос создающий таблицу в стиле той что с картинки в примерах. Работа с жсоном здесь потому что была проблема с выводом русских букв
        $fulldata = DB::select("select COUNT(*) as count from clients join cars on clients.client_id = cars.client_id")[0]->count;
        //Разделение данных, если здесь писать COUNT нужно было бы в любом случае делать группировку и считать длину массивов, строчка выше для того чтобы в одну переменную пихнуть всю длину данных разом
        $data = DB::select("SELECT clients.client_id,clients.full_name,clients.phone_num, cars.brand, cars.plate_num, cars.on_parking, cars.car_id FROM
        clients JOIN cars ON clients.client_id = cars.client_id
        ORDER BY clients.client_id asc LIMIT $offset,$pageSize");

        $btnsAmount = ceil(($fulldata / $pageSize));
        $prevpage = $page > 1 ? $page - 1 : 1;
        $nextpage = $page < $btnsAmount ? $page + 1 : $page;
        $enc = json_encode($data,JSON_UNESCAPED_UNICODE);
        return view('main',["data" =>json_decode($enc,true), 'btns'=>$btnsAmount, 'prev'=>$prevpage, 'next'=>$nextpage]);
    }

    public function addUserPage()
    {
        return view('addUser');
    }

    public function addClient(Request $req){


        $nr = '[a-zA-Zа-яА-Я]';
        $client = $req->input('user');
        $valid = $req->validate([
            'user.full_name' => "min:3 | max:100 | regex:/$nr+\s+$nr+\s+$nr+\s*/",
            'user.phone_num' => 'regex:/\+7([0-9]){10}/ | unique:clients,phone_num',

            'cars.*.plate_num' => 'unique:cars,plate_num|min:6|max:6',
        ]);
        $full_name = $client["full_name"];
        $phone_num = $client['phone_num'];
        $gender = $client['gender'];
        $address = $client['address'];
        DB::insert("INSERT INTO clients(full_name,phone_num,gender,address) VALUES (?,?,?,?)",[$full_name,$phone_num,$gender,$address]);
        $client_id = DB::select('SELECT client_id from clients order by client_id desc limit 1')[0]->client_id;

        $cars = $req->input('cars');
//        dd($cars);
        foreach($cars as $key => $val)
        {
            print_r($key);
            $color = $cars[$key]['color'];
            $model = $cars[$key]['model'];
            $brand = $cars[$key]['brand'];
            $plate_num = $cars[$key]['plate_num'];
            $on_parking = $cars[$key]['on_parking'];
            DB::insert("INSERT INTO cars(color,model,brand,plate_num,on_parking,client_id) VALUES (?,?,?,?,?,?)",[$color,$model,$brand,$plate_num,$on_parking,$client_id]);
        }
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

    public function deleteUser($id)
    {
        DB::delete("DELETE FROM cars where cars.client_id = $id");
        DB::delete("DELETE FROM clients where client_id=$id");
        return redirect('/1');
    }



}

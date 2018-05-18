<?php

namespace App\Http\Controllers;

use App\Logo;
use App\Tshirt;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;
use Illuminate\Http\Request;

class CreateImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Tshirt $tshirt, Logo $logo)
    {

        $pathTshirt = public_path('images/tshirts/' . $tshirt->id . '.png');
        $pathLogo = public_path('images/logo/' . $logo->id . '.png');


        $manager = new ImageManager();

        $imageTshirt = $manager->make($pathTshirt);

        $imageLogo = $manager->make($pathLogo)->resize($tshirt->largeurImpression, $tshirt->hauteurImpression, function ($constraint) {

            $constraint->aspectRatio();

        });

        $width = $imageLogo->width();
        $height = $imageLogo->height();

        $x = intval($tshirt->origineX + (($tshirt->largeurImpression / 2) - ($width / 2)));
        $y = intval($tshirt->origineY + (($tshirt->largeurImpression / 2) - ($height / 2)));

        //Coller le logo sur le tshirt
        $imageTshirt->insert($imageLogo, 'top-left', $x, $y);

        return $imageTshirt->response();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $manager = new ImageManager();
        $img = $manager->make($_FILES['input_img']['tmp_name']);

        $data = [
            'nom' => 'upload',
            'largeur' => $img->width(),
            'hauteur' => $img->height(),
        ];

        $logo = Logo::create($data);

        $pathSave = public_path('images/logo/' . $logo->id . '.png');

        $img->save($pathSave);

        return redirect('tshirts');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Tshirt $tshirt, Logo $logo)
    {
        $path = $tshirt->nom . $logo->nom . '_' . time();

        $pathTshirt = public_path('images/tshirts/' . $tshirt->id . '.png');
        $pathLogo = public_path('images/logo/' . $logo->id . '.png');
        $pathSave = public_path('images/save/' . $path . '.png');

        $manager = new ImageManager();

        $imageTshirt = $manager->make($pathTshirt);

        $imageLogo = $manager->make($pathLogo)->resize($tshirt->largeurImpression, $tshirt->hauteurImpression, function ($constraint) {

            $constraint->aspectRatio();

        });

        $width = $imageLogo->width();
        $height = $imageLogo->height();

        $x = intval($tshirt->origineX + (($tshirt->largeurImpression / 2) - ($width / 2)));
        $y = intval($tshirt->origineY + (($tshirt->largeurImpression / 2) - ($height / 2)));

        //Coller le logo sur le tshirt
        $imageTshirt->insert($imageLogo, 'top-left', $x, $y);

        $imageTshirt->save($pathSave);

        return redirect()->route('home');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

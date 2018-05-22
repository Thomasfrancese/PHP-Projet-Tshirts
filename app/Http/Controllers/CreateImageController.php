<?php

namespace App\Http\Controllers;

use App\Logo;
use App\Tshirt;
//use Faker\Provider\File;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
        $pathCopyright = public_path('images/copyright.png');


        $manager = new ImageManager();

        $imageTshirt = $manager->make($pathTshirt);

        $imageLogo = $manager->make($pathLogo)->resize($tshirt->largeurImpression, $tshirt->hauteurImpression, function ($constraint) {

            $constraint->aspectRatio();

        });

        $copyright = $manager->make($pathCopyright)->resize(1500, 1500);

        $width = $imageLogo->width();
        $height = $imageLogo->height();

        $x = intval($tshirt->origineX + (($tshirt->largeurImpression / 2) - ($width / 2)));
        $y = intval($tshirt->origineY + (($tshirt->largeurImpression / 2) - ($height / 2)));

        //Coller le logo sur le tshirt
        $imageTshirt->insert($imageLogo, 'top-left', $x, $y);

        $imageTshirt->insert($copyright, 'top-left', 650, 600);

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

        if ($logo->nom === 'upload') {
            $this->destroy($logo);
            return redirect()->route('home');
        }


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
    public function destroy(Logo $logo)
    {
        File::delete('images/logo/' . $logo->id . '.png');
        Logo::where('nom', 'upload')->delete();
        //
    }
}

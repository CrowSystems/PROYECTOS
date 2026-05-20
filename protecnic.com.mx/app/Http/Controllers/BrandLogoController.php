<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Response;

class BrandLogoController extends Controller
{
    /**
     * Devuelve el binario del logo guardado en la BD,
     * con su mime-type real y cache en navegador.
     */
    public function show(Brand $brand): Response
    {
        if (empty($brand->logo_data)) {
            abort(404);
        }

        return response($brand->logo_data, 200, [
            'Content-Type'   => $brand->logo_mime ?: 'image/png',
            'Content-Length' => strlen($brand->logo_data),
            'Cache-Control'  => 'public, max-age=86400',
        ]);
    }
}

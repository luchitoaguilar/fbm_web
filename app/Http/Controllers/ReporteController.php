<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Variables;
use App\Models\Zafra;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use PHPJasper\PHPJasper;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.Administrador.Reporte.view');
    }

    public function indexZafrero()
    {
        return view('modules.Administrador.Reporte.viewZafrero');
    }

    public function reporteDiario(Request $request)
    {
        $basePathJRXML = public_path('assets/reportes');
        $basePathGenerated = public_path('tmp/');
        try {
            $persona = Persona::where('id', auth()->user()->id)->first();
            $variables = Variables::orderBy('id', 'desc')->first();

            $fileName = 'REPORTE-DIARIO-' . $persona->ci . '-' .  md5(auth()->user()->id) . '-' . time();

            /////////////////////////////////////INICIO CIFRADO//////////////////////////////////////////////////
            /*Generar codigo que tiene : titulo|idEventopersona */
            $texto = $persona->id ;
            $method = 'aes-128-cbc';
            $options = 0;
            $encryption_key = config('parameters.codigo_cifrado');
            $encryption_iv = config('parameters.vector_cifrado');
            $encryption = openssl_encrypt($texto, $method, $encryption_key, $options, $encryption_iv);
            /* Fin cifrado */
            //////////////////////////////////////FIN CIFRADO////////////////////////////////////////////////////

            $encryption = str_replace(array("/"), '-', $encryption);

            $path = public_path("/storage/reportes/$persona->ci");
            // dd($path);
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }

            QrCode::generate("https:" . '//upab.cofadena.gob.bo/verificarReporte/' . $persona->ci . '/' . $encryption, public_path("/storage/reportes/$persona->ci/$encryption.svg"));

            $basePathJasper = $basePathJRXML . '/Reporte_diario.jrxml';
            $basePathGenerated = $basePathGenerated . $fileName;

            if (File::exists($basePathGenerated))
            File::delete($basePathGenerated);

            $options = [
                'format' => ['pdf'],
                'params' => [
                    'fecha_inicio'    => date("d/m/Y", strtotime($request->fecha_inicio)),
                    'fecha_fin'       => date("d/m/Y", strtotime($request->fecha_fin)),
                    'Persona'       => $variables->aux_prod_upab,
                    'Cargo'         => $variables->cargo_aux_prod_upab,
                    'logo_upab'         => public_path("/assets/logos/logo_upab.png"),
                    'logo_cofadena'         => public_path("/assets/logos/logo_cofadena_50.jpeg"),
                    'qr'            => public_path("/storage/reportes/$persona->ci/$encryption.svg"),
                ],
                'db_connection' => [
                    'driver' => 'postgres',
                    'username' => 'postgres',
                    'password' => 'root',
                    'host' => '127.0.0.1',
                    'database' => 'upab_web',
                    'port' => '5432'
                ]
            ];

            $basePathGenerated = public_path('/tmp/') . $fileName;
//dd($basePathGenerated);
            if (Storage::exists($basePathGenerated))
                Storage::delete($basePathGenerated);

            $jasper = new PHPJasper;

            $jasper->process(
                $basePathJasper,
                $basePathGenerated,
                $options
            );

            // dd($jasper->output());
            $jasper->execute();

            $data = array(
                'uri' => public_path('/tmp/') . $fileName . '.pdf',
                'url' => url('/') . '/tmp/' . $fileName . '.pdf'
            );

            return response()->json([
                'data' => $data,
                'message' => __('messages.generico.datasuccess')
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 422);
        }
    }

    public function reporteDiarioZafrero(Request $request)
    {
        $basePathJRXML = public_path('assets/reportes');
        $basePathGenerated = public_path('tmp/');
        try {
            $persona = Persona::where('id', auth()->user()->id)->first();
            $variables = Variables::orderBy('id', 'desc')->first();


            $fileName = 'REPORTE-DIARIO-ZAFRERO-' . $persona->ci . '-' .  md5(auth()->user()->id) . '-' . time();

            /////////////////////////////////////INICIO CIFRADO//////////////////////////////////////////////////
            /*Generar codigo que tiene : titulo|idEventopersona */
            $texto = $persona->id ;
            $method = 'aes-128-cbc';
            $options = 0;
            $encryption_key = config('parameters.codigo_cifrado');
            $encryption_iv = config('parameters.vector_cifrado');
            $encryption = openssl_encrypt($texto, $method, $encryption_key, $options, $encryption_iv);
            /* Fin cifrado */
            //////////////////////////////////////FIN CIFRADO////////////////////////////////////////////////////

            $encryption = str_replace(array("/"), '-', $encryption);

            $path = public_path("/storage/reportes/$persona->ci");
            // dd($path);
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }

            QrCode::generate("https:" . '//upab.cofadena.gob.bo/verificarReporte/' . $persona->ci . '/' . $encryption, public_path("/storage/reportes/$persona->ci/$encryption.svg"));

            $basePathJasper = $basePathJRXML . '/Reporte_diario_zafrero.jrxml';
            $basePathGenerated = $basePathGenerated . $fileName;

            if (File::exists($basePathGenerated))
            File::delete($basePathGenerated);

            $options = [
                'format' => ['pdf'],
                'params' => [
                    'fecha_inicio'    => date("d/m/Y", strtotime($request->fecha_inicio)),
                    'fecha_fin'       => date("d/m/Y", strtotime($request->fecha_fin)),
                    'Persona'       => $variables->aux_prod_upab,
                    'Cargo'         => $variables->cargo_aux_prod_upab,
                    'logo_upab'         => public_path("/assets/logos/logo_upab.png"),
                    'logo_cofadena'         => public_path("/assets/logos/logo_cofadena_50.jpeg"),
                    'qr'            => public_path("/storage/reportes/$persona->ci/$encryption.svg"),
                    'zafrero'       => $request->personal_zafra_id,
                    'monto_pago_zafra'    => $variables->precio_pago_zafrero,
                ],
                'db_connection' => [
                    'driver' => 'postgres',
                    'username' => 'postgres',
                    'password' => 'root',
                    'host' => '127.0.0.1',
                    'database' => 'upab_web',
                    'port' => '5432'
                ]
            ];

            $basePathGenerated = public_path('/tmp/') . $fileName;
//dd($basePathGenerated);
            if (Storage::exists($basePathGenerated))
                Storage::delete($basePathGenerated);

            $jasper = new PHPJasper;

            $jasper->process(
                $basePathJasper,
                $basePathGenerated,
                $options
            );

            // dd($jasper->output());
            $jasper->execute();

            $data = array(
                'uri' => public_path('/tmp/') . $fileName . '.pdf',
                'url' => url('/') . '/tmp/' . $fileName . '.pdf'
            );

            return response()->json([
                'data' => $data,
                'message' => __('messages.generico.datasuccess')
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 422);
        }
    }
}

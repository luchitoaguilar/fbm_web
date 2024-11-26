<?php

use App\Models\Usuario;


/**
 *
 * para el menu de acuerdo al tipo de usuario (cargo_id)
 * @param Usuario $usuario
 * @return array[]
 */
function crear_menu(): array
{
    if (Auth::user()->rol_id == 1) {
        return [
            [
                'icon' => 'fa fa-home',
                'title' => __('messages.sistema.home'),
                'url' => '#',
                'route-name' => '/',
                'visible' => true
            ],
            [
                'icon' => 'fa fa-image',
                'title' => __('messages.sistema.banner'),
                'url' => route('listar_banner'),
                'route-name' => '/banner/listar',
                'visible' => true
            ],
            [
                'icon' => 'fa fa-box-open',
                'title' => __('messages.sistema.producto'),
                'url' => route('listar_producto'),
                'route-name' => '/producto/listar',
                'visible' => true
            ],
            [
                'icon' => 'fa fa-film',
                'title' => __('messages.sistema.video'),
                'url' => route('listar_video'),
                'route-name' => '/video/listar',
                'visible' => true
            ],
            [
                'icon' => 'fa fa-newspaper',
                'title' => __('messages.sistema.noticia'),
                'url' => route('listar_noticia'),
                'route-name' => '/noticia/listar',
                'visible' => true
            ],
            [
                'icon' => 'fa fa-users',
                'title' => __('messages.sistema.persona'),
                'url' => route('listar_persona'),
                'route-name' => '/persona/listar',
                'visible' => true
            ],
            // [
            //     'title' => 'Menú Zafra',
            //     'url' => '#',
            // ],
            // [
            //     'icon' => 'fa fa-blind',
            //     'title' =>  'Personal ' . __('messages.sistema.zafrero'),
            //     'url' => route('listar_zafrero'),
            //     'route-name' => '/zafrero/listar',
            //     'visible' => true
            // ],
            // [
            //     'icon' => 'fa fa-leaf',
            //     'title' => __('messages.sistema.zafra'),
            //     'url' => route('listar_zafra'),
            //     'route-name' => '/zafra/listar',
            //     'visible' => true
            // ],
            // [
            //     'icon' => 'fa fa-car',
            //     'title' => __('messages.sistema.vehiculo'),
            //     'url' => route('listar_vehiculo'),
            //     'route-name' => '/vehiculo/listar',
            //     'visible' => true
            // ],
            // [
            //     'icon' => 'fa fa-cog',
            //     'title' => __('messages.sistema.variables'),
            //     'url' => route('variables'),
            //     'route-name' => '/variables/listar',
            //     'visible' => true
            // ],
        ];
    } elseif (Auth::user()->rol_id == 2) {
        return [
            [
                'icon' => 'fa fa-home',
                'title' => __('messages.sistema.home'),
                'url' => '#',
                'route-name' => '/',
                'visible' => true
            ],
            [
                'icon' => 'fa fa-image',
                'title' => __('messages.sistema.banner'),
                'url' => route('listar_banner'),
                'route-name' => '/banner/listar',
                'visible' => true
            ],
            [
                'icon' => 'fa fa-box-open',
                'title' => __('messages.sistema.producto'),
                'url' => route('listar_producto'),
                'route-name' => '/producto/listar',
                'visible' => true
            ],
            [
                'icon' => 'fa fa-film',
                'title' => __('messages.sistema.video'),
                'url' => route('listar_video'),
                'route-name' => '/video/listar',
                'visible' => true
            ],
            [
                'icon' => 'fa fa-newspaper',
                'title' => __('messages.sistema.noticia'),
                'url' => route('listar_noticia'),
                'route-name' => '/noticia/listar',
                'visible' => true
            ],
            [
                'icon' => 'fa fa-users',
                'title' => __('messages.sistema.persona'),
                'url' => route('listar_persona'),
                'route-name' => '/persona/listar',
                'visible' => true
            ],
            [
                'title' => 'Menú Zafra',
                'url' => '#',
            ],
            [
                'icon' => 'fa fa-blind',
                'title' => 'Personal ' . __('messages.sistema.zafrero'),
                'url' => route('listar_zafrero'),
                'route-name' => '/zafrero/listar',
                'visible' => true
            ],
            [
                'icon' => 'fa fa-leaf',
                'title' => __('messages.sistema.zafra'),
                'url' => route('listar_zafra'),
                'route-name' => '/zafra/listar',
                'visible' => true
            ],
            [
                'icon' => 'fa fa-car',
                'title' => __('messages.sistema.vehiculo'),
                'url' => route('listar_vehiculo'),
                'route-name' => '/vehiculo/listar',
                'visible' => true
            ],
            [
                'icon' => 'fa fa-file-text',
                'title' => __('messages.sistema.reporte'),
                'url' => '#',
                'visible' => true,
                'caret' => true,
                'sub_menu' => [
                    [
                        'icon' => 'fa fa-file-text',
                        'title' => __('messages.sistema.reporteFechas'),
                        'url' => route('reportes'),
                        'route-name' => '/reportes/reportes',
                        'visible' => true
                    ],
                    [
                        'icon' => 'fa fa-blind',
                        'title' => __('messages.sistema.reporteZafrero'),
                        'url' => route('reportes_zafrero'),
                        'route-name' => '/reportes/reportes-zafrero',
                        'visible' => true
                    ],
                    [
                        'icon' => 'fa fa-car',
                        'title' => __('messages.sistema.reporteVehiculo'),
                        'url' => route('reportes'),
                        'route-name' => '/reportes/reportes',
                        'visible' => true
                    ],
                ]
            ],

            [
                'icon' => 'fa fa-cog',
                'title' => __('messages.sistema.variables'),
                'url' => route('variables'),
                'route-name' => '/variables/listar',
                'visible' => true
            ],
        ];
    }
    // elseif (Auth::user()->cargo_id == 2) {
    //     return [
    //         [
    //             'icon' => 'fa fa-home',
    //             'title' => __('messages.sistema.home'),
    //             'url' => route('home'),
    //             'route-name' => '/',
    //             'visible' => true
    //         ],
    //         [
    //             'icon' => 'fa fa-users',
    //             'title' => __('messages.sistema.rrhh'),
    //             'url' => '#',
    //             'visible' => true,
    //             'caret' => true,
    //             'sub_menu' => [
    //                 [
    //                     'title' => __('validation.attributes.personal'),
    //                     'url' => route('Persona.view'),
    //                     'route-name' => '/Persona/view',
    //                     'icon' => 'fa fa-id-card',
    //                     'visible' => true
    //                 ],
    //                 [
    //                     'title' => __('validation.attributes.item'),
    //                     'url' => route('Item.view'),
    //                     'route-name' => '/Item/view',
    //                     'icon' => 'fa fa-microchip',
    //                     'visible' => true
    //                 ],
    //                 [
    //                     'title' => __('validation.attributes.eventual'),
    //                     'url' => route('Eventual.view'),
    //                     'route-name' => '/Eventual/view',
    //                     'icon' => 'fa fa-id-card',
    //                     'visible' => true
    //                 ],
    //                 [
    //                     'title' => __('validation.attributes.consultor'),
    //                     'url' => route('Consultor.view'),
    //                     'route-name' => '/Consultor/view',
    //                     'icon' => 'fa fa-microchip',
    //                     'visible' => true
    //                 ],
    //                 [
    //                     'title' => __('validation.attributes.destinado'),
    //                     'url' => route('Destinado.view'),
    //                     'route-name' => '/Destinado/view',
    //                     'icon' => 'fa fa-microchip',
    //                     'visible' => true
    //                 ],
    //             ],
    //         ],
    //         [
    //             'icon' => 'fa fa-file-pdf',
    //             'title' => __('validation.attributes.reportes'),
    //             'url' => '#',
    //             'route-name' => '#',
    //             'visible' => true,
    //         ],
    //         [
    //             'icon' => 'fa fa-book',
    //             'title' => __('validation.attributes.manual'),
    //             'url' => '#',
    //             'route-name' => '#',
    //             'visible' => true,
    //         ],
    //     ];
    // }
    // elseif (Auth::user()->Rol == 3 && Auth::user()->Tipo->idTipoContrato == 1) {
    //     return [
    //         [
    //             'title' => __('validation.attributes.actualizardatos'),
    //             'url' => route('Persona.view'),
    //             'route-name' => '/Persona/view',
    //             'icon' => 'fa fa-street-view',
    //             'visible' => true
    //         ],
    //         [
    //             'title' => __('validation.attributes.subirdocumentos'),
    //             'url' => route('Item.view'),
    //             'route-name' => '/Item/view',
    //             'icon' => 'fa fa-cloud-upload',
    //             'visible' => true
    //         ],
    //         [
    //             'icon' => 'fa fa-book',
    //             'title' => __('validation.attributes.manual'),
    //             'url' => '#',
    //             'route-name' => '#',
    //             'visible' => true,
    //         ],
    //     ];
    // }
    // elseif (Auth::user()->cargo_id == 3 && Auth::user()->Tipo->idTipoContrato == 2) {
    //     return [
    //         [
    //             'title' => __('validation.attributes.actualizardatos'),
    //             'url' => route('Persona.view'),
    //             'route-name' => '/Persona/view',
    //             'icon' => 'fa fa-street-view',
    //             'visible' => true
    //         ],
    //         [
    //             'title' => __('validation.attributes.subirdocumentos'),
    //             'url' => route('Eventual.view'),
    //             'route-name' => '/Eventual/view',
    //             'icon' => 'fa fa-cloud-upload',
    //             'visible' => true
    //         ],
    //         [
    //             'icon' => 'fa fa-book',
    //             'title' => __('validation.attributes.manual'),
    //             'url' => '#',
    //             'route-name' => '#',
    //             'visible' => true,
    //         ],
    //     ];
    // }
    // elseif (Auth::user()->cargo_id == 3 && Auth::user()->Tipo->idTipoContrato == 3) {
    //     return [
    //         [
    //             'title' => __('validation.attributes.actualizardatos'),
    //             'url' => route('Persona.view'),
    //             'route-name' => '/Persona/view',
    //             'icon' => 'fa fa-street-view',
    //             'visible' => true
    //         ],
    //         [
    //             'title' => __('validation.attributes.subirdocumentos'),
    //             'url' => route('Consultor.view'),
    //             'route-name' => '/Consultor/view',
    //             'icon' => 'fa fa-cloud-upload',
    //             'visible' => true
    //         ],
    //         [
    //             'icon' => 'fa fa-book',
    //             'title' => __('validation.attributes.manual'),
    //             'url' => '#',
    //             'route-name' => '#',
    //             'visible' => true,
    //         ],
    //     ];
    // }
    // elseif (Auth::user()->cargo_id == 3 && Auth::user()->Tipo->idTipoContrato == 5) {
    //     return [
    //         [
    //             'title' =>  __('validation.attributes.actualizardatos'),
    //             'url' => route('Persona.view'),
    //             'route-name' => '/Persona/view',
    //             'icon' => 'fa fa-street-view',
    //             'visible' => true
    //         ],
    //         [
    //             'title' => __('validation.attributes.subirdocumentos'),
    //             'url' => route('Destinado.view'),
    //             'route-name' => '/Destinado/view',
    //             'icon' => 'fa fa-cloud-upload',
    //             'visible' => true
    //         ],
    //         [
    //             'icon' => 'fa fa-book',
    //             'title' => __('validation.attributes.manual'),
    //             'url' => '#',
    //             'route-name' => '#',
    //             'visible' => true,
    //         ],
    //     ];
    // }
    //     return [
    //         [
    //             'title' =>  __('validation.attributes.actualizardatos'),
    //             'url' => route('Persona.view'),
    //             'route-name' => '/Persona/view',
    //             'icon' => 'fa fa-street-view',
    //             'visible' => true
    //         ],
    //         [
    //             'title' => __('validation.attributes.subirdocumentos'),
    //             'url' => route('Destinado.view'),
    //             'route-name' => '/Destinado/view',
    //             'icon' => 'fa fa-cloud-upload',
    //             'visible' => true
    //         ],
    //         [
    //             'icon' => 'fa fa-book',
    //             'title' => __('validation.attributes.manual'),
    //             'url' => '#',
    //             'route-name' => '#',
    //             'visible' => true,
    //         ],
    //     ];
}

<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */
    "accepted"         => ":attribute debe ser aceptado.",
    "active_url"       => ":attribute no es una URL válida.",
    "after"            => ":attribute debe ser una fecha posterior a :date.",
    "alpha"            => ":attribute solo debe contener letras.",
    "alpha_dash"       => ":attribute solo debe contener letras, números y guiones.",
    "alpha_num"        => ":attribute solo debe contener letras y números.",
    "array"            => ":attribute debe ser un conjunto.",
    "before"           => ":attribute debe ser una fecha anterior a :date.",
    "between"          => [
        "numeric" => ":attribute tiene que estar entre :min - :max.",
        "file"    => ":attribute debe pesar entre :min - :max kilobytes.",
        "string"  => ":attribute tiene que tener entre :min - :max caracteres.",
        "array"   => ":attribute tiene que tener entre :min - :max ítems.",
    ],
    "boolean"          => "El campo :attribute debe tener un valor verdadero o falso.",
    "confirmed"        => "La confirmación de :attribute no coincide.",
    "date"             => ":attribute no es una fecha válida.",
    "date_format"      => ":attribute no corresponde al formato :format.",
    "different"        => ":attribute y :other deben ser diferentes.",
    "digits"           => ":attribute debe tener :digits dígitos.",
    "digits_between"   => ":attribute debe tener entre :min y :max dígitos.",
    "email"            => ":attribute no es un correo válido",
    "exists"           => ":attribute es inválido.",
    "filled"           => "El campo :attribute es obligatorio.",
    "image"            => ":attribute debe ser una imagen.",
    "in"               => ":attribute es inválido.",
    "integer"          => ":attribute debe ser un número entero.",
    "ip"               => ":attribute debe ser una dirección IP válida.",
    "max"              => [
        "numeric" => ":attribute no debe ser mayor a :max.",
        "file"    => ":attribute no debe ser mayor que :max kilobytes.",
        "string"  => ":attribute no debe ser mayor que :max caracteres.",
        "array"   => ":attribute no debe tener más de :max elementos.",
    ],
    "mimes"            => ":attribute debe ser un archivo con formato: :values.",
    "min"              => [
        "numeric" => "El tamaño de :attribute debe ser de al menos :min.",
        "file"    => "El tamaño de :attribute debe ser de al menos :min kilobytes.",
        "string"  => ":attribute debe contener al menos :min caracteres.",
        "array"   => ":attribute debe tener al menos :min elementos.",
    ],
    "not_in"           => ":attribute es inválido.",
    "numeric"          => ":attribute debe ser numérico.",
    "regex"            => "El formato de :attribute es inválido.",
    "required"         => "El campo :attribute es obligatorio.",
    "required_if"      => "El campo :attribute es obligatorio cuando :other es :value.",
    "required_with"    => "El campo :attribute es obligatorio cuando :values está presente.",
    "required_with_all" => "El campo :attribute es obligatorio cuando :values está presente.",
    "required_without" => "El campo :attribute es obligatorio cuando :values no está presente.",
    "required_without_all" => "El campo :attribute es obligatorio cuando ninguno de :values estén presentes.",
    "same"             => ":attribute y :other deben coincidir.",
    "size"             => [
        "numeric" => "El tamaño de :attribute debe ser :size.",
        "file"    => "El tamaño de :attribute debe ser :size kilobytes.",
        "string"  => ":attribute debe contener :size caracteres.",
        "array"   => ":attribute debe contener :size elementos.",
    ],
    "timezone"          => "El :attribute debe ser una zona válida.",
    "unique"            => ":attribute ya ha sido registrado.",
    "url"               => "El formato :attribute es inválido.",
    "before_or_equal"   => "El campo :attribute debe ser una fecha antes o igual a :date.",
    "after_or_equal"    => "El campo :attribute debe ser una fecha después o igual a :date.",
    "recaptcha"         => "El campo :attribute no es correcto.",
    "captcha"           => "El campo :attribute no es correcto.",
    "present"           => "El campo :attribute debe estar presente",
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */
    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */
    'attributes' => [
        /************************ Charlie **************/
        'usuario'               => 'Usuario',
        'password'              => 'Contraseña',
        'persona'               => 'Persona',
        'ci'                    => 'Carnet de Identidad',
        'complemento'           => 'Complemento',
        'expedido_id'           => 'Expedido',
        'correo'                => 'Correo Electrónico',
        'fecha_nacimiento'      => 'Fecha de Nacimiento',
        'lugar_nacimiento_id'      => 'Lugar de Nacimiento',
        'telefono'              => 'Teléfono',
        'paterno'               => 'Apellido Paterno',
        'materno'               => 'Apellido Materno',
        'nombres'               => 'Nombres',
        'acciones'              => 'Acciones',
        'estado'                => 'Estado',
        'usuarios'              => 'Usuarios',
        'usuario_id'            => 'Usuario',
        'rol'                   => 'Rol',
        'roles'                 => 'Roles',
        'rol_id'                => 'Rol',
        'cargo'                 => 'Cargo',
        'cargos'                => 'Cargos',
        'cargo_id'              => 'Cargo',
        'persona_id'            => 'Persona',
        'foto'                  => 'Foto',
        'firma_digital'          => 'Firma Digital',
        'manual'                => 'Manual Usuario',
        'proveido'              => 'Proveido',


        'personal'              => 'Personal',
        'eventual'              => 'Eventual',
        'item'              => 'Item',
        'destinado'              => 'Destinado',
        'consultor'              => 'Consultor',
        'unidad'                => 'Unidad',
        'nivelSalario'          => 'Nivel Salarial',
        'nivelAcademico'                 => 'Nivel Academico',
        'grado'                 => 'Grado',
        'tipoContrato'          => 'Tipo Contrato',
        'parentezco'            => 'Parentezco',
        'documento'             => 'Documento',
        'tipoDocumento'         => 'Tipo Documento',
        'partesDocumento'        => 'Incisos Documentacion',
        'estadoDocumento'       => 'Estado Documento',
        'reparticion'           => 'Reparticion',
        'escala'                => 'Escala Salarial',
        'nivel'                 => 'Nivel Academico',
        'tipocontrato'          => 'Tipo Contrato',
        'parentesco'            => 'Tipo de Parentesco',
        'tipo'                  => 'Tipo de Contrato',
        'prioridad'             => 'Prioridad',
        'reparticiones'         => 'Reparticion',
        'reportes'              => 'Reportes',
        'actualizardatos'       => 'Actualizar Datos',
        'subirdocumentos'            => 'Subir Documentacion',

        'banner'                => 'Banner',
        'producto'              => 'Producto',
        'contacto'              => 'Contacto',
        'noticia'               => 'Noticia',
        'video'                 => 'Video',
        'zafra'                 => 'Zafra',
        'vehiculo'              => 'Vehiculo',
        'zafrero'           => 'Zafrero',
        'reporte'           => 'Reporte',
        'reporteFechas'     => 'Reporte Fechas',
        'reporteZafrero'     => 'Reporte Zafrero',
        'reporteVehiculo'     => 'Reporte Vehiculo',
        'variables'         => 'Parametros Sistema',
    ],

    /* para los valores */
    'values' => [
        'type_family' => [
            '33'    => 'Cónyuge'
        ],
        'familytype_id' => [
            '33'    => 'Cónyuge'
        ]
    ],
];

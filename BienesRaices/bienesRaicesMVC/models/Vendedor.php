<?php

namespace Model;

class Vendedor extends ActiveRecord{
    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }

    public function validar() {
        
        if(!$this->nombre) {
            self::$errores[] = "Nombre Obligatorio";
        }
        // if(!preg_match( '/^[a-z\d_]{4,15}$/i', $this->nombre)) {
        //     self::$errores[] = "Nombre con formato no válido";    
        // }
        if(!$this->apellido) {
            self::$errores[] = "Apellido Obligatorio";
        }
        // if(!preg_match( '/^[a-z\d_]{4,15}$/i', $this->apellido)) {
        //     self::$errores[] = "Apellido con formato no válido";    
        // }
        if(!$this->telefono) {
            self::$errores[] = "Teléfono Obligatorio";
        }
        if(!preg_match( '/^\+?\d{1,3}?[- .]?\(?(?:\d{2,3})\)?[- .]?\d\d\d[- .]?\d\d\d\d$/', $this->telefono)) {
            self::$errores[] = "Teléfono con formato no válido";    
        }
        return self::$errores;
    }
}
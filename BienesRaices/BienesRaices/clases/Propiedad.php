<?php
declare (strict_types = 1);

namespace App;

class Propiedad extends ActiveRecord {
   
   protected static $tabla = 'propiedades';
   protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];

   public $id;
   public $titulo;
   public $precio;
   public $imagen;
   public $descripcion;
   public $habitaciones;
   public $wc;
   public $estacionamiento;
   public $creado;
   public $vendedorId;

   public function __construct($args = [])
   {
       $this->id = $args['id'] ?? null;
       $this->titulo = $args['titulo'] ?? '';
       $this->precio = $args['precio'] ?? '';
       $this->imagen = $args['imagen'] ?? '';
       $this->descripcion = $args['descripcion'] ?? '';
       $this->habitaciones = $args['habitaciones'] ?? '';
       $this->wc = $args['wc'] ?? '';
       $this->estacionamiento = $args['estacionamiento'] ?? '';
       $this->creado = date('Y/m/d');
       $this->vendedorId = $args['vendedorId'] ?? '';

   }

   // ___Validación___

   public function validar() {
      
      if(!$this->titulo) {
            self::$errores[] = "Debes añadir un título";
      }
      if(!$this->precio) {
            self::$errores[] = "El precio es obligatorio";
      }
      if (strlen( $this->descripcion ) < 20) {
            self::$errores[] = "La descripción es obligatoria y 20 caracteres mínimo";
      }
      if(!$this->habitaciones) {
            self::$errores[] = "Debes indicar el número de habitaciones";
      }
      if(!$this->wc) {
            self::$errores[] = "Debes indicar el número de baños";
      }
      if(!$this->estacionamiento) {
            self::$errores[] = "Debes indicar el número de plazas de garage";
      }
      if(!$this->vendedorId) {
            self::$errores[] = "Debes elegir un vendedor";
      }
      if (!$this->imagen) {
            self::$errores[] = "La imagen de la propiedad es obligatoria";
      }

      return self::$errores;
   }

}
<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{

    public static function producto_Listar($arrayCampos = [])
    {
        $Resultado = DB::select("
            SELECT * FROM productos
            WHERE eliminado = '0'
            ORDER BY (CASE WHEN productos.date_create > productos.date_update THEN productos.date_create ELSE productos.date_update END) DESC
            LIMIT :item, :totreg
        ", $arrayCampos);
        return $Resultado;
    }


    public static function codigo_Producto_Existe($arrayCampos = [])
    {
        $Resultado = DB::selectOne("
            SELECT count(cod_product) as tot_reg 
            FROM productos 
            WHERE eliminado = '0'
            AND cod_product = :cod_product
        ", $arrayCampos);
        return $Resultado;
    }

    public static function name_Producto_Existe($arrayCampos = [])
    {
        $Resultado = DB::selectOne("
            SELECT count(name) as tot_reg 
            FROM productos 
            WHERE eliminado = '0'
            AND name = :name
        ", $arrayCampos);
        return $Resultado;
    }

    public static function name_Producto_Existe_in_Edit($arrayCampos = [])
    {
        $Resultado = DB::selectOne("
            SELECT count(name) as tot_reg 
            FROM productos 
            WHERE eliminado = '0'
            AND name = :name
            AND cod_product != :cod_product
        ", $arrayCampos);
        return $Resultado;
    }


     public static function registrar_producto($arrayCampos = [])
    {
        $Resultado = DB::insert("

            INSERT INTO productos (
                cod_product,
                idiomas_id,
                eliminado,
                date_create,
                date_update,
                date_delete,
                name,
                stock,
                is_offer,
                short_description,
                long_description,
                tags,
                alias_url,
                days_min_service,
                tmp_codigo_fabricante,
                cod_marca,
                oferta,
                garantia,
                banner,
                novedad,
                banner_2,
                promocion,
                especificaciones,
                cod_categoria,
                cod_subcategoria,
                estado_detalle
            ) VALUES(
                :cod_product,
                :idiomas_id,
                '0',
                NOW(),
                STR_TO_DATE('01-01-0000 00:00:00','%m-%d-%Y %H:%i:%s'),
                STR_TO_DATE('01-01-0000 00:00:00','%m-%d-%Y %H:%i:%s'),
                :name,
                :stock,
                :is_offer,
                :short_description,
                :long_description,
                :tags,
                :alias_url,
                :days_min_service,
                :tmp_codigo_fabricante,
                :cod_marca,
                :oferta,
                :garantia,
                :banner,
                :novedad,
                :banner_2,
                :promocion,
                :especificaciones,
                :cod_categoria,
                :cod_subcategoria,
                :estado_detalle
            )
        ", $arrayCampos);

        return $Resultado;
    }


    public static function mostrar_Producto_ById($arrayCampos = [])
    {
        $Resultado = DB::selectOne("
            SELECT * FROM productos 
            WHERE eliminado = '0' AND cod_product = :cod_product
        ", $arrayCampos);
        return $Resultado;
    }



    public static function actualizar_producto($arrayCampos = [])
    {
        $Resultado = DB::update("
            UPDATE productos SET
                idiomas_id          = :idiomas_id,
                date_update         = NOW(),
                name                = :name,
                stock               = :stock,
                is_offer            = :is_offer,
                short_description   = :short_description,
                long_description    = :long_description,
                tags                = :tags,
                alias_url           = :alias_url,
                days_min_service    = :days_min_service,
                tmp_codigo_fabricante = :tmp_codigo_fabricante,
                cod_marca           = :cod_marca,
                oferta              = :oferta,
                garantia            = :garantia,
                banner              = :banner,
                novedad             = :novedad,
                banner_2            = :banner_2,
                promocion           = :promocion,
                especificaciones    = :especificaciones,
                cod_categoria       = :cod_categoria,
                cod_subcategoria    = :cod_subcategoria,
                estado_detalle      = :estado_detalle
            WHERE cod_product       = :cod_product
        ", $arrayCampos);

        return $Resultado;
    }


    public static function eliminar_producto($arrayCampos = [])
    {
        $Resultado = DB::update("
            UPDATE productos SET
                eliminado      = '1',
                date_delete    = NOW()
            WHERE cod_product  = :cod_product
        ", $arrayCampos);

        return $Resultado;
    }


    public static function atributosProd_Listar_ByIdProd($arrayCampos = [])
    {
        $Resultado = DB::select("
            SELECT * FROM atributos_de_producto 
            WHERE id_producto = :id_producto AND eliminado = '1'
        ", $arrayCampos);
        return $Resultado;
    }



}

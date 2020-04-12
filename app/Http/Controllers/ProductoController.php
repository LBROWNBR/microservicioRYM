<?php

namespace App\Http\Controllers;

use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ProductoController extends Controller
{

    public function index()
    {
        $respuesta = "<center><h1><u>Multiservicio Producto</u></h1></center>";
        return $respuesta;
   
    }


    public function list($item, $totreg)
    {
        $data = array();

        $item   = ($item>0) ? $item : '0';
        $totreg = ($totreg>0) ? $totreg : '15';

        $limit = ['item' => $item, 'totreg' => $totreg];
     
        $data = Producto::producto_Listar($limit);

        if (!$data){
            return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra registros.'])],404);
        }

        return response()->json(['status'=>'ok','data'=>$data],200);
    }



    public function store(Request $request)
    {
        $data = array();

        $cod_product = $request->input('cod_product');
        $idiomas_id = $request->input('idiomas_id');
        $name = $request->input('name');
        $stock = $request->input('stock');
        $is_offer = $request->input('is_offer');
        $short_description = $request->input('short_description');
        $long_description = $request->input('long_description');
        $tags = $request->input('tags');
        $alias_url = $request->input('alias_url');
        $days_min_service = $request->input('days_min_service');
        $tmp_codigo_fabricante = $request->input('tmp_codigo_fabricante');
        $cod_marca = $request->input('cod_marca');
        $oferta = $request->input('oferta');
        $garantia = $request->input('garantia');
        $banner = $request->input('banner');
        $novedad = $request->input('novedad');
        $banner_2 = $request->input('banner_2');
        $promocion = $request->input('promocion');
        $especificaciones = $request->input('especificaciones');
        $cod_categoria = $request->input('cod_categoria');
        $cod_subcategoria = $request->input('cod_subcategoria');
        $estado_detalle = $request->input('estado_detalle');


        $arrayCampos = [
            'cod_product' => $cod_product, 
            'idiomas_id' => $idiomas_id,
            'name' => $name,
            'stock' => $stock,
            'is_offer' => $is_offer,
            'short_description' => $short_description,
            'long_description' => $long_description,
            'tags' => $tags,
            'alias_url' => $alias_url,
            'days_min_service' => $days_min_service,
            'tmp_codigo_fabricante' => $tmp_codigo_fabricante,
            'cod_marca' => $cod_marca,
            'oferta' => $oferta,
            'garantia' => $garantia,
            'banner' => $banner,
            'novedad' => $novedad,
            'banner_2' => $banner_2,
            'promocion' => $promocion,
            'especificaciones' => $especificaciones,
            'cod_categoria' => $cod_categoria,
            'cod_subcategoria' => $cod_subcategoria,
            'estado_detalle' => $estado_detalle
        ];
        

        if ($cod_product == null || $idiomas_id == null || $name == null || $long_description == null || $stock == null || $oferta == null || $banner == null || $novedad == null || $banner_2 == null || $promocion == null )
        {

            return response()->json(['errors'=>array(['code'=>422,'message'=>'Datos necesarios para el registro del producto son: (cod_product, idiomas_id, name, long_description, stock, oferta, banner, novedad, banner_2, promocion)'])],422);
        }
      

        $existeCod  = Producto::codigo_Producto_Existe(['cod_product' => $cod_product]);

        if($existeCod->tot_reg > 0){  
            return response()->json(['errors'=>array(['code'=>504,'message'=>'El código del producto ya existe.'])],504);
        }


        $existeName = Producto::name_Producto_Existe(['name' => $name]);
        if($existeName->tot_reg > 0){
            return response()->json(['errors'=>array(['code'=>504,'message'=>'El nombre del producto ya existe.'])],504);
        }
        

        $registro = Producto::registrar_producto($arrayCampos);

        if(!$registro){
            return response()->json(['errors'=>array(['code'=>304,'message'=>'No se registro producto.'])],304);
        }

        $producto = Producto::mostrar_Producto_ById(['cod_product' => $cod_product]);                   

        return response()->json(['status'=>'ok','data'=>$producto], 200);

    }




    public function show($codigo)
    {
        $data = array();

        $codigo   = ($codigo>0) ? $codigo : '0';
     
        $data['cabecera'] = Producto::mostrar_Producto_ById(['cod_product' => $codigo]);
        $data['detalle'] = Producto::atributosProd_Listar_ByIdProd(['id_producto' => $codigo]);

        if (!$data){
            return response()->json(['errors'=>array(['code'=>404,'message'=>'No existe información con este código.'])],404);
        }

        return response()->json(['status'=>'ok','data'=>$data],200);
    }




    public function update(Request $request)
    {
        $data = array();

        $cod_product = $request->input('cod_product');
        $idiomas_id = $request->input('idiomas_id');
        $eliminado = $request->input('eliminado');
        $name = $request->input('name');
        $stock = $request->input('stock');
        $is_offer = $request->input('is_offer');
        $short_description = $request->input('short_description');
        $long_description = $request->input('long_description');
        $tags = $request->input('tags');
        $alias_url = $request->input('alias_url');
        $days_min_service = $request->input('days_min_service');
        $tmp_codigo_fabricante = $request->input('tmp_codigo_fabricante');
        $cod_marca = $request->input('cod_marca');
        $oferta = $request->input('oferta');
        $garantia = $request->input('garantia');
        $banner = $request->input('banner');
        $novedad = $request->input('novedad');
        $banner_2 = $request->input('banner_2');
        $promocion = $request->input('promocion');
        $especificaciones = $request->input('especificaciones');
        $cod_categoria = $request->input('cod_categoria');
        $cod_subcategoria = $request->input('cod_subcategoria');
        $estado_detalle = $request->input('estado_detalle');


        $arrayCampos = [
            'cod_product' => $cod_product, 
            'idiomas_id' => $idiomas_id,
            'name' => $name,
            'stock' => $stock,
            'is_offer' => $is_offer,
            'short_description' => $short_description,
            'long_description' => $long_description,
            'tags' => $tags,
            'alias_url' => $alias_url,
            'days_min_service' => $days_min_service,
            'tmp_codigo_fabricante' => $tmp_codigo_fabricante,
            'cod_marca' => $cod_marca,
            'oferta' => $oferta,
            'garantia' => $garantia,
            'banner' => $banner,
            'novedad' => $novedad,
            'banner_2' => $banner_2,
            'promocion' => $promocion,
            'especificaciones' => $especificaciones,
            'cod_categoria' => $cod_categoria,
            'cod_subcategoria' => $cod_subcategoria,
            'estado_detalle' => $estado_detalle
        ];
        

        if ($cod_product == null || $idiomas_id == null || $name == null || $long_description == null || $stock == null || $oferta == null || $banner == null || $novedad == null || $banner_2 == null || $promocion == null )
        {

            return response()->json(['errors'=>array(['code'=>422,'message'=>'Datos necesarios para el registro del producto son: (cod_product, idiomas_id, name, long_description, stock, oferta, banner, novedad, banner_2, promocion)'])],422);
        }
      

        $existeCod  = Producto::codigo_Producto_Existe(['cod_product' => $cod_product]);

        if($existeCod->tot_reg == '0'){  
            return response()->json(['errors'=>array(['code'=>504,'message'=>'El código del producto no existe.'])],504);
        }


        $existeName = Producto::name_Producto_Existe_in_Edit(['name' => $name, 'cod_product' => $cod_product]);
        if($existeName->tot_reg > 0){
            return response()->json(['errors'=>array(['code'=>504,'message'=>'El nombre del producto ya existe.'])],504);
        }
        

        $actualizar = Producto::actualizar_producto($arrayCampos);

        if(!$actualizar){
            return response()->json(['errors'=>array(['code'=>304,'message'=>'No se ha actualizado el  producto.'])],304);
        }

        $producto = Producto::mostrar_Producto_ById(['cod_product' => $cod_product]);                   

        return response()->json(['status'=>'ok','data'=>$producto], 200);

    }


    public function destroy($codigo)
    {
        $data = array();

        $codigo   = ($codigo>0) ? $codigo : '0';
     
        $data = Producto::mostrar_Producto_ById(['cod_product' => $codigo]);
        if (!$data){
            return response()->json(['errors'=>array(['code'=>404,'message'=>'No existe información con este código.'])],404);
        }


        $eliminar = Producto::eliminar_producto(['cod_product' => $codigo]);

        if($eliminar == '1'){
            return response()->json(['status'=>'ok','data'=>'Se ha eliminado el producto correctamente.'], 200);    
        }else{
            return response()->json(['errors'=>array(['code'=>304,'message'=>'No se ha eliminado el  producto.'])],304);
        }
        
        
    }




}
